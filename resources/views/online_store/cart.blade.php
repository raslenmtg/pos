@extends('online_store.layout')
@section('title', 'Panier – ' . $business->name)

@section('content')
<div class="store-main">
    <div class="breadcrumb">
        <a href="{{ route('online_store.index', $slug) }}">Accueil</a>
        <span>›</span> Panier
    </div>

    <h2 style="font-size:26px;font-weight:800;margin-bottom:24px;"><i class="fas fa-shopping-cart"></i> Mon panier</h2>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @if(empty($cartItems))
        <div class="empty-state">
            <i class="fas fa-shopping-cart"></i>
            <h3>Votre panier est vide</h3>
            <p style="color:var(--muted);margin-bottom:20px;">Ajoutez des produits pour commencer.</p>
            <a href="{{ route('online_store.index', $slug) }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Continuer les achats
            </a>
        </div>
    @else
    <form action="{{ route('online_store.updateCart', $slug) }}" method="POST" id="cart_form">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 320px;gap:30px;align-items:start;">
            {{-- Items --}}
            <div class="card" style="padding:0;overflow:hidden;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th style="text-align:center;">Quantité</th>
                            <th style="text-align:right;">Prix</th>
                            <th style="text-align:right;">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($cartItems as $item)
                        @php $lineTotal = $item['price'] * $item['qty']; $grandTotal += $lineTotal; @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:14px;">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                         style="width:56px;height:56px;object-fit:cover;border-radius:8px;">
                                    <span style="font-weight:600;">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td style="text-align:center;">
                                <div class="qty-input" style="margin:auto;">
                                    <button type="button" class="qty-btn" onclick="changeQty(this,-1)">−</button>
                                    <input type="number" name="quantities[{{ $item['variation_id'] }}]"
                                           class="qty-val" value="{{ $item['qty'] }}" min="0"
                                           onchange="updateTotal(this, {{ $item['price'] }})">
                                    <button type="button" class="qty-btn" onclick="changeQty(this,1)">+</button>
                                </div>
                            </td>
                            <td style="text-align:right;">{{ number_format($item['price'], 3) }} TND</td>
                            <td style="text-align:right;font-weight:700;" class="line-total">{{ number_format($lineTotal, 3) }} TND</td>
                            <td>
                                <form action="{{ route('online_store.removeFromCart', $slug) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="variation_id" value="{{ $item['variation_id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding:16px;display:flex;gap:12px;">
                    <button type="submit" class="btn btn-outline btn-sm">
                        <i class="fas fa-sync"></i> Mettre à jour le panier
                    </button>
                    <a href="{{ route('online_store.index', $slug) }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-arrow-left"></i> Continuer les achats
                    </a>
                </div>
            </div>

            {{-- Summary --}}
            <div class="cart-summary">
                <h3 style="font-size:18px;font-weight:700;margin-bottom:16px;">Récapitulatif</h3>
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span id="grand-total">{{ number_format($grandTotal, 3) }} TND</span>
                </div>
                <div class="summary-row">
                    <span>Livraison</span>
                    <span style="color:#28a745;font-weight:600;">Gratuite</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>{{ number_format($grandTotal, 3) }} TND</span>
                </div>
                <a href="{{ route('online_store.checkout', $slug) }}" class="btn btn-primary"
                   style="width:100%;justify-content:center;margin-top:18px;font-size:16px;">
                    <i class="fas fa-credit-card"></i> Passer la commande
                </a>
                <div style="margin-top:14px;text-align:center;">
                    <small style="color:var(--muted);"><i class="fas fa-shield-alt"></i> Paiement 100% sécurisé</small>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

<style>
@media (max-width: 768px) {
    .store-main > form > div[style*="grid"] { grid-template-columns: 1fr !important; }
}
</style>

<script>
function changeQty(btn, delta) {
    var row = btn.closest('tr');
    var inp = row.querySelector('input[type=number]');
    var v = parseInt(inp.value) + delta;
    if (v < 0) v = 0;
    inp.value = v;
}
function updateTotal(inp, price) {
    var row = inp.closest('tr');
    var totalCell = row.querySelector('.line-total');
    totalCell.textContent = (price * parseInt(inp.value || 0)).toFixed(3) + ' TND';
}
</script>
@endsection
