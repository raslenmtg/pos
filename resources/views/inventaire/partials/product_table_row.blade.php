@php
    $theoretical_qty = isset($product->theoretical_qty) ? $product->theoretical_qty : ($product->qty_available ?? 0);
    $real_qty = isset($product->real_qty) ? $product->real_qty : $theoretical_qty;
@endphp
<tr class="inventaire_product_row" data-variation_id="{{ $product->variation_id }}">
    <td>
        {{ $product->product_name }}
        <br>
        <small>{{ $product->sub_sku }}</small>
        <input type="hidden" name="products[{{ $row_index }}][product_id]" value="{{ $product->product_id }}" class="product_id">
        <input type="hidden" name="products[{{ $row_index }}][variation_id]" value="{{ $product->variation_id }}" class="variation_id">
        <input type="hidden" name="products[{{ $row_index }}][theoretical_qty]" value="{{ @format_quantity($theoretical_qty) }}" class="theoretical_qty">
    </td>
    <td>
        <span class="theoretical_qty_text" data-value="{{ $theoretical_qty }}">
            {{ @format_quantity($theoretical_qty) }}
        </span>
        {{ $product->unit }}
    </td>
    <td>
        <input type="text"
            class="form-control input_number real_quantity"
            name="products[{{ $row_index }}][real_qty]"
            value="{{ @format_quantity($real_qty) }}"
            @if(($product->unit_allow_decimal ?? 0) == 1) data-decimal="1" @else data-decimal="0" data-rule-abs_digit="true" data-msg-abs_digit="@lang('lang_v1.decimal_value_not_allowed')" @endif
            data-rule-required="true"
            data-msg-required="@lang('validation.custom-messages.this_field_is_required')">
    </td>
    <td>
        <span class="difference_qty_text">{{ @format_quantity($real_qty - $theoretical_qty) }}</span>
    </td>
    <td class="text-center">
        <i class="fa fa-trash remove_inventaire_product_row cursor-pointer" aria-hidden="true"></i>
    </td>
</tr>

