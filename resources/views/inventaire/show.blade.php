<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                @lang('inventaire.inventaire') (<b>@lang('purchase.ref_no'):</b> #{{ $inventory->ref_no }})
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <p><b>@lang('messages.date'):</b> {{ @format_datetime($inventory->inventory_date) }}</p>
                    <p><b>@lang('business.location'):</b> {{ $inventory->location->name ?? '' }}</p>
                    <p><b>@lang('lang_v1.added_by'):</b> {{ trim(($inventory->createdBy->surname ?? '') . ' ' . ($inventory->createdBy->first_name ?? '') . ' ' . ($inventory->createdBy->last_name ?? '')) }}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>@lang('stock_adjustment.reason_for_stock_adjustment'):</b> {{ $inventory->notes }}</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('sale.product')</th>
                            <th>@lang('product.sku')</th>
                            <th>@lang('inventaire.theoretical_qty')</th>
                            <th>@lang('inventaire.real_qty')</th>
                            <th>@lang('inventaire.difference_qty')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory->lines as $line)
                            <tr>
                                <td>{{ $line->variation->full_name ?? '' }}</td>
                                <td>{{ $line->variation->sub_sku ?? '' }}</td>
                                <td>{{ @format_quantity($line->theoretical_qty) }}</td>
                                <td>{{ @format_quantity($line->real_qty) }}</td>
                                <td>{{ @format_quantity($line->difference_qty) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white no-print" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </div>
</div>

