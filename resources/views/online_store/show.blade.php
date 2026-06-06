@extends('online_store.layout')
@section('title', $product->name . ' – ' . $business->name)

@section('content')
<div class="store-main">
    <div class="breadcrumb">
        <a href="{{ route('online_store.index', $slug) }}">Accueil</a>
        <span>›</span>
        {{ $product->name }}
    </div>

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
        {{-- Image --}}
        <div>
            @if($product->image)
                <img src="{{ asset('uploads/img/' . rawurlencode($product->image)) }}"
                     alt="{{ $product->name }}"
                     style="width:100%;border-radius:12px;box-shadow:var(--shadow);object-fit:cover;max-height:480px;">
            @else
                <div style="width:100%;aspect-ratio:1;background:linear-gradient(135deg,#f0f0f0,#e0e0e0);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:96px;color:#ccc;">
                    <i class="fas fa-image"></i>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div>
            <h1 style="font-size:28px;font-weight:800;margin-bottom:12px;">{{ $product->name }}</h1>

            @if($product->product_description)
            <p style="color:var(--muted);font-size:15px;line-height:1.7;margin-bottom:20px;">
                {{ strip_tags($product->product_description) }}
            </p>
            @endif

            @php
                $hasVariations = $product->product_variations->count() > 0 &&
                    ($product->product_variations->first()->variations->count() > 1 ||
                     ($product->product_variations->count() > 1));
                $defaultVariation = $product->product_variations->first()?->variations->first();
            @endphp

            <div style="font-size:36px;font-weight:900;color:var(--accent);margin-bottom:24px;">
                <span id="displayed-price">{{ number_format($defaultVariation?->sell_price_inc_tax ?? 0, 3) }}</span>
                <span style="font-size:18px;font-weight:500;color:var(--muted);">TND</span>
            </div>

            <form action="{{ route('online_store.addToCart', $slug) }}" method="POST">
                @csrf

                @if($product->type === 'variable' || $hasVariations)
                <div class="form-group">
                    <label class="form-label">Variante</label>
                    <select name="variation_id" class="form-control" id="variation_select" onchange="updatePrice(this)">
                        @foreach($product->product_variations as $pv)
                            @foreach($pv->variations as $v)
                            <option value="{{ $v->id }}"
                                data-price="{{ $v->sell_price_inc_tax }}"
                                {{ $defaultVariation && $v->id === $defaultVariation->id ? 'selected' : '' }}>
                                {{ $v->name !== 'default' ? $v->name : $product->name }}
                                – {{ number_format($v->sell_price_inc_tax, 3) }} TND
                            </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                @else
                    <input type="hidden" name="variation_id" value="{{ $defaultVariation?->id }}">
                @endif

                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <div class="qty-input">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" name="qty" class="qty-val" id="qty_input" value="1" min="1">
                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="submit" class="btn btn-primary" style="flex:1;">
                        <i class="fas fa-cart-plus"></i> Ajouter au panier
                    </button>
                    <a href="{{ route('online_store.index', $slug) }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>

            <div style="margin-top:24px;padding:16px;background:var(--light);border-radius:8px;">
                <p style="font-size:13px;color:var(--muted);"><i class="fas fa-shield-alt"></i> Paiement à la livraison disponible</p>
                <p style="font-size:13px;color:var(--muted);margin-top:6px;"><i class="fas fa-truck"></i> Livraison rapide en Tunisie</p>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .store-main > div[style*="grid"] { grid-template-columns: 1fr !important; }
}
</style>

<script>
function changeQty(delta) {
    var inp = document.getElementById('qty_input');
    var v = parseInt(inp.value) + delta;
    if (v < 1) v = 1;
    inp.value = v;
}
function updatePrice(sel) {
    var price = sel.options[sel.selectedIndex].dataset.price;
    document.getElementById('displayed-price').textContent = parseFloat(price).toFixed(3);
}
</script>
@endsection
