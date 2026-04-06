@extends('layouts.app')
@section('title', __('inventaire.inventaires'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('inventaire.inventaires')</h1>
</section>

<section class="content no-print">
    @component('components.widget', ['class' => 'box-primary', 'title' => __('inventaire.history')])
        @slot('tool')
            <div class="box-tools">
                    <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full pull-right"
                        href="{{ route('inventaire.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg> @lang('inventaire.add')
                    </a>
            </div>
        @endslot

        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="form-group">
                    {!! Form::label('inventaire_location_filter', __('business.location') . ':') !!}
                    {!! Form::select('inventaire_location_filter', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'id' => 'inventaire_location_filter', 'style' => 'width:100%']) !!}
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="form-group">
                    {!! Form::label('inventaire_product_filter', __('sale.product') . ':') !!}
                    <select class="form-control select2" id="inventaire_product_filter" style="width:100%"></select>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="form-group">
                    {!! Form::label('inventaire_date_filter', __('messages.date') . ':') !!}
                    <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm tw-w-full" id="inventaire_date_filter">
                        <span><i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}</span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view" id="inventaire_table">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('business.location')</th>
                        <th>@lang('stock_adjustment.adjustment_note')</th>
                        <th>@lang('lang_v1.added_by')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
</section>
@endsection

@section('javascript')
    <script src="{{ asset('js/inventaire.js?v=' . $asset_v) }}"></script>
@endsection

