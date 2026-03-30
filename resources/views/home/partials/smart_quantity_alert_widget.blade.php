<div class="tw-p-4 sm:tw-p-5">
    <div class="tw-shadow-sm tw-overflow-hidden">

        <div class="tw-flex tw-items-center tw-gap-2.5">
            <div
                    class="tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-w-10 tw-h-10">
                <svg aria-hidden="true" class="tw-text-yellow-500 tw-size-5 tw-shrink-0"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                    <path d="M12 8v4"></path>
                    <path d="M12 16h.01"></path>
                </svg>
            </div>
            <div class="tw-flex tw-items-center tw-flex-1 tw-min-w-0 tw-gap-1">
                <div class="tw-flex-1 tw-min-w-0">
                    <h3 class="tw-font-bold tw-text-base lg:tw-text-xl">
                        {{ __('messages.smart_quantity_alerts') }}
                        @show_tooltip(__('messages.showing_low_stock_products'))
                    </h3>
                </div>
                <button type="button" id="bulk-process-btn" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-sm tw-ml-auto tw-text-white"
                    data-url="{{ route('smart-quantity.bulk-process') }}"
                    data-no-row-msg="{{ __('lang_v1.no_row_selected') }}"
                    data-error-msg="{{ __('messages.something_went_wrong') }}">
                    {{ __('messages.bulk_order') }}
                </button>
            </div>
        </div>

        <div class="tw-flow-root tw-mt-5 tw-border-gray-200">
            <div class="tw--mx-4 tw--my-2 tw-overflow-x-auto sm:tw--mx-5">
                <div class="tw-inline-block tw-min-w-full tw-py-2 tw-align-middle sm:tw-px-5">
                    <table class="table table-bordered table-striped" id="smart_quantity_alert_table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="smart-qty-select-all">
                                </th>
                                <th>{{ __('messages.product_name') }}</th>
                                <th>{{ __('messages.sku') }}</th>
                                <th>{{ __('messages.current_stock') }}</th>
                                <th>{{ __('messages.days_remaining') }}</th>
                                <th>{{ __('messages.reorder_qty') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($smart_quantity_alerts as $alert)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="smart-qty-checkbox"
                                            data-variation-id="{{ $alert['variation_id'] }}"
                                            data-quantity="{{ $alert['reorder_qty'] }}">
                                    </td>
                                    <td>{{ $alert['product_name'] }}</td>
                                    <td>{{ $alert['variation_id'] ?? '-' }}</td>
                                    <td>{{ $alert['current_stock'] }}</td>
                                    <td>{{ $alert['days_remaining'] }} {{ __('messages.days') }}</td>
                                    <td>{{ $alert['reorder_qty'] }}</td>
                                    <td>
                                        <a href="{{ route('purchase-order.create', ['supplier_id' => $alert['supplier']['supplier_id'], 'product_id' => $alert['variation_id'], 'quantity' => $alert['reorder_qty']]) }}"
                                           class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-primary tw-text-white">
                                            {{ __('messages.order') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>