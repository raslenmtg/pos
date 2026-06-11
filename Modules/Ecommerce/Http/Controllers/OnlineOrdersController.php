<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\TransactionSellLine;
use Illuminate\Support\Facades\Log;
use App\Contact;
use App\Transaction;
use App\Utils\ContactUtil;
use App\Utils\ProductUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OnlineOrdersController extends Controller
{
    protected $transactionUtil;
    protected $productUtil;
    protected $contactUtil;
    public function __construct(Util $transactionUtil,
                                ProductUtil $productUtil,
                                ContactUtil $contactUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->productUtil = $productUtil;
        $this->contactUtil = $contactUtil;
    }

    public function index(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        if ($request->ajax()) {
            $orders = Transaction::where('transactions.business_id', $business_id)
                ->where('transactions.type', 'sell')
                ->where('transactions.status', 'online')
                ->leftJoin('contacts', 'transactions.contact_id', '=', 'contacts.id')
                ->select([
                    'transactions.id',
                    'transactions.ref_no',
                    'transactions.final_total',
                    'transactions.shipping_status',
                    'transactions.additional_notes',
                    'transactions.created_at',
                    'contacts.name as contact_name',
                    'contacts.mobile as contact_phone',
                ])
                ->latest('transactions.created_at');

            return DataTables::of($orders)
                ->addColumn('customer', function ($row) {
                    $info = json_decode($row->additional_notes, true) ?? [];
                    $name  = $info['customer_name']  ?? $row->contact_name ?? '—';
                    $phone = $info['customer_phone'] ?? $row->contact_phone ?? '—';
                    $addr  = $info['customer_address'] ?? '';
                    return "<strong>{$name}</strong><br><small>{$phone}</small><br><small class='text-muted'>{$addr}</small>";
                })
                ->addColumn('total', function ($row) {
                    return number_format($row->final_total, 2).' DT';
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y H:i') : '—';
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-xs btn-danger btn-delete-order" data-id="'.$row->id.'"><i class="fa fa-trash"></i> Supprimer</button> '
                        .'<button class="btn btn-xs btn-info btn-show-order" data-id="'.$row->id.'"><i class="fa fa-eye"></i> Voir</button> '
                        .'<button class="btn btn-xs btn-success btn-finalize-order" data-id="'.$row->id.'"><i class="fa fa-check"></i> Finaliser</button>';
                })
                ->rawColumns(['customer', 'shipping', 'actions'])
                ->make(true);
        }

        $shipping_statuses = $this->transactionUtil->shipping_statuses();

        return view('ecommerce::orders.index', compact('shipping_statuses'));
    }

    public function show(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');

        $transaction = Transaction::where('business_id', $business_id)
            ->where('status', 'online')
            ->with(['sell_lines.product', 'sell_lines.variations'])
            ->findOrFail($id);

        $contact = Contact::find($transaction->contact_id);
        $info = json_decode($transaction->additional_notes, true) ?? [];

        return view('ecommerce::orders.show_modal', compact('transaction', 'contact', 'info'));
    }

    public function delete(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');
        TransactionSellLine::where('transaction_id', $id)->delete();
        Transaction::where('business_id', $business_id)
            ->where('id', $id)
            ->where('status', 'online')
            ->delete();
        return Response()->json(['success' => true, 'message' => 'Commande supprimée avec succès']);
    }

    public function finalize(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');

        $transaction = Transaction::where('business_id', $business_id)
            ->where('status', 'online')
            ->findOrFail($id);

        $info = json_decode($transaction->additional_notes, true) ?? [];

        DB::beginTransaction();
        try {
            $contact = Contact::firstOrCreate(
                ['mobile' => $request->customer_phone, 'business_id' => $business_id],
                [
                    'name'         => $info['customer_name'],
                    'type'         => 'customer',
                    'contact_type'         => 'individual',
                    'contact_id'         => $this->contactUtil->generateReferenceNumber('contacts', $this->contactUtil->setAndGetReferenceCount('contacts', $business_id), $business_id),
                    'mobile' => $info['customer_phone'],
                    'address_line_1' => $info['customer_address'],
                    'created_by'   => $request->session()->get('user.id'),
                ]
            );
            $shipping_status = $request->input('shipping_status', 'ordered');
            $transaction->update([
                'status'          => 'final',
                'shipping_status' => $shipping_status,
                'shipping_address' => $info['customer_address'],
                'contact_id'=>$contact->id,
                'additional_notes'=>null
            ]);

            $location_id = $transaction->location_id;

            foreach ($transaction->sell_lines as $sell_line) {
                $product = $sell_line->product;
                $variation = $sell_line->variations;

                $decrease_qty = $sell_line->quantity;

                if ($product->enable_stock) {
                    $this->productUtil->decreaseProductQuantity(
                        $product->id,
                        $variation->id ?? null,
                        $location_id,
                        $decrease_qty
                    );
                }

                if ($product->type == 'combo') {
                    $product_combo = array_map(function ($item) use ($product) {
                        $item['product_id'] = $product->id;
                        return $item;
                    }, $variation->combo_variations);
                    $this->productUtil->decreaseProductQuantityCombo(
                        $product_combo,
                        $location_id
                    );
                }
            }


            DB::commit();
            return response()->json(['success' => true, 'message' => 'Commande finalisée avec succès.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
