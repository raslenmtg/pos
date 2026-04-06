@extends('layouts.app')
@section('title', __('inventaire.add'))

@section('content')
<section class="content-header">
    <br>
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('inventaire.add')</h1>
</section>

<section class="content no-print">
    {!! Form::open(['url' => route('inventaire.store'), 'method' => 'post', 'id' => 'inventaire_form']) !!}
    @component('components.widget', ['class' => 'box-solid'])
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('location_id', __('purchase.business_location') . ':*') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'location_id']) !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('ref_no', __('purchase.ref_no') . ':') !!}
                    {!! Form::text('ref_no', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('inventory_date', __('messages.date') . ':*') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {!! Form::text('inventory_date', @format_datetime('now'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'inventory_date']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('additional_notes', __('stock_adjustment.adjustment_note') . ':') !!}
                    {!! Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 2]) !!}
                </div>
            </div>
        </div>
        <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm tw-w-full tw-mt-2" id="add_all_products">
            <i class="fa fa-list"></i> @lang('inventaire.add_all_products')
        </button>
    @endcomponent

    @component('components.widget', ['class' => 'box-solid'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('category_id', __('product.category') . ':') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'category_id']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                    {!! Form::select('sub_category_id', [], null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'sub_category_id']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="button" class="tw-dw-btn tw-dw-btn-warning tw-text-white tw-dw-btn-sm tw-w-full" id="add_category_products">
                        <i class="fa fa-plus"></i> @lang('inventaire.add_category_products')
                    </button>
                </div>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_inventaire', 'placeholder' => __('stock_adjustment.search_product'), 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <input type="hidden" id="product_row_index" value="0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" id="inventaire_product_table">
                        <thead>
                            <tr>
                                <th class="col-sm-4 text-center">@lang('sale.product')</th>
                                <th class="col-sm-2 text-center">@lang('inventaire.theoretical_qty')</th>
                                <th class="col-sm-2 text-center">@lang('inventaire.real_qty')</th>
                                <th class="col-sm-2 text-center">@lang('inventaire.difference_qty')</th>
                                <th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-solid'])
        <div class="tw-block text-center">
        <div class="row">
            <div class="col-sm-12 ">
                <button type="button" class="tw-dw-btn tw-dw-btn-success tw-dw-btn-sm tw-text-white" id="export_inventaire_excel">
                    <i class="fa fa-file-excel-o"></i> @lang('inventaire.export_excel')
                </button>
                <button type="button" class="tw-dw-btn tw-dw-btn-danger tw-dw-btn-sm tw-text-white" id="export_inventaire_pdf">
                    <i class="fa fa-file-pdf-o"></i> @lang('inventaire.export_pdf')
                </button>
            </div>
        </div>
            <br>
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-lg tw-text-white">
                @lang('inventaire.submit')
            </button>
        </div>
    @endcomponent
    {!! Form::close() !!}

    <form method="POST" action="{{ route('inventaire.export_excel') }}" id="inventaire_export_excel_form" class="hide">
        @csrf
        <input type="hidden" name="inventory_id" value="">
        <input type="hidden" name="location_id" id="export_excel_location_id">
        <input type="hidden" name="variation_ids" id="export_excel_variation_ids">
    </form>

    <form method="POST" action="{{ route('inventaire.export_pdf') }}" id="inventaire_export_pdf_form" class="hide" target="_blank">
        @csrf
        <input type="hidden" name="inventory_id" value="">
        <input type="hidden" name="location_id" id="export_pdf_location_id">
        <input type="hidden" name="variation_ids" id="export_pdf_variation_ids">
    </form>
</section>
@endsection

@section('javascript')
    <script src="{{ asset('js/inventaire.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        __page_leave_confirmation('#inventaire_form');
    </script>
@endsection

