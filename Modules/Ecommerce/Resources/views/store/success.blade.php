@extends('ecommerce::store.layout')

@section('title', 'Commande confirmée — '.$business->name)

@section('content')
<div class="container" style="padding-top:48px;padding-bottom:48px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div style="background:#fff;border-radius:14px;box-shadow:0 4px 24px rgba(0,0,0,.1);padding:48px 36px;text-align:center;">
                <div style="width:80px;height:80px;border-radius:50%;background:#e8f5e9;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                    <i class="fa fa-check" style="font-size:36px;color:#28a745;"></i>
                </div>
                <h2 style="font-weight:700;color:#2d3a4b;margin-top:0;">Commande confirmée !</h2>
                <p style="color:#5f6b7a;font-size:15px;">Merci pour votre commande. Nous vous contacterons prochainement pour confirmer la livraison.</p>
                <div style="background:#f8f9fa;border-radius:8px;padding:16px;margin:24px 0;text-align:left;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                        <span style="color:#6c757d;">Référence</span>
                        <strong>{{ $transaction->ref_no }}</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                        <span style="color:#6c757d;">Total</span>
                        <strong style="color:#1a73e8;">{{ number_format($transaction->final_total, 2) }} DT</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:#6c757d;">Date</span>
                        <strong>{{ $transaction->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
                <p style="color:#6c757d;font-size:13px;"><i class="fa fa-phone"></i> Paiement à la livraison</p>
                <a href="{{ route('ecom.dev.index', $subdomain) }}" class="btn btn-primary btn-lg" style="border-radius:8px;background:#1a73e8;border-color:#1a73e8;margin-top:8px;">
                    <i class="fa fa-arrow-left"></i> Retour à la boutique
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
