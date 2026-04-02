<?php

namespace App\Http\Controllers;

use App\Services\SmartQuantityService;
use Illuminate\Http\Request;

class SmartQuantityController extends Controller
{
    protected $smartQuantityService;

    public function __construct(SmartQuantityService $smartQuantityService)
    {
        $this->smartQuantityService = $smartQuantityService;
    }

    /**
     * Handle bulk processing of low stock alerts
     */
    public function bulkProcess(Request $request)
    {
        $items = $request->input('items', []);

        if (empty($items) || ! is_array($items)) {
            return response()->json(['success' => false, 'msg' => __('messages.no_items_selected')]);
        }

        $prefill_items = [];

        foreach ($items as $item) {
            $variation_id = (int) ($item['variation_id'] ?? 0);
            $quantity = (float) ($item['quantity'] ?? 0);

            if (empty($variation_id) || $quantity <= 0) {
                continue;
            }

            $variation = \DB::table('variations')
                ->join('products', 'variations.product_id', '=', 'products.id')
                ->where('variations.id', $variation_id)
                ->select('products.id as product_id', 'variations.id as variation_id')
                ->first();

            if (empty($variation)) {
                continue;
            }

            $prefill_items[] = [
                'product_id' => $variation->product_id,
                'variation_id' => $variation->variation_id,
                'quantity' => $quantity,
            ];
        }

        if (empty($prefill_items)) {
            return response()->json(['success' => false, 'msg' => __('messages.something_went_wrong')]);
        }

        $request->session()->flash('smart_quantity_prefill_items', $prefill_items);

        return response()->json([
            'success' => true,
            'redirect_url' => route('purchase-order.create'),
        ]);
    }
}
