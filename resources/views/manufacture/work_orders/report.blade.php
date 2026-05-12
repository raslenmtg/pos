@extends('layouts.app')
@section('title', __('manufacture.report'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('manufacture.report')</h1>
</section>

<section class="content">
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-2"><strong>@lang('manufacture.total_orders'):</strong> {{ $summary->total_orders ?? 0 }}</div>
            <div class="col-sm-2"><strong>@lang('manufacture.total_output_qty'):</strong> {{ @format_quantity($summary->total_output_qty ?? 0) }}</div>
            <div class="col-sm-2"><strong>@lang('manufacture.total_ingredient_cost'):</strong> {{ @num_format($summary->total_ingredient_cost ?? 0) }}</div>
            <div class="col-sm-2"><strong>@lang('manufacture.total_overhead_cost'):</strong> {{ @num_format($summary->total_overhead_cost ?? 0) }}</div>
            <div class="col-sm-2"><strong>@lang('manufacture.total_wastage_cost'):</strong> {{ @num_format($summary->total_wastage_cost ?? 0) }}</div>
            <div class="col-sm-2"><strong>@lang('manufacture.total_cost'):</strong> {{ @num_format($summary->total_cost ?? 0) }}</div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-12"><strong>@lang('manufacture.mapping_rows'):</strong> {{ $mapped_rows }}</div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('manufacture.work_order_ref')</th>
                        <th>@lang('manufacture.recipe')</th>
                        <th>@lang('business.location')</th>
                        <th>@lang('manufacture.produced_output_qty')</th>
                        <th>@lang('manufacture.total_ingredient_cost')</th>
                        <th>@lang('manufacture.overhead_cost')</th>
                        <th>@lang('manufacture.wastage_cost')</th>
                        <th>@lang('manufacture.total_cost')</th>
                        <th>@lang('manufacture.completed_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($work_orders as $work_order)
                        <tr>
                            <td><a href="{{ route('manufacture.show', $work_order->id) }}">{{ $work_order->ref_no }}</a></td>
                            <td>{{ optional($work_order->recipe)->name }}</td>
                            <td>{{ optional($work_order->location)->name }}</td>
                            <td>{{ @format_quantity($work_order->produced_output_qty) }}</td>
                            <td>{{ @num_format($work_order->total_ingredient_cost) }}</td>
                            <td>{{ @num_format($work_order->overhead_cost) }}</td>
                            <td>{{ @num_format($work_order->wastage_cost) }}</td>
                            <td>{{ @num_format($work_order->total_cost) }}</td>
                            <td>{{ $work_order->completed_at }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">@lang('messages.no_data')</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $work_orders->links() }}
    @endcomponent
</section>
@stop

