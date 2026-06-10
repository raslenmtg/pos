<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $business->name) – Boutique en ligne</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --light: #f8f9fa;
            --border: #e0e0e0;
            --text: #333;
            --muted: #777;
            --white: #fff;
            --radius: 10px;
            --shadow: 0 2px 16px rgba(0,0,0,.08);
        }
        body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; background: var(--light); color: var(--text); }

        /* TOPBAR */
        .topbar { background: var(--primary); color: var(--white); padding: 10px 0; font-size: 13px; }
        .topbar-inner { max-width: 1200px; margin: auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }

        /* HEADER */
        .store-header { background: var(--white); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; box-shadow: var(--shadow); }
        .header-inner { max-width: 1200px; margin: auto; padding: 16px 20px; display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .store-logo { font-size: 24px; font-weight: 800; color: var(--primary); text-decoration: none; letter-spacing: -0.5px; }
        .store-logo span { color: var(--accent); }
        .search-bar { flex: 1; min-width: 200px; }
        .search-bar form { display: flex; border: 2px solid var(--border); border-radius: 50px; overflow: hidden; transition: border-color .2s; }
        .search-bar form:focus-within { border-color: var(--accent); }
        .search-bar input { flex: 1; border: none; outline: none; padding: 10px 18px; font-size: 14px; }
        .search-bar button { border: none; background: var(--accent); color: var(--white); padding: 10px 20px; cursor: pointer; }
        .cart-link { display: flex; align-items: center; gap: 8px; text-decoration: none; color: var(--primary); font-weight: 600; padding: 8px 16px; border: 2px solid var(--primary); border-radius: 50px; transition: all .2s; white-space: nowrap; }
        .cart-link:hover { background: var(--primary); color: var(--white); }
        .cart-badge { background: var(--accent); color: var(--white); border-radius: 50%; width: 20px; height: 20px; font-size: 11px; display: flex; align-items: center; justify-content: center; font-weight: 700; }

        /* NAV */
        .store-nav { background: var(--primary); }
        .nav-inner { max-width: 1200px; margin: auto; padding: 0 20px; display: flex; align-items: center; gap: 4px; overflow-x: auto; }
        .nav-inner a { color: rgba(255,255,255,.8); text-decoration: none; padding: 12px 16px; font-size: 13px; white-space: nowrap; border-bottom: 3px solid transparent; transition: all .2s; display: block; }
        .nav-inner a:hover, .nav-inner a.active { color: var(--white); border-bottom-color: var(--accent); }

        /* HERO */
        .hero { background: linear-gradient(135deg, var(--primary) 0%, #16213e 100%); color: var(--white); padding: 60px 20px; text-align: center; }
        .hero h1 { font-size: 42px; font-weight: 800; margin-bottom: 12px; }
        .hero p { font-size: 18px; opacity: .8; }

        /* MAIN */
        .store-main { max-width: 1200px; margin: 30px auto; padding: 0 20px; min-height: calc(100vh - 400px); }

        /* PRODUCT GRID */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 24px; }
        .product-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; transition: transform .2s, box-shadow .2s; cursor: pointer; text-decoration: none; color: inherit; display: block; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,.13); }
        .product-img { width: 100%; aspect-ratio: 1; object-fit: cover; background: #f0f0f0; }
        .product-img-placeholder { width: 100%; aspect-ratio: 1; background: linear-gradient(135deg, #f0f0f0, #e0e0e0); display: flex; align-items: center; justify-content: center; color: #bbb; font-size: 48px; }
        .product-info { padding: 16px; }
        .product-name { font-weight: 700; font-size: 15px; margin-bottom: 6px; line-height: 1.3; }
        .product-desc { font-size: 13px; color: var(--muted); margin-bottom: 10px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
        .product-price { font-size: 20px; font-weight: 800; color: var(--accent); }
        .product-price small { font-size: 13px; font-weight: 500; color: var(--muted); }
        .btn-add { margin-top: 12px; width: 100%; padding: 10px; background: var(--primary); color: var(--white); border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background .2s; }
        .btn-add:hover { background: var(--accent); }

        /* FILTERS */
        .filters { display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap; align-items: center; }
        .filter-pill { padding: 6px 16px; border-radius: 50px; border: 2px solid var(--border); background: var(--white); color: var(--text); text-decoration: none; font-size: 13px; font-weight: 500; transition: all .2s; white-space: nowrap; }
        .filter-pill:hover, .filter-pill.active { border-color: var(--accent); background: var(--accent); color: var(--white); }

        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 8px; border: none; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all .2s; }
        .btn-primary { background: var(--accent); color: var(--white); }
        .btn-primary:hover { background: #c73652; }
        .btn-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: var(--white); }
        .btn-success { background: #28a745; color: var(--white); }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; color: var(--white); }
        .btn-danger:hover { background: #c82333; }
        .btn-sm { padding: 7px 14px; font-size: 13px; }

        /* FORMS */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; }
        .form-control { width: 100%; padding: 11px 14px; border: 2px solid var(--border); border-radius: 8px; font-size: 14px; outline: none; transition: border-color .2s; }
        .form-control:focus { border-color: var(--accent); }
        textarea.form-control { resize: vertical; min-height: 90px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
        .required-star { color: var(--accent); }

        /* BREADCRUMB */
        .breadcrumb { padding: 12px 0; font-size: 13px; color: var(--muted); }
        .breadcrumb a { color: var(--accent); text-decoration: none; }
        .breadcrumb span { margin: 0 6px; }

        /* ALERTS */
        .alert { padding: 14px 18px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }

        /* CARD */
        .card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px; }
        .card-title { font-size: 18px; font-weight: 700; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid var(--border); }

        /* TABLE */
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 14px; text-align: left; border-bottom: 1px solid var(--border); }
        .table th { font-weight: 700; font-size: 13px; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; background: var(--light); }
        .table tbody tr:hover { background: #fafafa; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 64px; color: var(--border); margin-bottom: 18px; }
        .empty-state h3 { font-size: 22px; color: var(--muted); margin-bottom: 10px; }

        /* FOOTER */
        .store-footer { background: var(--primary); color: rgba(255,255,255,.7); padding: 32px 20px 24px; margin-top: 60px; font-size: 14px; }
        .store-footer h5 { color: var(--white); margin: 0; font-size: 18px; }
        .store-footer h6 { color: var(--white); margin: 0; font-size: 12px; letter-spacing: 1px; }
        .store-footer p { margin: 0; color: rgba(255,255,255,.7); }
        .store-footer .mb-1 { margin-bottom: 5px; }
        .store-footer .mb-2 { margin-bottom: 10px; }
        .store-footer .mb-3 { margin-bottom: 15px; }
        .store-footer .mb-0 { margin-bottom: 0; }
        .store-footer strong { color: var(--white); }

        /* QUANTITY */
        .qty-input { display: flex; align-items: center; border: 2px solid var(--border); border-radius: 8px; overflow: hidden; width: 120px; }
        .qty-btn { border: none; background: #f0f0f0; color: var(--text); font-size: 18px; width: 36px; height: 40px; cursor: pointer; transition: background .2s; }
        .qty-btn:hover { background: var(--accent); color: var(--white); }
        .qty-val { flex: 1; border: none; text-align: center; font-size: 15px; font-weight: 600; outline: none; height: 40px; }

        /* CART SUMMARY */
        .cart-summary { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px; position: sticky; top: 80px; }
        .summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 15px; }
        .summary-row.total { font-weight: 800; font-size: 18px; border-top: 2px solid var(--border); margin-top: 8px; padding-top: 14px; }

        /* PAGINATION */
        .pagination { display: flex; gap: 4px; margin-top: 30px; justify-content: center; }
        .pagination a, .pagination span { padding: 8px 14px; border-radius: 6px; border: 1px solid var(--border); font-size: 14px; text-decoration: none; color: var(--text); }
        .pagination .active span, .pagination span[aria-current] { background: var(--accent); color: var(--white); border-color: var(--accent); }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header-inner { flex-direction: column; }
            .product-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }
            .hero h1 { font-size: 28px; }
            .store-footer > div > div[style*="grid"] { grid-template-columns: 1fr !important; }
            .store-footer > div > div[style*="text-align: right"] { text-align: left !important; }
        }
    </style>
    @yield('head_styles')
</head>
<body>
    <div class="topbar">
        <div class="topbar-inner">
            <span><i class="fas fa-phone"></i> Service client disponible</span>
            <span><i class="fas fa-truck"></i> Livraison rapide en Tunisie</span>
        </div>
    </div>

    <header class="store-header">
        <div class="header-inner">
            <a href="{{ route('online_store.index', $slug) }}" class="store-logo">
                {{ $business->name }}<span>.</span>
            </a>
            <div class="search-bar">
                <form action="{{ route('online_store.index', $slug) }}" method="GET">
                    <input type="text" name="search" placeholder="Rechercher un produit…" value="{{ request('search') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            @php
                $cartCount = collect(session('online_cart_' . $business->id, []))->sum();
            @endphp
            <a href="{{ route('online_store.cart', $slug) }}" class="cart-link">
                <i class="fas fa-shopping-cart"></i>
                Panier
                @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </header>

    @yield('content')

    <footer class="store-footer">
        <div style="max-width: 1200px; margin: auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div>
                    @if($business->logo)
                        <img src="{{ asset('uploads/business_logos/'.$business->logo) }}" alt="{{ $business->name }}" height="40" style="margin-bottom: 10px;">
                    @endif
                    <h5 class="mb-3">{{ $business->name }}</h5>
                    <p class="mb-2">Boutique en ligne officielle</p>
                </div>
                <div>
                    <h6 class="mb-2">Adresse</h6>
                    @php($location = $business->locations->first())
                    @if($location)
                        <p class="mb-1">{{ $location->landmark }}, {{ $location->city }}</p>
                        <p class="mb-1">{{ $location->state }}, {{ $location->zip_code }}</p>
                        <p class="mb-1">{{ $location->country }}</p>
                    @endif
                </div>
                <div style="text-align: right;">
                    <h6 class="mb-2">Contact</h6>
                    @if($location)
                        @if($location->mobile)
                            <p class="mb-1"><i class="fas fa-phone" style="width: 20px;"></i> {{ $location->mobile }}</p>
                        @endif
                        @if($location->email)
                            <p class="mb-1"><i class="fas fa-envelope" style="width: 20px;"></i> {{ $location->email }}</p>
                        @endif
                    @endif
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,.1); margin: 24px 0;">
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <p class="mb-0" style="font-size: 12px;">&copy; {{ date('Y') }} {{ $business->name }}. Tous droits réservés.</p>
                <p class="mb-0" style="font-size: 12px;">Propulsé par <strong>Simplex Gestion</strong></p>
            </div>
        </div>
    </footer>
</body>
</html>
