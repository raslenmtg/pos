@php
	// This variable is used to calculate the pre-discount total for the totals box
	$total_pre_discount_ht = 0;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>{!! $receipt_details->invoice_heading ?? 'Bon de Livraison' !!} - {{$receipt_details->invoice_no}}</title>
	<style>
		/* --- ALL STYLES ARE NOW SCOPED TO .invoice-container-bon --- */
		.invoice-container-bon {
			font-family: 'Arial', sans-serif;
			font-size: 10px;
			color: #000;
			line-height: 1.4;
			width: 100%;
			margin: 0 auto;
		}
		.invoice-container-bon table {
			width: 100%;
			border-collapse: collapse;
		}
		/* Use classes for specific table styles */
		.invoice-container-bon .header-table,
		.invoice-container-bon .doc-info-table,
		.invoice-container-bon .items-table,
		.invoice-container-bon .footer-table,
		.invoice-container-bon .bottom-bar-table {
			margin-bottom: 10px;
		}

		/* --- Header Table (Business/Customer) --- */
		.invoice-container-bon .header-table td {
			padding: 5px;
			vertical-align: top;
		}
		.invoice-container-bon .header-table .business-info {
			width: 50%;
			font-size: 11px;
			line-height: 1.5;
		}
		.invoice-container-bon .header-table .customer-info-box {
			width: 50%;
			border: 1px solid #000;
			padding: 8px;
			height: 100%;
		}
		.invoice-container-bon .business-info strong {
			font-size: 14px;
			font-weight: bold;
		}
		
		/* --- Doc Info Table (Date/Title/N°) --- */
		.invoice-container-bon .doc-info-table {
			margin-top: 10px;
		}
		.invoice-container-bon .doc-info-table td {
			padding: 5px;
			font-size: 12px;
		}
		.invoice-container-bon .doc-info-table .doc-title {
			text-align: center;
			font-weight: bold;
			font-size: 14px;
		}
		.invoice-container-bon .doc-info-table .doc-number {
			text-align: right;
		}


		/* --- Items Table --- */
		.invoice-container-bon .items-table {
			/*border: 1px solid #000;*/
		}
		.invoice-container-bon .items-table th {
			background-color: #eee;
			border: 1px solid #000;
			padding: 6px;
			font-weight: bold;
			text-align: center;
		}
		.invoice-container-bon .items-table td {
			border: 1px solid #000;
			padding: 5px;
			vertical-align: top;
		}
		.invoice-container-bon .items-table .text-right {
			text-align: right;
		}
		.invoice-container-bon .items-table .text-center {
			text-align: center;
		}
		/* This creates the "big box" effect by ensuring the body has a minimum height */
		/* Removed display block to allow proper pagination */
		.invoice-container-bon .items-table tbody {
			/* display: block; */
		}
		.invoice-container-bon .items-table tr {
			/* display: table; */
			width: 100%;
			table-layout: fixed;
		}
		.invoice-container-bon .items-table thead {
			/* display: table; */
			width: 100%;
			table-layout: fixed;
		}
		.invoice-container-bon .items-table .col-code { width: 12%; }
		.invoice-container-bon .items-table .col-designation { width: 30%; }
		.invoice-container-bon .items-table .col-qty { width: 8%; }
		.invoice-container-bon .items-table .col-pu { width: 10%; }
		.invoice-container-bon .items-table .col-netht { width: 10%; }
		.invoice-container-bon .items-table .col-tva { width: 8%; }
		.invoice-container-bon .items-table .col-ttc { width: 12%; }
		
		.invoice-container-bon .items-table small {
			font-size: 9px;
			color: #333;
		}

		/* --- Footer Tables (Signature, TVA, Totals) --- */
		.invoice-container-bon .footer-table > tbody > tr > td {
			vertical-align: top;
			padding: 0 5px;
		}
		.invoice-container-bon .footer-table .signature-box {
			width: 30%;
			border: 1px solid #000;
			padding: 5px;
			min-height: 120px;
		}
		.invoice-container-bon .footer-table .tva-box {
			width: 35%;
		}
		.invoice-container-bon .footer-table .totals-box {
			width: 35%;
		}
		
		/* Nested TVA Table */
		.invoice-container-bon .tva-table, .invoice-container-bon .totals-table {
			border: 1px solid #000;
		}
		.invoice-container-bon .tva-table th, .invoice-container-bon .totals-table th {
			border: 1px solid #000;
			padding: 4px;
			background-color: #eee;
			font-weight: bold;
		}
		.invoice-container-bon .tva-table td, .invoice-container-bon .totals-table td {
			border: 1px solid #000;
			padding: 4px;
		}
		.invoice-container-bon .tva-table .header-row th {
			text-align: center;
		}
		
		/* Nested Totals Table */
		.invoice-container-bon .totals-table td:first-child {
			font-weight: bold;
			width: 60%;
		}
		.invoice-container-bon .totals-table td:last-child {
			text-align: right;
		}
		.invoice-container-bon .totals-table .net-a-payer {
			background-color: #eee;
			font-weight: bold;
			font-size: 12px;
		}

        /* Payments Table */
        .invoice-container-bon .payments-table {
            border: 1px solid #000;
            margin-top: 10px;
            width: fit-content;
            border-collapse: collapse;
        }
        .invoice-container-bon .payments-table th,
        .invoice-container-bon .payments-table td {
            border: 1px solid #000;
            padding: 5px;
        }


        /* --- Bottom Bar (Words, Payment) --- */
		.invoice-container-bon .bottom-bar-table {
			border: 1px solid #000;
			padding: 8px;
		}
		.invoice-container-bon .bottom-bar-table td {
			padding: 2px 5px;
		}
		.invoice-container-bon .bottom-bar-table .total-in-words {
			font-weight: bold;
		}
		
		/* small adjustments for page-number inline */
		.invoice-container-bon .doc-number .pagenum,
		.invoice-container-bon .doc-number .pagecount {
			display: inline-block;
			min-width: 10px;
		}

	</style>
