@extends('layouts.app')
@section('title', __('manufacture.work_orders'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('manufacture.work_orders')</h1>
</section>

<section class="content">
    @component('components.widget', ['class' => 'box-primary'])
        @slot('tool')
            @if(auth()->user()->can('purchase.create'))
                <a class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right" href="{{ route('manufacture.create') }}">
                    @lang('manufacture.add_work_order')
                </a>
            @endif
        @endslot
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('manufacture.work_order_ref')</th>
                        <th>@lang('manufacture.recipe')</th>
                        <th>@lang('business.location')</th>
                        <th>@lang('manufacture.planned_output_qty')</th>
                        <th>@lang('manufacture.total_cost')</th>
                        <th>@lang('manufacture.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($work_orders as $work_order)
                        <tr>
                            <td>
                                <a class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary" href="{{ route('manufacture.show', $work_order->id) }}">
                                    @lang('messages.view')
                                </a>
                                @if($work_order->status === 'draft' && auth()->user()->can('purchase.create'))
                                    <form action="{{ route('manufacture.complete', $work_order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success" onclick="return confirm('@lang('messages.sure')')">
                                            @lang('manufacture.complete_work_order')
                                        </button>
                                    </form>
                                @endif
                                @if($work_order->status === 'draft' && auth()->user()->can('purchase.delete'))
                                    <form action="{{ route('manufacture.destroy', $work_order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error" onclick="return confirm('@lang('messages.sure')')">
                                            @lang('messages.delete')
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $work_order->ref_no }}</td>
                            <td>{{ optional($work_order->recipe)->name }}</td>
                            <td>{{ optional($work_order->location)->name }}</td>
                            <td>{{ @format_quantity($work_order->planned_output_qty) }}</td>
                            <td>{{ @num_format($work_order->total_cost) }}</td>
                            <td>@lang('manufacture.' . $work_order->status)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">@lang('messages.no_data')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $work_orders->links() }}
    @endcomponent
</section>
@stop

