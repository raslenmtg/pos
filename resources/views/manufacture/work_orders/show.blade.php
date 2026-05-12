@extends('layouts.app')
@section('title', __('manufacture.work_order'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
        @lang('manufacture.work_order') #{{ $work_order->ref_no }}
    </h1>
</section>

<section class="content">
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-3"><strong>@lang('manufacture.status'):</strong> @lang('manufacture.' . $work_order->status)</div>
            <div class="col-sm-3"><strong>@lang('business.location'):</strong> {{ optional($work_order->location)->name }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.recipe'):</strong> {{ optional($work_order->recipe)->name }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.finished_product'):</strong> {{ optional(optional($work_order->recipe)->finishedVariation)->full_name }}</div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-3"><strong>@lang('manufacture.planned_output_qty'):</strong> {{ @format_quantity($work_order->planned_output_qty) }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.produced_output_qty'):</strong> {{ @format_quantity($work_order->produced_output_qty) }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.overhead_cost'):</strong> {{ @num_format($work_order->overhead_cost) }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.wastage_cost'):</strong> {{ @num_format($work_order->wastage_cost) }}</div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-3"><strong>@lang('manufacture.total_ingredient_cost'):</strong> {{ @num_format($work_order->total_ingredient_cost) }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.total_cost'):</strong> {{ @num_format($work_order->total_cost) }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.started_at'):</strong> {{ $work_order->started_at }}</div>
            <div class="col-sm-3"><strong>@lang('manufacture.completed_at'):</strong> {{ $work_order->completed_at }}</div>
        </div>

        <hr>
        <h4>@lang('manufacture.ingredients')</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('manufacture.ingredient')</th>
                        <th>@lang('manufacture.quantity_per_batch')</th>
                        <th>@lang('manufacture.wastage_percent')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($work_order->ingredients as $line)
                        <tr>
                            <td>{{ optional($line->variation)->full_name }}</td>
                            <td>{{ @format_quantity($line->quantity_per_batch) }}</td>
                            <td>{{ @num_format($line->wastage_percent) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($work_order->consumptionTransaction || $work_order->productionTransaction)
            <div class="row">
                <div class="col-sm-6">
                    <strong>@lang('manufacture.consumption_transaction'):</strong>
                    @if($work_order->consumptionTransaction)
                        #{{ $work_order->consumption_transaction_id }} ({{ $work_order->consumptionTransaction->ref_no }})
                    @else
                        --
                    @endif
                </div>
                <div class="col-sm-6">
                    <strong>@lang('manufacture.production_transaction'):</strong>
                    @if($work_order->productionTransaction)
                        #{{ $work_order->production_transaction_id }} ({{ $work_order->productionTransaction->ref_no }})
                    @else
                        --
                    @endif
                </div>
            </div>
        @endif
    @endcomponent
</section>
@stop

