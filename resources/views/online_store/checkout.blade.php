@extends('online_store.layout')
@section('title', 'Passer la commande – ' . $business->name)

@section('content')
<div class="store-main">
    <div class="breadcrumb">
        <a href="{{ route('online_store.index', $slug) }}">Accueil</a>
        <span>›</span>
        <a href="{{ route('online_store.cart', $slug) }}">Panier</a>
        <span>›</span>
        Commande
    </div>

    <h2 style="font-size:26px;font-weight:800;margin-bottom:24px;"><i class="fas fa-credit-card"></i> Finaliser la commande</h2>

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('online_store.placeOrder', $slug) }}" method="POST">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 360px;gap:30px;align-items:start;">

            {{-- Delivery Form --}}
            <div class="card">
                <div class="card-title"><i class="fas fa-map-marker-alt"></i> Informations de livraison</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom complet <span class="required-star">*</span></label>
                        <input type="text" name="customer_name" class="form-control"
                               value="{{ old('customer_name') }}" placeholder="Prénom et Nom" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone <span class="required-star">*</span></label>
                        <input type="tel" name="customer_phone" class="form-control"
                               value="{{ old('customer_phone') }}" placeholder="Ex: 55 123 456" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Adresse de livraison <span class="required-star">*</span></label>
                    <textarea name="customer_address" class="form-control" rows="3"
                              placeholder="Numéro, rue, quartier…" required>{{ old('customer_address') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="customer_city" class="form-control"
                           value="{{ old('customer_city') }}" placeholder="Ex: Tunis, Sfax, Sousse…">
                </div>

                <div class="form-group">
                    <label class="form-label">Notes supplémentaires</label>
                    <textarea name="customer_notes" class="form-control" rows="2"
                              placeholder="Instructions spéciales, disponibilité…">{{ old('customer_notes') }}</textarea>
                </div>

                <div style="padding:16px;background:var(--light);border-radius:8px;margin-bottom:18px;">
                    <h4 style="font-size:14px;font-weight:700;margin-bottom:8px;"><i class="fas fa-credit-card"></i> Mode de paiement</h4>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="radio" name="payment_method" value="cash_on_delivery" checked>
                        <span>Paiement à la livraison (cash)</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:16px;padding:14px;">
                    <i class="fas fa-check-circle"></i> Confirmer la commande
                </button>
            </div>

            {{-- Order Summary --}}
            <div class="cart-summary">
                <h3 style="font-size:18px;font-weight:700;margin-bottom:16px;">Votre commande</h3>
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                @php $line = $item['price'] * $item['qty']; $total += $line; @endphp
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);">
                    <div>
                        <div style="font-weight:600;font-size:14px;">{{ $item['name'] }}</div>
                        <div style="font-size:12px;color:var(--muted);">Qté: {{ $item['qty'] }} × {{ number_format($item['price'], 3) }} TND</div>
                    </div>
                    <span style="font-weight:700;white-space:nowrap;">{{ number_format($line, 3) }} TND</span>
                </div>
                @endforeach
                <div class="summary-row" style="margin-top:12px;">
                    <span>Livraison</span>
                    <span style="color:#28a745;font-weight:600;">Gratuite</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>{{ number_format($total, 3) }} TND</span>
                </div>

                <div style="margin-top:18px;padding:14px;background:#f0f9f0;border-radius:8px;border:1px solid #c3e6cb;">
                    <p style="font-size:13px;color:#155724;text-align:center;">
                        <i class="fas fa-shield-alt"></i>
                        Commande sécurisée. Paiement à la livraison.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
@media (max-width: 768px) {
    .store-main > form > div[style*="grid"] { grid-template-columns: 1fr !important; }
}
</style>
@endsection
