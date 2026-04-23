<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplex Gestion – Module Caisse / POS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #2948ff;
            --accent: #10b981;
            --accent2: #8b5cf6;
            --pos: #2948ff;
            --pos-dark: #1a35cc;
            --warn: #f59e0b;
            --danger: #ef4444;
            --dark: #ffffff;
            --dark-card: #ffffff;
            --dark-border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-light: #334155;
            --radius: 14px;
            --radius-sm: 8px;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 50%);
            color: var(--text-main);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.4px;
        }

        .navbar .btn-primary,
        .navbar .btn-outline {
            padding: 8px 14px;
            font-size: 0.85rem;
            border-radius: 12px;
        }

        /* ─── HERO ────────────────────────────────────────────── */
        .hero {
            background: radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 70%);
            padding: 130px 24px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 55% at 50% 0%, rgba(41,72,255,0.14) 0%, transparent 70%);
        }
        .hero-label {
            display: inline-block;
            background: rgba(41,72,255,0.1);
            border: 1px solid rgba(41,72,255,0.35);
            color: var(--pos);
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 6px 18px; border-radius: 100px;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800; line-height: 1.18;
            margin-bottom: 24px; position: relative;
        }
        .hero h1 span {
            background: linear-gradient(90deg, var(--pos), #38b2f5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 720px; margin: 0 auto 40px;
            font-size: 1.15rem; color: var(--text-light);
        }
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--pos); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--pos); margin-bottom: 16px;
        }
        .section-tag::before {
            content: ''; display: inline-block;
            width: 24px; height: 2px;
            background: var(--pos); border-radius: 2px;
        }
        .section-tag.blue   { color: var(--primary); }
        .section-tag.blue::before   { background: var(--primary); }
        .section-tag.green  { color: var(--accent); }
        .section-tag.green::before  { background: var(--accent); }
        .section-tag.purple { color: var(--accent2); }
        .section-tag.purple::before { background: var(--accent2); }
        .section-tag.warn   { color: var(--warn); }
        .section-tag.warn::before   { background: var(--warn); }

        .section-title    { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .section-subtitle { font-size: 1.05rem; color: var(--text-light); max-width: 680px; margin-bottom: 56px; }

        /* ─── CARDS GRID ─────────────────────────────────────── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }
        .card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 26px;
            transition: border-color 0.25s, transform 0.2s;
        }
        .card:hover { border-color: rgba(41,72,255,0.35); transform: translateY(-3px); }
        .card.blue:hover   { border-color: rgba(26,107,250,0.4); }
        .card.green:hover  { border-color: rgba(0,194,123,0.4); }
        .card.purple:hover { border-color: rgba(167,139,250,0.4); }

        .card-icon {
            width: 44px; height: 44px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 16px;
        }
        .icon-pos    { background: rgba(41,72,255,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }
        .icon-green  { background: rgba(0,194,123,0.12); }
        .icon-purple { background: rgba(167,139,250,0.12); }
        .icon-warn   { background: rgba(245,158,11,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }

        .card h3 { font-size: 1.02rem; font-weight: 700; margin-bottom: 10px; }
        .card p  { font-size: 0.9rem; color: var(--text-muted); line-height: 1.65; }

        /* ─── FEATURE ROW ─────────────────────────────────────── */
        .feature-row {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 60px; align-items: center;
            margin-bottom: 80px;
        }
        .feature-row.reverse { direction: rtl; }
        .feature-row.reverse > * { direction: ltr; }
        @media (max-width: 768px) {
            .feature-row { grid-template-columns: 1fr; direction: ltr; }
            .feature-row.reverse { direction: ltr; }
        }
        .feature-content h3 { font-size: 1.6rem; font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .feature-content p  { font-size: 1rem; color: var(--text-light); margin-bottom: 24px; }

        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .feature-list li {
            display: flex; gap: 12px; align-items: flex-start;
            font-size: 0.95rem; color: var(--text-light);
        }
        .feature-list li::before {
            content: '✓'; flex-shrink: 0;
            width: 22px; height: 22px;
            background: rgba(41,72,255,0.15);
            color: var(--pos);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }
        .feature-list li.blue::before   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .feature-list li.purple::before { background: rgba(167,139,250,0.15); color: var(--accent2); }

        /* ─── POS MOCK SCREEN ─────────────────────────────────── */
        .pos-mock {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .pos-topbar {
            background: #f8fafc;
            border-bottom: 1px solid var(--dark-border);
            padding: 10px 16px;
            display: flex; align-items: center; gap: 8px;
        }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-red    { background: #ef4444; }
        .dot-yellow { background: #f59e0b; }
        .dot-green  { background: #2948ff; }
        .pos-topbar .ttitle { font-size: 0.78rem; color: var(--text-muted); margin-left: auto; }

        .pos-header-bar {
            background: #f8fafc;
            padding: 12px 14px;
            display: flex; align-items: center; gap: 8px;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--dark-border);
        }
        .pos-header-bar .pill {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 6px 12px;
            font-size: 0.75rem; color: var(--text-light);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .pos-header-bar .pill.date { background: var(--primary); color: #fff; border-color: var(--primary); }
        .pos-header-bar .icon-btn {
            width: 30px; height: 30px;
            border-radius: 6px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.85rem; cursor: pointer;
        }
        .ib-blue   { background: var(--primary); color: #fff; }
        .ib-red    { background: var(--danger); color: #fff; }
        .ib-green  { background: var(--accent); color: #fff; }
        .ib-orange { background: var(--warn); color: #fff; }
        .ib-purple { background: var(--accent2); color: #fff; }
        .ib-dark   { background: #ffffff; color: var(--text-light); border: 1px solid var(--dark-border); }

        .pos-body {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 0;
            min-height: 380px;
        }
        @media (max-width: 768px) {
            .pos-body { grid-template-columns: 1fr; }
        }
        .pos-cart-area {
            padding: 16px;
            border-right: 1px solid var(--dark-border);
        }
        .pos-cart-row1 {
            display: flex; gap: 8px; align-items: center;
            margin-bottom: 10px;
        }
        .pos-input {
            flex: 1;
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 7px 12px;
            font-size: 0.78rem; color: var(--text-light);
            height: 32px; display: flex; align-items: center; gap: 6px;
        }
        .pos-input.search { color: var(--text-muted); font-style: italic; }
        .pos-icon-action {
            width: 32px; height: 32px;
            background: var(--primary); color: #fff;
            border-radius: 6px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
        }
        .pos-icon-action.cam { background: var(--accent); }

        .pos-checkbox {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.75rem; color: var(--text-light);
        }
        .pos-checkbox .cbx {
            width: 14px; height: 14px;
            border: 1px solid var(--dark-border);
            border-radius: 3px; background: #ffffff;
        }
        .pos-checkbox .cbx.checked { background: var(--pos); border-color: var(--pos); }

        .price-type-row {
            display: flex; gap: 8px; align-items: center;
            margin: 8px 0 14px; flex-wrap: wrap;
        }
        .price-type-pill {
            font-size: 0.72rem; padding: 4px 10px;
            border-radius: 100px; font-weight: 600;
            background: #f8fafc; color: var(--text-muted);
            border: 1px solid var(--dark-border);
        }
        .price-type-pill.active { background: var(--pos); color: #fff; border-color: var(--pos); }

        .cart-table-head {
            display: grid; grid-template-columns: 2fr 1.4fr 1fr 30px;
            gap: 8px; padding: 8px 10px;
            font-size: 0.7rem; color: var(--text-muted); font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 4px;
        }
        .cart-table-row {
            display: grid; grid-template-columns: 2fr 1.4fr 1fr 30px;
            gap: 8px; padding: 12px 10px;
            align-items: center;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.82rem;
        }
        .cart-prod-name { color: var(--primary); font-weight: 600; font-size: 0.85rem; }
        .cart-prod-sku  { color: var(--text-muted); font-size: 0.72rem; margin-top: 2px; }
        .cart-prod-stock { color: var(--text-muted); font-size: 0.7rem; margin-top: 4px; }
        .qty-control {
            display: inline-flex; align-items: center; gap: 6px;
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 5px; padding: 4px 6px;
        }
        .qty-btn {
            width: 18px; height: 18px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 700;
            border-radius: 3px;
        }
        .qty-btn.minus { background: rgba(239,68,68,0.15); color: var(--danger); }
        .qty-btn.plus  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .qty-val { font-size: 0.8rem; min-width: 28px; text-align: center; font-weight: 600; }
        .cart-total { font-weight: 700; color: var(--text-main); }
        .cart-remove { color: var(--danger); font-size: 1rem; cursor: pointer; text-align: center; }

        .cart-summary-row {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid var(--dark-border);
        }
        .csum-item { font-size: 0.78rem; }
        .csum-item .lbl { color: var(--text-muted); display: block; margin-bottom: 3px; }
        .csum-item .val { color: var(--text-light); font-weight: 600; }

        .cart-totals-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 8px 10px; margin-top: 8px;
            font-size: 0.85rem;
        }
        .cart-totals-row .totlabel { color: var(--text-muted); }
        .cart-totals-row .totval   { font-weight: 700; }

        /* RIGHT SIDE — categories / brands */
        .pos-right {
            padding: 14px;
            background: #ffffff;
        }
        .right-header {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 8px; margin-bottom: 12px;
        }
        .right-header div {
            background: linear-gradient(135deg, var(--primary), #6366f1);
            color: #fff;
            text-align: center;
            padding: 8px 10px;
            border-radius: 6px;
            font-size: 0.78rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .right-header div:nth-child(2) {
            background: linear-gradient(135deg, var(--accent2), #c084fc);
        }
        .product-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        .prod-tile {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            padding: 10px 4px;
            text-align: center;
            font-size: 0.7rem;
            transition: border-color 0.2s, transform 0.15s;
            cursor: pointer;
        }
        .prod-tile:hover { border-color: var(--pos); transform: translateY(-1px); }
        .prod-tile .pt-img {
            width: 32px; height: 32px;
            background: #f8fafc;
            border-radius: 4px;
            margin: 0 auto 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
        }
        .prod-tile .pt-name { color: var(--text-light); font-weight: 600; line-height: 1.2; }
        .prod-tile .pt-ref  { color: var(--text-muted); font-size: 0.64rem; margin-top: 2px; }

        /* BOTTOM BAR */
        .pos-footer {
            background: #f8fafc;
            border-top: 1px solid var(--dark-border);
            padding: 12px 16px;
            display: flex; align-items: center; gap: 10px;
            flex-wrap: wrap;
        }
        .footer-btn {
            padding: 6px 12px; border-radius: 6px;
            font-size: 0.75rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            cursor: pointer;
        }
        .fb-outline { background: transparent; border: 1px solid var(--dark-border); color: var(--text-light); }
        .fb-cash    { background: var(--accent); color: #fff; }
        .fb-cancel  { background: var(--danger); color: #fff; }
        .fb-multi   { background: #ffffff; color: var(--text-main); border: 1px solid var(--dark-border); }
        .fb-recent  { background: rgba(167,139,250,0.12); color: var(--accent2); border: 1px solid rgba(167,139,250,0.3); }

        .pos-footer .total-display {
            margin-left: auto;
            display: flex; align-items: center; gap: 12px;
        }
        .pos-footer .total-display .lbl {
            font-size: 0.78rem; color: var(--text-muted);
        }
        .pos-footer .total-display .val {
            font-size: 1.4rem; font-weight: 800; color: var(--pos);
        }

        /* ─── HEADER BUTTONS LIST ─────────────────────────────── */
        .header-btns-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
            margin-top: 28px;
        }
        .hbtn-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 18px 20px;
            display: flex; align-items: flex-start; gap: 14px;
            transition: border-color 0.2s;
        }
        .hbtn-card:hover { border-color: var(--pos); }
        .hbtn-icon {
            width: 38px; height: 38px;
            border-radius: 7px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; color: #fff;
        }
        .hi-blue   { background: var(--primary); }
        .hi-red    { background: var(--danger); }
        .hi-green  { background: var(--accent); }
        .hi-orange { background: var(--warn); }
        .hi-purple { background: var(--accent2); }
        .hi-dark   { background: #ffffff; border: 1px solid var(--dark-border); color: var(--text-light); }
        .hi-pos    { background: var(--pos); }
        .hbtn-card h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 4px; }
        .hbtn-card p  { font-size: 0.82rem; color: var(--text-muted); line-height: 1.55; }

        /* ─── SEARCH METHODS ─────────────────────────────────── */
        .search-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-top: 32px;
        }
        .search-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .search-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: var(--pos);
        }
        .search-card .sm-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }
        .search-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .search-card p  { font-size: 0.82rem; color: var(--text-muted); line-height: 1.55; }

        /* ─── PRICE TYPES ────────────────────────────────────── */
        .price-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .price-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px;
            text-align: center;
            position: relative;
        }
        .price-card .pc-tag {
            display: inline-block;
            font-size: 0.7rem; font-weight: 700;
            padding: 3px 10px; border-radius: 100px;
            margin-bottom: 12px;
        }
        .pct-blue   { background: rgba(26,107,250,0.12); color: var(--primary); }
        .pct-green  { background: rgba(0,194,123,0.12); color: var(--accent); }
        .pct-purple { background: rgba(167,139,250,0.12); color: var(--accent2); }
        .price-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
        .price-card .price-val { font-size: 1.4rem; font-weight: 800; color: var(--pos); margin-bottom: 8px; }
        .price-card p { font-size: 0.83rem; color: var(--text-muted); line-height: 1.55; }

        /* ─── CUSTOMIZATION ────────────────────────────────────── */
        .config-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .config-mock h4 {
            font-size: 1rem; font-weight: 700; margin-bottom: 16px;
            padding-bottom: 12px; border-bottom: 1px solid var(--dark-border);
        }
        .toggle-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 11px 0;
            border-bottom: 1px solid var(--dark-border);
        }
        .toggle-row:last-child { border-bottom: none; }
        .toggle-label { font-size: 0.88rem; color: var(--text-light); }
        .toggle-label .tl-sub { font-size: 0.75rem; color: var(--text-muted); margin-top: 2px; }
        .toggle {
            width: 36px; height: 20px;
            background: #f8fafc;
            border-radius: 100px; position: relative;
            transition: background 0.2s;
            flex-shrink: 0;
        }
        .toggle::after {
            content: ''; position: absolute;
            width: 14px; height: 14px; border-radius: 50%;
            background: var(--text-muted);
            top: 3px; left: 3px;
            transition: left 0.2s, background 0.2s;
        }
        .toggle.on { background: var(--pos); }
        .toggle.on::after { left: 19px; background: #fff; }

        /* ─── ALERT BOX ───────────────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px; font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 14px;
        }
        .alert-pos    { background: rgba(41,72,255,0.08); border: 1px solid rgba(41,72,255,0.3); color: #60a5fa; }
        .alert-blue   { background: rgba(26,107,250,0.08); border: 1px solid rgba(26,107,250,0.3); color: #93c5fd; }
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.3); color: #34d399; }

        /* ─── CASHIER DETAILS PANEL ──────────────────────────── */
        .cashier-panel {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .cashier-panel h4 {
            font-size: 1.05rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 10px;
        }
        .stats-2col {
            display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
            margin-bottom: 18px;
        }
        .ministat {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 14px;
            text-align: center;
        }
        .ministat .mlbl { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.06em; font-weight: 600; }
        .ministat .mval { font-size: 1.3rem; font-weight: 800; margin-top: 6px; }

        .pay-line {
            display: flex; justify-content: space-between; align-items: center;
            padding: 9px 0;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.85rem;
        }
        .pay-line:last-child { border-bottom: none; }
        .pay-method {
            display: flex; align-items: center; gap: 8px;
        }
        .pm-icon {
            width: 26px; height: 26px;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
        }
        .pmi-cash    { background: rgba(0,194,123,0.15); color: var(--accent); }
        .pmi-card    { background: rgba(26,107,250,0.15); color: var(--primary); }
        .pmi-credit  { background: rgba(245,158,11,0.15); color: var(--warn); }
        .pmi-multi   { background: rgba(167,139,250,0.15); color: var(--accent2); }

        /* ─── CTA ─────────────────────────────────────────── */
        .cta-section {
            padding: 80px 24px;
            text-align: center;
            background: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            border-top: none;
            color: #fff;
        }
        .cta-section h2 {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 800;
            margin-bottom: 16px;
        }
        .cta-section p {
            color: rgba(255,255,255,0.85);
            font-size: 1.05rem;
            max-width: 540px;
            margin: 0 auto 36px;
        }
        .cta-buttons {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline {
            background: transparent;
            color: var(--dark);
            border: 2px solid #e2e8f0;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .btn-outline:hover { border-color: var(--dark); background: var(--dark); color: #fff; }

        .cta-section .btn-outline {
            border-color: rgba(255,255,255,0.85);
            color: #fff;
        }

        .cta-section .btn-outline:hover {
            background: #fff;
            color: var(--primary);
            border-color: #fff;
        }


        .divider { height: 1px; background: #e2e8f0; }

        .badge {
            display: inline-block; padding: 2px 9px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .badge-pos    { background: rgba(41,72,255,0.12); color: var(--pos); }
        .badge-green  { background: rgba(0,194,123,0.12); color: #1fd89b; }
        .badge-orange { background: rgba(245,158,11,0.12); color: #f5a623; }
    </style>
</head>
<body>
<div class="navbar fixed-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100 py-2 py-md-3">
            <a class="d-flex align-items-center" style="text-decoration: none" href="/">
                <span class="navbar-brand m-0">Simplex<span class="text-primary">.</span></span>
                <img src="/img/logo.png" alt="Simplex Gestion" width="36" height="36" class="ms-2">
            </a>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('business.getRegister') }}" class="btn btn-outline">Inscription</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
            </div>
        </div>
    </div>
</div>

<main>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  HERO                                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-label">Module Caisse / POS — Simplex Gestion</div>
    <h1>Une caisse rapide, simple,<br><span>pensée pour le terrain</span></h1>
    <p>
        Encaissez, scannez, suspendez, retournez — tout depuis un seul écran. Le module Caisse de Simplex Gestion combine la rapidité et la modernité avec la flexibilité d'un système de gestion complet, entièrement personnalisable selon vos habitudes.
    </p>
    <div class="hero-stats">
        <div class="hero-stat">
            <strong>un seul écran</strong>
            <span>Tout que vous besoin</span>
        </div>
        <div class="hero-stat">
            <strong>Douchette ou Caméra</strong>
            <span>Scan code-barres natif</span>
        </div>
        <div class="hero-stat">
            <strong>📱 💻 🖥️</strong>
            <span>Mobile, tablette, ordinateur</span>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Une interface caisse complète, lisible et puissante</h2>
    <p class="section-subtitle">
        Le module Caisse de Simplex Gestion regroupe sur un seul écran l'ensemble des actions dont vous avez besoin au quotidien : recherche produit, scan, gestion des prix, des clients, des paiements, des dépenses et bien plus encore.
    </p>

    <div class="cards-grid">
        <div class="card">
            <div class="card-icon icon-pos">🔍</div>
            <h3>Recherche multi-mode</h3>
            <p>Trouvez un produit par nom, SKU, douchette code-barres ou directement avec la caméra de votre téléphone — c'est vous qui choisissez.</p>
        </div>
        <div class="card blue">
            <div class="card-icon icon-blue">👤</div>
            <h3>Gestion client en direct</h3>
            <p>Sélectionnez un client existant par nom, téléphone ou ID, ou créez-en un nouveau sans quitter la caisse.</p>
        </div>
     <div class="card green">
            <div class="card-icon icon-green">📷</div>
            <h3>Scannez avec votre téléphone</h3>
            <p>Pas de douchette physique ? utilise directement la caméra de votre smartphone pour scanner les codes-barres produits.
            </p>
        </div>

          <div class="card green">
            <div class="card-icon icon-green">💰</div>
            <h3>Maîtrise des stocks</h3>
            <p>Ne vendez plus jamais à l'aveugle. Simplex affiche le stock disponible pour chaque produit directement sur l'interface</p>
        </div>

          <div class="card green">
            <div class="card-icon icon-green">💳</div>
            <h3>Paiement flexible</h3>
            <p>Choisissez type de paiement entre vente au comptant, vente à crédit, carte bancaire, ou toute autre méthode que vous aurez configurée.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">🏷️</div>
            <h3>Remises & taxes flexibles</h3>
            <p>Appliquez des remises personnalisées et des taxes spécifiques à chaque vente, en pourcentage ou montant fixe.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-warn">⏸️</div>
            <h3>Ventes suspendues</h3>
            <p>Mettez en pause une vente en cours pour servir un autre client, puis reprenez-la plus tard sans perdre une seule ligne.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-red">↩️</div>
            <h3>Retours en caisse</h3>
            <p>Traitez un retour client en saisissant simplement le numéro de la facture d'origine — Simplex Gestion fait le reste.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  POS MOCK SCREEN                                        -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">L'écran de caisse</div>
        <h2 class="section-title">Tout ce que votre caissier peut faire,<br>en un seul écran</h2>
        <p class="section-subtitle">
            Une interface dense mais lisible, conçue pour servir un client en quelques secondes. Chaque bouton a sa place, chaque action est à portée de clic.
        </p>

        <!-- POS MOCK -->
        <div class="pos-mock">
            <div class="pos-topbar">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
                <span class="ttitle">Caisse — Simplex Gestion</span>
            </div>

            <!-- HEADER BAR -->
            <div class="pos-header-bar">
                <div class="pill"><span style="color:var(--text-muted);">Emplacement :</span> <strong>Ariana (A1)</strong> ▾</div>
                <div class="pill date">📅 23/04/2026 20:32</div>
                <span style="margin-left:auto"></span>
                <div class="icon-btn ib-blue" title="Transactions récentes">⏪</div>
                <div class="icon-btn ib-red" title="Fermer la caisse">⛔</div>
                <div class="icon-btn ib-green" title="Détails caissier">📊</div>
                <div class="icon-btn ib-green" title="Calculatrice">🖩</div>
                <div class="icon-btn ib-orange" title="Retour de vente">↩️</div>
                <div class="icon-btn ib-purple" title="Plein écran">⛶</div>
                <div class="icon-btn ib-dark" title="Paramètres">⚙️</div>
                <div class="pill" style="background:#ffffff; border:1px solid var(--dark-border); cursor:pointer;">
                    ⊕ Ajouter des dépenses
                </div>
            </div>

            <div class="pos-body">
                <!-- LEFT: cart area -->
                <div class="pos-cart-area">
                    <!-- Client + product search -->
                    <div class="pos-cart-row1">
                        <div class="pos-input">👤 Passager ▾</div>
                        <div class="pos-icon-action">+</div>
                    </div>
                    <div class="pos-cart-row1">
                        <div class="pos-input search">🔍 Entrez le nom du produit / SKU / Code-barres…</div>
                        <div class="pos-icon-action">+</div>
                        <div class="pos-icon-action cam" title="Scanner avec caméra">📷</div>
                    </div>

                    <!-- Vente comptoir + price type -->
                    <div class="price-type-row">
                        <span class="pos-checkbox"><span class="cbx checked"></span> Vente au comptoir</span>
                        <span style="font-size:0.72rem; color:var(--text-muted); margin-left:auto;">Type de prix :</span>
                        <span class="price-type-pill active">Prix par défaut</span>
                        <span class="price-type-pill">Gros</span>
                        <span class="price-type-pill">VIP</span>
                    </div>

                    <!-- Cart table -->
                    <div class="cart-table-head">
                        <span>Produit</span>
                        <span>Quantité</span>
                        <span>Total</span>
                        <span></span>
                    </div>
                    <div class="cart-table-row">
                        <div>
                            <div class="cart-prod-name">Cahier 96 pages</div>
                            <div class="cart-prod-sku">SKU 651651984651 — Selecta</div>
                            <div class="cart-prod-stock">📦 846 Pcs en stock</div>
                        </div>
                        <div>
                            <div class="qty-control">
                                <span class="qty-btn minus">−</span>
                                <span class="qty-val">1.00</span>
                                <span class="qty-btn plus">+</span>
                            </div>
                            <div style="font-size:0.7rem; color:var(--text-muted); margin-top:6px;">pièce ▾</div>
                        </div>
                        <div class="cart-total">TND 2.650</div>
                        <div class="cart-remove">✕</div>
                    </div>
                    <div class="cart-table-row">
                        <div>
                            <div class="cart-prod-name">Stylo bille bleu</div>
                            <div class="cart-prod-sku">SKU 78901234 — Bic</div>
                            <div class="cart-prod-stock">📦 412 Pcs en stock</div>
                        </div>
                        <div>
                            <div class="qty-control">
                                <span class="qty-btn minus">−</span>
                                <span class="qty-val">2.00</span>
                                <span class="qty-btn plus">+</span>
                            </div>
                            <div style="font-size:0.7rem; color:var(--text-muted); margin-top:6px;">pièce ▾</div>
                        </div>
                        <div class="cart-total">TND 1.000</div>
                        <div class="cart-remove">✕</div>
                    </div>

                    <!-- Summary row -->
                    <div class="cart-summary-row">
                        <div class="csum-item">
                            <span class="lbl">Articles</span>
                            <span class="val">3.000</span>
                        </div>
                        <div class="csum-item">
                            <span class="lbl">Total HT</span>
                            <span class="val">TND 3.650</span>
                        </div>
                        <div class="csum-item">
                            <span class="lbl">Statut</span>
                            <span class="val" style="color:var(--accent);">● Caisse ouverte</span>
                        </div>
                    </div>
                    <div class="cart-totals-row">
                        <span class="totlabel">Remise <span style="color:var(--pos);">✎</span></span>
                        <span class="totval">− TND 0.000</span>
                    </div>
                    <div class="cart-totals-row">
                        <span class="totlabel">Taxe de commande <span style="color:var(--pos);">✎</span></span>
                        <span class="totval">+ TND 1.000</span>
                    </div>
                    <div class="cart-totals-row">
                        <span class="totlabel">Expédition <span style="color:var(--pos);">✎</span></span>
                        <span class="totval">+ TND 0.000</span>
                    </div>
                </div>

                <!-- RIGHT: categories / brands / products -->
                <div class="pos-right">
                    <div class="right-header">
                        <div>📂 Catégorie</div>
                        <div>🏷️ Marques</div>
                    </div>
                    <div class="product-grid">
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">0.6</div><div class="pt-ref">(0034)</div></div>
                        <div class="prod-tile"><div class="pt-img">📒</div><div class="pt-name">cahier</div><div class="pt-ref">(98651)</div></div>
                        <div class="prod-tile"><div class="pt-img">🎨</div><div class="pt-name">cahier dessin</div><div class="pt-ref">(521)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fd</div><div class="pt-ref">(0018)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.1</div><div class="pt-ref">(0029)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.2</div><div class="pt-ref">(0030)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.3</div><div class="pt-ref">(0031)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.4</div><div class="pt-ref">(0033)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.5</div><div class="pt-ref">(0032)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.7</div><div class="pt-ref">(0035)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.8</div><div class="pt-ref">(0036)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 0.9</div><div class="pt-ref">(0037)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 10.0</div><div class="pt-ref">(0038)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">fred 11.1</div><div class="pt-ref">(0039)</div></div>
                        <div class="prod-tile"><div class="pt-img">🥤</div><div class="pt-name">gazeuze 75cl</div><div class="pt-ref">(0060)</div></div>
                        <div class="prod-tile"><div class="pt-img">📦</div><div class="pt-name">hrissa</div><div class="pt-ref">(122)</div></div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="pos-footer">
                <span class="footer-btn fb-outline">📝 Brouillon</span>
                <span class="footer-btn fb-outline">🧾 Devis</span>
                <span class="footer-btn fb-outline">⏸ Suspendre</span>
                <span class="footer-btn fb-outline">🤝 Vente à crédit</span>
                <span class="footer-btn fb-outline">💳 Carte</span>
                <span class="footer-btn fb-multi">💰 Paiement multiple</span>
                <span class="footer-btn fb-cash">💵 Espèces</span>
                <span class="footer-btn fb-cancel">✕ Annuler</span>
                <div class="total-display">
                    <span class="lbl">Total<br>À payer :</span>
                    <span class="val">3.650</span>
                </div>
                <span class="footer-btn fb-recent">⓵ Transactions récentes</span>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RECHERCHE PRODUIT MULTI-MODE                           -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Recherche produit</div>
    <h2 class="section-title">Quatre façons de trouver un produit, en moins d'une seconde</h2>
    <p class="section-subtitle">
        Adaptez votre méthode de recherche à votre matériel et à votre habitude. Que vous tapiez le nom, scanniez un code-barres, l'article apparaît instantanément dans le panier.
    </p>

    <div class="search-methods">
        <div class="search-card">
            <div class="sm-icon">⌨️</div>
            <h4>Saisie par nom</h4>
            <p>Tapez les premières lettres du nom du produit — la liste se filtre en temps réel.</p>
        </div>
        <div class="search-card">
            <div class="sm-icon">🔢</div>
            <h4>Recherche par code article</h4>
            <p>Saisissez la référence interne du produit pour un accès direct, sans ambiguïté.</p>
        </div>
        <div class="search-card">
            <div class="sm-icon">📡</div>
            <h4>Douchette code-barres</h4>
            <p>Connectez n'importe quelle douchette et scanniez.</p>
        </div>
        <div class="search-card">
            <div class="sm-icon">📷</div>
            <h4>Caméra du téléphone</h4>
            <p>Pas de douchette ? Cliquez sur l'icône caméra et utilisez votre smartphone comme scanner instantané.</p>
        </div>
    </div>

    <div class="alert-box alert-pos" style="max-width:680px; margin:24px auto 0;">
        <span>💡</span>
        <span><strong>Astuce :</strong> Filtrez les produits par <strong>catégorie</strong> ou par <strong>marque</strong> dans le panneau de droite pour accélérer la sélection lorsque vous ne connaissez pas le nom exact.</span>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  BOUTONS D'EN-TÊTE                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag warn">Barre d'actions</div>
    <h2 class="section-title">Toutes les actions critiques, accessibles en un clic</h2>
    <p class="section-subtitle">
        La barre d'en-tête de la caisse regroupe les actions les plus utilisées par votre équipe : fermeture de caisse, consultation des transactions, retours, plein écran, calculatrice et bien plus.
    </p>

    <div class="header-btns-grid">
        <div class="hbtn-card">
            <div class="hbtn-icon hi-red">⛔</div>
            <div>
                <h4>Fermer la caisse</h4>
                <p>Clôturez la session en cours avec récapitulatif détaillé et impression du rapport Z.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-green">📊</div>
            <div>
                <h4>Détails du caissier</h4>
                <p>Consultez en direct les transactions, modes de paiement et montants encaissés sur la session.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-orange">↩️</div>
            <div>
                <h4>Retour de vente</h4>
                <p>Saisissez le numéro de facture d'origine pour traiter un retour client en quelques secondes.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-blue">⏪</div>
            <div>
                <h4>Transactions récentes</h4>
                <p>Accédez à l'historique des dernières ventes pour réimprimer un ticket ou vérifier un encaissement.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-purple">⛶</div>
            <div>
                <h4>Plein écran</h4>
                <p>Basculez en mode plein écran pour une expérience caisse immersive, sans distractions.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-green">🖩</div>
            <div>
                <h4>Calculatrice</h4>
                <p>Une calculatrice intégrée toujours à portée de main pour les calculs annexes en caisse.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-pos">⏸</div>
            <div>
                <h4>Ventes suspendues</h4>
                <p>Mettez en attente une vente complexe et reprenez-la sans saisir à nouveau aucun produit.</p>
            </div>
        </div>
        <div class="hbtn-card">
            <div class="hbtn-icon hi-dark">⊕</div>
            <div>
                <h4>Ajouter des dépenses</h4>
                <p>Enregistrez une sortie de caisse (achat ponctuel, frais divers) directement depuis l'écran POS.</p>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CASHIER DETAILS PANEL                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag green">Suivi de session</div>
                <h3>Suivez votre session de caisse en temps réel</h3>
                <p>
                    En un clic, votre caissier visualise l'état complet de sa session : nombre de transactions, ventilation par mode de paiement, montant encaissé, dépenses effectuées et solde théorique de la caisse. À la clôture, le rapport est généré et archivé automatiquement.
                </p>
                <ul class="feature-list">
                    <li class="green">Compteur de transactions en direct</li>
                    <li class="green">Ventilation par mode de paiement (espèces, carte, crédit, multiple)</li>
                    <li class="green">Montant encaissé et dépenses cumulées</li>
                    <li class="green">Solde pour rapprochement</li>
                    <li class="green">Rapport Z imprimable à la clôture</li>
                    <li class="green">Historique complet des sessions par caissier et par date</li>
                </ul>
            </div>
            <div>
                <div class="cashier-panel">
                    <h4>📊 Détails du caissier — Session du 23/04/2026</h4>

                    <div class="stats-2col">
                        <div class="ministat">
                            <div class="mlbl">Transactions</div>
                            <div class="mval" style="color:var(--primary);">47</div>
                        </div>
                        <div class="ministat">
                            <div class="mlbl">Total encaissé</div>
                            <div class="mval" style="color:var(--accent);">TND 2,340</div>
                        </div>
                        <div class="ministat">
                            <div class="mlbl">Dépenses</div>
                            <div class="mval" style="color:var(--danger);">− TND 85</div>
                        </div>
                        <div class="ministat">
                            <div class="mlbl">Solde théorique</div>
                            <div class="mval" style="color:var(--pos);">TND 2,255</div>
                        </div>
                    </div>

                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:10px;">
                        Ventilation par mode de paiement
                    </div>

                    <div class="pay-line">
                        <div class="pay-method">
                            <span class="pm-icon pmi-cash">💵</span>
                            <span>Espèces</span>
                        </div>
                        <span style="font-weight:700; color:var(--accent);">TND 1,420.500 <span class="badge badge-pos" style="margin-left:6px;">28 ventes</span></span>
                    </div>
                    <div class="pay-line">
                        <div class="pay-method">
                            <span class="pm-icon pmi-card">💳</span>
                            <span>Carte bancaire</span>
                        </div>
                        <span style="font-weight:700; color:var(--primary);">TND 680.000 <span class="badge badge-pos" style="margin-left:6px;">12 ventes</span></span>
                    </div>
                    <div class="pay-line">
                        <div class="pay-method">
                            <span class="pm-icon pmi-credit">🤝</span>
                            <span>Vente à crédit</span>
                        </div>
                        <span style="font-weight:700; color:var(--warn);">TND 180.500 <span class="badge badge-pos" style="margin-left:6px;">4 ventes</span></span>
                    </div>
                    <div class="pay-line">
                        <div class="pay-method">
                            <span class="pm-icon pmi-multi">💰</span>
                            <span>Paiement multiple</span>
                        </div>
                        <span style="font-weight:700; color:var(--accent2);">TND 59.000 <span class="badge badge-pos" style="margin-left:6px;">3 ventes</span></span>
                    </div>

                    <div class="alert-box alert-green">
                        <span>✓</span>
                        <span>Session ouverte depuis <strong>08:00</strong> par <strong>Ahmed</strong>.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CLÔTURE DE CAISSE + TRANSACTIONS RÉCENTES              -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag warn">Clôture & historique</div>
    <h2 class="section-title">Une fin de journée maîtrisée,<br>un historique toujours à portée de main</h2>
    <p class="section-subtitle">
        Deux fonctions essentielles au quotidien d'un caissier : la clôture de session pour boucler la journée en règle, et l'accès aux transactions récentes pour réimprimer un ticket, vérifier un encaissement ou retrouver une vente en quelques secondes.
    </p>

    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag red">Clôture de caisse</div>
            <h3>Bouclez votre journée en toute confiance</h3>
            <p>
                À la fin de la journée, lancez la clôture de caisse en un clic. Simplex Gestion compare le montant théorique au montant physique compté, met en évidence tout écart éventuel, génère le rapport de clôture (rapport Z) et archive la session pour consultation ultérieure.
            </p>
            <ul class="feature-list">
                <li class="red">Saisie du fond de caisse compté physiquement</li>
                <li class="red">Voir les produits vendus</li>
                <li class="red">Génération du rapport de clôture (rapport Z) imprimable</li>
                <li class="red">Voir les types des paiements</li>
            </ul>
        </div>
        <div>
            <div class="cashier-panel">
                <h4 style="color:#f87171;">⛔ Clôture de la caisse — 23/10/2024</h4>

                <div style="padding: 14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:14px;">
                    <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">Fond de caisse d'ouverture</span>
                        <span style="font-weight:600;">TND 200.000</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">+ Encaissements espèces</span>
                        <span style="font-weight:600; color:var(--accent);">+ TND 1,320.500</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">+ Encaissements par carte</span>
                        <span style="font-weight:600; color:var(--accent);">+ TND 100.000</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">− Dépenses</span>
                        <span style="font-weight:600; color:var(--danger);">− TND 85.000</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:10px 0 4px; border-top: 1px dashed var(--dark-border); margin-top:8px; font-size:0.95rem;">
                        <span style="font-weight:700;">Solde théorique</span>
                        <span style="font-weight:800; color:var(--pos);">TND 1,535.500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag purple">Transactions récentes</div>
            <h3>Retrouvez n'importe quelle vente, en un clin d'œil</h3>
            <p>
                Le bouton <strong>Transactions récentes</strong>, toujours visible dans le pied de page, affiche l'historique des dernières ventes effectuées sur la caisse. Réimprimez un ticket égaré, consultez le détail d'un encaissement ou démarrez un retour client à partir d'une vente passée.
            </p>
            <ul class="feature-list">
                <li class="purple">Liste des dernières ventes (n° facture, montant, client)</li>
                <li class="purple">Modifier ou supprimer une vente</li>
                <li class="purple">Réimpression du ticket original en un clic</li>
                <li class="purple">Détail complet de la vente </li>
            </ul>
        </div>
        <div>
            <div class="pos-mock">
                <div class="pos-topbar">
                    <div class="dot dot-red"></div>
                    <div class="dot dot-yellow"></div>
                    <div class="dot dot-green"></div>
                    <span class="ttitle">Transactions récentes</span>
                </div>
                <div style="padding: 18px;">
                    <div style="display:flex; gap:8px; margin-bottom:14px;">
                        <div class="pos-input search" style="flex:1;">🔍 Rechercher par n° facture, client, montant…</div>
                        <div class="pill" style="background:#ffffff; border:1px solid var(--dark-border); padding:7px 12px; font-size:0.75rem; color:var(--text-light);">Tous modes ▾</div>
                    </div>

                    <div class="cart-table-head" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr;">
                        <span>Heure</span>
                        <span>N° / Client</span>
                        <span>Montant</span>
                        <span>Mode</span>
                        <span></span>
                    </div>
                    <div class="cart-table-row" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr;">
                        <div style="font-size:0.8rem;">20:32</div>
                        <div>
                            <div class="cart-prod-name">FA-0584</div>
                            <div class="cart-prod-sku">Passager</div>
                        </div>
                        <div class="cart-total">TND 3.650</div>
                        <div><span class="badge" style="background:rgba(0,194,123,0.15); color:var(--accent);">💵 Espèces</span></div>
                        <div style="text-align:center; color:var(--accent2); font-size:1rem; cursor:pointer;">🖨️</div>
                    </div>
                    <div class="cart-table-row" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr;">
                        <div style="font-size:0.8rem;">20:18</div>
                        <div>
                            <div class="cart-prod-name">FA-0583</div>
                            <div class="cart-prod-sku">Sami Ben Ali</div>
                        </div>
                        <div class="cart-total">TND 142.300</div>
                        <div><span class="badge" style="background:rgba(26,107,250,0.15); color:var(--primary);">💳 Carte</span></div>
                        <div style="text-align:center; color:var(--accent2); font-size:1rem; cursor:pointer;">🖨️</div>
                    </div>
                    <div class="cart-table-row" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr;">
                        <div style="font-size:0.8rem;">19:54</div>
                        <div>
                            <div class="cart-prod-name">FA-0582</div>
                            <div class="cart-prod-sku">Passager</div>
                        </div>
                        <div class="cart-total">TND 28.500</div>
                        <div><span class="badge" style="background:rgba(0,194,123,0.15); color:var(--accent);">💵 Espèces</span></div>
                        <div style="text-align:center; color:var(--accent2); font-size:1rem; cursor:pointer;">🖨️</div>
                    </div>
                    <div class="cart-table-row" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr;">
                        <div style="font-size:0.8rem;">19:41</div>
                        <div>
                            <div class="cart-prod-name">FA-0581</div>
                            <div class="cart-prod-sku">Société Carthago</div>
                        </div>
                        <div class="cart-total">TND 480.000</div>
                        <div><span class="badge" style="background:rgba(245,158,11,0.15); color:var(--warn);">🤝 Crédit</span></div>
                        <div style="text-align:center; color:var(--accent2); font-size:1rem; cursor:pointer;">🖨️</div>
                    </div>
                    <div class="cart-table-row" style="grid-template-columns: 1fr 1.4fr 1fr 1.2fr 0.6fr; border-bottom:none;">
                        <div style="font-size:0.8rem;">19:22</div>
                        <div>
                            <div class="cart-prod-name">FA-0580</div>
                            <div class="cart-prod-sku">Mehdi Trabelsi</div>
                        </div>
                        <div class="cart-total">TND 67.800</div>
                        <div><span class="badge" style="background:rgba(167,139,250,0.15); color:var(--accent2);">💰 Multiple</span></div>
                        <div style="text-align:center; color:var(--accent2); font-size:1rem; cursor:pointer;">🖨️</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  COMPATIBILITÉ MULTI-APPAREILS                          -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag blue">Multi-appareils</div>
        <h2 class="section-title">Une caisse qui s'adapte à tous vos appareils</h2>
        <p class="section-subtitle">
            Que vous travailliez sur un grand écran de comptoir, une tablette mobile en magasin ou un smartphone en livraison, le module Caisse s'adapte automatiquement. Une seule application, trois expériences optimisées.
        </p>

        <div class="cards-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
            <div class="card blue" style="text-align:center;">
                <div style="font-size:3rem; margin-bottom:14px;">🖥️</div>
                <h3>Ordinateur de comptoir</h3>
                <p>L'expérience caisse complète, idéale pour le point de vente principal. Compatible avec n'importe quel ordinateur Windows, macOS ou Linux disposant d'un navigateur récent. Connectez douchette, imprimante ticket et tiroir-caisse.</p>
            </div>
            <div class="card blue" style="text-align:center;">
                <div style="font-size:3rem; margin-bottom:14px;">📱</div>
                <h3>Tablette tactile</h3>
                <p>Interface optimisée pour le tactile, parfaite pour la mobilité en magasin ou en stand. Servez vos clients où qu'ils se trouvent, scannez les produits avec la caméra arrière et encaissez sur place.</p>
            </div>
            <div class="card blue" style="text-align:center;">
                <div style="font-size:3rem; margin-bottom:14px;">📲</div>
                <h3>Smartphone</h3>
                <p>Encaissez en livraison, en marché ou en déplacement directement depuis votre téléphone. Toutes les fonctions essentielles sont disponibles, avec scan caméra natif intégré.</p>
            </div>
        </div>

        <div class="alert-box alert-blue" style="margin-top:24px; max-width:780px; margin-left:auto; margin-right:auto;">
            <span>☁️</span>
            <span><strong>Synchronisation cloud en temps réel</strong> — toutes vos caisses, peu importe l'appareil, partagent les mêmes produits, clients, stocks et tarifs. Une vente sur tablette est immédiatement visible sur l'ordinateur de comptoir.</span>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  REMISES, TAXES, EXPÉDITION, CLIENT                     -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag purple">Flexibilité totale</div>
    <h2 class="section-title">Adaptez chaque vente à la réalité du terrain</h2>
    <p class="section-subtitle">
        Aucune vente ne ressemble à une autre. Simplex Gestion vous donne la liberté d'ajuster prix, remises, taxes, frais et destinataire — sans quitter l'écran de caisse.
    </p>

    <div class="cards-grid">
        <div class="card purple">
            <div class="card-icon icon-purple">🏷️</div>
            <h3>Remises personnalisées</h3>
            <p>Ajoutez une remise globale ou ligne par ligne, en pourcentage ou en valeur fixe — la mise à jour du total est immédiate.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">💼</div>
            <h3>Taxes spécifiques</h3>
            <p>Appliquez une taxe de commande personnalisée à votre vente, en plus des taxes par défaut configurées au niveau produit.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">✏️</div>
            <h3>Modifier le prix d'un article</h3>
            <p>Besoin de négocier ? Changez ponctuellement le prix d'un produit pour cette vente uniquement, sans toucher à la fiche produit.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">🚚</div>
            <h3>Livraison & expédition</h3>
            <p>Ajoutez une adresse de livraison, des frais d'expédition depuis la caisse.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">👥</div>
            <h3>Création client express</h3>
            <p>Recherchez un client par nom, téléphone ou ID — ou créez-en un nouveau en quelques secondes sans interrompre la vente.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">➕</div>
            <h3>Ajout produit à la volée</h3>
            <p>Un nouveau produit qui n'existe pas encore ? Créez-le depuis la caisse et il sera immédiatement disponible à la vente.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">💰</div>
            <h3>Choisir type de prix</h3>
            <p>Bascule instantanée d'une grille(Détail, gros, VIP, revendeur, partenaire) à l'autre depuis l'écran caisse</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">💰</div>
            <h3>Vente à crédit</h3>
            <p>Enregistre la dette automatiquement dans le compte du client</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VENTE AU COMPTOIR                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag warn">Mode rapide</div>
                <h3>« Vente au comptoir » — pour aller encore plus vite</h3>
                <p>
                    Pour les ventes simples qui ne nécessitent pas de facture numérotée, activez le mode <strong>Vente au comptoir</strong> en un clic. La transaction est enregistrée dans votre caisse et votre stock, mais sans génération de numéro de facture officiel — idéal pour les ventes rapides au comptoir physique.
                </p>
                <ul class="feature-list">
                    <li>Activation/désactivation par simple case à cocher en haut du panier</li>
                    <li>Mode désactivable globalement depuis les paramètres si non souhaité</li>
                </ul>
            </div>
            <div>
                <div style="background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius); padding: 28px; box-shadow: 0 12px 40px rgba(0,0,0,0.4);">
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; background:#ffffff; border:1px solid var(--pos); border-radius:8px; margin-bottom:18px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:32px; height:32px; border-radius:6px; background:var(--pos); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800;">✓</div>
                            <div>
                                <div style="font-size:0.95rem; font-weight:700;">Vente au comptoir</div>
                                <div style="font-size:0.78rem; color:var(--text-muted);">Mode actif — sans n° de facture</div>
                            </div>
                        </div>
                        <span class="toggle on"></span>
                    </div>

                    <div style="margin-top:18px; padding-top:16px; border-top:1px solid var(--dark-border);">
                        <div style="display:flex; justify-content:space-between; padding:8px 0; font-size:0.85rem;">
                            <span style="color:var(--text-muted);">Articles vendus</span>
                            <span style="font-weight:700;">3</span>
                        </div>

                        <div style="display:flex; justify-content:space-between; padding:8px 0; font-size:0.95rem;">
                            <span style="color:var(--text-main); font-weight:700;">Total encaissé</span>
                            <span style="font-weight:800; color:var(--pos); font-size:1.2rem;">TND 3.650</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  PERSONNALISATION                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag">Configuration</div>
            <h3>Une caisse à votre image,<br>jusqu'au moindre bouton</h3>
            <p>
                Chaque commerce a ses propres habitudes. Depuis le menu de configuration, activez ou désactivez chaque option de l'écran caisse selon votre métier : afficher ou masquer le pied de page, autoriser ou non les ventes à crédit, le mode comptoir, les remises libres, etc.
            </p>
            <ul class="feature-list">
                <li>Personnalisation des boutons d'en-tête et de pied de page</li>
                <li>Activation/désactivation des modes de paiement disponibles</li>
                <li>Choix des actions visibles : devis, brouillon, suspendre, crédit…</li>
                <li>Configuration des grilles tarifaires (détail, gros, VIP…)</li>
                <li>Options d'impression du ticket : logo, en-tête, pied, format papier</li>
                <li>Permissions par caissier : qui peut faire des remises, des retours…</li>
                <li>Configuration multi-emplacements (caisses sur plusieurs sites)</li>
            </ul>
        </div>
        <div>
            <div class="config-mock">
                <h4>⚙️ Paramètres de la caisse</h4>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Afficher le bouton « Vente au comptoir »
                        <div class="tl-sub">Permet la vente sans n° de facture</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Autoriser les ventes à crédit
                        <div class="tl-sub">Le client paie ultérieurement</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Autoriser le paiement multiple
                        <div class="tl-sub">Combiner plusieurs modes de paiement</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Permettre la modification du prix
                        <div class="tl-sub">Le caissier peut ajuster le prix d'un article</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Autoriser les remises libres
                        <div class="tl-sub">Sans limite de pourcentage</div>
                    </div>
                    <span class="toggle"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Bouton « Suspendre » dans le pied
                        <div class="tl-sub">Mettre une vente en pause</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
                <div class="toggle-row">
                    <div class="toggle-label">
                        Autoriser la vente à crédit
                        <div class="tl-sub">Permet la vente à crédit</div>
                    </div>
                    <span class="toggle on"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  PIED DE PAGE — MOYENS DE PAIEMENT                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag blue">Pied de page</div>
        <h2 class="section-title">Encaissez en un seul geste,<br>quel que soit le mode</h2>
        <p class="section-subtitle">
            Le pied de page de la caisse regroupe toutes les actions de finalisation : sauvegarde en brouillon, génération de devis, suspension, vente à crédit, paiement par carte, espèces ou paiement multiple.
        </p>

        <div class="header-btns-grid" style="margin-top:0;">
            <div class="hbtn-card">
                <div class="hbtn-icon hi-dark">📝</div>
                <div>
                    <h4>Brouillon</h4>
                    <p>Sauvegardez la vente en cours pour la finaliser plus tard, sans engager le stock.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-dark">🧾</div>
                <div>
                    <h4>Devis</h4>
                    <p>Générez un devis officiel pour le client, convertible en facture après accord.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-orange">⏸</div>
                <div>
                    <h4>Suspendre</h4>
                    <p>Mettez la vente en attente le temps de servir un autre client.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-orange">🤝</div>
                <div>
                    <h4>Vente à crédit</h4>
                    <p>Le client emporte la marchandise et règle plus tard — solde suivi automatiquement.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-blue">💳</div>
                <div>
                    <h4>Carte bancaire</h4>
                    <p>Encaissement par TPE.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-purple">💰</div>
                <div>
                    <h4>Paiement multiple</h4>
                    <p>Combinez espèces + carte + crédit sur une même vente, en quelques clics.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-green">💵</div>
                <div>
                    <h4>Espèces</h4>
                    <p>Saisissez le montant donné par le client.</p>
                </div>
            </div>
            <div class="hbtn-card">
                <div class="hbtn-icon hi-red">✕</div>
                <div>
                    <h4>Annuler</h4>
                    <p>Vide entièrement le panier en cours après confirmation, en un seul clic.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CTA                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="cta-section">
    <h2>Une caisse moderne, à la hauteur de votre activité</h2>
    <p>
        Que vous serviez 10 ou 1 000 clients par jour, le module Caisse de Simplex Gestion s'adapte à votre rythme et à vos habitudes. Démarrez gratuitement, sans engagement.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Caisse rapide</span>
        <span style="font-size:0.85rem; color:white;">✓ Scan par caméra inclus</span>
        <span style="font-size:0.85rem; color:white;">✓ 100 % personnalisable</span>
    </div>
</section>

</main>
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start text-secondary small">
                &copy; 2026 Simplex Gestion. Tous droits réservés.
            </div>
            <div class="col-md-6 text-center text-md-end text-secondary small mt-2 mt-md-0">
                <a href="{{ url('/cgu') }}" class="text-secondary text-decoration-none me-3">CGU</a>
                <a href="{{ url('/privacy') }}" class="text-secondary text-decoration-none">Politique de Confidentialité</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
