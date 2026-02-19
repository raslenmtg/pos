<div class="payment_details_div @if( $payment_line->method !== 'card' ) {{ 'hide' }} @endif" data-type="card" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("card_transaction_number",__('lang_v1.card_transaction_no')) !!}
			{!! Form::text("card_transaction_number", $payment_line->card_transaction_number, ['class' => 'form-control', 'placeholder' => __('lang_v1.card_transaction_no')]); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'cheque' ) {{ 'hide' }} @endif" data-type="cheque" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("cheque_number",__('lang_v1.cheque_no')) !!}
			{!! Form::text("cheque_number", $payment_line->cheque_number, ['class' => 'form-control', 'placeholder' => __('lang_v1.cheque_no')]); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'bank_transfer' ) {{ 'hide' }} @endif" data-type="bank_transfer" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("bank_account_number",__('lang_v1.bank_account_number')) !!}
			{!! Form::text( "bank_account_number", $payment_line->bank_account_number, ['class' => 'form-control', 'placeholder' => __('lang_v1.bank_account_number')]); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_1' ) {{ 'hide' }} @endif" data-type="custom_pay_1" >
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label("transaction_no_1", __('lang_v1.transaction_no')) !!}
			{!! Form::text("transaction_no_1", $payment_line->transaction_no, ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]); !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label("due_date_1", __('lang_v1.traite_date_echeance')) !!}
			<div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
				{!! Form::text("due_date_1", !empty($payment_line->due_date) ? @format_date($payment_line->due_date) : null, ['class' => 'form-control DateTimePicker ','data-date-only'=>'true', 'placeholder' => __('lang_v1.traite_date_echeance'), 'id' => 'due_date_1']); !!}
			</div>
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_2' ) {{ 'hide' }} @endif" data-type="custom_pay_2" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("transaction_no_2", __('lang_v1.transaction_no')) !!}
			{!! Form::text("transaction_no_2", $payment_line->transaction_no, ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_3' ) {{ 'hide' }} @endif" data-type="custom_pay_3" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("transaction_no_3", __('lang_v1.transaction_no')) !!}
			{!! Form::text("transaction_no_3", $payment_line->transaction_no, ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]); !!}
		</div>
	</div>
</div>