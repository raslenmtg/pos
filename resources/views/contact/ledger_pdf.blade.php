<style>
/* Basic Reset and Layout */
* {
  box-sizing: border-box;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
  margin: 0;
  padding: 0;
}

/* Utility Classes */
.mb-0 {
  margin-bottom: 0;
}

.p-4 {
  padding: 4px;
}

.f-left {
  float: left;
}

.f-right {
  float: right;
}

.align-left {
  text-align: left;
}

.align-right {
  text-align: right;
}

.text-left {
  text-align: left;
}

.text-right {
  text-align: right;
}

.text-center {
  text-align: center;
}

.width-50 {
  width: 50% !important;
}

.width-100 {
  width: 100% !important;
}

.ws-nowrap {
  white-space: nowrap;
}

/* Column Classes */
.col-md-12, .col-sm-12, .col-xs-12 {
  width: 100%;
  position: relative;
  min-height: 1px;
  padding-left: 15px;
  padding-right: 15px;
}

.col-md-6, .col-sm-6, .col-xs-6 {
  width: 50%;
  position: relative;
  min-height: 1px;
  padding-left: 15px;
  padding-right: 15px;
}

.td-border td, .td-border th {
  border-bottom: 1px solid lightgrey;
  padding: 8px 5px;
}

.no-border,
.no-border td,
.no-border th {
  border: none !important;
}

.row-border {
  border-bottom: 1px solid #ddd;
}

/* Responsive table */
.table-responsive {
  min-height: 0.01%;
  overflow-x: auto;
}

/* Strong and bold text */
strong, b {
  font-weight: 700;
}
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
            border: 1px solid black;
        }
        .party-box h3 { margin-top: 0; font-size: 16px; color: var(--text-color); margin-bottom: 10px; }
        .party-box p, .party-box div { margin: 0; font-size: 13px; color: var(--text-muted-color); line-height: 1.7; }
        .word-wrap { word-wrap: break-word; }
</style>

<h2 class="mb-0 p-4" style="text-align: center;">@lang('lang_v1.account_summary')</h2>

  <div class="invoice-parties">
            <div class="party-box from-box">
            
                <div class="word-wrap">
                    <strong>{{$contact->business->name}}</strong>
                    	@if(!empty($location))
        		{!! $location->location_address !!}
        	@else
        		{!! $contact->business->business_address !!}
        	@endif
            
                </div>
            </div>
            
          
                <div class="party-box to-box">
                    <h3>Client</h3>
                    <div class="word-wrap">
                      {{$contact->name}}
                       
							<br>@lang('contact.mobile'): {{$contact->mobile}}
						<br> {!! $contact->contact_address !!} 
                      @if(!empty($contact->tax_number)) <br>@lang('contact.tax_no'): {{$contact->tax_number}} @endif
                     
                    </div>
                </div>
          
        </div>


<div class="col-md-6 col-sm-6 col-xs-6 text-right align-right  width-50 f-left ">
		
	<div style="border: 1px solid black; padding: 10px;">
		<i id="show_info_btn" class="fa fa-info-circle text-info" style="margin-right: 10px; margin-top:4px;"></i>
		<b>{{$ledger_details['start_date']}} @lang('lang_v1.to') {{$ledger_details['end_date']}}</b>
		<table class="table table-condensed text-left align-left no-border  table-pdf ">
        
        {{-- All summary_hidden class is commented --}}
        {{-- <tr class="summary_hidden">
				<td>@lang('lang_v1.opening_balance')</td>
				<td class="align-right">@format_currency($ledger_details['beginning_balance'])</td>
			</tr> --}}
		@if( $contact->type == 'supplier' || $contact->type == 'both')
			<tr>
				<td>@lang('report.total_purchase')</td>
				<td class="align-right">@format_currency($ledger_details['total_purchase'])</td>
			</tr>
		@endif
		@if( $contact->type == 'customer' || $contact->type == 'both')
			<tr>
				<td>@lang('lang_v1.total_invoice')</td>
				<td class="align-right">@format_currency($ledger_details['total_invoice'])</td>
			</tr>
		@endif
		<tr>
			<td>@lang('sale.total_paid')</td>
			<td class="align-right">@format_currency($ledger_details['total_paid'])</td>
		</tr>
		{{-- <tr class="summary_hidden">
			<td>@lang('lang_v1.advance_balance')</td>
			<td class="align-right">@format_currency($contact->balance - $ledger_details['total_reverse_payment'])</td>
		</tr> --}}
		@if($ledger_details['ledger_discount'] > 0)
			<tr>
				<td>@lang('lang_v1.ledger_discount')</td>
				<td class="align-right">@format_currency($ledger_details['ledger_discount'])</td>
			</tr>
		@endif
		{{-- <tr class="summary_hidden">
			<td><strong>@lang('lang_v1.balance_due')</strong></td>
			<td class="align-right">@format_currency($ledger_details['balance_due'] - $ledger_details['ledger_discount'])</td>
		</tr> --}}
		</table>
	</div>

	<div style="border: 1px solid black; padding: 10px;">
		<b> @lang('lang_v1.overall_summary') </b>
		<table class="table table-condensed text-left align-left no-border table-pdf ">
		
			@if( $contact->type == 'supplier' || $contact->type == 'both')
				<tr>
					<td>@lang('report.total_purchase')</td>
					<td class="align-right">@format_currency($ledger_details['all_total_purchase'])</td>
				</tr>
			@endif

			@if( $contact->type == 'customer' || $contact->type == 'both')
				<tr>
					<td>@lang('lang_v1.total_invoice')</td>
					<td class="align-right">@format_currency($ledger_details['all_total_invoice'])</td>
				</tr>
			@endif

            @if( $contact->type == 'customer' || $contact->type == 'both')
                <tr>
                    <td>@lang('sale.total_paid')</td>
                    <td class="align-right">@format_currency($ledger_details['all_invoice_paid'])</td>
                </tr>
            @endif

            @if( $contact->type == 'supplier' || $contact->type == 'both')
                <tr>
                    <td>@lang('sale.total_paid')</td>
                    <td class="align-right">@format_currency($ledger_details['all_purchase_paid'])</td>
                </tr>
            @endif

			<tr >
				<td><strong>@lang('lang_v1.balance_due')</strong></td>
				<td class="align-right">@format_currency($ledger_details['all_balance_due'])</td>
			</tr>
		</table>
	</div>
