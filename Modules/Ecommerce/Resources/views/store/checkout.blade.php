@extends('ecommerce::store.layout')

@section('title', 'Commande — '.$business->name)

@section('content')
<div class="page-hero">
    <div class="container">
        <h1><i class="fa fa-truck"></i> Finaliser votre commande</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.07);padding:28px;">
                <h4 style="margin-top:0;font-weight:700;"><i class="fa fa-user"></i> Vos informations de livraison</h4>
                <hr>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin:0;padding-left:16px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('ecom.dev.placeOrder', $subdomain) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" placeholder="Votre nom et prénom" required style="border-radius:6px;">
                    </div>
                    <div class="form-group">
                        <label>Téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" placeholder="+216 XX XXX XXX" required style="border-radius:6px;">
                    </div>
                    <div class="form-group">
                        <label>Adresse de livraison <span class="text-danger">*</span></label>
                        <textarea name="customer_address" class="form-control" rows="3" placeholder="Rue, ville, code postal..." required style="border-radius:6px;">{{ old('customer_address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius:8px;background:#1a73e8;border-color:#1a73e8;margin-top:8px;">
                        <i class="fa fa-check-circle"></i> Confirmer la commande
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.07);padding:24px;">
                <h4 style="margin-top:0;font-weight:700;">Votre commande</h4>
                <hr>
                @foreach($items as $item)
                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                    <div>
                        <strong>{{ $item['product']->name }}</strong>
                        @if($item['variation']->name !== 'DUMMY')
                            <br><small class="text-muted">{{ $item['variation']->name }}</small>
                        @endif
                        <br><small class="text-muted">× {{ $item['quantity'] }}</small>
                    </div>
                    <strong>{{ number_format($item['subtotal'], 2) }} DT</strong>
                </div>
                @endforeach
                <hr>
                <div style="display:flex;justify-content:space-between;font-size:18px;font-weight:700;color:#1a73e8;">
                    <span>Total</span>
                    <span>{{ number_format($total, 2) }} DT</span>
                </div>
                <p style="color:#6c757d;font-size:12px;margin-top:12px;"><i class="fa fa-info-circle"></i> Paiement à la livraison. Vous serez contacté pour confirmer votre commande.</p>
            </div>
        </div>
    </div>
</div>
@endsection
