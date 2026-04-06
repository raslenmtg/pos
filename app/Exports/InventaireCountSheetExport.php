<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class InventaireCountSheetExport implements FromArray
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    public function array(): array
    {
        $export = [[
            __('sale.product'),
            __('product.sku'),
            __('product.unit'),
            __('inventaire.real_qty'),
        ]];

        foreach ($this->rows as $row) {
            $product_name = is_array($row) ? ($row['product_name'] ?? '') : ($row->product_name ?? '');
            $sub_sku = is_array($row) ? ($row['sub_sku'] ?? '') : ($row->sub_sku ?? '');
            $unit = is_array($row) ? ($row['unit'] ?? '') : ($row->unit ?? '');

            $export[] = [
                $product_name,
                $sub_sku,
                $unit,
                '',
            ];
        }

        return $export;
    }
}

