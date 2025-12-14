<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(!empty($receipt_details->invoice_heading)){{$receipt_details->invoice_heading}}@else Facture @endif</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f7fafc;
            --card-color: #ffffff;
            --text-color: #000000ff;
            --text-muted-color: #303030ff;
            --border-color: #e2e8f0;
            --accent-color: #000000ff; /* Professional Blue */
        }
        
        body {
            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        .mono-font {
            font-family: 'Roboto Mono', 'Courier New', monospace;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: var(--card-color);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        /* --- Header --- */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 30px;
        }
        .header-left .logo {
            max-width: 150px;
            max-height: 70px;
        }
        .header-left .business-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: var(--text-color);
        }
        .header-right { text-align: right; }
        .header-right h2 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
            color: var(--accent-color);
        }
        .header-right p { margin: 2px 0; font-size: 14px; color: var(--text-muted-color); }

        /* --- Parties: Business & Customer Details --- */
        .invoice-parties {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }
        .party-box {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }
        .party-box h3 { margin-top: 0; font-size: 16px; color: var(--text-color); margin-bottom: 10px; }
        .party-box p, .party-box div { margin: 0; font-size: 13px; color: var(--text-muted-color); line-height: 1.7; }
        .word-wrap { word-wrap: break-word; }

        /* --- Invoice Items Table --- */
        .invoice-body { margin-bottom: 30px; }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th, .items-table td { padding: 7px; text-align: left; border-bottom: 1px solid var(--border-color); }
        .items-table thead th {
            color: var(--accent-color);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            border-bottom: 2px solid var(--accent-color);
        }
        .items-table .text-right { text-align: right; }
        .items-table .line-note { font-size: 12px; color: var(--text-muted-color); font-style: italic; }

        /* --- Totals & Summary Section --- */
        .invoice-summary { display: flex; justify-content: space-between; align-items: flex-start; gap: 30px; page-break-inside: avoid; }
        .summary-left { width: 55%; }
        .summary-right { width: 45%; }
        
        .totals-table { width: 100%; }
        .totals-table td { padding: 8px 10px; }
        .totals-table tr:not(:last-child) td { border-bottom: 1px solid var(--border-color); }
        .total-row { font-size: 18px; font-weight: bold; }
        .total-row td { color: var(--accent-color); padding-top: 15px; }

        .summary-section h3 { font-size: 16px; color: var(--text-color); margin-bottom: 10px; }
        .summary-section p, .summary-section table { color: var(--text-muted-color); font-size: 14px; }
        .payments-table td { padding: 5px 0; }
        .payments-table td:last-child { text-align: right; }

        /* --- Footer --- */
        .invoice-footer { margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color); text-align: center; font-size: 12px; color: var(--text-muted-color); }
        .furl{
                 position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #333;
        }
        .qr-code {
            width: 30%;
            text-align: right;
        }
        .qr-code img {
            max-width: 100px;
            height: auto;
        }

        .total-in-words {
            text-align: left;
            margin-top: 5px;
        }

        /* --- Print Styles --- */
        @media print {
            body {
                background-color: #fff;
                font-size: 10pt;
                padding: 0;
                margin: 0;
            }
            .invoice-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
           

            .invoice-header, .invoice-parties, .invoice-summary, .items-table thead {
                page-break-inside: avoid;
            }
            .party-box {
                background-color: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        
        @if(!empty($receipt_details->letter_head))
            <img style="width: 100%; margin-bottom: 20px;" src="{{$receipt_details->letter_head}}" alt="Letterhead">
        @endif
        
        <header class="invoice-header">
            <div class="header-left">
                @if(empty($receipt_details->letter_head))
                    @if(!empty($receipt_details->logo)) <img class="logo" src="{{$receipt_details->logo}}" alt="Logo"> @endif
                    <div class="business-name">@if(!empty($receipt_details->display_name)) {{$receipt_details->display_name}} @endif</div>
                @endif
            </div>
            <div class="header-right">
                @if(!empty($receipt_details->invoice_heading)) <h2>{!! $receipt_details->invoice_heading !!}</h2> @endif
                <p class="mono-font">
                    @if(!empty($receipt_details->invoice_no_prefix)) {!! $receipt_details->invoice_no_prefix !!} @endif
                    {{$receipt_details->invoice_no}}
                </p>
                @if(!empty($receipt_details->date_label))
                    <p>{{$receipt_details->date_label}} <span class="mono-font">{{$receipt_details->invoice_date}}</span></p>
                @endif
            </div>
        </header>

        <section class="invoice-parties">
            <div class="party-box from-box">
            
                <div class="word-wrap">
                    <strong>{{$receipt_details->display_name ?? ''}}</strong>
                    @if(!empty($receipt_details->address)) <br>{!! $receipt_details->address !!} @endif
                    @if(!empty($receipt_details->contact)) <br>{!! $receipt_details->contact !!} @endif
                </div>
            </div>
            
            @if(!empty($receipt_details->customer_info))
                <div class="party-box to-box">
                    <div class="word-wrap"></div>
                    <strong>Client: </strong>
                        {!! $receipt_details->customer_info !!}
                           @if(!empty($receipt_details->client_id))
                            <br>Code client: {{ $receipt_details->client_id }}
                        @endif
                        @if(!empty($receipt_details->customer_tax_number))
                            <br>M.F: {{ $receipt_details->customer_tax_number }}
                        @endif
                        	@if(!empty($receipt_details->customer_custom_fields))
									<br/>{!! $receipt_details->customer_custom_fields !!}
								@endif
								@if(!empty($receipt_details->sales_person))
									<br/>
									<strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
								@endif
								@if(!empty($receipt_details->commission_agent))
									<br/>
									<strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
								@endif
                </div>
                </div>
            @endif
        </section>

        <section class="invoice-body">
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Désignation</th>
                        <th class="text-right" style="width: 12%;">Qté</th>
                        <th class="text-right" style="width: 15%;">P.U TTC</th>
                        @if( !empty($receipt_details->total_line_discount) )
                            <th class="text-right" style="width: 12%;">Remise</th>
                        @endif
                        <th class="text-right" style="width: 15%;">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($receipt_details->lines as $line)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}}
                                @if(!empty($line['sell_line_note'])) <br><small class="line-note">{!!$line['sell_line_note']!!}</small> @endif
                            </td>
                            <td class="text-right mono-font">{{$line['quantity_uf']}} </td>
                            <td class="text-right mono-font">{{$line['unit_price_before_discount']}}</td>
                            @if( !empty($receipt_details->total_line_discount) )
                                <td class="text-right">{{$line['total_line_discount'] ?? '0.00'}}</td>
                            @endif
                            <td class="text-right mono-font">{{$line['line_total']}}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="text-align: center;">Aucun article.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <section class="invoice-summary">
            <div class="summary-left">
                @if(!empty($receipt_details->payments))
                    <div class="summary-section">
                        <h3>Mode de Paiement</h3>
                        <table class="payments-table">
                            @foreach($receipt_details->payments as $payment)
                                <tr>
                                    <td>{{$payment['method']}}:</td>
                                    <td class="mono-font">&nbsp;{{$payment['amount']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
                @if(!empty($receipt_details->additional_notes))
                    <div class="summary-section" style="margin-top: 20px;">
                        <h3>Notes</h3>
                        <p>{!! nl2br($receipt_details->additional_notes) !!}</p>
                    </div>
                @endif
                      @if(!empty($receipt_details->total_in_words))
                    <p class="total-in-words">Arrêté la présente {!! $receipt_details->invoice_heading !!} à la somme de : {{$receipt_details->total_in_words}}.</p>
                @endif
            </div>

            <div class="summary-right">
                <table class="totals-table mono-font">
                    <tr>
                        <td>Sous-total TTC</td>
                        <td class="text-right">{{$receipt_details->subtotal}}</td>
                    </tr>
                    @if(!empty($receipt_details->discount))<tr><td>{!! $receipt_details->discount_label !!}</td><td class="text-right">(-) {{$receipt_details->discount}}</td></tr>@endif
                    @if(!empty($receipt_details->shipping_charges))<tr><td>{!! $receipt_details->shipping_charges_label !!}</td><td class="text-right">(+) {{$receipt_details->shipping_charges}}</td></tr>@endif
                    @if(!empty($receipt_details->tax))<tr><td>{!! $receipt_details->tax_label !!}</td><td class="text-right">(+) {{$receipt_details->tax}}</td></tr>@endif
                    <tr class="total-row">
                        <td>{!! $receipt_details->total_label !!}</td>
                        <td class="text-right">{{$receipt_details->total}}</td>
                    </tr>
                </table>
            </div>
        </section>

        <footer class="invoice-footer">
            @if(!empty($receipt_details->footer_text)) <div class="footer-text">{!! $receipt_details->footer_text !!}</div> @endif
           
                	<div style="width: 100%; text-align: center;  display:flex;justify-content:center">
                    @if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
                    @endif
                </div>
        </footer>
    </div>
    <div class="furl">
        www.simplexgestion.tn
    </div>
</body>
</html>