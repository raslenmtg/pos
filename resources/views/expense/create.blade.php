@extends('layouts.app')
@section('title', __('expense.add_expense'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('expense.add_expense')</h1>
</section>

<!-- Main content -->
<section class="content">
	{!! Form::open(['url' => action([\App\Http\Controllers\ExpenseController::class, 'store']), 'method' => 'post', 'id' => 'add_expense_form', 'files' => true ]) !!}
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">

				@if(count($business_locations) == 1)
					@php 
						$default_location = current(array_keys($business_locations->toArray())) 
					@endphp
				@else
					@php $default_location = null; @endphp
				@endif
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('location_id', __('purchase.business_location').':*') !!}
						{!! Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], $bl_attributes); !!}
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('expense_category_id', __('expense.expense_category').':') !!}
						{!! Form::select('expense_category_id', $expense_categories, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
			            {!! Form::label('expense_sub_category_id', __('product.sub_category') . ':') !!}
			              {!! Form::select('expense_sub_category_id', [],  null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
			          </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('ref_no', __('purchase.ref_no').':') !!}
						{!! Form::text('ref_no', null, ['class' => 'form-control']); !!}
						<p class="help-block">
			                @lang('lang_v1.leave_empty_to_autogenerate')
			            </p>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('transaction_date', __('messages.date') . ':*') !!}
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							{!! Form::text('transaction_date', @format_datetime('now'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date']); !!}
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('expense_for', __('expense.expense_for').':') !!} @show_tooltip(__('tooltip.expense_for'))
						{!! Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('contact_id', __('lang_v1.expense_for_contact').':') !!} 
						{!! Form::select('contact_id', $contacts, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                        {!! Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')</p></small>
                    </div>
                </div>
				<div class="col-sm-4">
			    	<div class="form-group">
			            {!! Form::label('tax_id', __('product.applicable_tax') . ':' ) !!}
			                {!! Form::select('tax_id', $taxes['tax_rates'], null, ['class' => 'form-control'], $taxes['attributes']); !!}
							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="0">
			        </div>
			    </div>
			    <div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('final_total', __('sale.total_amount') . ':*') !!}
						{!! Form::text('final_total', null, ['class' => 'form-control input_number', 'placeholder' => 'Montant TTC', 'required']); !!}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('additional_notes', __('expense.expense_note') . ':') !!}
								{!! Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); !!}
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<br>
					<label>
		              {!! Form::checkbox('is_refund', 1, false, ['class' => 'input-icheck', 'id' => 'is_refund']); !!} @lang('lang_v1.is_refund')?
		            </label>@show_tooltip(__('lang_v1.is_refund_help'))
				</div>
			</div>
		</div>
	</div> <!--box end-->
	@include('expense.recur_expense_form_part')
	@component('components.widget', ['class' => 'box-solid', 'id' => "payment_rows_div", 'title' => __('purchase.add_payment')])
	<div class="payment_row">
		@include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
        <div class="col-12">
            <div class="form-group">
                <div class="checkbox">
                    <label>{!! Form::checkbox('is_rs', 1, false, ['class' => 'input-icheck','id' => 'is_rs']); !!} @lang('lang_v1.is_rs')</label>
                </div>
            </div>
        </div>
        <div id="choose_rs" class="hide">
            <div class="tw-block">
                <div class="tw-mb-1">
                   <h5> TVA: <span id="selected_tax"></span>
                    <span id="tax_error" class="text-danger" style="display:none;">Aucun taxe appliquée, séléctionner un taxe</span></h5>
                   <div style="display: grid">
                    <span id="contact_mobile_error" class="text-danger" style="display:none;">Le contact sélectionné n'a pas de numéro de téléphone</span>
                    <span id="contact_email_error" class="text-danger" style="display:none;">Le contact sélectionné n'a pas d'email</span>
                    <span id="contact_address_error" class="text-danger" style="display:none;">Le contact sélectionné n'a pas d'adresse</span>
                    <span id="contact_tax_number_error" class="text-danger" style="display:none;">Le contact sélectionné n'a pas de matricule fiscale</span>
                   </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        {!! Form::label('tax_id', __('expense.operation_type') . ':' ) !!}
                        <div class="input-group">
                            {!! Form::select('tax_category', [
                                'capitalIncome' => 'Revenus des capitaux mobiliers',
                                'boardCompensation' => 'Jetons de présences et tantièmes',
                                'assetTransfers' => 'Cessions Fc et immeubles',
                                'dividends' => 'Dividendes',
                                'rentals' => 'Loyers',
                                'acquisitions' => 'Acquisitions des marchandises, matériel équipements et de services',
                                'professionalServices' => 'Rémunération des activités non commerciales',
                                'gambling' => 'Jeux de pari et loterie'
                            ], null, ['class' => 'form-control', 'id' => 'tax_category', 'placeholder' => __('messages.please_select')]) !!}

                        </div>
                    </div>
            </div>
                <div class="col-5">
                    <div class="form-group">
                        {!! Form::label('code_rs', __('expense.operation') . ':' ) !!}
                        <div class="input-group">
                            {!! Form::select('code_rs', ['' => __('messages.please_select')], null, ['class' => 'form-control', 'id' => 'code_rs', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>
            </div>
                <div class="tw-flex-row width-50 tw-justify-between" style="display: none" id="tax_rate_display">
                    <h4  class="form-text">
                       {{ __('expense.rs_rate') }}: <span id="tax_rate_value"></span>%
                    </h4>
                    <h4 > {{ __('lang_v1.total_amount_exc_tax') }}: <span id="ht_rs"></span></h4>
                </div>

        </div>
        </div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right" style="color: red;">
					<h4>@lang('purchase.payment_due'):</h4>
					<h3 id="payment_due">{{@num_format(0)}}</h3>
				</div>
			</div>
		</div>
	</div>
	@endcomponent
	<div class="col-sm-12 text-center">
		<button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-lg tw-text-white">@lang('messages.save')</button>
	</div>
{!! Form::close() !!}
</section>
@endsection
@section('javascript')
<script type="text/javascript">
	const contactsDetails = @json($contacts_details ?? []);

	$(document).ready( function(){
		$('.paid_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });

        // Disable tax_category initially if no tax is selected
        if (!$('select#tax_id').val()) {
            $('#tax_category').prop('disabled', true);
        }

        const taxCodes = {
            "capitalIncome": [
                { value: "RS3_000001", text: "Revenus de capitaux mobiliers (autres que les dépôts en devise ou en dinars convertible) servis aux résidents soumi à l'impots (IS ou IRPP) - 20%", rate: "20" }
            ],
            "boardCompensation": [
                { value: "RS8_000001", text: "Rémunérations et primes servies aux membres des conseils/comités de SA payées aux résidents - 20%", rate: "20" }
            ],
            "assetTransfers": [
                { value: "RS6_000001", text: "Cession de fonds de commerce par les personnes morales et les personnes physiques résidentes - 2.5%", rate: "2.5" },
                { value: "RS6_000002", text: "Cession d'immeubles et des droits sociaux dans les sociétés immobilières par les personnes morales et les personnes physiques résidentes - 2.5%", rate: "2.5" }
            ],
            "dividends": [
                { value: "RS5_000001", text: "Dividendes servies à des personnes physiques résidentes - 10%", rate: "10" }
            ],
            "rentals": [
                { value: "RS1_000001", text: "Loyers d'hôtels servis aux personnes morales et aux personnes physiques soumises à l'impôt sur le revenu selon le régime réel - 5%", rate: "5" },
                { value: "RS1_000002", text: "Loyers servis à des résidents établis - 10%", rate: "10" }
            ],
            "acquisitions": [
                { value: "RS7_000003", text: "Montants égaux ou supérieurs à 1.000 D (TVA comprise) pour acquisitions auprès de personnes bénéficiant de la déduction de 2/3 et personnes morales soumises à l'IS au taux de 10% - 0.5%", rate: "0.5" },
                { value: "RS7_000002", text: "Montants égaux ou supérieurs à 1.000 D (TVA comprise) pour acquisitions auprès de personnes soumises à l'IS au taux de 15% - 1%", rate: "1" },
                { value: "RS7_000004", text: "Commission revenant aux distributeurs agréés des opérateurs télécoms (personne physique) - 1.5%", rate: "1.5" },
                { value: "RS7_000005", text: "Montants égaux ou supérieurs à 1.000 D (TVA comprise) pour acquisitions de marchandises/services auprès de personnes soumises à l'IS à des taux autres que 15% et 10% - 1%", rate: "1" },
                { value: "RS7_000001", text: "Montants égaux ou supérieurs à 1.000 D (TVA comprise) pour acquisitions de marchandises/services auprès de personnes soumises à l'IS à des taux autres que 15% et 10% - 1.5%", rate: "1.5" }
            ],
            "professionalServices": [
                { value: "RS2_000001", text: "Honoraires servis aux BNC forfait d'assiette, commissions, courtages, rémunérations des activités non commerciales qu'elle qu'en soit l'appellation servis à des résidents établis - 10%", rate: "10" },
                { value: "RS2_000002", text: "Honoraires servis aux BNC régime réel résidents établis - 3%", rate: "3" },
                { value: "RS2_000003", text: "Rémunérations en contrepartie de la performance - 3%", rate: "3" },
                { value: "RS2_000004", text: "Rémunérations servies aux artistes, aux créateurs soumis à l'impôt sur le revenu selon le régime réel et aux personnes morales au titre de la production, la diffusion et la présentation des œuvres théâtrales, scénique, musicale, littéraire et plastiques et cinématographique... - 5%", rate: "5" }
            ],
            "gambling": [
                { value: "RS11_000001", text: "Jeux de pari et loterie (hors courses de chevaux et pronostics sportifs) et gains en nature - 25%", rate: "25" }
            ]
        };

        // Handle category change
        $('#tax_category').on('change', function() {
            const selectedCategory = $(this).val();
            const $taxCodeSelect = $('#code_rs');
           // let $taxSelect = $('select#tax_id').val()
            // Clear existing options
            $taxCodeSelect.empty();
            $taxCodeSelect.append('<option value="">{{ __("messages.please_select") }}</option>');

            // If a category is selected, populate the tax codes
            if (selectedCategory && taxCodes[selectedCategory] ) {
                $taxCodeSelect.prop('disabled', false);

                $.each(taxCodes[selectedCategory], function(index, code) {
                    $taxCodeSelect.append(
                        $('<option></option>')
                            .attr('value', code.value)
                            .attr('data-rate', code.rate)
                            .text(code.text)
                    );
                });
            } else {
                // Disable if no category selected
                $taxCodeSelect.prop('disabled', true);
                $('#tax_rate_display').hide();
            }
        });

        // Handle tax code change to display rate
        $('#code_rs').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const rate = selectedOption.data('rate');

            if (rate) {
                $('#tax_rate_value').text(rate);
                $('#tax_rate_display').show();
                let finalTotal = __read_number($('input#final_total'));
                let rsRate = parseFloat(rate) || 0;

                // Get tax percentage from tax_id
                var $taxSelect = $('select#tax_id');
                var selectedTaxOption = $taxSelect.find('option:selected');
                var taxPercentage = parseFloat(selectedTaxOption.data('rate')) || 0;

                // Calculate HT using tax percentage
                let HT = finalTotal / (1 + (taxPercentage / 100));
                let taxAmount = finalTotal - HT;
                $('#tax_calculation_amount').val(taxAmount);
                $('#ht_rs').text(__currency_trans_from_en(HT,false,false));
                // Recalculate payment due with RS deduction
                calculateRSDeduction();
            } else {
                $('#tax_rate_display').hide();
                // Recalculate without RS deduction
                calculateExpensePaymentDue();
            }
        });

	});
	
	__page_leave_confirmation('#add_expense_form');

	// Add form validation before submission
	$('#add_expense_form').on('submit', function(e) {
		var codeRs = $('#code_rs').val();
		var contactId = $('#contact_id').val();
		var taxId = $('#tax_id').val();

		// If RS code is selected, validate that contact and tax are also selected
		if (codeRs && codeRs !== '') {
			if (!contactId || contactId === '') {
				e.preventDefault();
				toastr.error('{{ __("expense.contact_required_for_rs") }}');
				return false;
			}

			if (!taxId || taxId === '') {
				e.preventDefault();
				toastr.error('{{ __("expense.tax_required_for_rs") }}');
				return false;
			}
		}
	});

	$(document).on('change', 'input#final_total, input.payment-amount', function() {
		// Check if RS is enabled and calculate accordingly
		if ($('#is_rs').is(':checked')) {
			calculateRSDeduction();
		} else {
			calculateExpensePaymentDue();
		}
	});

	function calculateExpensePaymentDue() {
		var final_total = __read_number($('input#final_total'));
		var payment_amount = __read_number($('input.payment-amount'));
		var payment_due = final_total - payment_amount;
		$('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
	}

	$(document).on('change', '#recur_interval_type', function() {
	    if ($(this).val() == 'months') {
	        $('.recur_repeat_on_div').removeClass('hide');
	    } else {
	        $('.recur_repeat_on_div').addClass('hide');
	    }
	});

	$('#is_refund').on('ifChecked', function(event){
		$('#recur_expense_div').addClass('hide');
	});
	$('#is_refund').on('ifUnchecked', function(event){
		$('#recur_expense_div').removeClass('hide');
	});
  $('#is_rs').on('ifChecked', function(event){
            $('#choose_rs').removeClass('hide');
            calculateRSDeduction();
        });
    $('#is_rs').on('ifUnchecked', function(event){
            $('#choose_rs').addClass('hide');
            calculateExpensePaymentDue();
    });

    function updateSelectedTaxDisplay() {
        var $taxSelect = $('select#tax_id');
        var $display = $('#selected_tax');
        var $error = $('#tax_error');

        if ($taxSelect.length) {
            var selectedVal = $taxSelect.val();
            var selectedText = $taxSelect.find('option:selected').text().trim();

            // treat empty value or placeholder as no selection
            if (!selectedVal || selectedVal === '' || selectedVal === null) {
                $display.text('');
                $error.show();
                // Disable tax_category when no tax is selected
                $('#tax_category').prop('disabled', true);
            } else {
                $display.text(selectedText);
                $error.hide();
                // Enable tax_category when tax is selected
                $('#tax_category').prop('disabled', false);

                // Calculate RS deduction when tax is selected
                calculateRSDeduction();
            }
        } else {
            $display.text('');
            $error.show();
            // Disable tax_category when tax select doesn't exist
            $('#tax_category').prop('disabled', true);
        }
    }

    function updateSelectedContactDisplay() {
        var $contactSelect = $('select#contact_id');
        let $display = $('#selected_contact');
        let $mobileError = $('#contact_mobile_error');
        let $emailError = $('#contact_email_error');
        let $addressError = $('#contact_address_error');
        let $taxNumberError = $('#contact_tax_number_error');
        if ($contactSelect.length) {
            let selectedVal = $contactSelect.val();


            // Reset errors
            $mobileError.hide();
            $emailError.hide();
            $addressError.hide();
            $taxNumberError.hide();
            if (!selectedVal || selectedVal === '' || selectedVal === null) {
                $display.text('');
            } else {
                var contact = contactsDetails[selectedVal];
                if (contact) {
                    // Check if mobile exists
                    if (!contact.mobile || contact.mobile.trim() === '') {
                        $mobileError.show();
                    } else {
                        $mobileError.hide();
                    }

                    // Check if email exists
                    if (!contact.email || contact.email.trim() === '') {
                        $emailError.show();
                    } else {
                        $emailError.hide();
                    }

                    var hasAddress = false;
                    if ((contact.address_line_1 && contact.address_line_1.trim() !== '') ||
                        (contact.city && contact.city.trim() !== '') ||
                        (contact.state && contact.state.trim() !== '')) {
                        hasAddress = true;
                    }

                    if (!hasAddress) {
                        $addressError.show();
                    } else {
                        $addressError.hide();
                    }

                    if (!contact.tax_number || contact.tax_number.trim() === '') {
                        $taxNumberError.show();
                    } else {
                        $taxNumberError.hide();
                    }
                } else {
                    $mobileError.show();
                    $emailError.show();
                    $addressError.show();
                    $taxNumberError.show();
                }
            }
        } else {
            $display.text('');
        }
    }

    function calculateRSDeduction() {
        let finalTotal = __read_number($('input#final_total'));
        if (!finalTotal || finalTotal <= 0) {
            return;
        }
        let $taxSelect = $('select#tax_id');
        if(!$taxSelect.val())
            return;

        let $codeRsSelect = $('#code_rs');
        let selectedRsOption = $codeRsSelect.find('option:selected');
        let rsRate = parseFloat(selectedRsOption.data('rate')) || 0;

        let rsDeduction = 0;
        if (rsRate > 0 && $('#is_rs').is(':checked')) {
            rsDeduction = finalTotal * (rsRate / 100);
        }

        let payment_amount = __read_number($('input.payment-amount'));
        let payment_due = finalTotal - payment_amount - rsDeduction;
        $('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
    }
    $(document).ready( function(){
        updateSelectedTaxDisplay();
        updateSelectedContactDisplay();
    });
    // update when tax select changes
    $(document).on('change', 'select#tax_id', function() {
        updateSelectedTaxDisplay();
    });

    // update when contact select changes
    $(document).on('change', 'select#contact_id', function() {
        updateSelectedContactDisplay();
    });

	$(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
	    var default_accounts = $('select#location_id').length ? 
	                $('select#location_id')
	                .find(':selected')
	                .data('default_payment_accounts') : [];
	    var payment_types_dropdown = $('.payment_types_dropdown');
	    var payment_type = payment_types_dropdown.val();
	    if (payment_type) {
	        var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
	            default_accounts[payment_type]['account'] : '';
	        var payment_row = payment_types_dropdown.closest('.payment_row');
	        var row_index = payment_row.find('.payment_row_index').val();

	        var account_dropdown = payment_row.find('select#account_' + row_index);
	        if (account_dropdown.length && default_accounts) {
	            account_dropdown.val(default_account);
	            account_dropdown.change();
	        }
	    }
	});
</script>
@endsection