@extends('ecommerce::store.layout')

@section('title', 'Boutique — '.$business->name)

@section('content')
<div class="page-hero">
    <div class="container">
        <h1><i class="fa fa-store"></i> {{ $business->name }}</h1>
        <p>Découvrez nos produits et commandez en ligne</p>
    </div>
</div>

<div class="container">
    @if(request('q'))
        <p class="text-muted">Résultats pour : <strong>{{ request('q') }}</strong> — {{ $products->total() }} produit(s) trouvé(s)</p>
    @endif

    @if($products->count() === 0)
        <div class="text-center" style="padding:60px 0;">
            <i class="fa fa-box-open" style="font-size:60px;color:#c8d0da;"></i>
            <h3 style="color:#a0aab4;margin-top:16px;">Aucun produit disponible</h3>
            @if(request('q'))
                <a href="{{ route('ecom.dev.index', $subdomain) }}" class="btn btn-default" style="margin-top:12px;">Voir tous les produits</a>
            @endif
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                @php
                    $variation = $product->variations->first();
                    $price = $variation ? $variation->sell_price_inc_tax : 0;
                @endphp
                <div class="col-sm-4 col-md-3 col-xs-6">
                    <div class="product-card">
                        <a href="{{ route('ecom.dev.show', [$subdomain, $product->id]) }}" style="display:block;text-decoration:none;">
                            <div class="product-img">
                                @if($product->image)
                                    <img src="{{ asset('uploads/img/'.$product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <div style="width:100%;height:200px;display:flex;align-items:center;justify-content:center;background:#f5f6fa;">
                                        <i class="fa fa-image no-img"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="card-body">
                            <p class="product-name">
                                <a href="{{ route('ecom.dev.show', [$subdomain, $product->id]) }}" style="color:inherit;text-decoration:none;">
                                    {{ $product->name }}
                                </a>
                            </p>
                            <div class="product-price">{{ number_format($price, 2) }} DT</div>
                            @if($variation)
                                <form action="{{ route('ecom.dev.addToCart', $subdomain) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm btn-add">
                                        <i class="fa fa-cart-plus"></i> Ajouter
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center" style="margin-top:24px;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
