<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('lang_v1.packing_slip')</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border: 1px solid #ddd;
        }

        /* --- Header --- */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
            margin-bottom: 5px;
        }
        .header-left .logo {
            max-width: 380px;
            max-height: 120px;
        }
        .header-left .business-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: #000;
        }
        .header-right {
            text-align: right;
        }
        .header-right h2 {
            margin: 0;
            font-size: 40px;
            font-weight: bold;
            color: #333;
        }
        .header-right p {
            margin: 2px 0;
            font-size: 14px;
        }

        /* --- Parties: Business & Customer Details --- */
        .invoice-parties {
            display: block;
            margin-bottom: 30px;
        }
        .party-box {
            width: 48%;
        }
        .party-box h3 {
            margin-top: 0;
            font-size: 16px;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .party-box p, .party-box div {
            margin: 2px 0;
            font-size: 13px;
        }
        .word-wrap {
            word-wrap: break-word;
        }

        /* --- Invoice Items Table --- */
        .invoice-body {
            margin-bottom: 30px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th, .items-table td {
            padding: 2px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .items-table thead {
            background-color: #f8f8f8;
        }
        .items-table th {
            font-weight: bold;
            font-size: 14px;
        }
        .items-table .text-right { text-align: right; }
        .items-table .text-center { text-align: center; }
        .items-table .line-note {
            font-size: 12px;
            color: #555;
        }

        /* --- Totals & Summary Section --- */
        .invoice-summary {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }
        .summary-left {
            width: 55%;
        }
        .summary-right {
            width: 40%;
        }
        .payments-table, .totals-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .totals-table td {
            padding: 3px;
            border: 1px solid;
            border-collapse: collapse;
        }
        .total-row {
            font-size:16px
        }

        .payments-table td {
            padding: 3px;
            border: 1px solid;
            border-collapse: collapse;
        }

        .total-in-words {
            text-align: right;
            font-size: 12px;
            font-style: italic;
            margin-top: 5px;
        }
        .additional-notes {
            margin-top: 20px;
        }

        /* --- Footer --- */
        .invoice-footer {
            margin-top: 5px;
            padding-top: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            color: #777;
        }
        .footer-text {
            width: 70%;
        }
        .qr-code {
            width: 30%;
            text-align: right;
        }
        .qr-code img {
            max-width: 100px;
            height: auto;
        }

        /* --- Utility Classes --- */
        .text-right { text-align: right; }
        .font-weight-bold { font-weight: bold; }

        /* --- Print-Specific Styles --- */
        @media print {
            body {
                background-color: #fff;
                font-size: 12px;
            }
            .invoice-container {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
                max-width: 100%;
            }

            /* Allow page breaks in header/parties but keep them together individually */
            .invoice-header {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }

            .invoice-parties {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }

            /* Items table MUST break across pages */
            .invoice-body {
                page-break-inside: auto !important;
            }

            .items-table {
                page-break-inside: auto !important;
                break-inside: auto !important;
            }

            .items-table tbody {
                page-break-inside: auto !important;
                break-inside: auto !important;
            }

            /* Keep individual rows together */
            .items-table tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }

            .items-table td {
                page-break-inside: avoid !important;
            }

            /* Repeat table header on each page */
            .items-table thead {
                display: table-header-group !important;
            }

            /* Keep summary section together */
            .invoice-summary {
                page-break-inside: avoid !important;
                page-break-before: auto !important;
            }

            .invoice-footer {
                page-break-inside: avoid !important;
            }

            .totals-table tr.total-row {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .totals-table tr.total-row td {
                color: #fff !important;
                border: 1px solid;
            }

            .furl {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #333;
            }
        }
    </style>
</head>
<body>

<div class="invoice-container">

    <header class="invoice-header">
        <div class="header-left">
            @if(!empty($receipt_details->logo))
                <img class="logo" src="{{$receipt_details->logo}}" alt="Logo">
            @endif
        </div>
        <div class="header-right">
            <span style="font-size:28px"> @lang('lang_v1.packing_slip')</span>
            @if(!empty($receipt_details->business_name))
                <br>
                <span style="font-size:28px">{{$receipt_details->business_name}}</span>
            @endif
        </div>
    </header>

    <section class="invoice-parties">
        @if(!empty($receipt_details->customer_info))
            <h3>Client: {!! $receipt_details->customer_info !!}</h3>
            <div class="word-wrap" style="font-size:20px">
                    <span><strong>@lang('lang_v1.shipping_address'):</strong>
                    {!! $receipt_details->shipping_address !!}</span>
                @if(!empty($receipt_details->shipping_details))
                    <br><strong>{!!$receipt_details->shipping_details_label!!} :</strong> {!!$receipt_details->shipping_details ?? ''!!}
                @endif

                @if(!empty($receipt_details->shipping_custom_field_2_label))
                    <br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
                @endif

                @if(!empty($receipt_details->shipping_custom_field_3_label))
                    <br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
                @endif

                @if(!empty($receipt_details->shipping_custom_field_4_label))
                    <br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
                @endif

                @if(!empty($receipt_details->shipping_custom_field_5_label))
                    <br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
                @endif
            </div>
        @endif
    </section>

    <section class="invoice-body">
        <table class="items-table">
            <thead>
            <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th>{{$receipt_details->table_product_label}}</th>
                <th class="text-right" style="width: 12%;">{{$receipt_details->table_qty_label}}</th>
                <th class="text-right" style="width: 15%;">{{$receipt_details->table_unit_price_label}}</th>
                @if( !empty($receipt_details->total_line_discount) )
                    <th class="text-right" style="width: 12%;">Remise</th>
                @endif
                <th class="text-right" style="width: 15%;">{{$receipt_details->table_subtotal_label}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($receipt_details->lines as $line)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>
                        {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}}
                        @if(!empty($line['sell_line_note']))
                            <br><small class="line-note">{!!$line['sell_line_note']!!}</small>
                        @endif
                        @if(!empty($line['product_description']))
                            <div class="line-note">{!!$line['product_description']!!}</div>
                        @endif
                    </td>

                    <td class="text-right">{{$line['quantity']}} {{$line['units']}}</td>
                    <td class="text-right">{{$line['unit_price_before_discount']}}</td>
                    @if( !empty($receipt_details->total_line_discount) )
                        <td class="text-right">{{$line['total_line_discount'] ?? '0.00'}}</td>
                    @endif
                    <td class="text-right">{{$line['line_total']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <section class="invoice-summary">
        <div class="summary-left">
            @if(!empty($receipt_details->additional_notes))
                <div class="additional-notes">
                    <h3 style="font-size: 16px;">Notes</h3>
                    <p>{!! nl2br($receipt_details->additional_notes) !!}</p>
                </div>
            @endif
            @if(!empty($receipt_details->total_in_words))
                <p class="total-in-words">Arrêté la présente {!! $receipt_details->invoice_heading !!} à la somme de : {{$receipt_details->total_in_words}}.</p>
            @endif
        </div>

        <div class="summary-right">
            <table class="totals-table">
                @if( !empty($receipt_details->discount) )
                    <tr>
                        <td>{!! $receipt_details->discount_label !!}</td>
                        <td>(-) {{$receipt_details->discount}}</td>
                    </tr>
                @endif
                @if( !empty($receipt_details->total_line_discount) )
                    <tr>
                        <td>{!! $receipt_details->line_discount_label !!}</td>
                        <td>(-) {{$receipt_details->total_line_discount}}</td>
                    </tr>
                @endif

                <tr>
                    <td>{!! $receipt_details->subtotal_label !!}</td>
                    <td>{{$receipt_details->subtotal}}</td>
                </tr>

                @if(!empty($receipt_details->shipping_charges))
                    <tr>
                        <td>{!! $receipt_details->shipping_charges_label !!}</td>
                        <td>(+) {{$receipt_details->shipping_charges}}</td>
                    </tr>
                @endif

                @if(!empty($receipt_details->group_tax_details))
                    @foreach($receipt_details->group_tax_details as $key => $value)
                        <tr>
                            <td>{!! $key !!}</td>
                            <td>(+) {{$value}}</td>
                        </tr>
                    @endforeach
                @else
                    @if( !empty($receipt_details->tax) )
                        <tr>
                            <td>{!! $receipt_details->tax_label !!}</td>
                            <td>(+) {{$receipt_details->tax}}</td>
                        </tr>
                    @endif
                @endif

                <tr class="total-row">
                    <td><strong>{!! $receipt_details->total_label !!}</strong></td>
                    <td><strong>{{$receipt_details->total}}</strong></td>
                </tr>
            </table>
        </div>
    </section>
</div>

<footer class="invoice-footer">
    <div class="footer-text" style="text-align:center">
        @if(!empty($receipt_details->footer_text))
            {!! $receipt_details->footer_text !!}
        @endif
    </div>
</footer>

<div class="furl">
    www.simplexgestion.tn
</div>
</body>
</html>