<!-- business information here -->
<style>
	.invoice-classic {
		font-family: Arial, sans-serif;
		max-width: 210mm;
		margin: 0 auto;
		padding: 10mm;
		background: #fff;
		color: #000;
		line-height: 1.4;
		font-size: 12px;
	}
	.invoice-header {
		border-bottom: 2px solid #000;
		padding-bottom: 15px;
		margin-bottom: 20px;
	}
	.company-logo {
		max-height: 60px;
		margin-bottom: 10px;
	}
	.company-info {
		text-align: center;
		margin-bottom: 15px;
	}
	.company-name {
		font-size: 20px;
		font-weight: bold;
		color: #000;
		margin-bottom: 8px;
		text-transform: uppercase;
	}
	.company-details {
		font-size: 11px;
		color: #000;
		margin-bottom: 3px;
	}
	.invoice-title {
		font-size: 18px;
		font-weight: bold;
		color: #000;
		text-align: center;
		margin: 15px 0;
		padding: 8px;
		border: 2px solid #000;
		text-transform: uppercase;
		letter-spacing: 1px;
	}
	.invoice-meta {
		border: 1px solid #000;
		padding: 15px;
		margin-bottom: 20px;
	}
	.meta-left, .meta-right {
		font-size: 11px;
	}
	.meta-label {
		font-weight: bold;
		color: #000;
		display: inline-block;
		min-width: 100px;
	}
	.invoice-table {
		width: 100%;
		border-collapse: collapse;
		margin: 15px 0;
		border: 1px solid #000;
	}
	.invoice-table th {
		background: #000;
		color: #fff;
		padding: 8px 6px;
		font-weight: bold;
		text-align: left;
		font-size: 11px;
		border: 1px solid #000;
	}
	.invoice-table td {
		padding: 6px;
		border: 1px solid #000;
		vertical-align: top;
		font-size: 10px;
	}
	.invoice-table tbody tr:nth-child(even) {
		background: #f9f9f9;
	}
	.text-right {
		text-align: right !important;
	}
	.totals-section {
		margin-top: 20px;
	}
	.payment-info {
		float: left;
		width: 48%;
		margin-right: 2%;
	}
	.totals-table {
		float: right;
		width: 48%;
		margin-left: 2%;
	}
	.totals-table table, .payment-info table {
		width: 100%;
		border-collapse: collapse;
		border: 1px solid #000;
	}
	.totals-table th, .totals-table td, .payment-info th, .payment-info td {
		padding: 6px 8px;
		border: 1px solid #000;
		font-size: 11px;
	}
	.totals-table th, .payment-info th {
		background: #f0f0f0;
		font-weight: bold;
		color: #000;
	}
	.total-final {
		background: #000 !important;
		color: #fff !important;
		font-weight: bold;
		font-size: 12px;
	}
	.tax-summary {
		margin-top: 20px;
		clear: both;
	}
	.tax-summary table {
		width: 100%;
		border-collapse: collapse;
		border: 1px solid #000;
	}
	.tax-summary th {
		background: #000;
		color: #fff;
		padding: 8px;
		font-weight: bold;
		border: 1px solid #000;
	}
	.tax-summary td {
		padding: 6px 8px;
		border: 1px solid #000;
		text-align: center;
		font-size: 11px;
	}
	.invoice-footer {
		margin-top: 30px;
		padding-top: 15px;
		border-top: 1px solid #000;
		clear: both;
	}
	.footer-text {
		font-size: 11px;
		color: #000;
		margin-bottom: 10px;
	}
	.barcode-section {
		text-align: center;
		margin-top: 10px;
	}
	.additional-notes {
		margin: 15px 0;
		padding: 10px;
		border: 1px solid #000;
		border-left: 4px solid #000;
		font-size: 11px;
		color: #000;
	}
	.product-image {
		max-width: 40px;
		height: auto;
		margin-right: 8px;
		float: left;
		border: 1px solid #ccc;
	}
	
	/* Print optimizations */
	@media print {
		.invoice-classic {
			padding: 5mm;
			margin: 0;
		}
		body {
			margin: 0;
			padding: 0;
		}
		.invoice-table th {
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}
		.total-final {
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}
		.tax-summary th {
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}
	}
	
	/* Clear floats utility */
	.clearfix::after {
		content: "";
		display: table;
		clear: both;
	}
