<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel de gestion de stock en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Maîtrisez vos stocks en temps réel avec Simplex Gestion : inventaire, transferts multi-dépôts, alertes de rupture, pertes et valorisation pour entreprises en Tunisie.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Logiciel de gestion de stock en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Suivez l'inventaire, transférez le stock entre entrepôts, gérez les pertes et valorisez vos articles dans un module unique.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Logiciel de gestion de stock en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Inventaire, alertes de rupture, transferts et valorisation du stock sur une seule plateforme.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module de gestion de stock",
            "serviceType": "Logiciel de gestion de stock",
            "description": "Solution pour gérer l'inventaire, les transferts, les pertes et la valorisation du stock en temps réel.",
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
            --primary-dark: #1a35cc;
            --accent: #2948ff;
            --dark: #0f172a;
            --dark-card: #ffffff;
            --dark-border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-light: #334155;
            --badge-green-bg: #dbeafe;
            --badge-green-text: #1d4ed8;
            --badge-orange-bg: #fef3c7;
            --badge-orange-text: #b45309;
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
            padding: 130px 24px 70px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 55% at 50% 0%, rgba(41,72,255,0.13) 0%, transparent 70%);
        }
        .hero-label {
            display: inline-block;
            background: rgba(41,72,255,0.1);
            border: 1px solid rgba(41,72,255,0.35);
            color: var(--accent);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 6px 18px;
            border-radius: 100px;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800;
            line-height: 1.18;
            margin-bottom: 24px;
            position: relative;
        }
        .hero h1 span {
            background: linear-gradient(90deg, var(--accent), #38b2f5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 720px;
            margin: 0 auto 40px;
            font-size: 1.15rem;
            color: var(--text-light);
        }
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
            position: relative;
        }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--accent); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-alt { background: #f8fafc; }
        .section-alt .section { margin: 0 auto; }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 16px;
        }
        .section-tag::before {
            content: '';
            display: inline-block;
            width: 24px; height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }
        .section-tag.blue { color: var(--primary); }
        .section-tag.blue::before { background: var(--primary); }
        .section-tag.purple { color: var(--accent2); }
        .section-tag.purple::before { background: var(--accent2); }
        .section-tag.orange { color: var(--warn); }
        .section-tag.orange::before { background: var(--warn); }
        .section-tag.red { color: var(--danger); }
        .section-tag.red::before { background: var(--danger); }

        .section-title    { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .section-subtitle { font-size: 1.05rem; color: var(--text-light); max-width: 640px; margin-bottom: 56px; }

        /* ─── CARDS GRID ─────────────────────────────────────── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 28px;
            transition: border-color 0.25s, transform 0.2s;
        }
        .card:hover { border-color: rgba(41,72,255,0.4); transform: translateY(-3px); }
        .card.blue:hover { border-color: rgba(26,107,250,0.4); }
        .card.purple:hover { border-color: rgba(167,139,250,0.4); }
        .card.orange:hover { border-color: rgba(245,158,11,0.4); }
        .card.red:hover { border-color: rgba(239,68,68,0.4); }

        .card-icon {
            width: 46px; height: 46px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 18px;
        }
        .icon-green  { background: rgba(41,72,255,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }
        .icon-purple { background: rgba(139,92,246,0.12); }
        .icon-orange { background: rgba(245,158,11,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }
        .icon-cyan   { background: rgba(56,178,245,0.12); }

        .card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
        .card p  { font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; }

        /* ─── FEATURE ROW ─────────────────────────────────────── */
        .feature-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 80px;
        }
        .feature-row.reverse { direction: rtl; }
        .feature-row.reverse > * { direction: ltr; }
        @media (max-width: 768px) {
            .feature-row { grid-template-columns: 1fr; direction: ltr; }
            .feature-row.reverse { direction: ltr; }
        }
        .feature-content h3 { font-size: 1.7rem; font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .feature-content p  { font-size: 1rem; color: var(--text-light); margin-bottom: 24px; }

        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .feature-list li {
            display: flex; gap: 12px; align-items: flex-start;
            font-size: 0.95rem; color: var(--text-light);
        }
        .feature-list li::before {
            content: '✓';
            flex-shrink: 0;
            width: 22px; height: 22px;
            background: rgba(41,72,255,0.15);
            color: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700;
            margin-top: 2px;
        }
        .feature-list li.blue::before { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.purple::before { background: rgba(167,139,250,0.15); color: var(--accent2); }
        .feature-list li.orange::before { background: rgba(245,158,11,0.15); color: var(--warn); }
        .feature-list li.red::before { background: rgba(239,68,68,0.15); color: var(--danger); }

        /* ─── MOCK SCREEN ─────────────────────────────────────── */
        .mock-screen {
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
        .dot-green  { background: #2948ff; }
        .mock-topbar .mtitle { font-size: 0.78rem; color: var(--text-muted); margin-left: auto; }
        .mock-body { padding: 20px; }

        .mock-actions { display: flex; gap: 6px; flex-wrap: wrap; }
        .mock-btn {
            padding: 5px 12px;
            border-radius: 5px; font-size: 0.73rem; font-weight: 600;
            border: 1px solid var(--dark-border);
            background: transparent; color: var(--text-muted);
        }
        .mock-btn.primary { background: var(--primary); color: #fff; border-color: var(--primary); }
        .mock-btn.green   { background: rgba(41,72,255,0.15); color: var(--accent); border-color: rgba(41,72,255,0.3); }
        .mock-btn.orange  { background: rgba(245,158,11,0.12); color: var(--warn); border-color: rgba(245,158,11,0.3); }

        .tbl-head {
            display: grid; gap: 8px;
            padding: 8px 10px;
            font-size: 0.7rem; color: var(--text-muted); font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 4px; margin-top: 14px;
        }
        .tbl-row {
            display: grid; gap: 8px;
            padding: 9px 10px; font-size: 0.8rem;
            border-radius: 6px; margin-bottom: 2px; align-items: center;
        }
        .tbl-row:hover { background: rgba(41,72,255,0.06); }
        .cols-5 { grid-template-columns: 2fr 1fr 1fr 1fr 1fr; }
        .cols-6 { grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr; }
        .cols-4 { grid-template-columns: 2fr 1fr 1fr 1fr; }

        .badge {
            display: inline-block; padding: 2px 9px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .badge-green  { background: rgba(41,72,255,0.12); color: #1d4ed8; }
        .badge-orange { background: rgba(245,158,11,0.12); color: #f5a623; }
        .badge-red    { background: rgba(239,68,68,0.12);  color: #f87171; }
        .badge-blue   { background: rgba(26,107,250,0.12); color: #60a5fa; }
        .badge-purple { background: rgba(167,139,250,0.12); color: #a78bfa; }

        .val-blue   { color: var(--primary); font-weight: 600; }
        .val-green  { color: var(--accent); font-weight: 600; }
        .val-orange { color: var(--warn); font-weight: 600; }
        .val-red    { color: var(--danger); font-weight: 600; }
        .val-muted  { color: var(--text-muted); }
        .val-bold   { font-weight: 700; }

        /* ─── ALERT BOX ───────────────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 10px;
        }
        .alert-red    { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25); color: #f87171; }
        .alert-orange { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.25); color: #fbbf24; }
        .alert-green  { background: rgba(41,72,255,0.08); border: 1px solid rgba(41,72,255,0.25); color: #2563eb; }

        /* ─── STAT CARDS ─────────────────────────────────────── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .stat-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px;
        }
        .stat-card .slabel { font-size: 0.78rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.07em; font-weight: 600; margin-bottom: 10px; }
        .stat-card .sval   { font-size: 1.75rem; font-weight: 800; margin-bottom: 6px; }
        .stat-card .strend { font-size: 0.78rem; }

        /* ─── VALUATION TABLE ─────────────────────────────────── */
        .val-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .val-table th {
            text-align: left;
            padding: 10px 14px;
            font-size: 0.72rem; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border);
        }
        .val-table td {
            padding: 11px 14px;
            border-bottom: 1px solid rgba(35,43,58,0.6);
            color: var(--text-light);
        }
        .val-table tr:hover td { background: rgba(41,72,255,0.04); }
        .val-table tr:last-child td { border-bottom: none; font-weight: 700; color: var(--text-main); }

        /* ─── PROCESS STEPS ──────────────────────────────────── */
        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 0;
            margin: 48px 0;
        }
        .process-step { padding: 26px 18px; text-align: center; position: relative; }
        .process-step:not(:last-child)::after {
            content: '→';
            position: absolute; right: -8px; top: 32px;
            font-size: 1.2rem; color: var(--accent); font-weight: 300;
        }
        .step-num {
            width: 40px; height: 40px;
            background: rgba(41,72,255,0.12);
            border: 2px solid rgba(41,72,255,0.35);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: var(--accent); font-size: 0.9rem;
            margin: 0 auto 14px;
        }
        .process-step h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 6px; }
        .process-step p  { font-size: 0.8rem; color: var(--text-muted); }

        /* ─── LOSS REASONS ────────────────────────────────────── */
        .reasons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-top: 28px;
        }
        .reason-card {
            background: var(--dark-card);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: var(--radius-sm);
            padding: 18px 16px;
            text-align: center;
            transition: border-color 0.2s;
        }
        .reason-card:hover { border-color: rgba(239,68,68,0.5); }
        .reason-card .ricon { font-size: 1.6rem; margin-bottom: 8px; }
        .reason-card h4 { font-size: 0.88rem; font-weight: 700; margin-bottom: 4px; }
        .reason-card p  { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── VALUATION METHODS ──────────────────────────────── */
        .method-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            margin-top: 32px;
        }
        .method-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
        .method-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
        }
        .method-card.green::before { background: var(--accent); }
        .method-card.blue::before  { background: var(--primary); }
        .method-card.purple::before { background: var(--accent2); }
        .method-card.orange::before { background: var(--warn); }
        .method-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
        .method-card .method-tag {
            display: inline-block; font-size: 0.7rem; font-weight: 700;
            padding: 2px 10px; border-radius: 100px; margin-bottom: 12px;
        }
        .tag-green  { background: rgba(41,72,255,0.12); color: var(--accent); }
        .tag-blue   { background: rgba(26,107,250,0.12); color: var(--primary); }
        .tag-purple { background: rgba(167,139,250,0.12); color: var(--accent2); }
        .tag-orange { background: rgba(245,158,11,0.12); color: var(--warn); }
        .method-card p { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        /* ─── INVENTORY PROGRESS ─────────────────────────────── */
        .inventory-item {
            display: flex; align-items: center; gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid var(--dark-border);
        }
        .inventory-item:last-child { border-bottom: none; }
        .inv-name { flex: 1; font-size: 0.88rem; font-weight: 600; }
        .inv-ref  { font-size: 0.75rem; color: var(--text-muted); }
        .inv-bar-wrap { flex: 2; }
        .inv-bar-bg {
            background: #f1f5f9;
            border-radius: 100px; height: 8px; overflow: hidden;
        }
        .inv-bar { height: 100%; border-radius: 100px; }
        .bar-green  { background: var(--accent); }
        .bar-orange { background: var(--warn); }
        .bar-red    { background: var(--danger); }
        .inv-qty { font-size: 0.85rem; font-weight: 700; min-width: 80px; text-align: right; }

        /* ─── TRANSFER VISUAL ────────────────────────────────── */
        .transfer-visual {
            display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px 24px;
            margin-bottom: 14px;
        }
        .transfer-loc {
            flex: 1; min-width: 120px;
            background: #f8fafc;
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            text-align: center;
        }
        .transfer-loc .loc-label { font-size: 0.7rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; margin-bottom: 4px; }
        .transfer-loc .loc-name  { font-size: 0.95rem; font-weight: 700; }
        .transfer-arrow { font-size: 1.4rem; color: var(--primary); }
        .transfer-badge { font-size: 0.8rem; font-weight: 600; }

        /* ─── CTA ─────────────────────────────────────────────── */
        .cta-section {
            padding: 80px 24px; text-align: center;
            background: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            border-top: none;
            color: #fff;
        }
        .cta-section h2 { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; margin-bottom: 16px; }
        .cta-section p  { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 540px; margin: 0 auto 36px; }
        .cta-buttons { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn-primary {
            background: var(--primary); color: #fff; border: none;
            padding: 14px 32px; border-radius: 8px; font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: background 0.2s;
        }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline {
            background: transparent; color: var(--dark);
            border: 2px solid #e2e8f0;
            padding: 14px 32px; border-radius: 8px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: border-color 0.2s;
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

        /* ─── FORM MOCK ───────────────────────────────────────── */
        .form-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .form-mock h4 {
            font-size: 1.05rem; font-weight: 700; margin-bottom: 20px;
            padding-bottom: 14px; border-bottom: 1px solid var(--dark-border);
        }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
        .form-field label { display: block; font-size: 0.73rem; color: var(--text-muted); font-weight: 600; margin-bottom: 6px; }
        .form-field .fi {
            background: #f8fafc; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 8px 12px; font-size: 0.82rem; color: var(--text-light); height: 36px;
        }
        .form-field .fi.accent { color: var(--accent); }
        .form-field .fi.blue   { color: var(--primary); }
        .form-field .fi.warn   { color: var(--warn); }
        .form-field .fi.danger { color: var(--danger); }

        /* ─── MULTI-ENTREPOT ──────────────────────────────────── */
        .warehouse-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 32px;
        }
        .warehouse-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px 18px;
            text-align: center;
            transition: border-color 0.2s;
        }
        .warehouse-card:hover { border-color: rgba(26,107,250,0.4); }
        .warehouse-card .wh-icon { font-size: 2rem; margin-bottom: 10px; }
        .warehouse-card h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 6px; }
        .warehouse-card .wh-qty { font-size: 1.4rem; font-weight: 800; color: var(--primary); }
        .warehouse-card .wh-label { font-size: 0.75rem; color: var(--text-muted); }

        .cta-section > div[style*="margin-top:32px"] span {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        @media (max-width: 640px) {
            .cols-5, .cols-6 { grid-template-columns: 1fr 1fr 1fr; }
            .tbl-row .hide-sm, .tbl-head .hide-sm { display: none; }
        }
    </style>
</head>
<body>
<div class="navbar fixed-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100 py-2 py-md-3">
            <a class="d-flex align-items-center" style="text-decoration: none" href="/">
                <span class="navbar-brand m-0">Simplex<span class="text-primary">.</span></span>
                <img src="img/logo.png" alt="Simplex Gestion" width="36" height="36" class="ms-2">
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
    <div class="hero-label">Module Stock — Simplex Gestion</div>
    <h1>Maîtrisez votre stock,<br><span>de l'inventaire à la valorisation</span></h1>
    <p>
        Un module de gestion de stock complet, pensé pour les grossistes, fournisseurs et distributeurs tunisiens. Suivez chaque article en temps réel, transférez entre entrepôts, déclarez les pertes et évaluez la valeur exacte de votre stock à tout moment.
    </p>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Un stock sous contrôle, de A à Z</h2>
    <p class="section-subtitle">
        Simplex Gestion centralise toute votre gestion de stock dans une interface unique. De l'inventaire physique à la valorisation comptable, chaque mouvement est enregistré, tracé et analysable.
    </p>

    <div class="cards-grid">
        <div class="card">
            <div class="card-icon icon-green">📦</div>
            <h3>Inventaire en temps réel</h3>
            <p>Consultez le niveau de stock de chaque produit à l'instant T : quantité disponible, seuil d'alerte, emplacement et état. Plus de rupture ni de sur-stockage involontaire.</p>
        </div>
        <div class="card blue">
            <div class="card-icon icon-blue">🔄</div>
            <h3>Transferts de stock</h3>
            <p>Déplacez des articles d'un entrepôt ou point de vente à un autre en quelques clics. Chaque transfert est enregistré avec date, quantité, origine et destination.</p>
        </div>
        <div class="card red">
            <div class="card-icon icon-red">⚠️</div>
            <h3>Déclaration de perte</h3>
            <p>Déclarez les pertes de stock dues à la casse, péremption, vol ou erreur d'inventaire. Chaque perte est documentée, justifiée et déduite automatiquement du stock réel.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">🤖</div>
            <h3>Alertes de Rupture Intelligentes</h3>
            <p>Simplex Gestion vous alerte automatiquement sur les produits en risque de rupture sous 15 jours et calcule pour vous les quantités à commander. Anticipez vos besoins et commandez juste à temps.</p>
        </div>
        <div class="card orange">
            <div class="card-icon icon-orange">🔔</div>
            <h3>Alertes de stock bas</h3>
            <p>Définissez des seuils minimaux par produit et recevez des alertes automatiques dès qu'un article descend en dessous du niveau critique pour éviter toute rupture.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-cyan">📋</div>
            <h3>Historique des mouvements</h3>
            <p>Consultez l'intégralité de l'historique des entrées et sorties de stock : achats, ventes, transferts, pertes et ajustements, avec horodatage et utilisateur responsable.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  INVENTAIRE — MOCK TABLE                               -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Inventaire</div>
        <h2 class="section-title">Votre inventaire, précis et toujours à jour</h2>
        <p class="section-subtitle">
            Chaque produit dispose de sa propre fiche de stock avec quantité disponible, quantité minimale d'alerte, coût d'achat et valeur totale. Le stock se met à jour automatiquement à chaque vente, achat, transfert ou ajustement.
        </p>

        <!-- Mock inventory table -->
        <div class="mock-screen">
            <div class="mock-topbar">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
                <span class="mtitle">État de stock — Simplex Gestion</span>
            </div>
            <div class="mock-body">
            <img src="/img/inventory-table.png" alt="Mock Inventaire" style="width:100%; border-radius:6px;">
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  TRANSFERTS DE STOCK                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag blue">Transferts de stock</div>
            <h3>Gérez vos stocks sur plusieurs sites sans effort</h3>
            <p>
                Vous exploitez plusieurs entrepôts, dépôts ou points de vente ? Simplex Gestion vous permet de transférer du stock d'un site à un autre en quelques clics. Chaque transfert est enregistré, daté et traçable — le stock source est débité et le stock destination est crédité instantanément.
            </p>
            <ul class="feature-list">
                <li class="blue">Transfert entre emplacements multiples (entrepôts, dépôts, magasins)</li>
                <li class="blue">Sélection produit par nom, SKU ou code-barres</li>
                <li class="blue">Quantité transférée avec vérification du stock disponible</li>
                <li class="blue">Statut de transfert : en attente, en transit, réceptionné</li>
                <li class="blue">Historique complet de tous les transferts effectués</li>
                <li class="blue">Note de transfert et pièces jointes optionnelles</li>
                <li class="blue">Mise à jour automatique des niveaux de stock source et destination</li>
            </ul>
        </div>
        <div>
            <div class="form-mock">
                <h4>Nouveau transfert de stock</h4>
                <div class="form-row">
                    <div class="form-field">
                        <label>Emplacement source *</label>
                        <div class="fi blue">Entrepôt principal — Tunis</div>
                    </div>
                    <div class="form-field">
                        <label>Emplacement destination *</label>
                        <div class="fi blue">Dépôt Sfax</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Date du transfert *</label>
                        <div class="fi">20/04/2026 10:30</div>
                    </div>
                    <div class="form-field">
                        <label>Statut</label>
                        <div class="fi accent">En transit</div>
                    </div>
                </div>

                <!-- Transfer visual -->
                <div style="margin: 16px 0;">
                    <div class="transfer-visual">
                        <div class="transfer-loc">
                            <div class="loc-label">Source</div>
                            <div class="loc-name">🏭 Tunis</div>
                        </div>
                        <div class="transfer-arrow">→</div>
                        <div style="text-align:center; min-width:100px;">
                            <div style="font-size:0.75rem; color:var(--text-muted); margin-bottom:4px;">Café Arabica 1kg</div>
                            <div style="font-size:1.1rem; font-weight:800; color:var(--primary);">× 50</div>
                            <div style="font-size:0.7rem; color:var(--accent);">En transit</div>
                        </div>
                        <div class="transfer-arrow">→</div>
                        <div class="transfer-loc">
                            <div class="loc-label">Destination</div>
                            <div class="loc-name">🏪 Sfax</div>
                        </div>
                    </div>
                    <div class="transfer-visual">
                        <div class="transfer-loc">
                            <div class="loc-label">Source</div>
                            <div class="loc-name">🏭 Tunis</div>
                        </div>
                        <div class="transfer-arrow">→</div>
                        <div style="text-align:center; min-width:100px;">
                            <div style="font-size:0.75rem; color:var(--text-muted); margin-bottom:4px;">Huile d'olive 5L</div>
                            <div style="font-size:1.1rem; font-weight:800; color:var(--primary);">× 30</div>
                            <div style="font-size:0.7rem; color:var(--accent);">Réceptionné</div>
                        </div>
                        <div class="transfer-arrow">→</div>
                        <div class="transfer-loc">
                            <div class="loc-label">Destination</div>
                            <div class="loc-name">🏪 Sfax</div>
                        </div>
                    </div>
                </div>
                <div class="alert-box alert-green">
                    <span>✓</span>
                    <span>Stock source vérifié : 314 unités disponibles — transfert autorisé.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Multi-entrepôt overview -->
    <div class="section-tag blue" style="margin-top:20px;">Multi-emplacements</div>
    <h3 style="font-size:1.3rem; font-weight:700; margin-bottom:16px;">Vue consolidée par entrepôt</h3>
    <p style="font-size:0.95rem; color:var(--text-light); margin-bottom:24px; max-width:640px;">
        Visualisez instantanément la répartition de vos stocks sur l'ensemble de vos sites. Chaque emplacement affiche son volume, sa valeur et les alertes actives.
    </p>
    <div class="warehouse-grid">
        <div class="warehouse-card">
            <div class="wh-icon">🏭</div>
            <h4>Entrepôt Tunis</h4>
            <div class="wh-qty">1,240</div>
            <div class="wh-label">articles en stock</div>
            <div style="margin-top:8px; font-size:0.78rem; color:var(--accent);">TND 84,200.000</div>
        </div>
        <div class="warehouse-card">
            <div class="wh-icon">🏪</div>
            <h4>Dépôt Sfax</h4>
            <div class="wh-qty">430</div>
            <div class="wh-label">articles en stock</div>
            <div style="margin-top:8px; font-size:0.78rem; color:var(--accent);">TND 28,750.000</div>
        </div>
        <div class="warehouse-card">
            <div class="wh-icon">🏬</div>
            <h4>Point de vente Sousse</h4>
            <div class="wh-qty">185</div>
            <div class="wh-label">articles en stock</div>
            <div style="margin-top:8px; font-size:0.78rem; color:var(--warn);">2 alertes stock bas</div>
        </div>
        <div class="warehouse-card">
            <div class="wh-icon">📦</div>
            <h4>Stock en transit</h4>
            <div class="wh-qty">120</div>
            <div class="wh-label">articles en cours</div>
            <div style="margin-top:8px; font-size:0.78rem; color:var(--primary);">3 transferts actifs</div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  DÉCLARATION DE PERTE                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag red">Perte de stock</div>
        <h2 class="section-title">Déclarez et documentez chaque perte de stock</h2>
        <p class="section-subtitle">
            Casse, péremption, vol, erreur de préparation… les pertes font partie du quotidien du négoce. Simplex Gestion vous permet de les déclarer formellement, de les justifier et de les déduire automatiquement de vos niveaux de stock — pour une comptabilité-matière irréprochable.
        </p>

        <div class="feature-row">
            <div>
                <div class="form-mock">
                    <h4 style="color:#f87171;">Déclarer une perte de stock</h4>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Emplacement concerné *</label>
                            <div class="fi">Entrepôt principal — Tunis</div>
                        </div>
                        <div class="form-field">
                            <label>Date de la perte *</label>
                            <div class="fi">20/04/2026 09:15</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Produit *</label>
                            <div class="fi danger">Eau minérale 1,5L (carton×12)</div>
                        </div>
                        <div class="form-field">
                            <label>Quantité perdue *</label>
                            <div class="fi danger">5 cartons</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Motif de la perte *</label>
                            <div class="fi warn">Péremption / Date dépassée</div>
                        </div>
                        <div class="form-field">
                            <label>Valeur de la perte estimée</label>
                            <div class="fi danger">TND 200.000</div>
                        </div>
                    </div>
                    <div class="form-field" style="margin-bottom:14px;">
                        <label>Note explicative</label>
                        <div style="background:#0d1117; border:1px solid var(--dark-border); border-radius:6px; padding:10px 12px; font-size:0.82rem; color:var(--text-muted); height:56px;">Cartons stockés trop longtemps, DLC dépassée le 18/04/2026.</div>
                    </div>
                    <div class="alert-box alert-red">
                        <span>⚠</span>
                        <span>Cette déclaration déduira <strong>5 cartons</strong> du stock de l'Entrepôt Tunis. L'opération sera enregistrée dans le journal des pertes.</span>
                    </div>

                    <!-- journal mini -->
                    <div style="margin-top:16px;">
                        <div style="font-size:0.75rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">Journal des pertes — Dernier mois</div>
                        <div class="tbl-head cols-4">
                            <span>Produit</span><span>Qté</span><span>Motif</span><span>Valeur</span>
                        </div>
                        <div class="tbl-row cols-4">
                            <span>Savon Marseille</span>
                            <span class="val-red">−3 unités</span>
                            <span><span class="badge badge-orange">Casse</span></span>
                            <span class="val-red">TND 27.000</span>
                        </div>
                        <div class="tbl-row cols-4">
                            <span>Jus d'orange 1L</span>
                            <span class="val-red">−12 bouteilles</span>
                            <span><span class="badge badge-red">Péremption</span></span>
                            <span class="val-red">TND 84.000</span>
                        </div>
                        <div class="tbl-row cols-4">
                            <span>Farine T55 50kg</span>
                            <span class="val-red">−1 sac</span>
                            <span><span class="badge badge-purple">Vol présumé</span></span>
                            <span class="val-red">TND 60.000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-content">
                <div class="section-tag red">Motifs et traçabilité</div>
                <h3>Chaque perte documentée, chaque motif justifié</h3>
                <p>
                    La déclaration de perte dans Simplex Gestion n'est pas un simple ajustement négatif. C'est un document formel avec motif, date, quantité, valeur et note explicative — archivé dans le journal des pertes pour tout audit ou contrôle interne.
                </p>
                <ul class="feature-list">
                    <li class="red">Motifs prédéfinis : casse, péremption, vol, erreur de réception…</li>
                    <li class="red">Valeur de perte calculée automatiquement selon le coût d'achat</li>
                    <li class="red">Journal des pertes consultable et exportable</li>
                    <li class="red">Ajustement du stock en temps réel dès validation</li>
                    <li class="red">Pièces jointes : photos, rapports d'incident, PV de casse</li>
                    <li class="red">Historique par produit, par emplacement ou par période</li>
                </ul>

                <div class="reasons-grid" style="margin-top:28px;">
                    <div class="reason-card">
                        <div class="ricon">💥</div>
                        <h4>Casse</h4>
                        <p>Produits endommagés lors du stockage ou de la manutention.</p>
                    </div>
                    <div class="reason-card">
                        <div class="ricon">⏰</div>
                        <h4>Péremption</h4>
                        <p>Articles dont la date limite de consommation est dépassée.</p>
                    </div>
                    <div class="reason-card">
                        <div class="ricon">🔐</div>
                        <h4>Vol / Manquant</h4>
                        <p>Écart inexpliqué entre stock physique et stock système.</p>
                    </div>
                    <div class="reason-card">
                        <div class="ricon">📋</div>
                        <h4>Erreur d'inventaire</h4>
                        <p>Correction suite à un comptage physique divergent.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  ALERTES & RÉAPPROVISIONNEMENT                          -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag orange">Alertes & Réapprovisionnement</div>
        <h2 class="section-title">Ne soyez plus jamais pris de court par une rupture</h2>
        <p class="section-subtitle">
            Définissez un seuil d'alerte minimal pour chaque produit. Simplex Gestion surveille votre stock en continu et vous signale dès qu'un article approche de la rupture — avant qu'il soit trop tard.
        </p>

        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag orange">Seuils intelligents</div>
                <h3>Des alertes qui s'adaptent à votre réalité commerciale</h3>
                <p>
                    Chaque article a sa propre logique de réapprovisionnement. Definissez le seuil critique produit par produit en tenant compte de vos délais fournisseurs et de votre cadence de vente. Simplex Gestion fait le reste.
                </p>
                <ul class="feature-list">
                    <li class="orange">Suggestion intelligente des quantités à commander</li>
                    <li class="orange">Seuil d'alerte configurable par produit</li>
                    <li class="orange">Export de la liste des articles à réapprovisionner</li>
                    <li class="orange">Intégration directe avec le module achats pour générer des commandes</li>
                </ul>
            </div>
            <div>
                <div class="form-mock">
                    <h4 style="color:var(--warn);">⚠ Alertes de rupture Intelligente</h4>
                  <img src="/img/alerte-rupture-intelligent.png" alt="Alertes de stock" style="width:100%; border-radius:6px;">
                    <div class="alert-box alert-orange" style="margin-top:12px;">
                        <span>💡</span>
                        <span>Générez automatiquement un bon de commande fournisseur pour ces 4 articles depuis le module Achats.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  HISTORIQUE DES MOUVEMENTS                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Traçabilité</div>
        <h2 class="section-title">Un historique complet de chaque mouvement de stock</h2>
        <p class="section-subtitle">
            Simplex Gestion enregistre automatiquement chaque entrée et sortie de stock, quelle qu'en soit la source. Chaque mouvement est daté, associé à un utilisateur et à un document source (bon d'achat, facture de vente, transfert, déclaration de perte).
        </p>

        <div class="mock-screen">
            <div class="mock-topbar">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
                <span class="mtitle">Journal des mouvements de stock</span>
            </div>
            <div class="mock-body">
                <img src="/img/suivi-stock.png" alt="Suivi de stock" style="width:100%; border-radius:6px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); gap:20px; margin-top:28px;">
            <div class="card">
                <div class="card-icon icon-blue">🔍</div>
                <h3>Filtrage multi-critères</h3>
                <p>Filtrez l'historique par produit, par emplacement, par type de mouvement (achat, vente, transfert, perte) ou par plage de dates.</p>
            </div>
            <div class="card">
                <div class="card-icon icon-green">📤</div>
                <h3>Export du journal</h3>
                <p>Exportez l'intégralité du journal des mouvements en CSV, Excel ou PDF pour vos audits, votre comptable ou vos analyses internes.</p>
            </div>
            <div class="card">
                <div class="card-icon icon-purple">👤</div>
                <h3>Utilisateur responsable</h3>
                <p>Chaque mouvement est lié à l'utilisateur qui l'a effectué — pour un contrôle interne rigoureux et une responsabilité claire.</p>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  PROCESSUS COMPLET                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Cycle de stock</div>
    <h2 class="section-title">Le cycle complet de votre stock, sans angle mort</h2>
    <p class="section-subtitle">
        Simplex Gestion couvre chaque étape de la vie d'un article en stock — de la réception fournisseur à la vente finale, en passant par les transferts et les éventuelles pertes.
    </p>

    <div class="process-steps">
        <div class="process-step">
            <div class="step-num">1</div>
            <h4>Réception achat</h4>
            <p>Le stock est incrémenté automatiquement à chaque bon d'achat validé.</p>
        </div>
        <div class="process-step">
            <div class="step-num">2</div>
            <h4>Stockage & inventaire</h4>
            <p>Suivi en temps réel des niveaux, alertes de seuil minimal.</p>
        </div>
        <div class="process-step">
            <div class="step-num">3</div>
            <h4>Transferts</h4>
            <p>Déplacement entre entrepôts et points de vente, traçé et daté.</p>
        </div>
        <div class="process-step">
            <div class="step-num">4</div>
            <h4>Pertes déclarées</h4>
            <p>Casse, péremption ou vol documentés et déduits du stock.</p>
        </div>
        <div class="process-step">
            <div class="step-num">5</div>
            <h4>Vente & sortie</h4>
            <p>Le stock diminue automatiquement à chaque facture de vente validée.</p>
        </div>
        <div class="process-step">
            <div class="step-num">6</div>
            <h4>Valorisation & rapport</h4>
            <p>Évaluation financière du stock restant, exportable à tout moment.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VALORISATION DU STOCK                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag purple">Valorisation</div>
    <h2 class="section-title">Connaissez la valeur exacte de votre stock à chaque instant</h2>
    <p class="section-subtitle">
        La valorisation du stock est un pilier de la gestion financière. Simplex Gestion calcule automatiquement la valeur de votre inventaire selon plusieurs méthodes comptables reconnues, pour des états financiers précis et conformes.
    </p>
</section>



<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CTA                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="cta-section">
    <h2>Votre stock mérite une gestion sans faille</h2>
    <p>
        Rejoignez des grossistes et distributeurs tunisiens qui font confiance à Simplex Gestion pour piloter leur stock avec précision. Commencez gratuitement, sans engagement.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:var(--text-muted);">✓ Multi depôts inclus</span>
        <span style="font-size:0.85rem; color:var(--text-muted);">✓ Valorisation automatique</span>
        <span style="font-size:0.85rem; color:var(--text-muted);">✓ Historique illimité</span>
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
