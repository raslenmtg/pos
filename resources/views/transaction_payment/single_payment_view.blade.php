<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title no-print">
        @lang( 'lang_v1.view_payment' )
        @if(!empty($single_payment_line->payment_ref_no))
          ( @lang('purchase.ref_no'): {{ $single_payment_line->payment_ref_no }} )
        @endif
      </h4>
      <h4 class="modal-title visible-print-block">
        @if(!empty($single_payment_line->payment_ref_no))
          ( @lang('purchase.ref_no'): {{ $single_payment_line->payment_ref_no }} )
        @endif
      </h4>
    </div>
    <div class="modal-body">
      @if(!empty($transaction))
      <div class="row">
        @if(in_array($transaction->type, ['purchase', 'purchase_return']))
            <div class="col-xs-6">
              @lang('purchase.supplier'):
              <address>
                <strong>{{ $transaction->contact->supplier_business_name }}</strong>
                {{ $transaction->contact->name }}
                {!! $transaction->contact->contact_address !!}
                @if(!empty($transaction->contact->tax_number))
                  <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}
                @endif
                @if(!empty($transaction->contact->mobile))
                  <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}
                @endif
                @if(!empty($transaction->contact->email))
                  <br>@lang('business.email'): {{$transaction->contact->email}}
                @endif
              </address>
            </div>
            <div class="col-xs-6">
              @lang('business.business'):
              <address>
                <strong>{{ $transaction->business->name }}</strong>

                @if(!empty($transaction->location))
                  {{ $transaction->location->name }}
                  @if(!empty($transaction->location->landmark))
                    <br>{{$transaction->location->landmark}}
                  @endif
                  @if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country))
                    <br>{{implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country]))}}
                  @endif
                @endif
                
                @if(!empty($transaction->business->tax_number_1))
                  <br>{{$transaction->business->tax_label_1}}: {{$transaction->business->tax_number_1}}
                @endif

                @if(!empty($transaction->business->tax_number_2))
                  <br>{{$transaction->business->tax_label_2}}: {{$transaction->business->tax_number_2}}
                @endif

                @if(!empty($transaction->location))
                  @if(!empty($transaction->location->mobile))
                    <br>@lang('contact.mobile'): {{$transaction->location->mobile}}
                  @endif
                  @if(!empty($transaction->location->email))
                    <br>@lang('business.email'): {{$transaction->location->email}}
                  @endif
                @endif
              </address>
            </div>
        @else
          <div class="col-xs-6">
            @if($transaction->type != 'payroll' && !empty($transaction->contact))
              @lang('contact.customer'):
              <address>
                <strong>{{ $transaction->contact->name ?? '' }}</strong>
               
                {!! $transaction->contact->contact_address !!}
                @if(!empty($transaction->contact->tax_number))
                  <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}
                @endif
                @if(!empty($transaction->contact->mobile))
                  <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}
                @endif
                @if(!empty($transaction->contact->email))
                  <br>@lang('business.email'): {{$transaction->contact->email}}
                @endif
              </address>
            @else
            @if(!empty($transaction->transaction_for))
              @lang('lang_v1.payroll_for'):
              <address>
                  <strong>{{ $transaction->transaction_for->user_full_name }}</strong>
                  @if(!empty($transaction->transaction_for->address))
                      <br>{{$transaction->transaction_for->address}}
                  @endif
                  @if(!empty($transaction->transaction_for->contact_number))
                      <br>@lang('contact.mobile'): {{$transaction->transaction_for->contact_number}}
                  @endif
                  @if(!empty($transaction->transaction_for->email))
                      <br>@lang('business.email'): {{$transaction->transaction_for->email}}
                  @endif
              </address>
            @endif
            @endif
          </div>
          <div class="col-xs-6">
            @lang('business.business'):
            <address>
              <strong>{{ $transaction->business->name }}</strong>
              @if(!empty($transaction->location))
                {{ $transaction->location->name }}
                @if(!empty($transaction->location->landmark))
                  <br>{{$transaction->location->landmark}}
                @endif
                @if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country))
                  <br>{{implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country]))}}
                @endif
              @endif
              
              @if(!empty($transaction->business->tax_number_1))
                <br>{{$transaction->business->tax_label_1}}: {{$transaction->business->tax_number_1}}
              @endif

              @if(!empty($transaction->business->tax_number_2))
                <br>{{$transaction->business->tax_label_2}}: {{$transaction->business->tax_number_2}}
              @endif

              @if(!empty($transaction->location))
                @if(!empty($transaction->location->mobile))
                  <br>@lang('contact.mobile'): {{$transaction->location->mobile}}
                @endif
                @if(!empty($transaction->location->email))
                  <br>@lang('business.email'): {{$transaction->location->email}}
                @endif
              @endif
            </address>
          </div>
        @endif
      </div>
      @endif
      <div class="row">
          <br>
          <div class="col-xs-6">
            <strong>@lang('purchase.amount') :</strong>
            @format_currency($single_payment_line->amount)<br>
            <strong>@lang('lang_v1.payment_method') :</strong>
            {{ $payment_types[$single_payment_line->method] ?? '' }}<br>
            @if($single_payment_line->method == "card")
              <strong>@lang('lang_v1.card_transaction_number') :</strong>
              {{ $single_payment_line->card_transaction_number }}
              
            @elseif($single_payment_line->method == "cheque")
              <strong>@lang('lang_v1.cheque_number') :</strong>
              {{ $single_payment_line->cheque_number }}
            @elseif($single_payment_line->method == "bank_transfer")

            @elseif($single_payment_line->method == "custom_pay_1")

              <strong>@lang('lang_v1.traite_date_echeance') :</strong>
              {{@format_date( $single_payment_line->due_date )}}<br>
                  <strong>@lang('lang_v1.transaction_number') :</strong>
              {{ $single_payment_line->transaction_no }}<br>
            @elseif($single_payment_line->method == "custom_pay_2")

              <strong>@lang('lang_v1.transaction_number') :</strong>
              {{ $single_payment_line->transaction_no }}
            @elseif($single_payment_line->method == "custom_pay_3")

              <strong> @lang('lang_v1.transaction_number'):</strong>
              {{ $single_payment_line->transaction_no }}
            @endif
            <strong>@lang('purchase.payment_note') :</strong>
              {{ $single_payment_line->note }}
          </div>
          <div class="col-xs-6">
            <b>@lang('purchase.ref_no'):</b> 
              @if(!empty($single_payment_line->payment_ref_no))
                {{ $single_payment_line->payment_ref_no }}
              @else
                --
              @endif
              <br/>
            <b>@lang('lang_v1.paid_on'):</b> {{ @format_datetime($single_payment_line->paid_on) }}<br/>
            <br>
            @if(!empty($single_payment_line->document_path))
              <a href="{{$single_payment_line->document_path}}" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-accent no-print" download="{{$single_payment_line->document_name}}"><i class="fa fa-download" data-toggle="tooltip" title="{{__('purchase.download_document')}}"></i> {{__('purchase.download_document')}}</a>
            @endif
          </div>
      </div>
    </div>
    <div class="modal-footer">

      {{-- Receipt --}}
      <button type="button"
              class="tw-dw-btn tw-dw-btn-primary tw-text-white no-print"
              onclick="directPrint('{{ action([\App\Http\Controllers\TransactionPaymentController::class, 'printSinglePayment'], [$single_payment_line->id]) }}')">
        <i class="fa fa-print"></i> @lang('messages.print')
      </button>


      {{-- Lettre de Change (custom_pay_1 only) --}}
      @if($single_payment_line->method == 'custom_pay_1')
      <button type="button"
              class="tw-dw-btn tw-dw-btn-warning tw-text-white no-print"
              onclick="directPrint('{{ action([\App\Http\Controllers\TransactionPaymentController::class, 'printLettreDeChange'], [$single_payment_line->id]) }}')">
        <i class="fa fa-file-contract"></i> Imprimer Lettre de Change
      </button>
      @endif

      <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white no-print" data-dismiss="modal">
        @lang('messages.close')
      </button>
    </div>
  </div>
</div>

{{-- Hidden iframe used for direct silent printing --}}
<iframe id="silent-print-frame" style="display:none;width:0;height:0;border:none;position:absolute;left:-9999px;top:-9999px;"></iframe>

<script>
function directPrint(url) {
    var frame = document.getElementById('silent-print-frame');

    // Show a brief loading state on all print buttons
    var btns = document.querySelectorAll('.modal-footer .tw-dw-btn');
    btns.forEach(function(b){ b.disabled = true; });

    frame.onload = function () {
        try {
            frame.contentWindow.focus();
            frame.contentWindow.print();
        } catch(e) {
            // Fallback: open in new tab if iframe print is blocked
            window.open(url, '_blank');
        }
        // Re-enable buttons after print dialog appears
        setTimeout(function(){ btns.forEach(function(b){ b.disabled = false; }); }, 1500);
    };

    frame.src = url;
}
</script>
