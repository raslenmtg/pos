<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel CRM clients et fournisseurs en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Gérez vos clients et fournisseurs avec Simplex Gestion : fiches complètes, soldes, encours, grand livre, documents, limites de crédit et suivi des impayés en Tunisie.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Logiciel CRM clients et fournisseurs en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Centralisez la gestion des tiers : clients, fournisseurs, soldes, historiques et documents sur une seule plateforme.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Logiciel CRM clients et fournisseurs en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Une gestion complète des clients et fournisseurs, pensée pour les entreprises tunisiennes.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module Clients & Fournisseurs",
            "serviceType": "Logiciel CRM clients et fournisseurs",
            "description": "Solution pour gérer les tiers, suivre les soldes, les impayés, les documents et les historiques commerciaux.",
            "areaServed": "TN",
            "provider": {
                "@type": "Organization",
                "name": "Simplex Gestion",
                "url": "{{ url('/') }}"
            },
            "url": "{{ url()->current() }}"
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #2948ff;
            --accent: #2948ff;
            --accent2: #8b5cf6;
            --pos: #ff8a3d;
            --teal: #2948ff;
            --teal-dark: #1a35cc;
            --rose: #1d4ed8;
            --rose-dark: #1e40af;
            --indigo: #3b82f6;
            --indigo-dark: #2563eb;
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
            color: var(--teal);
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
        .hero h1 .grad-teal {
            background: linear-gradient(90deg, var(--teal), #38b2f5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero h1 .grad-rose {
            background: linear-gradient(90deg, var(--rose), #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 740px; margin: 0 auto 40px;
            font-size: 1.15rem; color: var(--text-light);
        }
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; }
        .hero-stat:nth-child(1) strong { color: var(--rose); }
        .hero-stat:nth-child(2) strong { color: var(--indigo); }
        .hero-stat:nth-child(3) strong { color: var(--teal); }
        .hero-stat:nth-child(4) strong { color: var(--accent); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--teal); margin-bottom: 16px;
        }
        .section-tag::before {
            content: ''; display: inline-block;
            width: 24px; height: 2px;
            background: var(--teal); border-radius: 2px;
        }
        .section-tag.rose   { color: var(--rose); }
        .section-tag.rose::before   { background: var(--rose); }
        .section-tag.indigo { color: var(--indigo); }
        .section-tag.indigo::before { background: var(--indigo); }
        .section-tag.warn   { color: var(--warn); }
        .section-tag.warn::before   { background: var(--warn); }
        .section-tag.danger { color: var(--danger); }
        .section-tag.danger::before { background: var(--danger); }
        .section-tag.green  { color: var(--accent); }
        .section-tag.green::before  { background: var(--accent); }

        .section-title    { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .section-subtitle { font-size: 1.05rem; color: var(--text-light); max-width: 720px; margin-bottom: 56px; }

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
        .card.rose:hover   { border-color: rgba(29,78,216,0.35); }
        .card.indigo:hover { border-color: rgba(59,130,246,0.35); }
        .card.green:hover  { border-color: rgba(41,72,255,0.35); }

        .card-icon {
            width: 44px; height: 44px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 16px;
        }
        .icon-teal   { background: rgba(20,184,166,0.12); }
        .icon-rose   { background: rgba(236,72,153,0.12); }
        .icon-indigo { background: rgba(99,102,241,0.12); }
        .icon-green  { background: rgba(0,194,123,0.12); }
        .icon-warn   { background: rgba(245,158,11,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }
        .icon-purple { background: rgba(167,139,250,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }

        .card h3 { font-size: 1.02rem; font-weight: 700; margin-bottom: 10px; }
        .card p  { font-size: 0.9rem; color: var(--text-muted); line-height: 1.65; }

        /* ─── FEATURE ROW ─────────────────────────────────────── */
        .feature-row {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 60px; align-items: center;
            margin-bottom: 80px;
        }
        .feature-row:last-child { margin-bottom: 0; }
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
            background: rgba(20,184,166,0.15);
            color: var(--teal);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }
        .feature-list li.rose::before   { background: rgba(236,72,153,0.15); color: var(--rose); }
        .feature-list li.indigo::before { background: rgba(99,102,241,0.15); color: var(--indigo); }
        .feature-list li.warn::before   { background: rgba(245,158,11,0.15); color: var(--warn); }
        .feature-list li.danger::before { background: rgba(239,68,68,0.15); color: var(--danger); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }

        /* ─── MOCK SCREEN ─────────────────────────────────── */
        .mock {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .mock-topbar {
            background: #f8fafc;
            border-bottom: 1px solid var(--dark-border);
            padding: 10px 16px;
            display: flex; align-items: center; gap: 8px;
        }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-red    { background: #ef4444; }
        .dot-yellow { background: #f59e0b; }
        .dot-green  { background: #22c55e; }
        .mock-topbar .ttitle { font-size: 0.78rem; color: var(--text-muted); margin-left: auto; }

        /* Filters bar */
        .filters-bar {
            background: #ffffff;
            padding: 16px;
            border-bottom: 1px solid var(--dark-border);
        }
        .filters-bar .ftitle {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.85rem; font-weight: 700; color: var(--teal);
            margin-bottom: 14px;
        }
        .filters-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 12px;
        }
        @media (max-width: 768px) {
            .filters-row { grid-template-columns: repeat(2, 1fr); }
        }
        .filter-check {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.78rem; color: var(--text-light);
        }
        .filter-check .cbx {
            width: 14px; height: 14px;
            border: 1px solid var(--dark-border);
            border-radius: 3px; background: #ffffff;
        }
        .filter-check .cbx.checked { background: var(--teal); border-color: var(--teal); }
        .filter-select {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 7px 10px;
            font-size: 0.78rem; color: var(--text-light);
        }
        .filter-select .lbl { color: var(--text-muted); font-size: 0.7rem; display: block; margin-bottom: 3px; }

        .mock-section-title {
            background: #f8fafc; padding: 12px 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 10px;
        }
        .mock-section-title h5 { font-size: 0.95rem; font-weight: 700; }

        .add-btn {
            background: linear-gradient(135deg, var(--teal), #22d3ee);
            color: #fff; padding: 6px 14px;
            border-radius: 100px; font-size: 0.78rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .add-btn.rose   { background: linear-gradient(135deg, var(--rose), #fb7185); }
        .add-btn.indigo { background: linear-gradient(135deg, var(--indigo), #818cf8); }

        .toolbar {
            background: #ffffff; padding: 12px 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
        }
        .toolbar .small { font-size: 0.75rem; color: var(--text-muted); }
        .export-btn {
            background: #ffffff; border: 1px solid var(--dark-border);
            color: var(--text-light);
            padding: 5px 10px; border-radius: 6px;
            font-size: 0.72rem;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .toolbar .search-input {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 6px 10px;
            font-size: 0.75rem; color: var(--text-muted);
            margin-left: auto; width: 180px;
        }

        /* Table */
        .data-table {
            overflow-x: auto;
            background: #ffffff;
        }
        .data-table table {
            width: 100%; border-collapse: collapse;
            font-size: 0.78rem;
            min-width: 900px;
        }
        .data-table thead th {
            background: #f8fafc;
            padding: 10px 12px;
            text-align: left;
            font-size: 0.7rem; font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em;
            border-bottom: 1px solid var(--dark-border);
            white-space: nowrap;
        }
        .data-table thead th .sort { color: var(--text-muted); margin-left: 4px; opacity: 0.5; font-size: 0.65rem;}
        .data-table tbody td {
            padding: 12px;
            border-bottom: 1px solid var(--dark-border);
            color: var(--text-light);
            vertical-align: top;
            white-space: nowrap;
        }
        .data-table tbody tr:hover { background: rgba(20,184,166,0.04); }
        .row-id { color: var(--teal); font-weight: 600; }
        .row-id.rose { color: var(--rose); }
        .row-name { font-weight: 600; color: var(--text-main); }
        .row-muted { color: var(--text-muted); font-size: 0.72rem; }

        .actions-btn {
            background: rgba(20,184,166,0.12);
            color: var(--teal);
            border: 1px solid rgba(20,184,166,0.3);
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            cursor: pointer;
        }
        .actions-btn.rose {
            background: rgba(236,72,153,0.12);
            color: var(--rose);
            border-color: rgba(236,72,153,0.3);
        }
        .badge {
            display: inline-block; padding: 2px 9px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .badge-zero    { background: rgba(139,154,181,0.15); color: var(--text-muted); }
        .badge-due     { background: rgba(239,68,68,0.15); color: #f87171; }
        .badge-warn    { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .badge-ok      { background: rgba(0,194,123,0.15); color: #1fd89b; }
        .badge-info    { background: rgba(20,184,166,0.15); color: var(--teal); }

        /* Action menu floating */
        .action-menu {
            position: relative;
            display: inline-block;
        }
        .action-menu-popup {
            position: absolute;
            top: calc(100% + 4px); left: 0;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            min-width: 220px;
            padding: 6px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            z-index: 5;
        }
        .action-menu-popup .item {
            display: flex; align-items: center; gap: 10px;
            padding: 7px 10px;
            font-size: 0.78rem; color: var(--text-light);
            border-radius: 5px;
            cursor: pointer;
        }
        .action-menu-popup .item:hover { background: #f8fafc; }
        .action-menu-popup .item.danger { color: #f87171; }
        .action-menu-popup .sep {
            height: 1px; background: var(--dark-border);
            margin: 5px 0;
        }
        .action-menu-popup .item .ic {
            width: 20px; text-align: center; font-size: 0.85rem;
        }

        /* ─── ACTION CARDS GRID ─────────────────────────────── */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
            margin-top: 28px;
        }
        .act-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 16px 18px;
            display: flex; align-items: flex-start; gap: 12px;
            transition: border-color 0.2s;
        }
        .act-card:hover { border-color: var(--teal); }
        .act-card.rose:hover   { border-color: var(--rose); }
        .act-card.indigo:hover { border-color: var(--indigo); }
        .act-icon {
            width: 34px; height: 34px;
            border-radius: 7px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem; color: #fff;
        }
        .ai-teal   { background: var(--teal); }
        .ai-rose   { background: var(--rose); }
        .ai-indigo { background: var(--indigo); }
        .ai-green  { background: var(--accent); }
        .ai-blue   { background: var(--primary); }
        .ai-warn   { background: var(--warn); }
        .ai-purple { background: var(--accent2); }
        .ai-red    { background: var(--danger); }
        .ai-dark   { background: #ffffff; border: 1px solid var(--dark-border); }
        .act-card h4 { font-size: 0.88rem; font-weight: 700; margin-bottom: 4px; }
        .act-card p  { font-size: 0.78rem; color: var(--text-muted); line-height: 1.55; }

        /* ─── LEDGER MOCK ─────────────────────────────────── */
        .ledger-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .ledger-mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 10px;
        }
        .ledger-row {
            display: grid;
            grid-template-columns: 80px 1fr 90px 90px 90px;
            gap: 8px;
            padding: 10px 6px;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.78rem;
            align-items: center;
        }
        .ledger-row.head {
            font-size: 0.68rem; font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border);
            padding-bottom: 8px;
        }
        .ledger-row.total {
            font-weight: 700;
            background: rgba(20,184,166,0.05);
            margin-top: 4px;
            border-bottom: none;
            border-top: 2px solid var(--teal);
        }
        .ledger-row.total.rose {
            background: rgba(236,72,153,0.05);
            border-top-color: var(--rose);
        }
        .ledger-debit  { color: var(--danger); font-weight: 600; text-align: right; }
        .ledger-credit { color: var(--accent); font-weight: 600; text-align: right; }
        .ledger-balance { font-weight: 700; text-align: right; }

        /* ─── CREDIT GAUGE ─────────────────────────────────── */
        .credit-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .credit-card h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 10px;
        }
        .gauge-container {
            background: #ffffff; padding: 18px;
            border-radius: 10px; margin-bottom: 14px;
        }
        .gauge-line {
            display: flex; justify-content: space-between;
            margin-bottom: 8px; font-size: 0.85rem;
        }
        .gauge-line .lbl { color: var(--text-muted); }
        .gauge-line .val { font-weight: 700; }
        .gauge-bar {
            height: 12px;
            background: #f8fafc;
            border-radius: 100px;
            overflow: hidden;
            margin: 8px 0 4px;
        }
        .gauge-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), var(--warn) 70%, var(--danger) 95%);
            border-radius: 100px;
        }
        .gauge-pct { font-size: 0.7rem; color: var(--text-muted); }

        .invoice-line {
            display: flex; justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.82rem;
        }
        .invoice-line:last-child { border-bottom: none; }
        .invoice-line .iref { color: var(--rose); font-weight: 600; }
        .invoice-line .idate { color: var(--text-muted); font-size: 0.72rem; margin-top: 2px; }
        .invoice-line .iamt { font-weight: 700; }
        .invoice-line .iamt.due { color: #f87171; }

        /* ─── ALERT BOX ───────────────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px; font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 14px;
        }
        .alert-teal   { background: rgba(20,184,166,0.08); border: 1px solid rgba(20,184,166,0.3); color: #5eead4; }
        .alert-rose   { background: rgba(236,72,153,0.08); border: 1px solid rgba(236,72,153,0.3); color: #f9a8d4; }
        .alert-indigo { background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.3); color: #a5b4fc; }
        .alert-warn   { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3); color: #fbbf24; }
        .alert-danger { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.3); color: #1fd89b; }

        /* ─── COMPARISON TABLE ───────────────────────────────── */
        .compare {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .compare table {
            width: 100%; border-collapse: collapse;
        }
        .compare th, .compare td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.9rem;
        }
        .compare th {
            background: #f8fafc;
            font-size: 0.85rem; font-weight: 700;
        }
        .compare th.col-rose   { color: var(--rose); }
        .compare th.col-indigo { color: var(--indigo); }
        .compare td:first-child { font-weight: 600; color: var(--text-main); width: 35%; }
        .compare td .yes { color: var(--accent); font-weight: 700; }
        .compare td .no  { color: var(--text-muted); }

        /* ─── DOC NOTE MOCK ─────────────────────────────────── */
        .doc-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
        }
        .doc-mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
        }
        .doc-item {
            display: flex; gap: 12px; align-items: flex-start;
            padding: 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .doc-icon {
            width: 36px; height: 36px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .di-pdf { background: rgba(239,68,68,0.15); color: #f87171; }
        .di-img { background: rgba(20,184,166,0.15); color: var(--teal); }
        .di-doc { background: rgba(26,107,250,0.15); color: var(--primary); }
        .di-note { background: rgba(245,158,11,0.15); color: var(--warn); }
        .doc-item .di-name { font-size: 0.88rem; font-weight: 600; color: var(--text-main); }
        .doc-item .di-meta { font-size: 0.75rem; color: var(--text-muted); margin-top: 3px; }

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

        /* Two-color split intro */
        .split-cards {
            display: grid; grid-template-columns: 1fr 1fr; gap: 24px;
            margin-bottom: 56px;
        }
        @media (max-width: 768px) {
            .split-cards { grid-template-columns: 1fr; }
        }
        .split-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 30px;
            position: relative; overflow: hidden;
        }
        .split-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
        }
        .split-card.rose::before   { background: var(--rose); }
        .split-card.indigo::before { background: var(--indigo); }
        .split-card .sc-icon {
            width: 56px; height: 56px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; margin-bottom: 18px;
        }
        .split-card.rose .sc-icon   { background: rgba(236,72,153,0.15); color: var(--rose); }
        .split-card.indigo .sc-icon { background: rgba(99,102,241,0.15); color: var(--indigo); }
        .split-card h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 12px; }
        .split-card p  { font-size: 0.95rem; color: var(--text-light); margin-bottom: 16px; }
        .split-card ul { list-style: none; }
        .split-card ul li {
            font-size: 0.85rem; color: var(--text-light);
            padding: 5px 0; display: flex; gap: 8px;
        }
        .split-card.rose ul li::before   { content: '◆'; color: var(--rose); }
        .split-card.indigo ul li::before { content: '◆'; color: var(--indigo); }

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
    <div class="hero-label">Module Tiers — Simplex Gestion</div>
    <h1>Maîtrisez vos relations<br><span class="grad-rose">Clients</span> & <span class="grad-teal">Fournisseurs</span></h1>
    <p>
        Toutes les informations de vos partenaires commerciaux centralisées en un seul endroit : coordonnées, soldes, historique, grand livre, encours, limites de crédit, documents et notes. Une vision à 360° pour piloter chaque relation en toute confiance.
    </p>
    <div class="hero-stats">
        <div class="hero-stat">
            <strong>Clients</strong>
            <span>Particuliers, sociétés, VIP</span>
        </div>
        <div class="hero-stat">
            <strong>Fournisseurs</strong>
            <span>Locaux, importateurs</span>
        </div>
        <div class="hero-stat">
            <strong>Grand livre</strong>
            <span>Compte courant détaillé</span>
        </div>
        <div class="hero-stat">
            <strong>Documents</strong>
            <span>Pièces jointes & notes</span>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE - SPLIT                                 -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Une fiche tiers complète, deux usages distincts</h2>
    <p class="section-subtitle">
        Que vous gériez un client fidèle ou un fournisseur stratégique, Simplex Gestion vous offre la gestion complète.
    </p>

    <div class="split-cards">
        <div class="split-card rose">
            <div class="sc-icon">👥</div>
            <h3>Vos Clients</h3>
            <p>Suivez vos ventes, encours, impayés et fidélisez vos meilleurs comptes grâce à des limites de crédit et des grilles tarifaires personnalisées.</p>
            <ul>
                <li>Suivi des impayés et créances en temps réel</li>
                <li>Limite de crédit configurable par client</li>
                <li>Historique complet des ventes et règlements</li>
                <li>Affectation d'une grille tarifaire (détail, gros, VIP…)</li>
                <li>Acompte et Crédit</li>
            </ul>
        </div>
        <div class="split-card indigo">
            <div class="sc-icon">🏭</div>
            <h3>Vos Fournisseurs</h3>
            <p>Gardez le contrôle de vos achats, dettes et retours fournisseurs — pour ne jamais payer en retard ni rater une remise.</p>
            <ul>
                <li>Suivi des achats impayés et avances versées</li>
                <li>Gestion des retours d'achats et avoirs</li>
                <li>Numéro d'identification fiscale (matricule fiscal)</li>
                <li>Historique complet des achats et règlements</li>
                <li>Conditions commerciales et délais de paiement</li>
            </ul>
        </div>
    </div>

    <!-- Common cards -->
    <div class="cards-grid">
        <div class="card">
            <div class="card-icon icon-teal">📒</div>
            <h3>Grand livre</h3>
            <p>Compte courant détaillé avec encaissements, impayées, solde progressif et toutes les pièces (factures, règlements, retours).</p>
        </div>
        <div class="card rose">
            <div class="card-icon icon-rose">💳</div>
            <h3>Soldes & encours</h3>
            <p>Solde d'ouverture, solde d'avance, total impayés, total retours impayés — tout est calculé automatiquement.</p>
        </div>
        <div class="card indigo">
            <div class="card-icon icon-indigo">📎</div>
            <h3>Documents & notes</h3>
            <p>Joignez contrats, scans de pièces d'identité, RIB ou photos — et ajoutez des notes internes par tiers.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-warn">🔍</div>
            <h3>Filtres avancés</h3>
            <p>Filtrez par impayés, retours, soldes d'avance, statut, utilisateur attribué — affichez exactement ce que vous cherchez.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-blue">📤</div>
            <h3>Export multi-format</h3>
            <p>Exportez vos listes en CSV, Excel ou PDF, ou imprimez directement. Personnalisez les colonnes affichées.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-green">✅</div>
            <h3>Statut actif/inactif</h3>
            <p>Désactivez un client/fournisseur obsolète sans supprimer ses données — toute son historique reste consultable.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  FOURNISSEURS — TABLE MOCK                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag indigo">Module Fournisseurs</div>
        <h2 class="section-title">Tous vos fournisseurs, une fiche par partenaire</h2>
        <p class="section-subtitle">
            Visualisez d'un coup d'œil l'identité, les coordonnées, le matricule fiscal, les soldes et les encours de chacun de vos fournisseurs. Filtrez par statut, exportez la liste, et accédez à toutes les actions clés depuis un menu unique.
        </p>

        <div class="mock">
            <div class="mock-topbar">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
                <span class="ttitle">Liste des fournisseurs — Simplex Gestion</span>
            </div>

            <!-- Filters -->
            <div class="filters-bar">
                <div class="ftitle">▾ Filtres</div>
                <div class="filters-row">
                    <div class="filter-check"><span class="cbx"></span> Achat impayé</div>
                    <div class="filter-check"><span class="cbx"></span> Retour d'achat</div>
                    <div class="filter-check"><span class="cbx"></span> Acompte</div>
                    <div class="filter-check"><span class="cbx"></span> Crédit initial</div>
                </div>
                <div class="filters-row" style="grid-template-columns: 1fr 1fr;">
                    <div class="filter-select">
                        <span class="lbl">Peut voir que :</span>
                        Aucun ▾
                    </div>
                    <div class="filter-select">
                        <span class="lbl">Statut :</span>
                        Aucun ▾
                    </div>
                </div>
            </div>

            <!-- Section title -->
            <div class="mock-section-title">
                <h5>Tous vos Fournisseurs</h5>
                <span class="add-btn indigo">⊕ Ajouter</span>
            </div>

            <!-- Toolbar -->
            <div class="toolbar">
                <span class="small">Afficher</span>
                <span class="export-btn">25 ▾</span>
                <span class="small">entrées</span>
                <span class="export-btn">📋 CSV</span>
                <span class="export-btn">📊 Excel</span>
                <span class="export-btn">🖨️ Imprimer</span>
                <span class="export-btn">👁 Colonnes</span>
                <span class="export-btn">📄 PDF</span>
                <span class="search-input">🔍 Recherche…</span>
            </div>

            <!-- Table -->
            <div class="data-table">
                <table>
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>ID contact <span class="sort">↕</span></th>
                        <th>Nom de l'entreprise <span class="sort">↕</span></th>
                        <th>Email <span class="sort">↕</span></th>
                        <th>Matricule fiscal <span class="sort">↕</span></th>
                        <th>Crédit initial <span class="sort">↕</span></th>
                        <th>Acompte <span class="sort">↕</span></th>
                        <th>Mobile</th>
                        <th>Tot. achats impayés <span class="sort">↕</span></th>
                        <th>Tot. retours impayés <span class="sort">↕</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="action-menu">
                                <span class="actions-btn">⚙ Actions ▾</span>
                                <div class="action-menu-popup">
                                    <div class="item"><span class="ic">💵</span> Payer</div>
                                    <div class="item"><span class="ic">↩️</span> Recevoir un retour d'achat impayé</div>
                                    <div class="sep"></div>
                                    <div class="item"><span class="ic">👁</span> Voir</div>
                                    <div class="item"><span class="ic">✏️</span> Modifier</div>
                                    <div class="item danger"><span class="ic">🗑️</span> Effacer</div>
                                    <div class="item"><span class="ic">⛔</span> Désactiver</div>
                                    <div class="sep"></div>
                                    <div class="item"><span class="ic">📒</span> Grand livre</div>
                                    <div class="item"><span class="ic">🛒</span> Achats</div>
                                    <div class="item"><span class="ic">📦</span> État de stock</div>
                                    <div class="item"><span class="ic">📎</span> Documents et notes</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="row-id">CO0006</span></td>
                        <td><span class="row-name">Société Marmouri</span></td>
                        <td>contact@marmouri.tn</td>
                        <td>1215834 K/P/C/000</td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td>55 123 456</td>
                        <td><span class="badge badge-due">TND 2,754.000</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                    </tr>
                    <tr>
                        <td><span class="actions-btn">⚙ Actions ▾</span></td>
                        <td><span class="row-id">CO0005</span></td>
                        <td><span class="row-name">Sement Aboudi Commerce</span></td>
                        <td>aboudi.commerce@gmail.com</td>
                        <td>0985471 A/M/N/000</td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td><span class="badge badge-info">TND 1,200.000</span></td>
                        <td>72 200 000</td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td><span class="badge badge-warn">TND 480.000</span></td>
                    </tr>
                    <tr>
                        <td><span class="actions-btn">⚙ Actions ▾</span></td>
                        <td><span class="row-id">CO0004</span></td>
                        <td><span class="row-name">Distributeur Carthago</span></td>
                        <td>contact@carthago-dist.tn</td>
                        <td>1564782 K/P/N/000</td>
                        <td><span class="badge badge-info">TND 5,000.000</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td>71 100 000</td>
                        <td><span class="badge badge-due">TND 12,453.880</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                    </tr>
                    <tr>
                        <td><span class="actions-btn">⚙ Actions ▾</span></td>
                        <td><span class="row-id">CO0003</span></td>
                        <td><span class="row-name">Belhassen Trabelsi & Fils</span></td>
                        <td>btf@btf.com.tn</td>
                        <td>1215834 K/P/C/000</td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td>98 308 812</td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                        <td><span class="badge badge-zero">TND 0.000</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  FOURNISSEURS — ACTIONS DÉTAILLÉES                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag indigo">Menu Actions — Fournisseurs</div>
    <h2 class="section-title">10 actions, accessibles depuis chaque ligne fournisseur</h2>
    <p class="section-subtitle">
        Le menu « Actions » de chaque fournisseur regroupe toutes les opérations possibles : paiement, retour, consultation, modification, archivage, et accès direct au grand livre, aux achats et aux documents associés.
    </p>

    <div class="actions-grid">
        <div class="act-card indigo">
            <div class="act-icon ai-green">💵</div>
            <div>
                <h4>Payer</h4>
                <p>Enregistrez un règlement fournisseur (espèces, virement, chèque, traite) en quelques clics.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-warn">↩️</div>
            <div>
                <h4>Recevoir un retour d'achat impayé</h4>
                <p>Réceptionnez un avoir fournisseur et ajustez votre solde automatiquement.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-blue">👁</div>
            <div>
                <h4>Voir</h4>
                <p>Affichez la fiche complète du fournisseur avec coordonnées, statistiques et historique.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-purple">✏️</div>
            <div>
                <h4>Modifier</h4>
                <p>Mettez à jour les informations : raison sociale, contact, RIB, conditions de paiement.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-red">🗑️</div>
            <div>
                <h4>Effacer</h4>
                <p>Supprimez définitivement un fournisseur (uniquement si aucune opération n'est liée).</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-dark" style="color:var(--text-light);">⛔</div>
            <div>
                <h4>Désactiver</h4>
                <p>Archivez le fournisseur sans perdre l'historique.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-teal">📒</div>
            <div>
                <h4>Grand livre</h4>
                <p>Consultez le compte courant détaillé : factures, règlements, retours, soldes progressifs.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-indigo">🛒</div>
            <div>
                <h4>Achats</h4>
                <p>Liste complète des bons de commande, factures d'achat et retours liés à ce fournisseur.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-green">📦</div>
            <div>
                <h4>État de stock</h4>
                <p>Inventaire des produits achetés chez ce fournisseur, avec stocks actuels et rotations.</p>
            </div>
        </div>
        <div class="act-card indigo">
            <div class="act-icon ai-warn">📎</div>
            <div>
                <h4>Documents et notes</h4>
                <p>Pièces jointes (contrats, RIB, attestations) et notes internes liées au fournisseur.</p>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  FILTRES                                                -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag warn">Filtres avancés</div>
                <h3>Trouvez exactement ce que vous cherchez,<br>en quelques secondes</h3>
                <p>
                    Plusieurs centaines de fournisseurs ou de clients ? Aucun problème. Combinez les filtres pour cibler instantanément un sous-ensemble : ceux qui vous doivent de l'argent, ceux qui ont une avance, ceux qui ont un solde d'ouverture, ceux qui sont attribués à un commercial particulier, etc.
                </p>
                <ul class="feature-list">
                    <li class="warn">Filtre <strong>Achat impayé</strong> — n'afficher que les fournisseurs avec dettes ouvertes</li>
                    <li class="warn">Filtre <strong>Retour d'achat</strong> — fournisseurs avec retours en attente</li>
                    <li class="warn">Filtre <strong>Avance</strong> — fournisseurs ayant reçu des avances</li>
                    <li class="warn">Filtre <strong>Crédit initial</strong> — soldes hérités d'un ancien système</li>
                    <li class="warn">Filtre <strong>Peut voir que</strong> — restreindre par utilisateur attribué</li>
                    <li class="warn">Filtre <strong>Statut</strong> — actif, inactif</li>
                    <li class="warn">Recherche textuelle libre dans tous les champs</li>
                    <li class="warn">Cumul des filtres pour des recherches très précises</li>
                </ul>
            </div>
            <div>
                <div class="mock" style="box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);">
                    <div class="filters-bar" style="padding: 20px;">
                        <div class="ftitle">▾ Filtres actifs</div>
                        <div class="filters-row">
                            <div class="filter-check"><span class="cbx checked"></span> Achat impayé</div>
                            <div class="filter-check"><span class="cbx"></span> Retour d'achat</div>
                            <div class="filter-check"><span class="cbx checked"></span> Acompte</div>
                            <div class="filter-check"><span class="cbx"></span> Crédit initial</div>
                        </div>
                        <div class="filters-row" style="grid-template-columns: 1fr 1fr; margin-top: 6px;">
                            <div class="filter-select">
                                <span class="lbl">Peut voir que :</span>
                                Ahmed Ben Ali ▾
                            </div>
                            <div class="filter-select">
                                <span class="lbl">Statut :</span>
                                Actif ▾
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px; text-align: center; background: #ffffff;">
                        <div style="font-size: 2.4rem; font-weight: 800; color: var(--teal);">17</div>
                        <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">
                            fournisseurs correspondent à vos filtres
                        </div>
                        <div style="display: flex; justify-content: center; gap: 12px; margin-top: 14px; flex-wrap: wrap;">
                            <span class="badge badge-due">Total impayés : TND 23,847</span>
                            <span class="badge badge-info">Total avances : TND 4,200</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CLIENTS — TABLE MOCK                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag rose">Module Clients</div>
    <h2 class="section-title">Vos clients, vos ventes, vos encours</h2>
    <p class="section-subtitle">
      Suivi des impayés, gestion d'une limite de crédit configurable par client, consultation directe de l'historique des ventes et encaissement en un clic.
    </p>

    <div class="mock">
        <div class="mock-topbar">
            <div class="dot dot-red"></div>
            <div class="dot dot-yellow"></div>
            <div class="dot dot-green"></div>
            <span class="ttitle">Liste des clients — Simplex Gestion</span>
        </div>

        <!-- Filters -->
        <div class="filters-bar">
            <div class="ftitle" style="color:var(--rose);">▾ Filtres</div>
            <div class="filters-row">
                <div class="filter-check"><span class="cbx checked" style="background:var(--rose); border-color:var(--rose);"></span> Vente impayée</div>
                <div class="filter-check"><span class="cbx"></span> Retour de vente</div>
                <div class="filter-check"><span class="cbx"></span> Acompte</div>
                <div class="filter-check"><span class="cbx"></span> Limite de crédit dépassée</div>
            </div>
            <div class="filters-row" style="grid-template-columns: 1fr 1fr 1fr;">
                <div class="filter-select">
                    <span class="lbl">Grille tarifaire :</span>
                    Toutes ▾
                </div>
                <div class="filter-select">
                    <span class="lbl">Commercial :</span>
                    Tous ▾
                </div>
                <div class="filter-select">
                    <span class="lbl">Statut :</span>
                    Actif ▾
                </div>
            </div>
        </div>

        <div class="mock-section-title">
            <h5>Tous vos Clients</h5>
            <span class="add-btn rose">⊕ Ajouter</span>
        </div>

        <div class="toolbar">
            <span class="small">Afficher</span>
            <span class="export-btn">25 ▾</span>
            <span class="small">entrées</span>
            <span class="export-btn">📋 CSV</span>
            <span class="export-btn">📊 Excel</span>
            <span class="export-btn">🖨️ Imprimer</span>
            <span class="export-btn">👁 Colonnes</span>
            <span class="export-btn">📄 PDF</span>
            <span class="search-input">🔍 Recherche…</span>
        </div>

        <!-- Table -->
        <div class="data-table">
            <table>
                <thead>
                <tr>
                    <th>Action</th>
                    <th>ID <span class="sort">↕</span></th>
                    <th>Nom / Société <span class="sort">↕</span></th>
                    <th>Mobile</th>
                    <th>Grille tarif</th>
                    <th>Limite crédit</th>
                    <th>Acompte</th>
                    <th>Tot. ventes impayées <span class="sort">↕</span></th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="action-menu">
                            <span class="actions-btn rose">⚙ Actions ▾</span>
                            <div class="action-menu-popup">
                                <div class="item"><span class="ic">💵</span> Encaisser</div>
                                <div class="item"><span class="ic">↩️</span> Effectuer un retour de vente</div>
                                <div class="sep"></div>
                                <div class="item"><span class="ic">👁</span> Voir</div>
                                <div class="item"><span class="ic">✏️</span> Modifier</div>
                                <div class="item danger"><span class="ic">🗑️</span> Effacer</div>
                                <div class="item"><span class="ic">⛔</span> Désactiver</div>
                                <div class="sep"></div>
                                <div class="item"><span class="ic">📒</span> Grand livre</div>
                                <div class="item"><span class="ic">🛒</span> Consulter ses ventes</div>
                                <div class="item"><span class="ic">💳</span> Limite de crédit</div>
                                <div class="item"><span class="ic">📎</span> Documents et notes</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="row-id rose">CL0042</span></td>
                    <td>
                        <div class="row-name">Société Carthago SARL</div>
                        <div class="row-muted">contact@carthago.tn</div>
                    </td>
                    <td>71 234 567</td>
                    <td><span class="badge badge-info">Gros</span></td>
                    <td><strong>TND 5,000</strong></td>
                    <td><span class="badge badge-zero">TND 0</span></td>
                    <td><span class="badge badge-due">TND 4,820</span></td>
                    <td><span class="badge badge-warn">⚠ 96 % du crédit</span></td>
                </tr>
                <tr>
                    <td><span class="actions-btn rose">⚙ Actions ▾</span></td>
                    <td><span class="row-id rose">CL0041</span></td>
                    <td>
                        <div class="row-name">Sami Ben Ali</div>
                        <div class="row-muted">sami.benali@gmail.com</div>
                    </td>
                    <td>22 456 789</td>
                    <td><span class="badge badge-zero">Détail</span></td>
                    <td><strong>TND 500</strong></td>
                    <td><span class="badge badge-zero">TND 0</span></td>
                    <td><span class="badge badge-due">TND 142</span></td>
                    <td><span class="badge badge-ok">✓ OK</span></td>
                </tr>
                <tr>
                    <td><span class="actions-btn rose">⚙ Actions ▾</span></td>
                    <td><span class="row-id rose">CL0040</span></td>
                    <td>
                        <div class="row-name">Pharmacie Centrale</div>
                        <div class="row-muted">centrale.pharma@yahoo.fr</div>
                    </td>
                    <td>74 123 456</td>
                    <td><span class="badge" style="background:rgba(167,139,250,0.15); color:var(--accent2);">VIP</span></td>
                    <td><strong>TND 10,000</strong></td>
                    <td><span class="badge badge-info">TND 1,200</span></td>
                    <td><span class="badge badge-zero">TND 0</span></td>
                    <td><span class="badge badge-ok">✓ OK</span></td>
                </tr>
                <tr>
                    <td><span class="actions-btn rose">⚙ Actions ▾</span></td>
                    <td><span class="row-id rose">CL0039</span></td>
                    <td>
                        <div class="row-name">Mehdi Trabelsi</div>
                        <div class="row-muted">mehdi.t@outlook.com</div>
                    </td>
                    <td>54 789 012</td>
                    <td><span class="badge badge-zero">Détail</span></td>
                    <td><strong>TND 0</strong></td>
                    <td><span class="badge badge-zero">TND 0</span></td>
                    <td><span class="badge badge-due">TND 685</span></td>
                    <td><span class="badge badge-due">⛔ Bloqué</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CLIENTS — SPÉCIFICITÉS                                 -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag rose">Clients</div>
        <h2 class="section-title">Trois fonctions exclusives à la fiche client</h2>
        <p class="section-subtitle">
            Le module Clients embarque trois piliers indispensables à toute activité commerciale : suivi des impayés, limite de crédit, et accès direct à l'historique des ventes.
        </p>

        <!-- Impayés -->
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag danger">Impayés</div>
                <h3>Pilotez vos créances clients sans rien laisser passer</h3>
                <p>
                    Pour chaque client, Simplex Gestion calcule en temps réel le montant total des ventes impayées, ventile par facture avec date d'échéance, et signale les retards. Lancez les relances en deux clics et encaissez directement depuis la fiche.
                </p>
                <ul class="feature-list">
                    <li class="danger">Total des ventes impayées calculé automatiquement</li>
                    <li class="danger">Détail par facture avec date d'échéance et nombre de jours de retard</li>
                    <li class="danger">Indicateur visuel pour les factures en retard</li>
                    <li class="danger">Encaissement direct depuis la fiche (espèces, chèque, virement, carte)</li>
                    <li class="danger">Affectation d'un règlement à plusieurs factures (lettrage)</li>
                </ul>
            </div>
            <div>
                <div class="credit-card">
                    <h4 style="color:#f87171;">⚠️ Société Carthago SARL — Impayés</h4>

                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0058</div>
                            <div class="idate">Émise le 12/03/2026 — Échéance 12/04/2026 <strong style="color:#f87171;">(retard 12 j)</strong></div>
                        </div>
                        <span class="iamt due">TND 1,820.000</span>
                    </div>
                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0061</div>
                            <div class="idate">Émise le 28/03/2026 — Échéance 28/04/2026</div>
                        </div>
                        <span class="iamt due">TND 2,100.000</span>
                    </div>
                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0067</div>
                            <div class="idate">Émise le 15/04/2026 — Échéance 15/05/2026</div>
                        </div>
                        <span class="iamt due">TND 900.000</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; padding:14px 0 0; margin-top:14px; border-top:2px solid var(--rose);">
                        <span style="font-weight:700;">Total impayé</span>
                        <span style="font-size:1.3rem; font-weight:800; color:#f87171;">TND 4,820.000</span>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:16px;">
                        <button style="flex:1; background:var(--accent); color:#fff; border:none; padding:10px; border-radius:6px; font-size:0.85rem; font-weight:700; cursor:pointer;">💵 Encaisser</button>
                        <button style="flex:1; background:transparent; color:var(--text-light); border:1px solid var(--dark-border); padding:10px; border-radius:6px; font-size:0.85rem; font-weight:600; cursor:pointer;">📧 Relancer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Limite de crédit -->
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag warn">Limite de crédit</div>
                <h3>Définissez un plafond, et soyez alerté avant qu'il soit dépassé</h3>
                <p>
                    Pour chaque client, fixez une limite de crédit maximale. Simplex Gestion suit en temps réel l'encours et bloque automatiquement (ou alerte selon votre configuration) les nouvelles ventes à crédit dès que la limite est atteinte. Fini les mauvaises surprises en fin de mois.
                </p>
                <ul class="feature-list">
                    <li class="warn">Limite de crédit configurable client par client</li>
                    <li class="warn">Calcul de l'encours en temps réel (impayés + ventes en cours)</li>
                    <li class="warn">Blocage automatique des nouvelles ventes à crédit dépassant la limite</li>
                    <li class="warn">Historique des ajustements de limite (par qui, quand, pourquoi)</li>
                </ul>
            </div>
            <div>
                <div class="credit-card">
                    <h4 style="color:#fbbf24;">💳 Société Carthago SARL — Limite de crédit</h4>

                    <div class="gauge-container">
                        <div class="gauge-line">
                            <span class="lbl">Limite autorisée</span>
                            <span class="val">TND 5,000</span>
                        </div>
                        <div class="gauge-line">
                            <span class="lbl">Encours actuel</span>
                            <span class="val" style="color:#fbbf24;">TND 4,820</span>
                        </div>
                        <div class="gauge-bar">
                            <div class="gauge-fill" style="width: 96%;"></div>
                        </div>
                        <div class="gauge-pct" style="display:flex; justify-content:space-between;">
                            <span>0</span>
                            <span style="color:#fbbf24; font-weight:700;">96 % utilisé</span>
                            <span>5 000</span>
                        </div>
                    </div>

                    <div style="padding: 12px; background:#ffffff; border:1px solid var(--dark-border); border-radius: 8px; margin-bottom: 12px;">
                        <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.82rem;">
                            <span style="color:var(--text-muted);">Disponible</span>
                            <span style="font-weight:700; color:var(--accent);">TND 180.000</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.82rem;">
                            <span style="color:var(--text-muted);">Statut</span>
                            <span class="badge badge-warn">⚠ Seuil critique</span>
                        </div>
                    </div>

                    <div class="alert-box alert-warn" style="margin-top:0;">
                        <span>⚠️</span>
                        <span>Toute nouvelle vente à crédit supérieure à <strong>TND 180</strong> sera bloquée.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consulter ses ventes -->
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag rose">Consulter ses ventes</div>
                <h3>Toute l'histoire commerciale d'un client, en un clic</h3>
                <p>
                    Depuis le menu d'actions, accédez instantanément à la liste complète des ventes effectuées avec ce client : factures, devis, brouillons, retours et règlements. Triez, filtrez par période, exportez ou réimprimez en deux clics.
                </p>
                <ul class="feature-list">
                    <li class="rose">Liste exhaustive des factures, devis et bons de livraison</li>
                    <li class="rose">Filtre par période, par statut (payée, partielle, impayée)</li>
                    <li class="rose">Total des ventes, total encaissé, solde courant calculés</li>
                    <li class="rose">Réimpression de toute facture en un clic</li>
                    <li class="rose">Statistiques : panier moyen, fréquence d'achat, top produits</li>
                    <li class="rose">Export Excel/PDF de l'historique complet</li>
                </ul>
            </div>
            <div>
                <div class="credit-card">
                    <h4 style="color:var(--rose);">🛒 Société A — Ventes (12 derniers mois)</h4>

                    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px; margin-bottom:18px;">
                        <div style="background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; padding:14px; text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Ventes</div>
                            <div style="font-size:1.4rem; font-weight:800; color:var(--rose); margin-top:4px;">47</div>
                        </div>
                        <div style="background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; padding:14px; text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Total CA</div>
                            <div style="font-size:1.4rem; font-weight:800; color:var(--accent); margin-top:4px;">TND 2800</div>
                        </div>
                        <div style="background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; padding:14px; text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Panier moyen</div>
                            <div style="font-size:1.4rem; font-weight:800; color:var(--teal); margin-top:4px;">TND 596</div>
                        </div>
                    </div>

                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0067 <span class="badge badge-due" style="margin-left:6px;">Impayée</span></div>
                            <div class="idate">15/04/2026 — 12 articles</div>
                        </div>
                        <span class="iamt">TND 900</span>
                    </div>
                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0061 <span class="badge badge-warn" style="margin-left:6px;">Partielle</span></div>
                            <div class="idate">28/03/2026 — 18 articles</div>
                        </div>
                        <span class="iamt">TND 2,100</span>
                    </div>
                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0058 <span class="badge badge-due" style="margin-left:6px;">Impayée</span></div>
                            <div class="idate">12/03/2026 — 9 articles</div>
                        </div>
                        <span class="iamt">TND 1,820</span>
                    </div>
                    <div class="invoice-line">
                        <div>
                            <div class="iref">FA-2025-0052 <span class="badge badge-ok" style="margin-left:6px;">Payée</span></div>
                            <div class="idate">22/02/2026 — 24 articles</div>
                        </div>
                        <span class="iamt">TND 3,450</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  GRAND LIVRE                                            -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag">Grand livre — Compte courant</div>
            <h3>Compte courant détaillé,<br>en un seul clic</h3>
            <p>
                Le grand livre de Simplex Gestion donne une vision complète de tous les mouvements financiers entre vous et un tiers donné : factures, règlements, retours, avoirs, régularisations. Chaque ligne affiche le règlment, l'impayée — avec le solde final clairement mis en évidence.
            </p>
            <ul class="feature-list">
                <li>Liste de toutes les pièces comptables</li>
                <li>Filtre par période (jour, mois, année, intervalle libre)</li>
                <li>Lien direct vers chaque pièce d'origine (facture, règlement, retour)</li>
                <li>Solde d'ouverture pris en compte automatiquement</li>
                <li>Export PDF prêt à imprimer ou à envoyer au tiers</li>
                <li>Disponible pour clients et fournisseurs avec la même structure</li>
            </ul>
        </div>
        <div>
            <div class="ledger-mock">
                <h4>📒 Grand livre — Société A</h4>


                <div class="ledger-row">
                    <span style="color:var(--text-muted);">01/01/2026</span>
                    <span>Solde d'ouverture</span>
                    <span class="ledger-debit">—</span>
                    <span class="ledger-credit">—</span>

                </div>
                <div class="ledger-row">
                    <span style="color:var(--text-muted);">22/02</span>
                    <span>FA-0052 (vente)</span>
                    <span class="ledger-debit">3,450.000</span>
                    <span class="ledger-credit">—</span>

                </div>
                <div class="ledger-row">
                    <span style="color:var(--text-muted);">28/02</span>
                    <span>RC-0014 (règlement)</span>
                    <span class="ledger-debit">—</span>
                    <span class="ledger-credit">3,450.000</span>

                </div>
                <div class="ledger-row">
                    <span style="color:var(--text-muted);">12/03</span>
                    <span>FA-0058 (vente)</span>
                    <span class="ledger-debit">1,820.000</span>
                    <span class="ledger-credit">—</span>

                </div>
                <div class="ledger-row">
                    <span style="color:var(--text-muted);">28/03</span>
                    <span>FA-0061 (vente)</span>
                    <span class="ledger-debit">2,100.000</span>
                    <span class="ledger-credit">—</span>

                </div>
                <div class="ledger-row">
                    <span style="color:var(--text-muted);">15/04</span>
                    <span>FA-0067 (vente)</span>
                    <span class="ledger-debit">900.000</span>
                    <span class="ledger-credit">—</span>

                </div>

                <div class="ledger-row total rose">
                    <span></span>
                    <span>SOLDE COURANT</span>
                    <span class="ledger-debit">8,270.000</span>
                    <span class="ledger-credit">3,450.000</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  DOCUMENTS & NOTES                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag indigo">Documents & notes</div>
                <h3>Toutes vos pièces justificatives,<br>attachées à chaque tiers</h3>
                <p>
                    Joignez à chaque fiche client ou fournisseur tous les documents utiles : contrats, RIB, scans de pièces d'identité, attestations de résidence fiscale, photos de magasin, etc. Ajoutez des notes internes pour partager du contexte avec votre équipe — visibles uniquement par vos collaborateurs autorisés.
                </p>
                <ul class="feature-list">
                    <li class="indigo">Pièces jointes multi-formats (PDF, image, Word, Excel)</li>
                    <li class="indigo">Stockage sécurisé dans le cloud Simplex</li>
                    <li class="indigo">Notes internes horodatées avec auteur</li>
                    <li class="indigo">Permissions par rôle (qui peut voir / ajouter / supprimer)</li>
                </ul>
            </div>
            <div>
                <div class="doc-mock">
                    <h4>📎 Documents & notes — Société A</h4>

                    <div class="doc-item">
                        <div class="doc-icon di-pdf">📄</div>
                        <div style="flex:1;">
                            <div class="di-name">Contrat commercial 2026.pdf</div>
                            <div class="di-meta">2.4 Mo — Ajouté le 01/01/2026 par Ahmed</div>
                        </div>
                        <span style="color:var(--teal); font-size:0.85rem; cursor:pointer;">👁</span>
                    </div>
                    <div class="doc-item">
                        <div class="doc-icon di-doc">📑</div>
                        <div style="flex:1;">
                            <div class="di-name">RIB Banque BIAT.pdf</div>
                            <div class="di-meta">340 Ko — Ajouté le 12/01/2026 par Yasmine</div>
                        </div>
                        <span style="color:var(--teal); font-size:0.85rem; cursor:pointer;">👁</span>
                    </div>
                    <div class="doc-item">
                        <div class="doc-icon di-img">🖼️</div>
                        <div style="flex:1;">
                            <div class="di-name">Photo magasin La Marsa.jpg</div>
                            <div class="di-meta">1.8 Mo — Ajouté le 03/02/2026 par Ahmed</div>
                        </div>
                        <span style="color:var(--teal); font-size:0.85rem; cursor:pointer;">👁</span>
                    </div>
                    <div class="doc-item">
                        <div class="doc-icon di-note">📌</div>
                        <div style="flex:1;">
                            <div class="di-name">Note : Préfère règlement par traite à 60 j</div>
                            <div class="di-meta">Ajoutée le 15/03/2026 par Ahmed</div>
                        </div>
                    </div>

                    <button style="width:100%; background:transparent; border:1px dashed var(--indigo); color:var(--indigo); padding:10px; border-radius:8px; font-size:0.85rem; font-weight:600; margin-top:8px; cursor:pointer;">
                        ⊕ Ajouter un document ou une note
                    </button>
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
    <h2>Vos relations commerciales,<br>enfin sous contrôle</h2>
    <p>
        Centralisez clients et fournisseurs, suivez chaque dinar dû ou avancé, et pilotez vos relations commerciales avec la rigueur d'une grande entreprise.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Clients & fournisseurs illimités</span>
        <span style="font-size:0.85rem; color:white;">✓ Grand livre intégré</span>
        <span style="font-size:0.85rem; color:white;">✓ Documents & notes en cloud</span>
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
