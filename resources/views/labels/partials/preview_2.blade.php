<table align="center" style="border-spacing: {{$barcode_details->col_distance * 1}}in {{$barcode_details->row_distance * 1}}in; overflow: hidden !important;">
@foreach($page_products as $page_product)
	@if($loop->index % $barcode_details->stickers_in_one_row == 0)
		<tr>
	@endif
		<td align="center" valign="center">
			<div class="label-container" style="width: {{$barcode_details->width * 1}}in; height: {{$barcode_details->height * 1}}in;">
				<div class="label-content">
					{{-- Business Name --}}
					@if(!empty($print['business_name']))
						<div class="business-name" style="font-size: {{$print['business_name_size'] * 0.8}}px; font-weight: bold; margin-bottom: 2px;">
							{{$business_name}}
						</div>
					@endif

					{{-- Product Name & Lot Number --}}
					@if(!empty($print['name']))
						<div class="product-name" style="font-size: {{$print['name_size'] * 1.2}}px; font-weight: 600; margin-bottom: 1px; line-height: 1.1;">
							{{$page_product->product_actual_name}}
						</div>
					@endif

					{{-- Variation --}}
					@if(!empty($print['variations']) && $page_product->is_dummy != 1)
						<div class="variation" style="font-size: {{$print['variations_size']}}px; margin-bottom: 1px;">
							{{$page_product->product_variation_name}}: <strong>{{$page_product->variation_name}}</strong>
						</div>
					@endif

					{{-- Custom Fields --}}
					@php
						$custom_labels = json_decode(session('business.custom_labels'), true);
						$product_custom_fields = !empty($custom_labels['product']) ? $custom_labels['product'] : [];
					@endphp
					@foreach($product_custom_fields as $index => $cf)
						@php
							$field_name = 'product_custom_field' . $loop->iteration;
						@endphp
						@if(!empty($cf) && !empty($page_product->$field_name ) && !empty($print[$field_name]))
							<div class="custom-field" style="font-size: {{ $print[$field_name . '_size'] }}px; margin-bottom: 1px;">
								<strong>{{ $cf }}:</strong> {{ $page_product->$field_name }}
							</div>
						@endif
					@endforeach

				
					<div class="info-row" style="margin: 2px 0;">
						@if(!empty($print['price']))
							<span class="price" style="font-size: {{$print['price_size']}}px; font-weight: bold;">
								{{@num_format($page_product->sell_price_inc_tax)}}&nbsp;{{session('currency')['symbol'] ?? ''}}
							</span>
						@endif
					
					</div>

					{{-- Barcode --}}
					<div class="barcode-section" style="text-align: center;">
						<img class="barcode" style="max-width: 95%; height: {{$barcode_details->height*0.22}}in; margin: 2px auto; display: block;" src="data:image/png;base64,{{DNS1D::getBarcodePNG($page_product->sub_sku, $page_product->barcode_type, 2,90, array(0, 0, 0), false)}}">
						<div class="sku" style="font-size: 9px; font-weight: 500; margin-top: 1px; text-align: center;">
							{{$page_product->sub_sku}}
						</div>
					</div>
				</div>
			</div>
		</td>

	@if($loop->iteration % $barcode_details->stickers_in_one_row == 0)
		</tr>
	@endif
@endforeach
</table>

<style type="text/css">
	* {
		box-sizing: border-box;
	}
	
	table {
		border-collapse: separate;
		font-family: 'Arial', sans-serif;
	}
	
	td {
		border: 1px dotted #ccc;
		padding: 2px;
	}
	
	.label-container {
		display: flex;
		align-items: center;
		justify-content: center;
		overflow: hidden;
		padding: 3px;
	}
	
	.label-content {
		text-align: center;
		width: 100%;
		line-height: 1.2;
	}
	
	.business-name {
		color: #333;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	
	.product-name {
		color: #000;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	
	.variation, .custom-field {
		color: #555;
	}
	
	.info-row {
		display: flex;
		justify-content: center;
		align-items: center;
		flex-wrap: wrap;
	}
	
	.barcode-section {
		margin-top: 2px;
	}
	
	.barcode {
		display: block;
		margin: 0 auto;
	}
	
	.sku {
		color: #333;
		letter-spacing: 0.5px;
	}
	
	@media print {
		table {
			page-break-after: always;
		}
		
		@page {
			size: {{$paper_width}}in {{$paper_height}}in;
			margin-top: {{$margin_top}}in !important;
			margin-bottom: {{$margin_top}}in !important;
			margin-left: {{$margin_left}}in !important;
			margin-right: {{$margin_left}}in !important;
		}
		
		td {
			border: none;
		}
		
		.label-container {
			border: 1px solid #ddd;
		}
	}
</style>