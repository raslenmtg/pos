<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\InvoiceMappingService;
use App\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InvoiceScanController extends Controller
{
    public function __construct(private InvoiceMappingService $mappingService) {}

    /**
     * Accept an uploaded invoice file, run OCR via Gemini, and return
     * the extracted + catalog-mapped line items for user review.
     *
     * POST /invoice-scans/upload
     */
    public function upload(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'invoice_file' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'supplier_id'  => 'nullable|integer',
        ]);

        $businessId = $request->session()->get('user.business_id');
        $supplierId = $request->input('supplier_id') ?: null;

        // Store the file temporarily
        $path = $request->file('invoice_file')->store('temp_invoices', 'local');
        $absolutePath = Storage::disk('local')->path($path);

        // Verify the file was actually saved
        if (! file_exists($absolutePath)) {
            Log::error('InvoiceScanController@upload: stored file not found at ' . $absolutePath);
            return response()->json(['success' => false, 'message' => 'Failed to save uploaded file.'], 500);
        }

        // Build a flat catalog of products for this business
        $catalog = Product::where('business_id', $businessId)
            ->select('id', 'name')
            ->get()
            ->map(fn ($p) => ['id' => $p->id, 'name' => $p->name])
            ->toArray();

        try {
            $items = $this->mappingService->extractFromInvoice(
                $businessId,
                $supplierId,
                $absolutePath,
                $catalog
            );
        } catch (\Throwable $e) {
            Log::error('InvoiceScanController@upload: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        } finally {
            // Remove temp file
            \Illuminate\Support\Facades\Storage::disk('local')->delete($path);
        }

        // Enrich each item with variation_id (first variation of the product)
        foreach ($items as &$item) {
            if (! empty($item['product_id'])) {
                $variation = Variation::where('product_id', $item['product_id'])
                    ->orderBy('id')
                    ->first();
                $item['variation_id'] = $variation ? $variation->id : null;
            } else {
                $item['variation_id'] = null;
            }
        }
        unset($item);

        return response()->json([
            'success' => true,
            'items'   => $items,
        ]);
    }

    /**
     * After user confirms/corrects the mapped items, persist the mappings
     * and return the items ready to be injected into the purchase form.
     *
     * POST /invoice-scans/confirm
     */
    public function confirm(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'items'       => 'required|array',
            'supplier_id' => 'nullable|integer',
        ]);

        $businessId = $request->session()->get('user.business_id');
        $supplierId = $request->input('supplier_id') ?: null;
        $items      = $request->input('items');

        // Only process items where a product was actually selected
        $itemsWithProduct = array_values(array_filter($items, fn ($i) => ! empty($i['product_id'])));

        $this->mappingService->confirmMappings($businessId, $supplierId, $itemsWithProduct);

        return response()->json([
            'success' => true,
            'items'   => $itemsWithProduct,
        ]);
    }
}
