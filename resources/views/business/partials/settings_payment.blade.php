<!--payment related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('cash_denominations', __('lang_v1.cash_denominations') . ':') !!}
                 {!! Form::text('pos_settings[cash_denominations]', isset($pos_settings['cash_denominations']) ? $pos_settings['cash_denominations'] : null, ['class' => 'form-control', 'id' => 'cash_denominations']); !!}
                 <p class="help-block">{{__('lang_v1.cash_denominations_help')}}</p>
            </div>
        </div>

    </div>
</div>