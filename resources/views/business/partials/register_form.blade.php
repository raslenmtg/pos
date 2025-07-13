
@if(empty($is_admin))
    <h3>@lang('business.business')</h3>
@endif
{!! Form::hidden('language', request()->lang); !!}

<fieldset>
<legend class="text-black">@lang('business.business_details'):</legend>

<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('name', __('business.business_name') . ':*' ) !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-suitcase"></i>
            </span>
            {!! Form::text('name', null, ['class' => 'form-control','placeholder' => __('business.business_name'), 'required']); !!}
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
    {!! Form::label('mobile', __('lang_v1.business_telephone') . ':') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-phone"></i>
        </span>
        {!! Form::text('mobile', null, ['class' => 'form-control','placeholder' => __('lang_v1.business_telephone')]); !!}
    </div>
    </div>
</div>

</fieldset>


<!-- Owner Information -->
@if(empty($is_admin))
    <h3>@lang('business.owner')</h3>
@endif

<fieldset>

<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('first_name', __('business.first_name') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            {!! Form::text('first_name', null, ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']); !!}
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('last_name', __('business.last_name') . ':') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            {!! Form::text('last_name', null, ['class' => 'form-control','placeholder' =>  __('business.last_name')]); !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('username', __('business.username') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-user"></i>
            </span>
            {!! Form::text('username', null, ['class' => 'form-control','placeholder' => __('business.username'), 'required']); !!}
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', __('business.email') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
            </span>
            {!! Form::text('email', null, ['class' => 'form-control','placeholder' => __('business.email'), 'required']); !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('password', __('business.password') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            {!! Form::password('password', ['class' => 'form-control','placeholder' => __('business.password'), 'required']); !!}
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('confirm_password', __('business.confirm_password') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            {!! Form::password('confirm_password', ['class' => 'form-control','placeholder' => __('business.confirm_password'), 'required']); !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    @if(!empty($system_settings['superadmin_enable_register_tc']))
        <div>
            <label>
                {!! Form::checkbox('accept_tc', 0, false, ['required', 'class' => 'input-check-box']); !!}
                <a class="terms_condition cursor-pointer" data-toggle="modal" data-target="#tc_modal">
                    @lang('lang_v1.accept_terms_and_conditions') <i></i>
                </a>
            </label>
        </div>
        @include('business.partials.terms_conditions')
    @endif
</div>
<div class="clearfix"></div>
</fieldset>