</div>


<div class="col-md-12 col-sm-12 width-100 ">
	<p class="text-center" style="text-align: center;"><strong>@lang('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</strong></p>
	<div class="table-responsive">
	<table class="table table-striped table-pdf td-border " id="ledger_table">
		<thead>
			<tr class="row-border blue-heading">
				<th width="18%" class="text-center">@lang('lang_v1.date')</th>
				<th width="9%" class="text-center">@lang('purchase.ref_no')</th>
				<th width="8%" class="text-center">@lang('lang_v1.type')</th>
				<th width="10%" class="text-center">@lang('sale.location')</th>
				<th width="5%" class="text-center">@lang('sale.payment_status')</th>
				{{--<th width="10%" class="text-center">@lang('sale.total')</th>--}}
				<th width="10%" class="text-center">@lang('account.debit')</th>
				<th width="10%" class="text-center">@lang('account.credit')</th>
				{{-- <th width="10%" class="text-center summary_hidden">@lang('lang_v1.balance')</th> --}}
				<th width="5%" class="text-center">@lang('lang_v1.payment_method')</th>
				<th width="15%" class="text-center">@lang('report.others')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ledger_details['ledger'] as $data)

                @if($data['type'] == 'Opening Balance') 
                    @continue
                @endif 

				<tr @if(!empty($for_pdf) && $loop->iteration % 2 == 0) class="odd" @endif>
					<td class="row-border">{{@format_datetime($data['date'])}}</td>
					<td>{{$data['ref_no']}}</td>
					<td>{{$data['type']}}</td>
					<td>{{$data['location']}}</td>
					<td>{{$data['payment_status']}}</td>
					{{--<td class="ws-nowrap align-right">@if($data['total'] !== '') @format_currency($data['total']) @endif</td>--}}
					<td class="ws-nowrap align-right">@if($data['debit'] != '') @format_currency($data['debit']) @endif</td>
					<td class="ws-nowrap align-right">@if($data['credit'] != '') @format_currency($data['credit']) @endif</td>
					{{--<td class="ws-nowrap align-right summary_hidden">{{$data['balance']}}</td>--}}
					<td>{{$data['payment_method']}}</td>
					<td>
						{!! $data['others'] !!}

						@if(!empty($is_admin) && !empty($data['transaction_id']) && $data['transaction_type'] == 'ledger_discount')
							<br>
							<button type="button" class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_ledger_discount" data-href="{{action([\App\Http\Controllers\LedgerDiscountController::class, 'destroy'], ['ledger_discount' => $data['transaction_id']])}}"><i class="fas fa-trash"></i></button>
							<button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary btn-modal" data-href="{{action([\App\Http\Controllers\LedgerDiscountController::class, 'edit'], ['ledger_discount' => $data['transaction_id']])}}" data-container="#edit_ledger_discount_modal"><i class="fas fa-edit"></i></button>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</div>