</style>

<div class="invoice-classic">
<div class="row invoice-header" style="color: #000000 !important;">
		<!-- Logo -->
		@if(empty($receipt_details->letter_head))
			@if(!empty($receipt_details->logo))
				<div class="text-center">
					<img src="{{$receipt_details->logo}}" class="company-logo img img-responsive">
				</div>
			@endif

			<!-- Header text -->
			@if(!empty($receipt_details->header_text))
				<div class="col-xs-12">
					{!! $receipt_details->header_text !!}
				</div>
			@endif

			<!-- business information here -->
			<div class="col-xs-12 company-info">
				<div class="company-name">
					<!-- Shop & Location Name  -->
					@if(!empty($receipt_details->display_name))
						{{$receipt_details->display_name}}
					@endif
				</div>

				<!-- Address -->
				<div class="company-details">
				@if(!empty($receipt_details->address))
						{!! $receipt_details->address !!}
				@endif
				</div>
				@if(!empty($receipt_details->contact) || !empty($receipt_details->website))
				<div class="company-details">
					@if(!empty($receipt_details->contact))
						{!! $receipt_details->contact !!}
					@endif
					@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
						 • 
					@endif
					@if(!empty($receipt_details->website))
						{{ $receipt_details->website }}
					@endif
				</div>
				@endif
				@if(!empty($receipt_details->location_custom_fields))
				<div class="company-details">{{ $receipt_details->location_custom_fields }}</div>
				@endif
				@if(!empty($receipt_details->sub_heading_line1) || !empty($receipt_details->sub_heading_line2) || !empty($receipt_details->sub_heading_line3) || !empty($receipt_details->sub_heading_line4) || !empty($receipt_details->sub_heading_line5))
				<div class="company-details">
					@if(!empty($receipt_details->sub_heading_line1))
						{{ $receipt_details->sub_heading_line1 }}<br>
					@endif
					@if(!empty($receipt_details->sub_heading_line2))
						{{ $receipt_details->sub_heading_line2 }}<br>
					@endif
					@if(!empty($receipt_details->sub_heading_line3))
						{{ $receipt_details->sub_heading_line3 }}<br>
					@endif
					@if(!empty($receipt_details->sub_heading_line4))
						{{ $receipt_details->sub_heading_line4 }}<br>
					@endif		
					@if(!empty($receipt_details->sub_heading_line5))
						{{ $receipt_details->sub_heading_line5 }}
					@endif
				</div>
				@endif
				@if(!empty($receipt_details->tax_info1) || !empty($receipt_details->tax_info2))
				<div class="company-details">
					@if(!empty($receipt_details->tax_info1))
						<strong>{{ $receipt_details->tax_label1 }}</strong> {{ $receipt_details->tax_info1 }}
						@if(!empty($receipt_details->tax_info2))<br>@endif
					@endif
					@if(!empty($receipt_details->tax_info2))
						<strong>{{ $receipt_details->tax_label2 }}</strong> {{ $receipt_details->tax_info2 }}
					@endif
				</div>
				@endif
			</div>
		@endif


			<!-- Title of receipt -->
			@if(!empty($receipt_details->invoice_heading))
				<div class="invoice-title">
					{!! $receipt_details->invoice_heading !!}
				</div>
			@endif
		</div>
		@if(!empty($receipt_details->letter_head))
			<div class="col-xs-12 text-center">
				<img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
			</div>
		@endif
	<div class="col-xs-12 invoice-meta">
		<!-- Invoice  number, Date  -->
		<div class="row">
			<div class="col-xs-6 meta-left">
				<div style="margin-bottom: 8px;">
					<span class="meta-label">Invoice #:</span>
					@if(!empty($receipt_details->invoice_no_prefix))
						{!! $receipt_details->invoice_no_prefix !!}
					@endif
					{{$receipt_details->invoice_no}}
				</div>

				@if(!empty($receipt_details->types_of_service))
					<div style="margin-bottom: 8px;">
						<span class="meta-label">{!! $receipt_details->types_of_service_label !!}:</span>
						{{$receipt_details->types_of_service}}
					</div>
					@if(!empty($receipt_details->types_of_service_custom_fields))
						@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
							<div style="margin-bottom: 5px;"><span class="meta-label">{{$key}}:</span> {{$value}}</div>
						@endforeach
					@endif
				@endif

				<!-- Table information-->
		        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
		        	<div style="margin-bottom: 8px;">
						@if(!empty($receipt_details->table_label))
							<span class="meta-label">{!! $receipt_details->table_label !!}:</span>
						@endif
						{{$receipt_details->table}}
					</div>
		        @endif

				<!-- customer info -->
				@if(!empty($receipt_details->customer_info))
					<div style="margin-bottom: 8px;">
						<span class="meta-label">{{ $receipt_details->customer_label }}:</span><br>
						{!! $receipt_details->customer_info !!}
					</div>
				@endif
				@if(!empty($receipt_details->client_id_label))
					<br/>
					<b>{{ $receipt_details->client_id_label }}</b> {{ $receipt_details->client_id }}
				@endif
				@if(!empty($receipt_details->customer_tax_label))
					<br/>
					<b>{{ $receipt_details->customer_tax_label }}</b> {{ $receipt_details->customer_tax_number }}
				@endif
				@if(!empty($receipt_details->customer_custom_fields))
					<br/>{!! $receipt_details->customer_custom_fields !!}
				@endif
				@if(!empty($receipt_details->sales_person_label))
					<br/>
					<b>{{ $receipt_details->sales_person_label }}</b> {{ $receipt_details->sales_person }}
				@endif
				@if(!empty($receipt_details->commission_agent_label))
					<br/>
					<strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
				@endif
				@if(!empty($receipt_details->customer_rp_label))
					<br/>
					<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}
				@endif
			</div>

			<div class="col-xs-6 meta-right text-right">
				<div style="margin-bottom: 8px;">
					<span class="meta-label">{{$receipt_details->date_label}}:</span>
					{{$receipt_details->invoice_date}}
				</div>

				@if(!empty($receipt_details->due_date_label))
				<div style="margin-bottom: 8px;">
					<span class="meta-label">{{$receipt_details->due_date_label}}:</span>
					{{$receipt_details->due_date ?? ''}}
				</div>
				@endif

				@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
					<br>
					@if(!empty($receipt_details->brand_label))
						<b>{!! $receipt_details->brand_label !!}</b>
					@endif
					{{$receipt_details->repair_brand}}
		        @endif


		        @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
					<br>
					@if(!empty($receipt_details->device_label))
						<b>{!! $receipt_details->device_label !!}</b>
					@endif
					{{$receipt_details->repair_device}}
		        @endif

				@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
					<br>
					@if(!empty($receipt_details->model_no_label))
						<b>{!! $receipt_details->model_no_label !!}</b>
					@endif
					{{$receipt_details->repair_model_no}}
		        @endif

				@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
					<br>
					@if(!empty($receipt_details->serial_no_label))
						<b>{!! $receipt_details->serial_no_label !!}</b>
					@endif
					{{$receipt_details->repair_serial_no}}<br>
		        @endif
				@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
					@if(!empty($receipt_details->repair_status_label))
						<b>{!! $receipt_details->repair_status_label !!}</b>
					@endif
					{{$receipt_details->repair_status}}<br>
		        @endif
		        
		        @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
					@if(!empty($receipt_details->repair_warranty_label))
						<b>{!! $receipt_details->repair_warranty_label !!}</b>
					@endif
					{{$receipt_details->repair_warranty}}
					<br>
		        @endif
		        
				<!-- Waiter info -->
				@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
		        	<br/>
					@if(!empty($receipt_details->service_staff_label))
						<b>{!! $receipt_details->service_staff_label !!}</b>
					@endif
					{{$receipt_details->service_staff}}
		        @endif
		        @if(!empty($receipt_details->shipping_custom_field_1_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
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
				{{-- sale order --}}
				@if(!empty($receipt_details->sale_orders_invoice_no))
					<br>
					<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
				@endif

				@if(!empty($receipt_details->sale_orders_invoice_date))
					<br>
					<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_1_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_1_label }}:</strong> {!!$receipt_details->sell_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_2_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_2_label }}:</strong> {!!$receipt_details->sell_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_3_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_3_label }}:</strong> {!!$receipt_details->sell_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_4_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_4_label }}:</strong> {!!$receipt_details->sell_custom_field_4_value ?? ''!!}
				@endif

			</div>
		</div>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	@includeIf('sale_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-12">
		<br/>
		@php
			$p_width = 45;
		@endphp
		@if(!empty($receipt_details->item_discount_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		@if(!empty($receipt_details->discounted_unit_price_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		<table class="invoice-table">
			<thead>
				<tr>
					<th width="{{$p_width}}%">{{$receipt_details->table_product_label}}</th>
					<th class="text-right" width="15%">{{$receipt_details->table_qty_label}}</th>
					<th class="text-right" width="15%">{{$receipt_details->table_unit_price_label}}</th>
					@if(!empty($receipt_details->discounted_unit_price_label))
						<th class="text-right" width="10%">{{$receipt_details->discounted_unit_price_label}}</th>
					@endif
					@if(!empty($receipt_details->item_discount_label))
						<th class="text-right" width="10%">{{$receipt_details->item_discount_label}}</th>
					@endif
					<th class="text-right" width="15%">{{$receipt_details->table_subtotal_label}}</th>
				</tr>
			</thead>
			<tbody>
				@forelse($receipt_details->lines as $line)
					<tr>
						<td>
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Product Image" class="product-image">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['product_description']))
                            	<small>
                            		{!!$line['product_description']!!}
                            	</small>
                            @endif 
                            @if(!empty($line['sell_line_note']))
                            <br>
                            <small>
                            	{!!$line['sell_line_note']!!}
                            </small>
                            @endif 
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

                            @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif

                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                            	{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                            </small>
                            @endif
                        </td>
						<td class="text-right">
							{{$line['quantity']}} {{$line['units']}} 

							@if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif
						</td>
						<td class="text-right">{{$line['unit_price_before_discount']}}</td>
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
						<td class="text-right">{{$line['line_total']}}</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td>
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
		                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
		                        </td>
								<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
								<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
								@if(!empty($receipt_details->discounted_unit_price_label))
									<td class="text-right">{{$modifier['unit_price_exc_tax']}}</td>
								@endif
								@if(!empty($receipt_details->item_discount_label))
									<td class="text-right">0.00</td>
								@endif
								<td class="text-right">{{$modifier['line_total']}}</td>
							</tr>
						@endforeach
					@endif
				@empty
					<tr>
						<td colspan="4">&nbsp;</td>
						@if(!empty($receipt_details->discounted_unit_price_label))
    					<td></td>
    					@endif
    					@if(!empty($receipt_details->item_discount_label))
    					<td></td>
    					@endif
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>

<div class="totals-section clearfix" style="color: #000000 !important;">
	<div class="payment-info">

		<table>

			@if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
					<tr>
						<td>{{$payment['method']}}</td>
						<td class="text-right" >{{$payment['amount']}}</td>
						<td class="text-right">{{$payment['date']}}</td>
					</tr>
				@endforeach
			@endif

			<!-- Total Paid-->
			@if(!empty($receipt_details->total_paid))
				<tr>
					<th>
						{!! $receipt_details->total_paid_label !!}
					</th>
					<td class="text-right">
						{{$receipt_details->total_paid}}
					</td>
				</tr>
			@endif

			<!-- Total Due-->
			@if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
			<tr>
				<th>
					{!! $receipt_details->total_due_label !!}
				</th>
				<td class="text-right">
					{{$receipt_details->total_due}}
				</td>
			</tr>
			@endif

			@if(!empty($receipt_details->all_due))
			<tr>
				<th>
					{!! $receipt_details->all_bal_label !!}
				</th>
				<td class="text-right">
					{{$receipt_details->all_due}}
				</td>
			</tr>
			@endif
		</table>
	</div>

	<div class="totals-table">
          	<table>
				<tbody>
					@if(!empty($receipt_details->total_quantity_label))
						<tr>
							<th style="width:70%">
								{!! $receipt_details->total_quantity_label !!}
							</th>
							<td class="text-right">
								{{$receipt_details->total_quantity}}
							</td>
						</tr>
					@endif

					@if(!empty($receipt_details->total_items_label))
						<tr>
							<th style="width:70%">
								{!! $receipt_details->total_items_label !!}
							</th>
							<td class="text-right">
								{{$receipt_details->total_items}}
							</td>
						</tr>
					@endif
					<tr>
						<th style="width:70%">
							{!! $receipt_details->subtotal_label !!}
						</th>
						<td class="text-right">
							{{$receipt_details->subtotal}}
						</td>
					</tr>
					@if(!empty($receipt_details->total_exempt_uf))
					<tr>
						<th style="width:70%">
							@lang('lang_v1.exempt')
						</th>
						<td class="text-right">
							{{$receipt_details->total_exempt}}
						</td>
					</tr>
					@endif
					<!-- Shipping Charges -->
					@if(!empty($receipt_details->shipping_charges))
						<tr>
							<th style="width:70%">
								{!! $receipt_details->shipping_charges_label !!}
							</th>
							<td class="text-right">
								{{$receipt_details->shipping_charges}}
							</td>
						</tr>
					@endif

					@if(!empty($receipt_details->packing_charge))
						<tr>
							<th style="width:70%">
								{!! $receipt_details->packing_charge_label !!}
							</th>
							<td class="text-right">
								{{$receipt_details->packing_charge}}
							</td>
						</tr>
					@endif

					<!-- Discount -->
					@if( !empty($receipt_details->discount) )
						<tr>
							<th>
								{!! $receipt_details->discount_label !!}
							</th>

							<td class="text-right">
								(-) {{$receipt_details->discount}}
							</td>
						</tr>
					@endif

					@if( !empty($receipt_details->total_line_discount) )
						<tr>
							<th>
								{!! $receipt_details->line_discount_label !!}
							</th>

							<td class="text-right">
								(-) {{$receipt_details->total_line_discount}}
							</td>
						</tr>
					@endif

					@if( !empty($receipt_details->additional_expenses) )
						@foreach($receipt_details->additional_expenses as $key => $val)
							<tr>
								<td>
									{{$key}}:
								</td>

								<td class="text-right">
									(+) {{$val}}
								</td>
							</tr>
						@endforeach
					@endif

					@if( !empty($receipt_details->reward_point_label) )
						<tr>
							<th>
								{!! $receipt_details->reward_point_label !!}
							</th>

							<td class="text-right">
								(-) {{$receipt_details->reward_point_amount}}
							</td>
						</tr>
					@endif

					<!-- Tax -->
					@if( !empty($receipt_details->tax) )
						<tr>
							<th>
								{!! $receipt_details->tax_label !!}
							</th>
							<td class="text-right">
								(+) {{$receipt_details->tax}}
							</td>
						</tr>
					@endif

					@if( $receipt_details->round_off_amount > 0)
						<tr>
							<th>
								{!! $receipt_details->round_off_label !!}
							</th>
							<td class="text-right">
								{{$receipt_details->round_off}}
							</td>
						</tr>
					@endif

					<!-- Total -->
					<tr class="total-final">
						<th>
							{!! $receipt_details->total_label !!}
						</th>
						<td class="text-right">
							{{$receipt_details->total}}
							@if(!empty($receipt_details->total_in_words))
								<br>
								<small style="color: #ccc;">({{$receipt_details->total_in_words}})</small>
							@endif
						</td>
					</tr>
				</tbody>
        	</table>
    </div>

    <div class="tax-summary">
	    @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
	        <!-- tax -->
	        @if(!empty($receipt_details->taxes))
	        	<table>
	        		<tr>
	        			<th colspan="2" class="text-center">{{$receipt_details->tax_summary_label}}</th>
	        		</tr>
	        		@foreach($receipt_details->taxes as $key => $val)
	        			<tr>
	        				<td><strong>{{$key}}</strong></td>
	        				<td>{{$val}}</td>
	        			</tr>
	        		@endforeach
	        	</table>
	        @endif
	    @endif
	</div>

	@if(!empty($receipt_details->additional_notes))
	    <div class="additional-notes">
	    	<strong>Additional Notes:</strong><br>
	    	{!! nl2br($receipt_details->additional_notes) !!}
	    </div>
    @endif
    
</div>
<div class="invoice-footer" style="color: #000000 !important;">
	@if(!empty($receipt_details->footer_text))
	<div class="footer-text">
		{!! $receipt_details->footer_text !!}
	</div>
	@endif
	@if($receipt_details->show_barcode || $receipt_details->show_qr_code)
		<div class="barcode-section">
			@if($receipt_details->show_barcode)
				{{-- Barcode --}}
				<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif
			
			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}" style="margin-top: 10px;">
			@endif
		</div>
	@endif
</div>

</div> <!-- End invoice-classic container -->