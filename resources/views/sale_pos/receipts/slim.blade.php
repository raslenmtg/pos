<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
        /* === PRINT STYLES FOR 80MM === */
            @media print {
                @page {
                    size: 80mm auto;
                    margin: 0;
                }

                body {
                    width: 302px; /* 80mm ~ 302px at 96dpi */
                    font-size: 10px;
                    line-height: 1.3;
                    margin: 0;
                    padding: 5px;
                    -webkit-print-color-adjust: exact;
                }

                .ticket {
                    width: 100%;
                    max-width: 302px;
                    word-wrap: break-word;
                }

                * {
                    font-family: "Courier New", monospace !important;
                    color: #000;
                    box-sizing: border-box;
                }

                .centered {
                    text-align: center;
                }

                .f-8 {
                    font-size: 8px !important;
                }

                .headings {
                    font-size: 13px;
                    font-weight: 700;
                    text-transform: uppercase;
                }

                .sub-headings {
                    font-size: 11px;
                    font-weight: 700;
                }

                /* === IMAGE SIZING === */
                img {
                    max-width: 60px !important;
                    max-height: 60px !important;
                    display: block;
                    margin: 0 auto;
                }

                /* === TEXT BOX INFO === */
                .textbox-info {
                    width: 100%;
                    clear: both;
                    overflow: hidden;
                    margin-bottom: 2px;
                }

                .textbox-info p {
                    margin: 0;
                    padding: 0;
                    line-height: 1.2;
                }

                .textbox-info .f-left {
                    float: left;
                    width: 45%;
                    text-align: left;
                }

                .textbox-info .f-right {
                    float: right;
                    width: 54%;
                    text-align: right;
                }

                /* === TABLE LAYOUT === */
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 5px;
                }

                th, td {
                    padding: 2px 1px;
                    vertical-align: top;
                    word-break: break-word;
                    font-size: 9px;
                }

                thead th {
                    font-weight: 700;
                    border-bottom: 1px dashed #000;
                    padding-bottom: 3px;
                }

                /* Column widths for product table */
                td.serial_number, th.serial_number {
                    width: 6%;
                    text-align: center;
                }

                td.description, th.description {
                    width: 34%;
                    text-align: left;
                }

                td.quantity, th.quantity {
                    width: 10%;
                    text-align: right;
                }

                td.unit_price, th.unit_price {
                    width: 18%;
                    text-align: right;
                }

                td.price, th.price {
                    width: 18%;
                    text-align: right;
                }

                /* If discount columns are shown */
                .table-f-12 th,
                .table-f-12 td {
                    font-size: 9px;
                }

                /* === BORDERS === */
                .border-bottom-dotted {
                    border-bottom: 1px dotted #000;
                    padding-bottom: 2px;
                }

                .border-top {
                    border-top: 1px solid #000;
                    padding-top: 2px;
                }

                .border-bottom {
                    border-bottom: 1px solid #000;
                    padding-bottom: 2px;
                }

                /* === FLEX BOX FOR TOTALS === */
                .flex-box {
                    display: flex;
                    justify-content: space-between;
                    width: 100%;
                    margin: 1px 0;
                }

                .flex-box p {
                    margin: 0;
                    padding: 0;
                    line-height: 1.3;
                }

                .flex-box .left,
                .flex-box .width-50:first-child {
                    width: 60%;
                    text-align: left;
                }

                .flex-box .width-50:last-child {
                    width: 39%;
                    text-align: right;
                }

                /* === ALIGNMENTS === */
                .text-right { text-align: right; }
                .text-left { text-align: left; }
                .f-left { float: left; }
                .f-right { float: right; }

                /* === SPACING === */
                .mb-10 { margin-bottom: 3px; }
                .m-0 { margin: 0; }
                .mt-5 { margin-top: 2px; }

                br {
                    line-height: 1;
                }

                /* === QR CODE === */
                .centered img[src*="base64"] {
                    max-width: 80px !important;
                    max-height: 80px !important;
                    margin: 5px auto;
                }

                /* === FOOTER === */
                .footer {
                    margin-top: 8px;
                    text-align: center;
                    font-size: 9px;
                }

                /* === SMALL TEXT === */
                small {
                    font-size: 8px;
                }

                /* === WIDTH UTILITIES === */
                .width-100 { width: 100%; }
                .width-60 { width: 60%; }
                .width-50 { width: 50%; }
                .width-40 { width: 40%; }

                /* === HIDE NON-PRINT ELEMENTS === */
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }

                /* === RESPONSIVE TABLE ADJUSTMENTS === */
                /* When discount column is present, adjust widths */
                table.has-discount td.description,
                table.has-discount th.description {
                    width: 28%;
                }

                table.has-discount td.quantity,
                table.has-discount th.quantity {
                    width: 8%;
                }

                table.has-discount td.unit_price,
                table.has-discount th.unit_price {
                    width: 15%;
                }

                table.has-discount td.price,
                table.has-discount th.price {
                    width: 15%;
                }

                /* Discount column */
                table.has-discount td.discount,
                table.has-discount th.discount {
                    width: 12%;
                    text-align: right;
                }

                /* === ENSURE NO OVERFLOW === */
                * {
                    max-width: 100%;
                }

                /* === LINE SPACING FOR READABILITY === */
                tbody tr {
                    border-bottom: 1px dotted #ddd;
                }

                tbody tr:last-child {
                    border-bottom: none;
                }

                /* === PAYMENT SECTION === */
                .payment-section {
                    margin-top: 5px;
                    border-top: 1px dashed #000;
                    padding-top: 3px;
                }

                /* === NOTES SECTION === */
                .additional-notes {
                    margin-top: 5px;
                    font-size: 9px;
                    text-align: center;
                    border-top: 1px dashed #000;
                    padding-top: 3px;
                }
            }
            </style>
    </head>
    <body>
        <div class="ticket">
        	@if(empty($receipt_details->letter_head))
				@if(!empty($receipt_details->logo))
					<div class="text-box centered">
						<img style="max-height: 100px; width: 70px; height: 70px;" src="{{$receipt_details->logo}}" alt="Logo">
					</div>
				@endif
				<div class="text-box">
				<!-- Logo -->
				<p class="centered">
					<!-- Header text -->
					@if(!empty($receipt_details->header_text))
						<span class="headings">{!! $receipt_details->header_text !!}</span>
						<br/>
					@endif

					<!-- business information here -->
					@if(!empty($receipt_details->display_name))
						<span class="headings">
							{{$receipt_details->display_name}}
						</span>
						<br/>
					@endif
					
					@if(!empty($receipt_details->address))
						{!! $receipt_details->address !!}
						<br/>
					@endif

					@if(!empty($receipt_details->contact))
						{!! $receipt_details->contact !!}
					@endif
					@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
						, 
					@endif
					@if(!empty($receipt_details->website))
						{{ $receipt_details->website }}
					@endif
					@if(!empty($receipt_details->location_custom_fields))
						<br>{{ $receipt_details->location_custom_fields }}
					@endif

					@if(!empty($receipt_details->sub_heading_line1))
						{{ $receipt_details->sub_heading_line1 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line2))
						{{ $receipt_details->sub_heading_line2 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line3))
						{{ $receipt_details->sub_heading_line3 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line4))
						{{ $receipt_details->sub_heading_line4 }}<br/>
					@endif		
					@if(!empty($receipt_details->sub_heading_line5))
						{{ $receipt_details->sub_heading_line5 }}<br/>
					@endif

				
				@endif
				
						<br/><span class="sub-headings">{!! $receipt_details->invoice_no_prefix !!}{{$receipt_details->invoice_no}}</span>
				
				</p>
				</div>
				@if(!empty($receipt_details->letter_head))
					<div class="text-box">
						<img style="width: 100%;margin-bottom: 10px; width: 70px; height: 70px;" src="{{$receipt_details->letter_head}}">
					</div>
				@endif
			
			<div class="textbox-info">
				<p class="f-left"><strong>Date: </strong></p>
				<p class="f-right">
					{{$receipt_details->invoice_date}}
				</p>
			</div>
		
	@if(!empty($receipt_details->sales_person))
		<div class="textbox-info">
				<p class="f-left"><strong>{{ $receipt_details->sales_person_label }}: </strong></p>
				<p class="f-right">
					{{$receipt_details->sales_person}}
				</p>
			</div>
								@endif
								@if(!empty($receipt_details->commission_agent))
								<div class="textbox-info">
				<p class="f-left"><strong>{{ $receipt_details->commission_agent_label }}: </strong></p>
				<p class="f-right">
					{{$receipt_details->commission_agent}}
				</p>
			</div>
								
								@endif

		
		

			@if (!empty($receipt_details->sell_custom_field_1_value))
				<div class="textbox-info">
					<p class="f-left"><strong>{!! $receipt_details->sell_custom_field_1_label !!}</strong></p>
					<p class="f-right">
						{{$receipt_details->sell_custom_field_1_value}}
					</p>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_2_value))
				<div class="textbox-info">
					<p class="f-left"><strong>{!! $receipt_details->sell_custom_field_2_label !!}</strong></p>
					<p class="f-right">
						{{$receipt_details->sell_custom_field_2_value}}
					</p>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_3_value))
				<div class="textbox-info">
					<p class="f-left"><strong>{!! $receipt_details->sell_custom_field_3_label !!}</strong></p>
					<p class="f-right">
						{{$receipt_details->sell_custom_field_3_value}}
					</p>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_4_value))
				<div class="textbox-info">
					<p class="f-left"><strong>{!! $receipt_details->sell_custom_field_4_label !!}</strong></p>
					<p class="f-right">
						{{$receipt_details->sell_custom_field_4_value}}
					</p>
				</div>
			@endif

				<div class="textbox-info">
					<p class="f-left"><strong>Client:</strong></p>
					<p class="f-right">
						{!!$receipt_details->customer_info!!}
					</p>
				</div>

			@if(!empty($receipt_details->client_id))
				<div class="textbox-info">
					<p class="f-left"><strong>
					Code client:
					</strong></p>
					<p class="f-right">
						{{ $receipt_details->client_id }}
					</p>
				</div>
			@endif
			
			@if(!empty($receipt_details->customer_tax_number))
				<div class="textbox-info">
					<p class="f-left"><strong>
					M.F
					</strong></p>
					<p class="f-right">
						{{ $receipt_details->customer_tax_number }}
					</p>
				</div>
			@endif

			@if(!empty($receipt_details->customer_custom_fields))
				<div class="textbox-info">
					<p class="centered">
						{!! $receipt_details->customer_custom_fields !!}
					</p>
				</div>
			@endif
			
			@if(!empty($receipt_details->customer_rp_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{{ $receipt_details->customer_rp_label }}
					</strong></p>
					<p class="f-right">
						{{ $receipt_details->customer_total_rp }}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_1_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_1_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_2_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_2_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_3_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_3_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_4_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_4_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_5_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_5_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->sale_orders_invoice_no))
				<div class="textbox-info">
					<p class="f-left"><strong>
						@lang('restaurant.order_no')
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->sale_orders_invoice_no ?? ''!!}
					</p>
				</div>
			@endif

			@if(!empty($receipt_details->sale_orders_invoice_date))
				<div class="textbox-info">
					<p class="f-left"><strong>
						@lang('lang_v1.order_dates')
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->sale_orders_invoice_date ?? ''!!}
					</p>
				</div>
			@endif
            <table style="margin-top: 25px !important" class="border-bottom width-100 table-f-12 mb-10">
                <thead class="border-bottom-dotted">
                    <tr>
                        <th class="serial_number">#</th>
                        <th class="description" width="30%">
                        	Désignation
                        </th>
                        <th class="quantity text-right">
                        	Qté
                        </th>
                        @if(empty($receipt_details->hide_price))
                        <th class="unit_price text-right">
                        	P.U TTC
                        </th>
                        @if(!empty($receipt_details->discounted_unit_price_label))
							<th class="text-right">
								{{$receipt_details->discounted_unit_price_label}}
							</th>
						@endif
                        @if(!empty($receipt_details->item_discount_label))
							<th class="text-right">{{$receipt_details->item_discount_label}}</th>
						@endif
                        <th class="price text-right">total</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                	@forelse($receipt_details->lines as $line)
	                    <tr>
	                        <td class="serial_number" style="vertical-align: top;">
	                        	{{$loop->iteration}}
	                        </td>
	                        <td class="description">
	                        	{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
	                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
	                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
	                        	@if(!empty($line['product_description']))
	                            	<div class="f-8">
	                            		{!!$line['product_description']!!}
	                            	</div>
	                            @endif
	                        	@if(!empty($line['sell_line_note']))
	                        	<br>
	                        	<span class="f-8">
	                        	{!!$line['sell_line_note']!!}
	                        	</span>
	                        	@endif 
	                        

	                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
		                            <br><small>
		                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                            			{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
		                            </small>
		                            @endif
	                        </td>
	                        <td class="quantity text-right">{{$line['quantity_uf']}} @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif</td>
	                        @if(empty($receipt_details->hide_price))
	                        <td class="unit_price text-right">{{$line['unit_price_before_discount']}}</td>

	                        @if(!empty($receipt_details->discounted_unit_price_label))
								<td class="text-right">
									{{$line['unit_price_inc_tax']}} 
								</td>
							@endif

	                        @if(!empty($receipt_details->item_discount_label))
								<td class="text-right">
									{{$line['total_line_discount'] ?? '0.00'}}
									@if(!empty($line['line_discount_percent']))
								 		({{$line['line_discount_percent']}}%)
									@endif
								</td>
							@endif
	                        <td class="price text-right">{{$line['line_total']}}</td>
	                        @endif
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            {{$modifier['name']}} {{$modifier['variation']}} 
			                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
			                        </td>
									<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
									@if(empty($receipt_details->hide_price))
									<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
									@if(!empty($receipt_details->discounted_unit_price_label))
										<td class="text-right">{{$modifier['unit_price_exc_tax']}}</td>
									@endif
									@if(!empty($receipt_details->item_discount_label))
										<td class="text-right">0.00</td>
									@endif
									<td class="text-right">{{$modifier['line_total']}}</td>
									@endif
								</tr>
							@endforeach
						@endif
                    @endforeach
                    <tr>
                    	<td @if(!empty($receipt_details->item_discount_label)) colspan="6" @else colspan="5" @endif>&nbsp;</td>
                    	@if(!empty($receipt_details->discounted_unit_price_label))
    					<td></td>
    					@endif
                    </tr>
                </tbody>
            </table>
		
			@if(empty($receipt_details->hide_price))
                <div class="flex-box">
                    <p class="left text-right sub-headings">
                    	Sous-total:
                    </p>
                    <p class="width-50 text-right sub-headings">
                    	{{$receipt_details->subtotal}}
                    </p>
                </div>

                <!-- Shipping Charges -->
				@if(!empty($receipt_details->shipping_charges))
					<div class="flex-box">
						<p class="left text-right">
							Livraison:
						</p>
						<p class="width-50 text-right">
							{{$receipt_details->shipping_charges}}
						</p>
					</div>
				@endif


				<!-- Discount -->
				@if( !empty($receipt_details->discount) )
					<div class="flex-box">
						<p class="width-50 text-right">
							Remise:
						</p>

						<p class="width-50 text-right">
							(-) {{$receipt_details->discount}}
						</p>
					</div>
				@endif

				@if( !empty($receipt_details->total_line_discount) )
					<div class="flex-box">
						<p class="width-50 text-right">
							{!! $receipt_details->line_discount_label !!}
						</p>

						<p class="width-50 text-right">
							(-) {{$receipt_details->total_line_discount}}
						</p>
					</div>
				@endif

				@if( !empty($receipt_details->additional_expenses) )
					@foreach($receipt_details->additional_expenses as $key => $val)
						<div class="flex-box">
							<p class="width-50 text-right">
								{{$key}}:
							</p>

							<p class="width-50 text-right">
								(+) {{$val}}
							</p>
						</div>
					@endforeach
				@endif

				@if(!empty($receipt_details->reward_point_label) )
					<div class="flex-box">
						<p class="width-50 text-right">
							{!! $receipt_details->reward_point_label !!}:
						</p>

						<p class="width-50 text-right">
							(-) {{$receipt_details->reward_point_amount}}
						</p>
					</div>
				@endif

				@if( !empty($receipt_details->tax) )
					<div class="flex-box">
						<p class="width-50 text-right">
							{!! $receipt_details->tax_label !!}
						</p>
						<p class="width-50 text-right">
							{{$receipt_details->tax}}
						</p>
					</div>
				@endif


				<div class="flex-box">
					<p class="width-50 text-right sub-headings">
					{!! $receipt_details->total_label !!}
					</p>
					<p class="width-50 text-right sub-headings">
						{{$receipt_details->total}}
					</p>
				</div>
				@if(!empty($receipt_details->total_in_words))
				<p colspan="2" class="text-right mb-0">
					<small>
					Arrêté la présente {!! $receipt_details->invoice_heading !!} à la somme de : {{$receipt_details->total_in_words}}
					</small>
				</p>
				@endif
				@if(!empty($receipt_details->payments))
				Méthode paiement:
					@foreach($receipt_details->payments as $payment)
						<div class="flex-box">
							<p class="width-50 text-right">{{$payment['method']}} ({{$payment['date']}}) </p>
							<p class="width-50 text-right">{{$payment['amount']}}</p>
						</div>
					@endforeach
				@endif

			

			
			@endif
          

            @if(!empty($receipt_details->additional_notes))
	            <p class="centered">
	            	{!! nl2br($receipt_details->additional_notes) !!}
	            </p>
            @endif
			
		@if(!empty($receipt_details->footer_text))
						<div style="width:100%  text-align: center; margin-top:5px;margin-bottom:5px; display:flex;justify-content:center">
							{!! $receipt_details->footer_text !!}
						</div>
						@endif
			
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>

