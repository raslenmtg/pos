<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ __('inventaire.count_sheet') }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 2px; text-align: left; }
        th { background: #f5f5f5; }
        p {margin: 0; padding: 0;}
    </style>
</head>
<body>
    <h3 style="margin: 0; padding: 0;">{{ __('inventaire.count_sheet') }}</h3>

    <p><strong>{{ __('business.location') }}:</strong> {{ $location_name }}</p>
    <p><strong>{{ __('messages.date') }}:</strong> {{ @format_date(now()) }}</p>

    <table>
        <thead>
            <tr>
                <th>{{ __('sale.product') }}</th>
                <th>{{ __('product.sku') }}</th>
                <th>{{ __('product.unit') }}</th>
                <th>{{ __('inventaire.real_qty') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row->product_name }}</td>
                    <td>{{ $row->sub_sku }}</td>
                    <td>{{ $row->unit }}</td>
                    <td>&nbsp;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

