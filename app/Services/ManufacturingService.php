<?php

namespace App\Services;

use App\MfgWorkOrder;
use App\Transaction;
use App\TransactionSellLine;
use App\TransactionSellLinesPurchaseLines;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Variation;
use Illuminate\Support\Facades\DB;

class ManufacturingService
{
    protected $productUtil;

    protected $transactionUtil;

    public function __construct(ProductUtil $productUtil, TransactionUtil $transactionUtil)
    {
        $this->productUtil = $productUtil;
        $this->transactionUtil = $transactionUtil;
    }

    public function completeWorkOrder(MfgWorkOrder $workOrder, $user_id, $accounting_method)
    {
        try {
            DB::beginTransaction();

            $workOrder->loadMissing(['recipe.finishedVariation', 'ingredients']);

            // Validate stock before consumption.
            foreach ($workOrder->ingredients as $ingredient) {
                $product_details = $this->productUtil->getDetailsFromVariation(
                    $ingredient->variation_id,
                    $workOrder->business_id,
                    $workOrder->location_id
                );
                if (empty($product_details) || (float) $product_details->qty_available < (float) $ingredient->required_quantity) {
                    DB::rollBack();

                    return [
                        'success' => 0,
                        'msg' => __('manufacture.insufficient_ingredient_stock'),
                    ];
                }
            }

            $consumption = Transaction::create([
                'business_id' => $workOrder->business_id,
                'location_id' => $workOrder->location_id,
                'type' => 'production_sell',
                'status' => 'final',
                'payment_status' => 'paid',
                'contact_id' => null,
                'ref_no' => $this->generateProductionRef('MFG-CNS'),
                'transaction_date' => now(),
                'total_before_tax' => 0,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'shipping_charges' => 0,
                'final_total' => 0,
                'additional_notes' => 'Work order consumption: ' . $workOrder->ref_no,
                'created_by' => $user_id,
            ]);

            $sell_lines = [];
            foreach ($workOrder->ingredients as $ingredient) {
                $variation = Variation::find($ingredient->variation_id);
                $unit_price = ! empty($variation->dpp_inc_tax) ? (float) $variation->dpp_inc_tax : 0;
                $sell_lines[] = new TransactionSellLine([
                    'product_id' => $ingredient->product_id,
                    'variation_id' => $ingredient->variation_id,
                    'quantity' => $ingredient->required_quantity,
                    'unit_price_before_discount' => $unit_price,
                    'unit_price' => $unit_price,
                    'unit_price_inc_tax' => $unit_price,
                    'item_tax' => 0,
                    'tax_id' => null,
                ]);

                $this->productUtil->decreaseProductQuantity(
                    $ingredient->product_id,
                    $ingredient->variation_id,
                    $workOrder->location_id,
                    $ingredient->required_quantity
                );
            }
            $consumption->sell_lines()->saveMany($sell_lines);

            $business = [
                'id' => $workOrder->business_id,
                'accounting_method' => $accounting_method ?: 'fifo',
                'location_id' => $workOrder->location_id,
                'pos_settings' => [],
            ];
            $this->transactionUtil->mapPurchaseSell($business, $consumption->sell_lines, 'production_purchase');

            $sell_line_ids = $consumption->sell_lines->pluck('id')->all();
            $ingredient_cost = (float) TransactionSellLinesPurchaseLines::join('purchase_lines as pl', 'transaction_sell_lines_purchase_lines.purchase_line_id', '=', 'pl.id')
                ->whereIn('transaction_sell_lines_purchase_lines.sell_line_id', $sell_line_ids)
                ->sum(DB::raw('transaction_sell_lines_purchase_lines.quantity * pl.purchase_price_inc_tax'));

            // Fallback for overselling case with no purchase line mapping.
            if ($ingredient_cost <= 0) {
                foreach ($consumption->sell_lines as $line) {
                    $ingredient_cost += (float) $line->quantity * (float) $line->unit_price_inc_tax;
                }
            }

            $overhead = (float) $workOrder->overhead_cost;
            $wastage = (float) $workOrder->wastage_cost;
            $total_cost = $ingredient_cost + $overhead + $wastage;
            $produced_qty = (float) $workOrder->planned_output_qty;
            $unit_cost = $produced_qty > 0 ? ($total_cost / $produced_qty) : 0;

            $production = Transaction::create([
                'business_id' => $workOrder->business_id,
                'location_id' => $workOrder->location_id,
                'type' => 'production_purchase',
                'status' => 'received',
                'payment_status' => 'paid',
                'contact_id' => null,
                'ref_no' => $this->generateProductionRef('MFG-PRD'),
                'transaction_date' => now(),
                'total_before_tax' => $total_cost,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'shipping_charges' => 0,
                'final_total' => $total_cost,
                'additional_notes' => 'Work order production: ' . $workOrder->ref_no,
                'created_by' => $user_id,
            ]);

            $finished_variation = $workOrder->recipe->finishedVariation;
            $production->purchase_lines()->create([
                'product_id' => $finished_variation->product_id,
                'variation_id' => $finished_variation->id,
                'quantity' => $produced_qty,
                'purchase_price' => $unit_cost,
                'purchase_price_inc_tax' => $unit_cost,
                'item_tax' => 0,
                'tax_id' => null,
            ]);

            $this->productUtil->updateProductQuantity(
                $workOrder->location_id,
                $finished_variation->product_id,
                $finished_variation->id,
                $produced_qty,
                0,
                null,
                false
            );

            foreach ($workOrder->ingredients as $ingredient) {
                $ingredient->consumed_quantity = $ingredient->required_quantity;
                $ingredient->save();
            }

            $workOrder->update([
                'status' => 'completed',
                'completed_at' => now(),
                'completed_by' => $user_id,
                'produced_output_qty' => $produced_qty,
                'total_ingredient_cost' => $ingredient_cost,
                'total_cost' => $total_cost,
                'consumption_transaction_id' => $consumption->id,
                'production_transaction_id' => $production->id,
            ]);

            DB::commit();

            return [
                'success' => 1,
                'msg' => __('manufacture.work_order_completed_successfully'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            return [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
    }

    private function generateProductionRef($prefix)
    {
        $count = Transaction::where('type', 'like', 'production_%')
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        return $prefix . '-' . now()->format('Ymd') . '-' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }
}

