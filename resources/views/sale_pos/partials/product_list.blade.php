@forelse($products as $product)
    <div class="col-md-3 col-sm-4 col-xs-6 product_list no-print">
        <div class="product_box pos-product-card" data-variation_id="{{$product->id}}" title="{{$product->name}} @if($product->type == 'variable')- {{$product->variation}} @endif {{ '(' . $product->sub_sku . ')'}}">
            <div class="pos-product-image image-container" style="background-image:url(@if(count($product->media) > 0){{$product->media->first()->display_url}}@elseif(!empty($product->product_image)){{asset('/uploads/img/' . rawurlencode($product->product_image))}}@else{{asset('/img/default.png')}}@endif);background-repeat:no-repeat;background-position:center;background-size:contain;"></div>
            <div class="pos-product-info">
                <div class="pos-product-name">{{$product->name}} @if($product->type == 'variable')<span>- {{$product->variation}}</span>@endif</div>
                <div class="pos-product-sku">{{$product->sub_sku}}</div>
                <div class="pos-product-meta">
                    @if(!empty($show_prices))
                        <strong>@format_currency($product->selling_price)</strong>
                    @endif
                    @if($product->enable_stock)
                        <span>{{ @num_format($product->qty_available) }} {{$product->unit}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <input type="hidden" id="no_products_found">
    <div class="col-md-12"><div class="pos-empty-products"><i class="fas fa-box-open"></i><strong>@lang('lang_v1.no_products_to_display')</strong><span>Try another search or category.</span></div></div>
@endforelse