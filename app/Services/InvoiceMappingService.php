<?php

namespace App\Services;

use App\OcrProductMapping;
use Illuminate\Support\Facades\Log;

class InvoiceMappingService
{
    public function __construct(private GeminiOcrService $gemini) {}

    /**
     * Given a raw uploaded invoice file, extract & map all line items:
     *  1. Look up the business's cached OCR→product mappings (free, instant).
     *  2. Fall back to a single Gemini API call for unknowns.
     *
     * @param  int     $businessId
     * @param  int|null $supplierId
     * @param  string  $imagePath   Absolute path to the uploaded file
     * @param  array   $catalog     [['id' => int, 'name' => string], ...]
     * @return array
     */
    public function extractFromInvoice(
        int $businessId,
        ?int $supplierId,
        string $imagePath,
        array $catalog
    ): array {
        // Call Gemini to extract all line items from the image
        $geminiData = $this->gemini->extractAndMap($imagePath, $catalog);

        $items = $geminiData['items'] ?? [];
        // Fallback for list response
        if (isset($geminiData[0]) && is_array($geminiData[0])) {
            $items = $geminiData;
            $geminiData = [];
        }

        $results = [];
        foreach ($items as $item) {
            $ocrText = $item['ocr_text'] ?? '';

            // Check cached mapping first
            $mapping = OcrProductMapping::where('business_id', $businessId)
                ->where('supplier_id', $supplierId)
                ->where('ocr_text', $ocrText)
                ->first();

            if ($mapping) {
                $item['product_id']   = $mapping->product_id;
                $item['source']       = 'mapping_table';
                $item['confidence']   = 1.0;

                $mapping->increment('confirmed_count');
                $mapping->touch('last_used_at');
            } else {
                $item['source'] = 'gemini';
            }

            $results[] = $item;
        }

        return [
            'invoice_date' => $geminiData['invoice_date'] ?? null,
            'ref_no'       => $geminiData['ref_no'] ?? null,
            'supplier'     => $geminiData['supplier'] ?? null,
            'items'        => $results,
        ];
    }

    /**
     * Persist confirmed OCR→product mappings after user review.
     *
     * @param  int        $businessId
     * @param  int|null   $supplierId
     * @param  array      $confirmedItems  Items that the user confirmed/corrected
     */
    public function confirmMappings(int $businessId, ?int $supplierId, array $confirmedItems): void
    {
        foreach ($confirmedItems as $item) {
            if (empty($item['product_id']) || empty($item['ocr_text'])) {
                continue;
            }

            OcrProductMapping::updateOrCreate(
                [
                    'business_id' => $businessId,
                    'supplier_id' => $supplierId,
                    'ocr_text'    => $item['ocr_text'],
                ],
                [
                    'product_id'   => $item['product_id'],
                    'last_used_at' => now(),
                ]
            );
        }
    }
}
