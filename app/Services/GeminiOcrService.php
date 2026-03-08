<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiOcrService
{
    private string $apiKey;
    private string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model  = config('services.gemini.model', 'gemini-1.5-flash');
    }

    /**
     * Extract all line items from an invoice image/PDF and map them to
     * the provided product catalog in a single Gemini Vision API call.
     *
     * @param  string  $imagePath  Absolute path to the invoice image or PDF
     * @param  array   $catalog    [['id' => 1, 'name' => 'Product Name'], ...]
     * @return array               Mapped line items
     */
    public function extractAndMap(string $imagePath, array $catalog): array
    {

        $imageData = base64_encode(file_get_contents($imagePath));
        $mimeType  = mime_content_type($imagePath);

        // Gemini only supports certain MIME types for inline_data
        $supportedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'application/pdf'];
        if (! in_array($mimeType, $supportedMimes)) {
            Log::warning("GeminiOcrService: Unsupported MIME type: {$mimeType}");
            return [];
        }

        $catalogJson = json_encode($catalog, JSON_UNESCAPED_UNICODE);

        $prompt = <<<PROMPT
IMPORTANT: This is a Tunisian invoice. Prices use Tunisian Dinar format where
the comma is a decimal separator (NOT thousands separator).
Examples: "8,000" = 8.000 dinars, "12,750" = 12.750 dinars.
Since you work in simplex which removes 3 decimal digits, return prices divided by 1000.
So "8,000" → 8, "12,750" → 12.750 → return as 12.75.

Extract the following information from this supplier invoice:
1. Invoice Date (format YYYY-MM-DD HH:mm:ss if time present, else YYYY-MM-DD)
2. Invoice Reference Number
3. Supplier Information (Name, Tax Number, Phone, Email, Address, City). 
   Note: Tax Number often follows formats like "1234567/A", "123456/A/B/C", "1234567ABC" or similar Tunisian matricule fiscal formats.
4. Product line items.

For each product item, find the closest match in this product catalog:
{$catalogJson}

Return ONLY a valid JSON object with no extra text or markdown. Format:
{
  "invoice_date": "MM/DD/YYYY",
  "ref_no": "ABC-123",
  "supplier": {
      "name": "Business Name",
      "tax_number": "Tax ID",
      "mobile": "Phone",
      "email": "Email",
      "address_line_1": "Address",
      "city": "City"
  },
  "items": [
    {
        "ocr_text": "exact text from invoice",
        "product_id": 42,
        "product_name": "matched product name",
        "quantity": 10,
        "unit_price": 2.50,
        "line_discount": 0,
        "sku": "extracted SKU/Code if present",
        "tax_rate": "extracted TVA if present",
        "confidence": 0.95
    }
  ]
}

If no match is found for product_id, set it to null and confidence to 0.
Notes:
- Extract "remise" or "discount" per line item if present. Return as percentage number (e.g. 5 for 5%).
- Extract "TVA" or "Tax" per line item if present. Return as percentage number (e.g. 19 for 19%).
- Extract "Code" or "Reference" as SKU.
PROMPT;

        try {
            $response = Http::timeout(60)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post(
                    "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}",
                    [
                        'contents' => [[
                            'parts' => [
                                [
                                    'inline_data' => [
                                        'mime_type' => $mimeType,
                                        'data'      => $imageData,
                                    ],
                                ],
                                ['text' => $prompt],
                            ],
                        ]],
                        'generationConfig' => [
                            'temperature' => 0.1,
                        ],
                    ]
                );

            if ($response->failed()) {
                Log::error('GeminiOcrService: API error', ['status' => $response->status(), 'body' => $response->body()]);
                return [];
            }

            $text = $response->json('candidates.0.content.parts.0.text', '[]');

            // Strip possible markdown code fences
            $text = preg_replace('/```json\s*|```/', '', $text);

            return json_decode(trim($text), true) ?? [];
        } catch (\Throwable $e) {
            Log::error('GeminiOcrService: Exception', ['message' => $e->getMessage()]);
            return [];
        }
    }
}
