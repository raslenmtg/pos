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
                <button type="button" id="bulk-process-btn" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-sm tw-ml-auto tw-text-white">
                    {{ __('messages.bulk_order') }}
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="tw-overflow-x-auto">
            <table class="tw-w-full tw-text-sm">
                <thead class="tw-bg-gray-50 tw-border-b tw-border-gray-200">
                    <tr>
                        <th class="tw-px-6 tw-py-3 tw-w-10">
                            <input type="checkbox" id="smart-qty-select-all" class="tw-rounded tw-border-gray-300 tw-text-primary-600 focus:tw-ring-primary-500">
                        </th>
                        <th class="tw-px-6 tw-py-3 tw-text-left tw-font-semibold tw-text-gray-900">{{ __('messages.product_name') }}</th>
                        <th class="tw-px-6 tw-py-3 tw-text-left tw-font-semibold tw-text-gray-900">{{ __('messages.sku') }}</th>
                        <th class="tw-px-6 tw-py-3 tw-text-right tw-font-semibold tw-text-gray-900">{{ __('messages.current_stock') }}</th>
                        <th class="tw-px-6 tw-py-3 tw-text-right tw-font-semibold tw-text-gray-900">{{ __('messages.days_remaining') }}</th>
                        <th class="tw-px-6 tw-py-3 tw-text-right tw-font-semibold tw-text-gray-900">{{ __('messages.reorder_qty') }}</th>
                        <th class="tw-px-6 tw-py-3 tw-text-center tw-font-semibold tw-text-gray-900">{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody class="tw-divide-y tw-divide-gray-200">
                    @forelse($smart_quantity_alerts as $alert)
                        <tr class="hover:tw-bg-gray-50 tw-transition-colors">
                            <td class="tw-px-6 tw-py-4">
                                <input type="checkbox" class="smart-qty-checkbox tw-rounded tw-border-gray-300 tw-text-primary-600 focus:tw-ring-primary-500"
                                    data-variation-id="{{ $alert['variation_id'] }}"
                                    data-quantity="{{ $alert['reorder_qty'] }}">
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-gray-900 tw-font-medium">
                                {{ $alert['product_name'] }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-gray-600 tw-font-mono tw-text-xs">
                                {{ $alert['variation_id'] ?? '-' }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-right tw-text-gray-900">
                                <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-bg-blue-100 tw-text-blue-800">
                                    {{ $alert['current_stock'] }}
                                </span>
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-right">
                                @if($alert['days_remaining'] <= 3)
                                    <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-bg-red-100 tw-text-red-800">
                                        {{ $alert['days_remaining'] }} {{ __('messages.days') }}
                                    </span>
                                @elseif($alert['days_remaining'] <= 7)
                                    <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-bg-amber-100 tw-text-amber-800">
                                        {{ $alert['days_remaining'] }} {{ __('messages.days') }}
                                    </span>
                                @else
                                    <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-bg-yellow-100 tw-text-yellow-800">
                                        {{ $alert['days_remaining'] }} {{ __('messages.days') }}
                                    </span>
                                @endif
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-right tw-text-gray-900 tw-font-semibold">
                                {{ $alert['reorder_qty'] }}
                            </td>
                            <td class="tw-px-6 tw-py-4 tw-text-right">
                                    <a href="{{ route('purchase-order.create', ['supplier_id' => $alert['supplier']['supplier_id'], 'product_id' => $alert['variation_id'], 'quantity' => $alert['reorder_qty']]) }}"
                                       class="tw-inline-flex tw-items-center tw-justify-center tw-px-3 tw-py-1.5 tw-text-xs tw-font-medium tw-text-white tw-bg-primary-600 hover:tw-bg-primary-700 tw-rounded-lg tw-transition-colors">
                                        <svg class="tw-w-4 tw-h-4 tw-mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 6l11 0"/>
                                            <path d="M9 12l11 0"/>
                                            <path d="M9 18l11 0"/>
                                            <path d="M5 6l0 .01"/>
                                            <path d="M5 12l0 .01"/>
                                            <path d="M5 18l0 .01"/>
                                        </svg>
                                        {{ __('messages.order') }}
                                    </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="tw-px-6 tw-py-8 tw-text-center tw-text-gray-500">
                                <svg class="tw-w-12 tw-h-12 tw-mx-auto tw-mb-2 tw-text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"/>
                                    <path d="M12 12l8 -4.5"/>
                                    <path d="M12 12l0 9"/>
                                    <path d="M12 12l-8 -4.5"/>
                                </svg>
                                {{ __('messages.no_low_stock_products') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple vanilla JS checkbox handler
        const selectAll = document.querySelector('input[id^="smart-qty-select-all"]'); // In case ID is duplicated
        const bulkBtn = document.getElementById('bulk-process-btn')
        
        function getCheckboxes() {
            return document.querySelectorAll('.smart-qty-checkbox');
        }

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                getCheckboxes().forEach(cb => cb.checked = this.checked);

            });
        }
            bulkBtn.addEventListener('click', function() {
                const items = [];
                document.querySelectorAll('.smart-qty-checkbox:checked').forEach(cb => {
                    items.push({
                        variation_id: cb.getAttribute('data-variation-id'),
                        quantity: cb.getAttribute('data-quantity')
                    });
                });

                if(items.length === 0) return;

                $.ajax({
                    url: "{{ route('smart-quantity.bulk-process') }}",
                    method: 'POST',
                    data: { items: items },
                    success: function(res) {
                        if(res.success) {
                            toastr.success(res.msg);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            toastr.error(res.msg);
                        }
                    },
                    error: function(err) {
                        console.error(err);
                        toastr.error("{{ __('messages.something_went_wrong') }}");
                    }
                });
            });

    });
</script>