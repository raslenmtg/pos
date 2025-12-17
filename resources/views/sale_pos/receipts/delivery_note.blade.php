<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 4px;
            vertical-align: top;
        }
        p {
            margin: 0 0 4px 0;
        }
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        /* Helpers */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-30 { font-size: 30px; }
        .font-20 { font-size: 20px; }
        .font-17 { font-size: 17px; }
        .color-555 { color: #555; }

        .border th, .border td {
            border: 1px solid #000;
        }
        @media print {
            @page {
                @bottom-center {
                    content: "www.simplexgestion.tn";
                    font-size: 10px;
                    color: #333;
                }
            }
        }
    </style>
</head>

<body>

<!-- ===== TITLE ===== -->
<p class="text-right font-30 color-555" style="margin-bottom:10px;">
    <b>@lang('lang_v1.delivery_note')</b>
</p>

<table>
    <tr>
        <td style="width:50%;">
                        @if(!empty($receipt_details->logo))
                            <img src="{{ $receipt_details->logo }}" style="max-width: 380px; max-height: 120px;">
                        @endif
        </td>

        <td style="width:50%;" class="text-right">
            <p class="font-17">
                {{ $receipt_details->invoice_no_prefix ?? '' }}
                {{ $receipt_details->invoice_no }}
            </p>

            <p class="font-17">
                Date:
                {{ $receipt_details->invoice_date }}
            </p>
        </td>
    </tr>

    <!-- ===== ROW 2 : DISPLAY NAME | CLIENT ===== -->
    <tr>
        <td style="width:50%;">
            <p class="font-20" style="font-weight:bold;">
                {{ $receipt_details->display_name }}
            </p>
            {!! $receipt_details->address ?? '' !!}<br>
            {!! $receipt_details->contact ?? '' !!}

        </td>

        <td style="width:50%;">
            <strong>Client: </strong>{!! $receipt_details->customer_info !!} <br>
            <strong>@lang('lang_v1.shipping_address'):</strong> {!! $receipt_details->shipping_address !!}
        </td>
    </tr>
</table>

<!-- =====================================================
     PRODUCTS TABLE
====================================================== -->
<table class="border" style="margin-top:15px;">
    <thead>
    <tr>
        <th style="width:5%;" class="text-center">#</th>
        <th>{{ $receipt_details->table_product_label }}</th>
        <th style="width:12%;" class="text-right">
            {{ $receipt_details->table_qty_label }}
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach($receipt_details->lines as $line)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>
                {{ $line['name'] }}
                {{ $line['product_variation'] }}
                {{ $line['variation'] }}
            </td>
            <td class="text-right">
                {{ $line['quantity'] }} {{ $line['units'] }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<span style="margin-top: 15px"> <strong>Reçu le :</strong></span>
</body>
</html>
