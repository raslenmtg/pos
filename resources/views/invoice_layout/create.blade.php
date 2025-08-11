@extends('layouts.app')
@section('title',  __('invoice.add_invoice_layout'))

@section('content')
<style type="text/css">



</style>
@php
  $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('invoice.add_invoice_layout')</h1>
</section>

<!-- Main content -->
<section class="content">
{!! Form::open(['url' => action([\App\Http\Controllers\InvoiceLayoutController::class, 'store']), 'method' => 'post', 'id' => 'add_invoice_layout_form', 'files' => true]) !!}
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('name', __('invoice.layout_name') . ':*') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required',
              'placeholder' => __('invoice.layout_name')]); !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('design', __('lang_v1.design') . ':*') !!}
              {!! Form::select('design', $designs, 'classic', ['class' => 'form-control']); !!}
              <span class="help-block">
                @lang('lang_v1.used_for_browser_based_printing')
              </span>
          </div>

          <div class="form-group hide" id="columnize-taxes">
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" required="required" 
              placeholder="tax 1 name"
              disabled>
              @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 2 name"
              disabled>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 3 name"
              disabled>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 4 name"
              disabled>
            </div>
          </div>

        </div>
        <div class="clearfix"></div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="checkbox">
                    <label>
                        {!! Form::checkbox('show_letter_head', 1, false, 
                            ['class' => 'input-icheck', 'id' => 'show_letter_head']); !!} @lang('lang_v1.show_letter_head')</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 letter_head_input hide">
                <div class="form-group">
                    {!! Form::label('letter_head', __('lang_v1.letter_head') . ':') !!}
                    {!! Form::file('letter_head', ['accept' => 'image/*']); !!}
                    <span class="help-block">@lang('lang_v1.letter_head_help') <br> @lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB'])</span>
                </div>
            </div>
        <div class="clearfix"></div>

        <!-- Logo -->
        <div class="col-sm-6 hide-for-letterhead">
          <div class="form-group">
            {!! Form::label('logo', __('invoice.invoice_logo') . ':') !!}
            {!! Form::file('logo', ['accept' => 'image/*']); !!}
            <span class="help-block">@lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB'])</span>
          </div>
        </div>
        <div class="col-sm-6 hide-for-letterhead">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_logo', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_logo')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-12 hide-for-letterhead">
          <div class="form-group">
            {!! Form::label('header_text', __('invoice.header_text') . ':' ) !!}
            {!! Form::textarea('header_text','', ['class' => 'form-control',
              'placeholder' => __('invoice.header_text'), 'rows' => 3]); !!}
          </div>
        </div>
      </div>
      <div class="row hide-for-letterhead">
      <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_heading_line1', __('lang_v1.sub_heading_line', ['_number_' => 1]) . ':' ) !!}
            {!! Form::text('sub_heading_line1', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 1]) ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_heading_line2', __('lang_v1.sub_heading_line', ['_number_' => 2]) . ':' ) !!}
            {!! Form::text('sub_heading_line2', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 2]) ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_heading_line3', __('lang_v1.sub_heading_line', ['_number_' => 3]) . ':' ) !!}
            {!! Form::text('sub_heading_line3', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 3]) ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_heading_line4', __('lang_v1.sub_heading_line', ['_number_' => 4]) . ':' ) !!}
            {!! Form::text('sub_heading_line4', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 4]) ]); !!}
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_heading_line5', __('lang_v1.sub_heading_line', ['_number_' => 5]) . ':' ) !!}
            {!! Form::text('sub_heading_line5', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 5]) ]); !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="box box-solid">
  <div class="box-body">
    <div class="row">
      
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('proforma_heading', __('lang_v1.proforma_heading') . ':' ) !!}
            @show_tooltip(__('lang_v1.tooltip_proforma_heading'))
            {!! Form::text('common_settings[proforma_heading]', __('lang_v1.proforma_invoice'), ['class' => 'form-control',
              'placeholder' => __('lang_v1.proforma_heading'), 'id' => 'proforma_heading' ]); !!}
          </div>
        </div>
     
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sales_order_heading', __('lang_v1.sales_order_heading') . ':' ) !!}
            {!! Form::text('common_settings[sales_order_heading]', __('lang_v1.sales_order'), ['class' => 'form-control',
              'placeholder' => __('lang_v1.sales_order_heading'), 'id' => 'sales_order_heading' ]); !!}
          </div>
        </div>
      
      @php
        $sell_custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';

        $sell_custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';

        $sell_custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';

        $sell_custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
      @endphp
        @if (!empty($sell_custom_field_1_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields1]', 1, false, ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_2_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields2]', 1, false, ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_3_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields3]', 1, false, ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_4_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields4]', 1, false, ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
            </div>
          </div>
        </div>
        @endif
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sales_person_label', __('lang_v1.sales_person_label') . ':' ) !!}
            {!! Form::text('sales_person_label', null, ['class' => 'form-control',
            'placeholder' => __('lang_v1.sales_person_label') ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('commission_agent_label', __('lang_v1.commission_agent_label') . ':' ) !!}
            {!! Form::text('commission_agent_label', __('lang_v1.commission_agent'), ['class' => 'form-control',
            'placeholder' => __('lang_v1.commission_agent_label') ]); !!}
          </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_business_name', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_business_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_location_name', 1, true, ['class' => 'input-icheck']); !!} @lang('invoice.show_location_name')</label>
              </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_sales_person', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sales_person')</label>
              </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_commission_agent', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_commission_agent')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_customer', 1, true, ['class' => 'input-icheck']); !!} @lang('invoice.show_customer')</label>
              </div>
          </div>
        </div>
      
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_client_id', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_client_id')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('client_id_label', __('lang_v1.client_id_label') . ':' ) !!}
            {!! Form::text('client_id_label', null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.client_id_label') ]); !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('client_tax_label', __('lang_v1.client_tax_label') . ':' ) !!}
            {!! Form::text('client_tax_label', null, ['class' => 'form-control',
            'placeholder' => __('lang_v1.client_tax_label') ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_reward_point', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_reward_point')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field1', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field2', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field3', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</label>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field4', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</label>
          </div>
        </div>
      </div>        
    </div>
    <div class="row hide-for-letterhead">
        <div class="col-sm-12">
          <h4>@lang('invoice.fields_to_be_shown_in_address'):</h4>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_landmark', 1, true, ['class' => 'input-icheck']); !!} @lang('business.landmark')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_city', 1, true, ['class' => 'input-icheck']); !!} @lang('business.city')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_state', 1, true, ['class' => 'input-icheck']); !!} @lang('business.state')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_country', 1, true, ['class' => 'input-icheck']); !!} @lang('business.country')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_zip_code', 1, true, ['class' => 'input-icheck']); !!} @lang('business.zip_code')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field1', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field2', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field3', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field4', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}</label>
          </div>
        </div>
      </div>

        <div class="clearfix"></div>
         <!-- Shop Communication details -->
        <div class="col-sm-12">
          <h4>@lang('invoice.fields_to_shown_for_communication'):</h4>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_mobile_number', 1, true, ['class' => 'input-icheck']); !!} @lang('invoice.show_mobile_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_alternate_number', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_alternate_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_email', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_email')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-12">
          <h4>@lang('invoice.fields_to_shown_for_tax'):</h4>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_tax_1', 1, true, ['class' => 'input-icheck']); !!} @lang('invoice.show_tax_1')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_tax_2', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_tax_2')</label>
              </div>
          </div>
        </div>
        
    </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
       
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('cat_code_label', __('lang_v1.cat_code_label') . ':' ) !!}
            {!! Form::text('cat_code_label', 'HSN', ['class' => 'form-control',
              'placeholder' => 'HSN or Category Code' ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('discounted_unit_price_label', __('lang_v1.discounted_unit_price_label') . ':' ) !!}
            {!! Form::text('common_settings[discounted_unit_price_label]', 'Price after discount', ['class' => 'form-control',
              'placeholder' => __('lang_v1.discounted_unit_price_label'), 'id' => 'discounted_unit_price_label' ]); !!}
          </div>
        </div>
        
        <div class="col-sm-12">
          <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_brand', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_brand')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_sku', 1, true, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sku')</label>
              </div>
          </div>
        </div>
     
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_sale_description', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sale_description')</label>
            </div>
            <p class="help-block">@lang('lang_v1.product_imei_or_sn')</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_product_description]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_product_description')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field1', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field2', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field3', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field4', false, ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
        @if(request()->session()->get('business.enable_product_expiry') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  {!! Form::checkbox('show_expiry', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_product_expiry')</label>
                </div>
            </div>
          </div>
        @endif
        @if(request()->session()->get('business.enable_lot_number') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  {!! Form::checkbox('show_lot', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_lot_number')</label>
                </div>
            </div>
          </div>
        @endif

    

        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_name]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_exp_date]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_exp_date')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_description]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_description')</label>
              </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_base_unit_details]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_base_unit_details')</label>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
       
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('total_due_label', __('invoice.total_due_label') . ' (' . __('lang_v1.current_sale') . '):' ) !!}
            {!! Form::text('total_due_label', __('report.total_due'), ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label') ]); !!}
          </div>
        </div>
       

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_payments', 1, true, ['class' => 'input-icheck']); !!} @lang('invoice.show_payments')</label>
              </div>
          </div>
        </div>
        <!-- Barcode -->
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_barcode', 1, false, ['class' => 'input-icheck']); !!} @lang('invoice.show_barcode')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('prev_bal_label', __('invoice.total_due_label') . ' (' . __('lang_v1.all_sales') . '):' ) !!}
            {!! Form::text('prev_bal_label', '', ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-5">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_previous_bal', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_previous_bal_due')</label>
                @show_tooltip(__('lang_v1.previous_bal_due_help'))
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('change_return_label', __('lang_v1.change_return_label') . ':' ) !!} @show_tooltip(__('lang_v1.change_return_help'))
            {!! Form::text('change_return_label', __('lang_v1.change_return'), ['class' => 'form-control',
              'placeholder' => __('lang_v1.change_return_label') ]); !!}
          </div>
        </div>

        <div class="col-sm-3 hide" id="hide_price_div">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[hide_price]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.hide_all_prices')</label>
              </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
              <label>
                {!! Form::checkbox('common_settings[show_total_in_words]', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_total_in_words')</label> @show_tooltip(__('lang_v1.show_in_word_help'))
                @if(!extension_loaded('intl'))
                  <p class="help-block">@lang('lang_v1.enable_php_intl_extension')</p>
                @endif
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('tax_summary_label', __('lang_v1.tax_summary_label') . ':' ) !!}
            {!! Form::text('common_settings[tax_summary_label]', '', ['class' => 'form-control', 'placeholder' => __('lang_v1.tax_summary_label'), 'id' => 'tax_summary_label' ]); !!}
          </div>
        </div>

        


      </div>
    </div>
  </div>
	<div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6 hide">
          <div class="form-group">
            {!! Form::label('highlight_color', __('invoice.highlight_color') . ':' ) !!}
            {!! Form::text('highlight_color', '#000000', ['class' => 'form-control',
              'placeholder' => __('invoice.highlight_color') ]); !!}
          </div>
        </div>
        
        <div class="clearfix"></div>
        <div class="col-md-12 hide">
          <hr/>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('footer_text', __('invoice.footer_text') . ':' ) !!}
              {!! Form::textarea('footer_text', null, ['class' => 'form-control',
              'placeholder' => __('invoice.footer_text'), 'rows' => 3]); !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                {!! Form::checkbox('is_default', 1, false, ['class' => 'input-icheck']); !!} @lang('barcode.set_as_default')</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @component('components.widget', ['class' => 'box-solid', 'title' => __('lang_v1.qr_code')])
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('show_qr_code', 1, false, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_qr_code')</label>
        </div>
      </div>
    </div>
  </div>
  @endcomponent

  <div class="row">
    <div class="col-sm-12 text-center">
      <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-lg">@lang('messages.save')</button>
    </div>
  </div>

  {!! Form::close() !!}
</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
  __page_leave_confirmation('#add_invoice_layout_form');
    $(document).on('ifChanged', '#show_letter_head', function() {
        letter_head_changed();
    });

    function letter_head_changed() {
        if($('#show_letter_head').is(":checked")) {
            $('.hide-for-letterhead').addClass('hide');
            $('.letter_head_input').removeClass('hide');
        } else {
            $('.hide-for-letterhead').removeClass('hide');
            $('.letter_head_input').addClass('hide');
        }
    }
</script>
@endsection