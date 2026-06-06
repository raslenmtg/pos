@extends('online_store.layout')
@section('title', 'Commande confirmée – ' . $business->name)

@section('content')
<div class="store-main" style="max-width:700px;">
    <div class="card" style="text-align:center;padding:50px 40px;">
        <div style="width:80px;height:80px;background:#d4edda;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
            <i class="fas fa-check" style="font-size:36px;color:#28a745;"></i>
        </div>
        <h1 style="font-size:30px;font-weight:800;color:#155724;margin-bottom:10px;">Commande confirmée !</h1>
        <p style="color:var(--muted);font-size:16px;margin-bottom:24px;">
            Merci pour votre commande. Nous vous contacterons très prochainement.
        </p>

        <div style="background:var(--light);border-radius:10px;padding:20px;margin-bottom:28px;text-align:left;">
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:var(--muted);">N° de commande</span>
                <strong>{{ $order->order_number }}</strong>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:var(--muted);">Client</span>
                <strong>{{ $order->customer_name }}</strong>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:var(--muted);">Téléphone</span>
                <strong>{{ $order->customer_phone }}</strong>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:var(--muted);">Adresse</span>
                <strong>{{ $order->customer_address }}{{ $order->customer_city ? ', ' . $order->customer_city : '' }}</strong>
            </div>
            <div style="display:flex;justify-content:space-between;border-top:1px solid var(--border);padding-top:10px;margin-top:10px;">
                <span style="color:var(--muted);">Total</span>
                <strong style="font-size:18px;color:var(--accent);">{{ number_format($order->subtotal, 3) }} TND</strong>
            </div>
        </div>

        <div style="background:#fff3cd;border:1px solid #ffc107;border-radius:8px;padding:14px;margin-bottom:28px;">
            <p style="color:#856404;font-size:14px;margin:0;">
                <i class="fas fa-info-circle"></i>
                <strong>Paiement à la livraison.</strong> Un représentant vous contactera pour confirmer la livraison.
            </p>
        </div>

        <a href="{{ route('online_store.index', $slug) }}" class="btn btn-primary" style="font-size:16px;padding:14px 32px;">
            <i class="fas fa-arrow-left"></i> Retour à la boutique
        </a>
    </div>
</div>
@endsection
