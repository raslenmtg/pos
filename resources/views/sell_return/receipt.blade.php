<div style="width: 100%;">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .sell-return-print-root {
            --r-bg-color: #f7fafc;
            --r-card-color: #ffffff;
            --r-text-color: #2d3748;
            --r-text-muted-color: #718096;
            --r-border-color: #e2e8f0;
            --r-accent-color: #4299e1;

            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif;
            background-color: var(--r-bg-color);
            color: var(--r-text-color);
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        .sell-return-print-root .mono-font {
            font-family: 'Roboto Mono', 'Courier New', monospace;
        }

        .sell-return-print-root .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: var(--r-card-color);
            border-radius: 8px;
            border: 1px solid var(--r-border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .sell-return-print-root .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--r-border-color);
            margin-bottom: 30px;
        }

        .sell-return-print-root .header-left .logo {
            max-width: 150px;
            max-height: 70px;
        }

        .sell-return-print-root .header-left .business-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: var(--r-text-color);
        }

        .sell-return-print-root .header-right {
            text-align: right;
        }

        .sell-return-print-root .header-right h2 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
            color: var(--r-accent-color);
        }

        .sell-return-print-root .header-right p {
            margin: 2px 0;
            font-size: 14px; 
            color: var(--r-text-muted-color);
        }

        .sell-return-print-root .invoice-parties {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .sell-return-print-root .party-box {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid var(--r-border-color);
        }

        .sell-return-print-root .party-box h3 {
            margin-top: 0;
            font-size: 16px; 
            color: var(--r-text-color);
            margin-bottom: 10px;
        }

        .sell-return-print-root .party-box p, .sell-return-print-root .party-box div {
            margin: 0;
            font-size: 13px; 
            color: var(--r-text-muted-color);
            line-height: 1.7;
        }

        .sell-return-print-root .word-wrap {
            word-wrap: break-word;
        }

        .sell-return-print-root .invoice-body {
            margin-bottom: 30px;
        }

        .sell-return-print-root .items-table {
            width: 100%;
            border-collapse: collapse; 
        }

        .sell-return-print-root .items-table th, .sell-return-print-root .items-table td {
            padding: 5px;
            text-align: left; 
            border-bottom: 1px solid var(--r-border-color);
        }

        .sell-return-print-root .items-table thead th {
            color: var(--r-accent-color);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            background-color: #f8fafc;
        }

        .sell-return-print-root .items-table .text-right {
            text-align: right;
        }

        .sell-return-print-root .items-table .text-center {
            text-align: center;
        }

        .sell-return-print-root .invoice-summary {
            display: flex;
            justify-content: space-between; 
            align-items: flex-start; 
            gap: 30px; 
            page-break-inside: avoid; 
        }

        .sell-return-print-root .summary-left {
            width: 55%;
        }

        .sell-return-print-root .summary-right {
            width: 45%;
        }
        
        .sell-return-print-root .totals-table {
            width: 100%;
        }

        .sell-return-print-root .totals-table td {
            padding: 8px 10px;
        }

        .sell-return-print-root .totals-table tr:not(:last-child) td {
            border-bottom: 1px solid var(--r-border-color);
        }

        .sell-return-print-root .total-row {
            font-size: 18px;
            font-weight: bold; 
        }

        .sell-return-print-root .total-row td {
            color: var(--r-accent-color);
            padding-top: 15px;
        }

        .sell-return-print-root .invoice-footer {
            margin-top: 40px;
            padding-top: 20px; 
            border-top: 1px solid var(--r-border-color);
            text-align: center;
            font-size: 12px; 
            color: var(--r-text-muted-color);
        }

        @media print {
            .sell-return-print-root {
                background-color: #fff;
                font-size: 10pt;
                padding: 0;
                margin: 0;
            }
            .sell-return-print-root .invoice-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                border-radius: 0 !important;
            }
        }
    </style>

<div class="sell-return-print-root">
<div class="invoice-container">
<!-- Invoice Header -->
<div class="invoice-header">
    <div class="header-left">
        @if(!empty($receipt_details->logo))
            <img src="{{$receipt_details->logo}}" class="logo" alt="Logo">
        @endif
        @if(!empty($receipt_details->display_name))
            <div class="business-name">{{$receipt_details->display_name}}</div>
        @endif
    </div>
    <div class="header-right">
        <h3>@if(!empty($receipt_details->invoice_heading)){{$receipt_details->invoice_heading}}@else Facture d'avoir @endif N° {{$receipt_details->invoice_no}}</h3>
    
        @if(!empty($receipt_details->parent_invoice_no))
            <p>{{$receipt_details->parent_invoice_no_prefix ?? 'Facture originale'}} {{$receipt_details->parent_invoice_no}}</p>
        @endif
        @if(!empty($receipt_details->date_label) && !empty($receipt_details->invoice_date))
            <p>{{$receipt_details->date_label}}: {{$receipt_details->invoice_date}}</p>
        @endif
    </div>
</div>

