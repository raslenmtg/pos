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
            $extractedData = $this->mappingService->extractFromInvoice(
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

        $items = $extractedData['items'] ?? [];

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

        $extractedData['items'] = $items;

        // Try to match supplier if not provided
        if (empty($supplierId) && !empty($extractedData['supplier'])) {
            $ocrSup = $extractedData['supplier'];
            $match = null;

            // 1. Try Tax Number Matching (Robust)
            if (!empty($ocrSup['tax_number'])) {
                // Exact match
                $match = \App\Contact::where('business_id', $businessId)
                    ->where('type', 'supplier')
                    ->where('tax_number', $ocrSup['tax_number'])
                    ->first();

                // If no exact match, try simplified match (remove non-alphanumeric)
                if (!$match) {
                    $taxSimplified = preg_replace('/[^a-zA-Z0-9]/', '', $ocrSup['tax_number']);
                    if (strlen($taxSimplified) > 4) { // Avoid matching short junk
                        // Get candidates - optimization: search by first few chars if possible, or loose search
                        // For now we assume reasonably small supplier list or good DB performance
                        $candidates = \App\Contact::where('business_id', $businessId)
                            ->where('type', 'supplier')
                            ->select('id', 'name', 'tax_number', 'supplier_business_name')
                            ->get();

                        foreach ($candidates as $candidate) {
                            $cTax = preg_replace('/[^a-zA-Z0-9]/', '', $candidate->tax_number);
                            // check if one contains the other to handle partial scans
                            if (!empty($cTax) && ($cTax === $taxSimplified || strpos($cTax, $taxSimplified) !== false || strpos($taxSimplified, $cTax) !== false)) {
                                $match = $candidate;
                                break;
                            }
                        }
                    }
                }
            }

            // 2. Try Name Matching
            if (!$match && !empty($ocrSup['name'])) {
                $match = \App\Contact::where('business_id', $businessId)
                    ->where('type', 'supplier')
                    ->where(function($q) use ($ocrSup) {
                        $q->where('name', 'LIKE', '%' . $ocrSup['name'] . '%')
                          ->orWhere('supplier_business_name', 'LIKE', '%' . $ocrSup['name'] . '%');
                    })
                    ->first();
            }

            if ($match) {
                $extractedData['matched_supplier_id'] = $match->id;
                // Use business name if available, otherwise name
                $extractedData['matched_supplier_name'] = $match->supplier_business_name ?: $match->name;
            }
        }

        return response()->json(array_merge([
            'success' => true,
        ], $extractedData));
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
