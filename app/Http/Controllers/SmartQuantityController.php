<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Contact;
use App\Services\SmartQuantityService;
use App\Transaction;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SmartQuantityController extends Controller
{
    protected $smartQuantityService;
    protected $commonUtil;
    protected $transactionUtil;

    public function __construct(
        SmartQuantityService $smartQuantityService,
        Util $commonUtil,
        TransactionUtil $transactionUtil
    ) {
        $this->smartQuantityService = $smartQuantityService;
        $this->commonUtil = $commonUtil;
        $this->transactionUtil = $transactionUtil;
    }

    /**
     * Handle bulk processing of low stock alerts
     */
    public function bulkProcess(Request $request)
    {
        try {
            $items = $request->input('items', []); // Array of {variation_id, quantity}
            $business_id = request()->session()->get('user.business_id');
            $user_id = auth()->user()->id;
            
            // We need a default location. For now, pick the first one the user has access to.
            // Ideally, the user should select this in the modal, but to automate:
            $business_locations = BusinessLocation::forDropdown($business_id);
            $location_id = array_key_first($business_locations->toArray());

            if (empty($items)) {
                return response()->json(['success' => false, 'msg' => __('messages.no_items_selected')]);
            }

            // Group items by supplier
            $supplier_groups = [];
            $no_supplier_items = [];

            foreach ($items as $item) {
                $variation_id = $item['variation_id'];
                $quantity = $item['quantity'];

                $supplier = $this->smartQuantityService->getBestSupplier($variation_id);

                if ($supplier) {
                    $supplier_id = $supplier['supplier_id'];
                    if (!isset($supplier_groups[$supplier_id])) {
                        $supplier_groups[$supplier_id] = [];
                    }
                    $supplier_groups[$supplier_id][] = [
                        'variation_id' => $variation_id,
                        'quantity' => $quantity,
                        'unit_price' => $supplier['unit_price']
                    ];
                } else {
                    $no_supplier_items[] = [
                        'variation_id' => $variation_id,
                        'quantity' => $quantity
                    ];
                }
            }

            DB::beginTransaction();
            
            $created_pos = 0;
            $created_prs = 0;

            // 1. Create Purchase Orders (Draft) for each supplier group
            foreach ($supplier_groups as $supplier_id => $group_items) {
                $this->createPurchaseOrder($business_id, $location_id, $supplier_id, $group_items, $user_id);
                $created_pos++;
            }

            // 2. Report skipped items (no supplier)
            $skipped_count = count($no_supplier_items);

            DB::commit();

            $msg = __('messages.bulk_po_success', ['count' => $created_pos]);
            if ($skipped_count > 0) {
                $msg .= " " . __('messages.items_skipped_no_supplier', ['count' => $skipped_count]);
            }
            
            return response()->json(['success' => true, 'msg' => $msg]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return response()->json(['success' => false, 'msg' => __('messages.error_prefix') . $e->getMessage()]);
        }
    }

    protected function createPurchaseOrder($business_id, $location_id, $supplier_id, $items, $user_id)
    {
        $transaction_data = [
            'business_id' => $business_id,
            'location_id' => $location_id,
            'type' => 'purchase',
            'status' => 'draft',
            'contact_id' => $supplier_id,
            'created_by' => $user_id,
            'transaction_date' => \Carbon::now()->toDateTimeString(),
            'total_before_tax' => 0,
            'tax_amount' => 0,
            'final_total' => 0,
        ];

        //Update reference count
        $ref_count = $this->commonUtil->setAndGetReferenceCount('purchase');
        //Generate reference number
        if (empty($transaction_data['ref_no'])) {
            $transaction_data['ref_no'] = $this->commonUtil->generateReferenceNumber('purchase', $ref_count);
        }

        $transaction = Transaction::create($transaction_data);

        $purchase_lines = [];
        $total_amount = 0;

        foreach ($items as $item) {
            $product_data = DB::table('variations')
                        ->join('products', 'variations.product_id', '=', 'products.id')
                        ->where('variations.id', $item['variation_id'])
                        ->select('products.id as product_id')
                        ->first();

            $unit_price = $item['unit_price'];
            $line_total = $item['quantity'] * $unit_price;
            $total_amount += $line_total;

            $purchase_lines[] = [
                'transaction_id' => $transaction->id,
                'product_id' => $product_data->product_id,
                'variation_id' => $item['variation_id'],
                'quantity' => $item['quantity'],
                'pp_without_discount' => $unit_price,
                'purchase_price' => $unit_price,
                'purchase_price_inc_tax' => $unit_price, 
                'item_tax' => 0, 
            ];
        }

        $transaction->purchase_lines()->createMany($purchase_lines);
        $transaction->final_total = $total_amount;
        $transaction->save();

        return $transaction;
    }
}
