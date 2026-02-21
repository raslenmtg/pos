
@if(empty($is_admin))
    <h3>@lang('business.business')</h3>
@endif
{!! Form::hidden('language', request()->lang); !!}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="tw-mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<fieldset>
<legend class="text-black">@lang('business.business_details'):</legend>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', __('business.business_name') . ':*' ) !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-suitcase"></i>
            </span>
            {!! Form::text('name', null, ['class' => 'form-control','placeholder' => __('business.business_name'), 'required']); !!}
        </div>
        @if($errors->has('name'))
            <span class="help-block text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
    {!! Form::label('mobile', __('lang_v1.business_telephone') . ':*') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-phone"></i>
        </span>
        {!! Form::number('mobile', null, ['class' => 'form-control','length'=>8, 'id' => 'mobile', 'placeholder' => __('lang_v1.business_telephone'), 'required']); !!}
    </div>
    @if($errors->has('mobile'))
        <span class="help-block text-danger">{{ $errors->first('mobile') }}</span>
    @endif
    </div>
</div>

</fieldset>


<!-- Owner Information -->
@if(empty($is_admin))
    <h3>@lang('business.owner')</h3>
@endif

<fieldset>

<div class="col-md-4">
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {!! Form::label('first_name', __('business.first_name') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            {!! Form::text('first_name', null, ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']); !!}
        </div>
        @if($errors->has('first_name'))
            <span class="help-block text-danger">{{ $errors->first('first_name') }}</span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {!! Form::label('last_name', __('business.last_name') . ':') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            {!! Form::text('last_name', null, ['class' => 'form-control','placeholder' =>  __('business.last_name')]); !!}
        </div>
        @if($errors->has('last_name'))
            <span class="help-block text-danger">{{ $errors->first('last_name') }}</span>
        @endif
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
        {!! Form::label('username', __('business.username') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-user"></i>
            </span>
            {!! Form::text('username', null, ['class' => 'form-control','placeholder' => __('business.username'), 'required']); !!}
        </div>
        @if($errors->has('username'))
            <span class="help-block text-danger">{{ $errors->first('username') }}</span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', __('business.email') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
            </span>
            {!! Form::text('email', null, ['class' => 'form-control','placeholder' => __('business.email'), 'required']); !!}
        </div>
        @if($errors->has('email'))
            <span class="help-block text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('password', __('business.password') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            {!! Form::password('password', ['class' => 'form-control','placeholder' => __('business.password'), 'required']); !!}
        </div>
        @if($errors->has('password'))
            <span class="help-block text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        {!! Form::label('password_confirmation', __('business.confirm_password') . ':*') !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder' => __('business.confirm_password'), 'required']); !!}
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