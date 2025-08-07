<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_sales_discount', __('business.default_sales_discount') . ':*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-percent"></i>
                    </span>
                    {!! Form::text('default_sales_discount', @num_format($business->default_sales_discount), ['class' => 'form-control input_number']); !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_sales_tax', __('business.default_sales_tax') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select('default_sales_tax', $tax_rates, $business->default_sales_tax, ['class' => 'form-control select2','placeholder' => __('business.default_sales_tax'), 'style' => 'width: 100%;']); !!}
                </div>
            </div>
        </div>
     

    </div>
    <hr>
    <div class="row">
        <div class="col-md-12"><h4>@lang('lang_v1.commission_agent'):</h4></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('sales_cmsn_agnt', __('lang_v1.sales_commission_agent') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select('sales_cmsn_agnt', $commission_agent_dropdown, $business->sales_cmsn_agnt, ['class' => 'form-control select2', 'style' => 'width: 100%;']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('cmmsn_calculation_type', __('lang_v1.cmmsn_calculation_type') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select('pos_settings[cmmsn_calculation_type]', ['invoice_value' => __('lang_v1.invoice_value'), 'payment_received' => __('lang_v1.payment_received')], !empty($pos_settings['cmmsn_calculation_type']) ? $pos_settings['cmmsn_calculation_type'] : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'cmmsn_calculation_type']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                    {!! Form::checkbox('pos_settings[is_commission_agent_required]', 1, !empty($pos_settings['is_commission_agent_required']) , [ 'class' => 'input-icheck', 'id' => 'is_commission_agent_required']); !!} {{ __( 'lang_v1.is_commission_agent_required' ) }}
                    </label>
                </div>
            </div>
        </div>
    </div>

</div>