<!-- Invoice Parties -->
<div class="invoice-parties">
    <div class="party-box">
        <h3>{{ $receipt_details->customer_label ?? 'Client' }}</h3>
        <div class="word-wrap">
            @if(!empty($receipt_details->customer_name))
                <strong>{!! $receipt_details->customer_name !!}</strong><br>
            @endif
            @if(!empty($receipt_details->customer_info))
                {!! $receipt_details->customer_info !!}<br>
            @endif
            @if(!empty($receipt_details->client_id_label) && !empty($receipt_details->client_id))
                {{ $receipt_details->client_id_label }} {{ $receipt_details->client_id }}<br>
            @endif
            @if(!empty($receipt_details->customer_tax_label) && !empty($receipt_details->customer_tax_number))
                {{ $receipt_details->customer_tax_label }} {{ $receipt_details->customer_tax_number }}<br>
            @endif
            @if(!empty($receipt_details->customer_custom_fields))
                {!! $receipt_details->customer_custom_fields !!}
            @endif
        </div>
    </div>

    <div class="party-box">
        <h3>Entreprise</h3>
        <div class="word-wrap">
            @if(!empty($receipt_details->display_name))
                <strong>{{$receipt_details->display_name}}</strong><br>
            @endif
            @if(!empty($receipt_details->address))
                {!! $receipt_details->address !!}<br>
            @endif
            @if(!empty($receipt_details->contact))
                {{ $receipt_details->contact }}<br>
            @endif
            @if(!empty($receipt_details->website))
                {{ $receipt_details->website }}<br>
            @endif
            @if(!empty($receipt_details->sub_heading_line1))
                {{ $receipt_details->sub_heading_line1 }}<br>
            @endif
            @if(!empty($receipt_details->sub_heading_line2))
                {{ $receipt_details->sub_heading_line2 }}<br>
            @endif
            @if(!empty($receipt_details->sub_heading_line3))
                {{ $receipt_details->sub_heading_line3 }}<br>
            @endif
            @if(!empty($receipt_details->location_custom_fields))
                {{ $receipt_details->location_custom_fields }}
            @endif
        </div>
    </div>
</div>

<!-- Invoice Body -->
<div class="invoice-body">
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                @php
                    $p_width = $receipt_details->show_cat_code == 1 ? 35 : 45;
                @endphp
                <th style="width: {{$p_width}}%;">{{$receipt_details->table_product_label}}</th>
                @if($receipt_details->show_cat_code == 1)
                    <th style="width: 10%;">{{$receipt_details->cat_code_label}}</th>
                @endif
                <th style="width: 15%;" class="text-right">{{$receipt_details->table_qty_label}}</th>
                <th style="width: 15%;" class="text-right">{{$receipt_details->table_unit_price_label}}</th>
                <th style="width: 20%;" class="text-right">{{$receipt_details->table_subtotal_label}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipt_details->lines as $line)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>
                        <strong>{{$line['name']}}</strong>
                        @if(!empty($line['variation']))
                            {{$line['variation']}}
                        @endif
                        @if(!empty($line['sub_sku']))
                            ,<small class="mono-font">SKU: {{$line['sub_sku']}}</small>
                        @endif
                        @if(!empty($line['brand']))
                            ,<small>{{$line['brand']}}</small>
                        @endif
                        @if(!empty($line['sell_line_note']))
                            ,<small style="font-style: italic;">({{$line['sell_line_note']}})</small>
                        @endif
                    </td>
                    @if($receipt_details->show_cat_code == 1)
                        <td>
                            @if(!empty($line['cat_code']))
                                {{$line['cat_code']}}
                            @endif
                        </td>
                    @endif
                    <td class="text-right">{{$line['quantity']}} {{$line['units']}}</td>
                    <td class="text-right">{{$line['unit_price_exc_tax']}}</td>
                    <td class="text-right">{{$line['line_total']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Invoice Summary -->
<div class="invoice-summary">
    <div class="summary-left">
        @if(!empty($receipt_details->additional_notes))
            <div class="summary-section">
                <h3>Notes additionnelles</h3>
                <p>{{$receipt_details->additional_notes}}</p>
            </div>
        @endif
    </div>
    
    <div class="summary-right">
        <table class="totals-table">
            <tbody>
                <tr>
                    <td>{!! $receipt_details->subtotal_label !!}</td>
                    <td class="text-right">{{$receipt_details->subtotal}}</td>
                </tr>

                <!-- Tax -->
                @if(!empty($receipt_details->taxes))
                    @foreach($receipt_details->taxes as $k => $v)
                        <tr>
                            <td>{{$k}}</td>
                            <td class="text-right">{{$v}}</td>
                        </tr>
                    @endforeach
                @endif

                <!-- Discount -->
                @if(!empty($receipt_details->discount))
                    <tr>
                        <td>{!! $receipt_details->discount_label !!}</td>
                        <td class="text-right">(-) {{$receipt_details->discount}}</td>
                    </tr>
                @endif

          {{--      @if(!empty($receipt_details->group_tax_details))
                    @foreach($receipt_details->group_tax_details as $key => $value)
                        <tr>
                            <td>{!! $key !!}</td>
                            <td class="text-right">(+) {{$value}}</td>
                        </tr>
                    @endforeach
                @elseif(!empty($receipt_details->tax))
                    <tr>
                        <td>{!! $receipt_details->tax_label !!}</td>
                        <td class="text-right">(+) {{$receipt_details->tax}}</td>
                    </tr>
                @endif--}}
                
                <!-- Total -->
                <tr class="total-row">
                    <td>{!! $receipt_details->total_label !!}</td>
                    <td class="text-right">{{$receipt_details->total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@if(!empty($receipt_details->footer_text))
    <div class="invoice-footer">
        {!! $receipt_details->footer_text !!}
    </div>
@endif

</div>
</div>
</div>

