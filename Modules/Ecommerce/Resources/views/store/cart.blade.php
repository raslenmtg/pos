@extends('ecommerce::store.layout')

@section('title', 'Panier — '.$business->name)

@section('content')
    <div class="page-hero">
        <div class="container">
            <h1><i class="fa fa-shopping-cart"></i> Votre Panier</h1>
        </div>
    </div>

    <div class="container">
        @if(empty($items))
            <div class="text-center" style="padding:60px 0;">
                <i class="fa fa-shopping-cart" style="font-size:60px;color:#c8d0da;"></i>
                <h3 style="color:#a0aab4;margin-top:16px;">Votre panier est vide</h3>
                <a href="{{ route('ecom.dev.index', $subdomain) }}" class="btn btn-primary" style="margin-top:12px;border-radius:8px;background:#1a73e8;border-color:#1a73e8;">
                    <i class="fa fa-arrow-left"></i> Continuer les achats
                </a>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.07);overflow:hidden;">
                        <table class="table table-hover" id="cart-table" style="margin:0;">
                            <thead style="background:#f8f9fa;">
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th style="width:130px;">Qté</th>
                                <th class="text-right">Sous-total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr data-price="{{ $item['price'] }}">
                                    <td>
                                        <strong>{{ $item['product']->name }}</strong>
                                        @if($item['variation']->name !== 'DUMMY')
                                            <br><small class="text-muted">{{ $item['variation']->name }}</small>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item['price'], 2) }} DT</td>
                                    <td>
                                        <form action="{{ route('ecom.dev.updateCart', $subdomain) }}" method="POST" class="cart-update-form" style="display:flex;gap:4px;">
                                            @csrf
                                            <input type="hidden" name="key" value="{{ $item['key'] }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                   class="form-control input-sm qty-input" style="width:70px;">
                                            <button type="submit" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-right line-subtotal"><strong>{{ number_format($item['subtotal'], 2) }} DT</strong></td>
                                    <td>
                                        <form action="{{ route('ecom.dev.removeFromCart', $subdomain) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="key" value="{{ $item['key'] }}">
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top:12px;">
                        <a href="{{ route('ecom.dev.index', $subdomain) }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> Continuer les achats
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.07);padding:24px;">
                        <h4 style="margin-top:0;font-weight:700;">Récapitulatif</h4>
                        <hr>
                        <div style="display:flex;justify-content:space-between;font-size:15px;margin-bottom:8px;">
                            <span>Sous-total</span><span id="cart-subtotal">{{ number_format($total, 2) }} DT</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;font-size:13px;color:#6c757d;margin-bottom:16px;">
                            <span>Livraison</span><span>À confirmer</span>
                        </div>
                        <hr>
                        <div style="display:flex;justify-content:space-between;font-size:18px;font-weight:700;color:#1a73e8;margin-bottom:20px;">
                            <span>Total</span><span id="cart-total">{{ number_format($total, 2) }} DT</span>
                        </div>
                        <a href="{{ route('ecom.dev.checkout', $subdomain) }}" class="btn btn-primary btn-block btn-lg" style="border-radius:8px;background:#1a73e8;border-color:#1a73e8;">
                            <i class="fa fa-credit-card"></i> Passer la commande
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            function recalculate() {
                var total = 0;
                $('#cart-table tbody tr').each(function () {
                    var price = parseFloat($(this).data('price')) || 0;
                    var qty   = parseInt($(this).find('.qty-input').val()) || 1;
                    var sub   = price * qty;
                    $(this).find('.line-subtotal').html('<strong>' + sub.toFixed(2) + ' DT</strong>');
                    total += sub;
                });
                $('#cart-subtotal').text(total.toFixed(2) + ' DT');
                $('#cart-total').text(total.toFixed(2) + ' DT');
            }

            $(document).on('input change', '.qty-input', function () {
                var val = parseInt($(this).val());
                if (isNaN(val) || val < 1) { $(this).val(1); }
                recalculate();
            });
        });
    </script>
@endpush
