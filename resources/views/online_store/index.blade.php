@extends('online_store.layout')
@section('title', 'Catalogue – ' . $business->name)

@section('content')
    {{-- Hero --}}
    <div class="hero">
        <h1>{{ $business->name }}</h1>
        <p>Découvrez nos produits et commandez en ligne</p>
    </div>

    <div class="store-main">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        {{-- Category Filters --}}
        @if($categories->isNotEmpty())
        <div class="filters">
            <a href="{{ route('online_store.index', $slug) }}" class="filter-pill {{ !request('category') ? 'active' : '' }}">
                Tout voir
            </a>
            @foreach($categories as $id => $name)
            <a href="{{ route('online_store.index', $slug) }}?category={{ $id }}" class="filter-pill {{ request('category') == $id ? 'active' : '' }}">
                {{ $name }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Results --}}
        @if($products->isEmpty())
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>Aucun produit disponible</h3>
                <p style="color: var(--muted);">Revenez bientôt !</p>
            </div>
        @else
        <div class="product-grid">
            @foreach($products as $product)
            @php
                $variation = $product->product_variations->first()?->variations->first();
                $price = $variation?->sell_price_inc_tax ?? 0;
                $variation_id = $variation?->id;
            @endphp
            <div class="product-card">
                <a href="{{ route('online_store.show', [$slug, $product->id]) }}" style="text-decoration:none;color:inherit;">
                    @if($product->image)
                        <img class="product-img" src="{{ asset('uploads/img/' . rawurlencode($product->image)) }}" alt="{{ $product->name }}">
                    @else
                        <div class="product-img-placeholder"><i class="fas fa-image"></i></div>
                    @endif
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        @if($product->product_description)
                        <div class="product-desc">{{ strip_tags($product->product_description) }}</div>
                        @endif
                        <div class="product-price">
                            {{ number_format($price, 3) }}
                            <small>TND</small>
                        </div>
                    </div>
                </a>
                @if($variation_id)
                <div style="padding: 0 16px 16px;">
                    <form action="{{ route('online_store.addToCart', $slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="variation_id" value="{{ $variation_id }}">
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" class="btn-add"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->links('online_store.partials.pagination') }}
        </div>
        @endif
    </div>
@endsection
