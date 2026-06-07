<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .store-footer { background: #2d3a4b; color: #adb5bd; text-align: center; padding: 24px 0; margin-top: 48px; font-size: 13px; }
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
                    <i class="fa fa-shopping-bag"></i> {{ $business->name }}
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
    @yield('content')
</div>

<footer class="store-footer">
    <div class="container">
        Boutique de <strong>{{ $business->name }}</strong> — Propulsé par <strong>Simplex Gestion</strong>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
@stack('scripts')
</body>
</html>
