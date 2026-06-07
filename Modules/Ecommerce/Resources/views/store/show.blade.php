@extends('ecommerce::store.layout')

@section('title', $product->name.' — '.$business->name)

@section('content')
<div class="container" style="padding-top:24px;">
    <ol class="breadcrumb">
        <li><a href="{{ route('ecom.dev.index', $subdomain) }}">Boutique</a></li>
        <li class="active">{{ $product->name }}</li>
    </ol>

    <div class="row">
        <div class="col-md-5">
            <div style="background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.07);min-height:300px;display:flex;align-items:center;justify-content:center;">
                @if($product->image)
                    <img src="{{ asset('uploads/img/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;max-height:420px;object-fit:cover;">
                @else
                    <i class="fa fa-image" style="font-size:80px;color:#c8d0da;"></i>
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <div style="background:#fff;border-radius:10px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,.07);">
                <h1 style="font-size:24px;font-weight:700;color:#2d3a4b;margin-top:0;">{{ $product->name }}</h1>

                @if($product->product_description)
                    <p style="color:#5f6b7a;line-height:1.7;">{{ $product->product_description }}</p>
                @endif

                @if($product->variations->count() > 1)
                    <form action="{{ route('ecom.dev.addToCart', $subdomain) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Variante</label>
                            <select name="variation_id" id="variation_select" class="form-control" style="max-width:280px;">
                                @foreach($product->variations as $v)
                                    <option value="{{ $v->id }}" data-price="{{ $v->sell_price_inc_tax }}">
                                        {{ $v->name != 'DUMMY' ? $v->name : 'Standard' }} — {{ number_format($v->sell_price_inc_tax,2) }} DT
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="font-size:28px;font-weight:700;color:#1a73e8;margin:16px 0;" id="selected-price">
                            {{ number_format($product->variations->first()->sell_price_inc_tax, 2) }} DT
                        </div>
                        <div class="form-group" style="max-width:160px;">
                            <label>Quantité</label>
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius:8px;background:#1a73e8;border-color:#1a73e8;">
                            <i class="fa fa-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                @elseif($product->variations->count() === 1)
                    @php $v = $product->variations->first(); @endphp
                    <div style="font-size:32px;font-weight:700;color:#1a73e8;margin:16px 0;">
                        {{ number_format($v->sell_price_inc_tax, 2) }} DT
                    </div>
                    <form action="{{ route('ecom.dev.addToCart', $subdomain) }}" method="POST">
                        @csrf
                        <input type="hidden" name="variation_id" value="{{ $v->id }}">
                        <div class="form-group" style="max-width:160px;">
                            <label>Quantité</label>
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius:8px;background:#1a73e8;border-color:#1a73e8;">
                            <i class="fa fa-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                @else
                    <p class="text-muted">Ce produit n'est pas disponible à la vente.</p>
                @endif

                <div style="margin-top:20px;">
                    <a href="{{ route('ecom.dev.index', $subdomain) }}" class="btn btn-default">
                        <i class="fa fa-arrow-left"></i> Retour boutique
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('#variation_select').on('change', function() {
    var price = $(this).find(':selected').data('price');
    $('#selected-price').text(parseFloat(price).toFixed(2) + ' DT');
});
</script>
@endpush
