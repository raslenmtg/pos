@extends('layouts.app')
@section('title', __('manufacture.add_work_order'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('manufacture.add_work_order')</h1>
</section>

<section class="content">
    {!! Form::open(['url' => route('manufacture.store'), 'method' => 'post']) !!}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('location_id', __('purchase.business_location') . ':*') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('recipe_id', __('manufacture.recipe') . ':*') !!}
                    <select class="form-control select2" name="recipe_id" required>
                        <option value="">@lang('messages.please_select')</option>
                        @foreach($recipes as $recipe)
                            <option value="{{ $recipe->id }}">{{ $recipe->name }} - {{ optional($recipe->finishedVariation)->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('planned_output_qty', __('manufacture.planned_output_qty') . ':*') !!}
                    {!! Form::text('planned_output_qty', 1, ['class' => 'form-control input_number', 'required']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('overhead_cost', __('manufacture.overhead_cost') . ':') !!}
                    {!! Form::text('overhead_cost', 0, ['class' => 'form-control input_number']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('wastage_cost', __('manufacture.wastage_cost') . ':') !!}
                    {!! Form::text('wastage_cost', 0, ['class' => 'form-control input_number']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('notes', __('manufacture.reason') . ':') !!}
                    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.save')</button>
            </div>
        </div>
    @endcomponent
    {!! Form::close() !!}
</section>
@stop

