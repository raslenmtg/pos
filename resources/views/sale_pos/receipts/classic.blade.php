<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(!empty($receipt_details->invoice_heading)){{$receipt_details->invoice_heading}}@else Facture @endif</title>
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
            padding-bottom: 20px;
            border-bottom: 1px solid #000000ff;
            margin-bottom: 30px;
        }
        .header-left .logo {
            max-width: 180px;
            max-height: 100px;
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
            display: flex;
            justify-content: space-between;
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
        /* Fill empty rows to maintain consistent height */
        .items-table .empty-row td {
            border: 1px solid #ddd;
            border-top: none;
            border-bottom: none;
            height: 38px; /* Approx height of a normal row */
        }
        .items-table .last-empty-row td {
             border-bottom: 1px solid #ddd;
        }

        /* --- Totals & Summary Section --- */
        .invoice-summary {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            page-break-inside: avoid;
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
            border: 1px solid ;
            border-collapse: collapse;
       }
       .total-row{
        font-size:16px
       }

         .payments-table td {
            padding: 3px;
            border: 1px solid ;
            border-collapse: collapse;
       }
      
        .total-in-words {
            text-align: left;
            margin-top: 5px;
        }
        .additional-notes {
            margin-top: 20px;
        }

        /* --- Footer --- */
        .invoice-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
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
            .invoice-header, .invoice-parties, .invoice-body, .invoice-summary, .invoice-footer {
                page-break-inside: avoid;
            }
            .items-table tr, .items-table td {
                page-break-inside: avoid;
            }
            .totals-table tr.total-row {
             
                -webkit-print-color-adjust: exact; 
                color-adjust: exact;
            }
            .totals-table tr.total-row td {
                 color: #fff !important;
                 border: 1px solid;
            }
            .furl{
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

        @if(!empty($receipt_details->letter_head))
            <img style="margin-bottom: 20px; width:120px; height:120px;" src="{{$receipt_details->letter_head}}" alt="Letterhead">
        @endif
        
        <header class="invoice-header">
            <div class="header-left">
                @if(empty($receipt_details->letter_head))
                    @if(!empty($receipt_details->logo))
                        <img class="logo" src="{{$receipt_details->logo}}" alt="Logo">
                    @endif
                    <div class="business-name">
                        @if(!empty($receipt_details->display_name))
                            {{$receipt_details->display_name}}
                        @endif
                    </div>
                @endif
            </div>
            <div class="header-right">
                @if(!empty($receipt_details->invoice_heading))
                    <h2>{!! $receipt_details->invoice_heading !!}</h2>
                @endif
                <p><span class="font-weight-bold">
                    @if(!empty($receipt_details->invoice_no_prefix))
                        {!! $receipt_details->invoice_no_prefix !!}
                    @endif
                </span> {{$receipt_details->invoice_no}}</p>

                @if(!empty($receipt_details->date_label))
                    <p><span class="font-weight-bold">{{$receipt_details->date_label}}</span> {{$receipt_details->invoice_date}}</p>
                @endif
            </div>
        </header>

        <section class="invoice-parties">
            <div class="party-box from-box">
                  <div >
                     @if(!empty($receipt_details->display_name))
                            {{$receipt_details->display_name}} 
                        @endif
                        
                        @if(!empty($receipt_details->address))
                           <br> {!! $receipt_details->address !!}  
                        @endif
                      
                        @if(!empty($receipt_details->contact))
                            <br>{!! $receipt_details->contact !!}
                        @endif
                         
                        @if(!empty($receipt_details->website))
                            <br>{{ $receipt_details->website }}
                        @endif
                    </div>
            </div>
 		 @if(!empty($receipt_details->customer_info))
            <div class="party-box to-box" style='border-bottom:none'>
                <h3>Client:  {!! $receipt_details->customer_info !!}</h3>
                <div class="word-wrap">
                 	@if(!empty($receipt_details->client_id))
									<br/>
									<strong>Code client:</strong> {{ $receipt_details->client_id }}
								@endif
                                	@if(!empty($receipt_details->customer_tax_number))
									<br/>
									<strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
								@endif
                  	@if(!empty($receipt_details->sales_person))
									<br/>
									<strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
								@endif
               	@if(!empty($receipt_details->commission_agent))
									<br/>
									<strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
								@endif
                    @if(!empty($receipt_details->customer_rp_label))
                         <p><span >{{ $receipt_details->customer_rp_label }}:</span> {{ $receipt_details->customer_total_rp }}</p>
                    @endif
                </div>
            </div>
			   @endif
        </section>

        <section class="invoice-body">
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th>Désignation</th>
                       
                        <th class="text-right" style="width: 12%;">Qté</th>
                        <th class="text-right" style="width: 15%;">P.U TTC</th>
                        @if(!empty($receipt_details->item_discount_label))
                            <th class="text-right" style="width: 12%;">{{$receipt_details->item_discount_label}}</th>
                        @endif
                        <th class="text-right" style="width: 15%;">Sous-total</th>
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
                          
                            <td class="text-right">{{$line['quantity_uf']}}</td>
                            <td class="text-right">{{$line['unit_price_before_discount']}}</td>
                            @if(!empty($receipt_details->item_discount_label))
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
                @if(!empty($receipt_details->payments))
                    <span style="font-size: 16px;font-weight:bold">Mode de Paiement:</span>
                    <table class="payments-table">
                        @foreach($receipt_details->payments as $payment)
                            <tr>
                                <td>{{$payment['method']}}</td>
                                <td class="text-right">{{$payment['amount']}}</td>
                                <td>({{$payment['date']}})</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                
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
                    @if( !empty($receipt_details->total_line_discount) )
                        <tr>
                            <td>{!! $receipt_details->line_discount_label !!}</td>
                            <td>(-) {{$receipt_details->total_line_discount}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Sous-total TTC</td>
                        <td>{{$receipt_details->subtotal}}</td>
                    </tr>

                    @if( !empty($receipt_details->discount) )
                        <tr>
                            <td>{!! $receipt_details->discount_label !!}</td>
                            <td>(-) {{$receipt_details->discount}}</td>
                        </tr>
                    @endif

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

                    <tr>
                        <td><strong>Total TTC</strong></td>
                        <td><strong>{{$receipt_details->total}}</strong></td>
                    </tr>
                </table>
            </div>
        </section>

        <footer class="invoice-footer">
            <div class="footer-text">
                @if(!empty($receipt_details->footer_text))
                    {!! $receipt_details->footer_text !!}
                @endif
            </div>
             @if( $receipt_details->show_qr_code)
               	<div style="width: 100%; text-align: center;  display:flex;justify-content:center">
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
                </div>
            @endif
        </footer>
    </div>
 <div class="furl">
         www.simplexgestion.tn
    </div>
</body>
</html>