</head>
<body>
	<div class="invoice-container-bon">

		<table class="header-table">
			<tr>
				<td class="business-info">
					@if(empty($receipt_details->letter_head))
						@if(!empty($receipt_details->display_name))
							<strong>{{$receipt_details->display_name}}</strong>
						@endif
						@if(!empty($receipt_details->address))
							<div>{!! $receipt_details->address !!}</div>
						@endif
						@if(!empty($receipt_details->contact))
							<div>{!! $receipt_details->contact !!}</div>
						@endif
						@if(!empty($receipt_details->tax_info1))
							<div>{{ $receipt_details->tax_label1 }}: {{ $receipt_details->tax_info1 }}</div>
						@endif
						@if(!empty($receipt_details->tax_info2))
							<div>{{ $receipt_details->tax_label2 }}: {{ $receipt_details->tax_info2 }}</div>
						@endif
					@endif
				</td>
				<td class="customer-info-box">
					@if(!empty($receipt_details->client_id))
						<div><strong>Code client:</strong> {{ $receipt_details->client_id }}</div>
					@endif
					@if(!empty($receipt_details->customer_info))
						<div>{!! $receipt_details->customer_info !!}</div>
					@endif
					@if(!empty($receipt_details->customer_tax_number))
						<div><strong>M.F:</strong> {{ $receipt_details->customer_tax_number }}</div>
					@endif
					@if(!empty($receipt_details->customer_custom_fields))
						<div>{!! $receipt_details->customer_custom_fields !!}</div>
					@endif
				</td>
			</tr>
		</table>

		<table class="doc-info-table">
			<tr>
				<td><strong>Date Le :</strong> {{$receipt_details->invoice_date}}</td>
				<td class="doc-number">
					<strong>{!! $receipt_details->invoice_heading !!} N° :</strong> {{$receipt_details->invoice_no}} <br>

				</td>
			</tr>
		</table>
		<table class="items-table">
			<thead>
				<tr>
					<th class="col-code">#</th>
					<th class="col-designation">DESIGNATION</th>
					<th class="col-qty">QUANTITE</th>
					<th class="col-pu">P.U. HT</th>
					<th class="col-netht">TOTAL HT</th>
					<th class="col-tva">TVA</th>
					<th class="col-tva">Remise</th>
					<th class="col-ttc">TOTAL TTC</th>
				</tr>
			</thead>
			<tbody>
				@foreach($receipt_details->lines as $line)
				
					<tr>
						<td class="col-code">	{{$loop->iteration}}</td>
						<td class="col-designation">
							{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
							@if(!empty($line['brand'])), {{$line['brand']}} @endif
							@if(!empty($line['product_description']))
								<br><small>{!!$line['product_description']!!}</small>
							@endif 
							@if(!empty($line['sell_line_note']))
								<br><small>{!!$line['sell_line_note']!!}</small>
							@endif
							@if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
						</td>
						<td class="col-qty text-center">{{$line['quantity_uf']}}</td>
						<td class="col-pu text-right">{{$line['unit_price_exc_tax']??'-'}}</td>
						<td class="col-netht text-right">{{$line['line_total_exc_tax']!='0.000'?$line['line_total_exc_tax']:'-' }}</td>
                        <td class="col-tva text-center">
                            {{empty($line['tax_percent'])?'-':$line['tax_percent'].'%'}}
                        </td>
						<td class="col-tva text-center">
                            @if(!empty($line['line_discount_percent']))
                                {{$line['line_discount_percent']}}%
                            @else
                                {{$line['total_line_discount']!='0.000'?$line['total_line_discount']:'' }}
                            @endif
                        </td>

						<td class="col-ttc text-right">
								{{$line['line_total']}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<table class="footer-table">
			<tr>
				<td class="signature-box">
					<strong>Cachet & Signature</strong>
				</td>
                @if(!empty($receipt_details->taxes))
				<td class="tva-box">
					<table class="tva-table">
						<thead>
							<tr class="header-row">
								<th colspan="3">T . V . A</th>
							</tr>
							<tr>
								<th>TAUX</th>
								<th>MONT. TVA.</th>
							</tr>
						</thead>
						<tbody>

								@foreach($receipt_details->taxes as $key => $val)
									<tr>
										<td class="text-center">{{$key}}</td>
										<td class="text-right">{{$val}}</td>
									</tr>
								@endforeach


						
						</tbody>
					</table>
				</td>
                @endif
				<td class="totals-box">
					<table class="totals-table">
						<thead>
							<tr>
								<th colspan="2" style="text-align: center">T  O  T  A  U  X</th>
							</tr>
						</thead>
						<tbody>


							<tr>
								<td>TOTAL HT.</td>
								<td>{{$receipt_details->subtotal_exc_tax }}</td>
							</tr>
                            @if(!empty($receipt_details->taxes))
							<tr>
								<td>TOTAL TVA</td>
								<td>{{$receipt_details->taxes['Total TVA'] }}</td>
							</tr>
                            @endif

                            @if(!empty($receipt_details->total_line_discount ))
                            <tr>
                                <td>TOTAL REM.</td>
                                <td>{{$receipt_details->total_line_discount }}</td>
                            </tr>
                            @endif
                        @if(!empty($receipt_details->discount ))
                        <tr>
                            <td>REMISE</td>
                            <td>{{$receipt_details->discount }}</td>
                        </tr>
                        @endif
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px;">
                                    Sous-total TTC
                                </td>
                                <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                                    {{$receipt_details->subtotal}}
                                </td>
                            </tr>

            @if( !empty($receipt_details->additional_expenses) )
                @foreach($receipt_details->additional_expenses as $key => $val)
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">
                            {{$key}}:
                        </td>

                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            (+) {{$val}}
                        </td>
                    </tr>
                @endforeach
            @endif
                <!-- Shipping Charges -->
                @if(!empty($receipt_details->shipping_charges))
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">
                            {!! $receipt_details->shipping_charges_label !!}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{$receipt_details->shipping_charges}}
                        </td>
                    </tr>
                @endif

                @if( !empty($receipt_details->reward_point_label) )
                <tr>
                    <td style="border: 1px solid #000; padding: 5px;">
                        {!! $receipt_details->reward_point_label !!}
                    </td>

                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                        (-) {{$receipt_details->reward_point_amount}}
                    </td>
                </tr>
                @endif

                @if(!empty($receipt_details->group_tax_details))
                    @foreach($receipt_details->group_tax_details as $key => $value)
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px;">
                                {!! $key !!}
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                                 {{$value}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @if( !empty($receipt_details->tax) )
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px;">
                                {!! $receipt_details->tax_label !!}
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                                 {{$receipt_details->tax}}
                            </td>
                        </tr>
                    @endif
                @endif
<tr class="net-a-payer">
    <td>NET A PAYER</td>
    <td>{{$receipt_details->total }}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>

        @if(!empty($receipt_details->total_in_words))
            Arrêté Le Présent {!! $receipt_details->invoice_heading !!} à la somme de : {{$receipt_details->total_in_words}}
        @endif
        @if(!empty($receipt_details->payments))
            <table class="payments-table">


                <tr>
                    <th>
                        <strong>Méthode paiement</strong>
                    </th>
                    <th>
                        <strong>Montant</strong>
                    </th>
                    <th>
                        <strong>Date</strong>
                    </th>
                </tr>
                @foreach($receipt_details->payments as $payment)
                    <tr>
                        <td >{{$payment['method']}}</td>
                        <td >{{$payment['amount']}}</td>
                        <td >{{$payment['date']}}</td>
                    </tr>
                @endforeach

            </table>
        @endif
    </div></body>
</html>