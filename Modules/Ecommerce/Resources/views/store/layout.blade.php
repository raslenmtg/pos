<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $business->name) — Boutique en ligne</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { background: #f5f6fa; font-family: 'Segoe UI', Arial, sans-serif; }
        .store-nav { background: #fff; border-bottom: 2px solid #e8eaf0; padding: 14px 0; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .store-nav .brand { font-size: 22px; font-weight: 700; color: #2d3a4b; text-decoration: none; }
        .store-nav .brand:hover { text-decoration: none; color: #1a73e8; }
        .store-nav .cart-btn { position: relative; display: inline-block; }
        .cart-badge { position: absolute; top: -8px; right: -10px; background: #e74c3c; color: #fff; border-radius: 50%; width: 20px; height: 20px; font-size: 11px; display: flex; align-items: center; justify-content: center; }
        .search-bar input { border-radius: 20px 0 0 20px; border-right: none; }
        .search-bar .btn { border-radius: 0 20px 20px 0; background: #1a73e8; color: #fff; border: 1px solid #1a73e8; }
        .product-card { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.07); transition: transform .2s, box-shadow .2s; margin-bottom: 24px; overflow: hidden; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
        .product-card .product-img { width: 100%; height: 200px; object-fit: cover; background: #f0f2f5; display: flex; align-items: center; justify-content: center; }
        .product-card .product-img img { width: 100%; height: 200px; object-fit: cover; }
        .product-card .product-img .no-img { font-size: 48px; color: #c8d0da; }
        .product-card .card-body { padding: 16px; }
        .product-card .product-name { font-weight: 600; font-size: 15px; color: #2d3a4b; margin: 0 0 6px; }
        .product-card .product-price { color: #1a73e8; font-size: 18px; font-weight: 700; }
        .product-card .btn-add { width: 100%; margin-top: 10px; border-radius: 6px; background: #1a73e8; border-color: #1a73e8; }
        .product-card .btn-add:hover { background: #155dbe; border-color: #155dbe; }
        .store-footer { background: #2d3a4b; color: #adb5bd; padding: 32px 0 24px; margin-top: 48px; font-size: 14px; }
        .store-footer h5 { color: #fff; margin: 0; font-size: 18px; }
        .store-footer h6 { color: #fff; margin: 0; }
        .store-footer p { margin: 0; color: #adb5bd; }
        .store-footer .mb-1 { margin-bottom: 5px; }
        .store-footer .mb-2 { margin-bottom: 10px; }
        .store-footer .mb-3 { margin-bottom: 15px; }
        .store-footer .mb-0 { margin-bottom: 0; }
        .text-right-sm { text-align: right; }
        @media(max-width:768px) { .text-right-sm { text-align: center; } }
        .store-footer strong { color: #fff; }
        .breadcrumb { background: transparent; padding: 8px 0; font-size: 13px; }
        .page-hero { background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); color: #fff; padding: 40px 0 32px; margin-bottom: 32px; }
        .page-hero h1 { font-size: 28px; font-weight: 700; margin: 0; }
        .page-hero p { opacity: .85; margin: 6px 0 0; }
        .alert { border-radius: 8px; }
        @media(max-width:768px) { .product-card .product-img, .product-card .product-img img { height: 160px; } }
    </style>
    @stack('styles')
</head>
<body>
<nav class="store-nav">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-6">
                <a href="{{ route('ecom.dev.index', $subdomain) }}" class="brand">
                     {{ $business->name }}
                </a>
            </div>
            <div class="col-sm-6 hidden-xs">
                <form action="{{ route('ecom.dev.index', $subdomain) }}" method="GET" class="input-group search-bar">
                    <input type="text" name="q" class="form-control" placeholder="Rechercher un produit..." value="{{ request('q') }}">
                    <span class="input-group-btn">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>
            </div>
            <div class="col-sm-3 col-xs-6 text-right">
                <a href="{{ route('ecom.dev.cart', $subdomain) }}" class="btn btn-default cart-btn">
                    <i class="fa fa-shopping-cart"></i> Panier
                    @if(isset($cart_count) && $cart_count > 0)
                        <span class="cart-badge">{{ $cart_count }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>

<div id="store-content">
    @if(session('success'))
        <div class="container" style="margin-top:12px">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="container" style="margin-top:12px">
            <div class="alert alert-danger">{{ session('error') }}</div>
        </div>
    @endif
    <div style="min-height: calc(100vh - 250px);">
        @yield('content')
    </div>
</div>

<footer class="store-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                @if($business->logo)
                    <img src="{{ asset('uploads/business_logos/'.$business->logo) }}" alt="{{ $business->name }}" height="40" class="mb-2">
                @endif
                <h5 class="mb-3">{{ $business->name }}</h5>
                <p class="mb-2">Boutique en ligne officielle</p>
            </div>
            <div class="col-sm-4 col-xs-6">
                <h6 class="text-uppercase mb-2" style="color: #fff; font-size: 12px; letter-spacing: 1px;">Adresse</h6>
                @php($location = $business->locations->first())
                @if($location)
                    <p class="mb-1">{{ $location->landmark }}, {{ $location->city }}</p>
                    <p class="mb-1">{{ $location->state }}, {{ $location->zip_code }}</p>
                    <p class="mb-1">{{ $location->country }}</p>
                @endif
            </div>
            <div class="col-sm-4 col-xs-6">
                <h6 class="text-uppercase mb-2" style="color: #fff; font-size: 12px; letter-spacing: 1px;">Contact</h6>
                @if($location)
                    @if($location->mobile)
                        <p class="mb-1"><i class="fa fa-phone" style="width: 20px;"></i> {{ $location->mobile }}</p>
                    @endif
                    @if($location->email)
                        <p class="mb-1"><i class="fa fa-envelope" style="width: 20px;"></i> {{ $location->email }}</p>
                    @endif
                @endif
            </div>
        </div>
        <hr style="border-color: #4a5568; margin: 24px 0;">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <p class="mb-0" style="font-size: 12px;">&copy; {{ date('Y') }} {{ $business->name }}. Tous droits réservés.</p>
            </div>
            <div class="col-sm-6 col-xs-12 text-right-sm">
                <p class="mb-0" style="font-size: 12px;">Publié par <strong>Simplex Gestion</strong></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
@stack('scripts')
</body>
</html>
