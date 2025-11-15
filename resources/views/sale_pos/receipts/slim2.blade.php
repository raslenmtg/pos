<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            /* Add this to your existing styles or replace the @media print section */

            @media print {
                * {
                    font-size: 10px !important;
                    font-family: 'Times New Roman';
                    word-break: break-word;
                }

                body {
                    margin: 0;
                    padding: 0;
                    width: 58mm;
                }

                .f-8 {
                    font-size: 7px !important;
                }

                .headings {
                    font-size: 12px !important;
                    font-weight: 700;
                    text-transform: uppercase;
                }

                .sub-headings {
                    font-size: 11px !important;
                    font-weight: 700;
                }

                /* Fix image sizes */
                img {
                    max-width: 50px !important;
                    height: auto !important;
                    width: auto !important;
                }

                /* Simplify layout for narrow paper */
                .ticket {
                    width: 58mm;
                    max-width: 58mm;
                    padding: 2mm;
                    box-sizing: border-box;
                }

                /* Stack textbox-info items vertically */
                .textbox-info {
                    width: 100%;
                    margin-bottom: 2px;
                }

                .textbox-info p {
                    display: block;
                    width: 100% !important;
                    margin: 0;
                    padding: 0;
                    text-align: left;
                }

                .textbox-info .f-left {
                    display: inline;
                    font-weight: bold;
                }

                .textbox-info .f-right {
                    display: inline;
                    float: none;
                }

                /* Fix flex-box for narrow paper */
                .flex-box {
                    display: table;
                    width: 100%;
                    margin-bottom: 2px;
                }

                .flex-box p {
                    display: table-cell;
                    width: 50%;
                    padding: 1px 0;
                    font-size: 9px !important;
                }

                .flex-box .left,
                .flex-box .width-50:first-child {
                    text-align: left;
                }

                .flex-box .width-50:last-child {
                    text-align: right;
                }

                /* Product table adjustments */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                td.description {
                    width: 100%;
                    max-width: 100%;
                    padding: 2px 0;
                }

                td.description > div {
                    display: block !important;
                    width: 100% !important;
                }

                /* Stack quantity and price */
                td.description p {
                    display: block;
                    width: 100% !important;
                    margin: 1px 0 !important;
                    font-size: 9px !important;
                }

                .quantity {
                    text-align: left !important;
                }

                .price {
                    text-align: right !important;
                }

                /* Center aligned content */
                .centered {
                    text-align: center;
                    display: block;
                    width: 100%;
                }

                /* Remove excessive spacing */
                br {
                    line-height: 0.5;
                }

                .border-bottom {
                    border-bottom: 1px solid #000;
                    margin: 2px 0;
                }

                .bb-lg {
                    border-bottom: 1px dashed #000;
                    padding-bottom: 2px;
                }

                /* QR Code */
                .centered img {
                    max-width: 40mm !important;
                    height: auto !important;
                }

                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }

                /* Ensure no content overflows */
                * {
                    max-width: 54mm;
                    box-sizing: border-box;
                }
            }
        </style>
    </head>
    <body>
        <div class="ticket">
			@if(empty($receipt_details->letter_head))

				<div style="width:100%; text-align:center;">
			
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
						<br/>{!! $receipt_details->contact !!}
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
	<br/><span class="sub-headings">{!! $receipt_details->invoice_no_prefix !!} {{$receipt_details->invoice_no}}</span>
				
				
				</div>
			@endif

		
			<div class="textbox-info">
				<p class="f-left"><strong>Date</strong></p>
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
			
            <table style="padding-top: 5px !important" class="border-bottom width-100 table-f-12 mb-10">
                <tbody>
                	@forelse($receipt_details->lines as $line)
	                    <tr class="bb-lg">
	                        <td class="description">
	                        	<div style="display:flex; width: 100%;">
	                        		
	                        		<p class="text-left m-0 mt-5 pull-left">{{$line['name']}}  
			                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif



			                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
				                            <br><small>
				                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br> {{$line['quantity_uf']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}} <br>
                            					{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
				                            </small>
				                            @endif
	                        		</p>
	                        	</div>
	                        	<div style="display:flex; width: 100%;">
	                        		<p class="text-left width-60 quantity m-0 bw" style="direction: ltr;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                        			{{$line['quantity']}} 
	                        			@if(empty($receipt_details->hide_price))
	                        			x {{$line['unit_price_before_discount']}}
	                        			
	                        			@if(!empty($line['total_line_discount']) && $line['total_line_discount'] != 0)
	                        				- {{$line['total_line_discount']}}
	                        			@endif
	                        			@endif
	                        		</p>
	                        		@if(empty($receipt_details->hide_price))
	                        		<p class="text-right width-40 price m-0 bw">{{$line['line_total']}}</p>
	                        		@endif
	                        	</div>
	                        </td>
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										<div style="display:flex;">
	                        				<p style="width: 28px;" class="m-0">
	                        				</p>
	                        				<p class="text-left width-60 m-0" style="margin:0;">
	                        					{{$modifier['name']}} 
	                        					@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            		@if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif
	                        				</p>
	                        				<p class="text-right width-40 m-0">
	                        					{{$modifier['variation']}}
	                        				</p>
	                        			</div>	
	                        			<div style="display:flex;">
	                        				<p style="width: 28px;"></p>
	                        				<p class="text-left width-50 quantity">
	                        					{{$modifier['quantity']}}
	                        					@if(empty($receipt_details->hide_price))
	                        					x {{$modifier['unit_price_inc_tax']}}
	                        					@endif
	                        				</p>
	                        				<p class="text-right width-50 price">
	                        					{{$modifier['line_total']}}
	                        				</p>
	                        			</div>		                             
			                        </td>
			                    </tr>
							@endforeach
						@endif
                    @endforeach
                </tbody>
            </table>
          
			@if(empty($receipt_details->hide_price))
            <div class="flex-box">
                <p class="left text-left">
                	<strong>Sous-total</strong>
                </p>
                <p class="width-50 text-right">
                	<strong>{{$receipt_details->subtotal}}</strong>
                </p>
            </div>

            <!-- Shipping Charges -->
			@if(!empty($receipt_details->shipping_charges))
				<div class="flex-box">
					<p class="left text-left">
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
					<p class="width-50 text-left">
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
					<p class="width-50 text-left">
						{!! $receipt_details->reward_point_label !!}
					</p>

					<p class="width-50 text-right">
						(-) {{$receipt_details->reward_point_amount}}
					</p>
				</div>
			@endif

			@if( !empty($receipt_details->tax) )
				<div class="flex-box">
					<p class="width-50 text-left">
					Tax:
					</p>
					<p class="width-50 text-right">
						(+) {{$receipt_details->tax}}
					</p>
				</div>
			@endif

			<div class="flex-box">
				<p class="width-50 text-left">
					<strong>Total:</strong>
				</p>
				<p class="width-50 text-right">
					<strong>{{$receipt_details->total}}</strong>
				</p>
			</div>
			@if(!empty($receipt_details->total_in_words))
				<p colspan="2" class="text-right mb-0">
					<small>
					({{$receipt_details->total_in_words}})
					</small>
				</p>
			@endif
			@if(!empty($receipt_details->payments))
			Méthode paiement:
				@foreach($receipt_details->payments as $payment)
					<div class="flex-box">
						<p class="width-50 text-left">{{$payment['method']}} ({{$payment['date']}}) </p>
						<p class="width-50 text-right">{{$payment['amount']}}</p>
					</div>
				@endforeach
			@endif
			
			@endif
           
            @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
	            <!-- tax -->
	            @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12">
	            		<tr>
	            			<th colspan="2" class="text-center">{{$receipt_details->tax_summary_label}}</th>
	            		</tr>
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="left">{{$key}}</td>
	            				<td class="right">{{$val}}</td>
	            			</tr>
	            		@endforeach
	            	</table>
	            @endif
            @endif

            @if(!empty($receipt_details->additional_notes))
	            <p class="centered" >
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

        <!-- Thermal Printer Client-Side Scripts for SaaS (Mobile Bluetooth RPP02N Support) -->
        <script src="{{ asset('js/thermal-printer-client.js?v=' . $asset_v) }}"></script>
        <script src="{{ asset('js/pos-thermal-print.js?v=' . $asset_v) }}"></script>
    </body>
</html>

