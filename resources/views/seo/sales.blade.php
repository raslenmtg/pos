<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel de gestion des ventes en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Pilotez vos ventes de la commande à l'encaissement avec Simplex Gestion : devis, factures, paiements multiples, retours et tableaux de bord pour entreprises en Tunisie.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Logiciel de gestion des ventes en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Centralisez devis, factures, encaissements et retours dans un seul module de gestion des ventes pensé pour les entreprises tunisiennes.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Logiciel de gestion des ventes en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Un module ventes complet pour gérer facturation, paiements, expéditions et retours.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module de gestion des ventes",
            "serviceType": "Logiciel de gestion des ventes",
            "description": "Solution pour centraliser devis, factures, paiements, expéditions et retours dans une seule interface.",
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
            --accent: #10b981;
            --dark: #0f172a;
            --dark-card: #ffffff;
            --dark-border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-light: #334155;
            --badge-green-bg: #dcfce7;
            --badge-green-text: #15803d;
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

        /* ─── HERO ──────────────────────────────────────────── */
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
            background: radial-gradient(ellipse 70% 60% at 50% 0%, rgba(26,107,250,0.18) 0%, transparent 70%);
        }
        .hero-label {
            display: inline-block;
            background: rgba(26,107,250,0.15);
            border: 1px solid rgba(26,107,250,0.4);
            color: var(--primary);
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
            background: linear-gradient(90deg, var(--primary), #38b2f5);
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
        .hero-stat {
            text-align: center;
        }
        .hero-stat strong {
            display: block;
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
        }
        .hero-stat span {
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        /* ─── SECTION WRAPPERS ─────────────────────────────── */
        .section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-alt {
            background: #f8fafc;
        }
        .section-alt .section {
            margin: 0 auto;
        }

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
            width: 24px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }
        .section-title {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 16px;
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: var(--text-light);
            max-width: 640px;
            margin-bottom: 56px;
        }

        /* ─── OVERVIEW GRID ────────────────────────────────── */
        .overview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .overview-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 28px 28px 26px;
            transition: border-color 0.25s, transform 0.2s;
        }
        .overview-card:hover {
            border-color: rgba(26,107,250,0.45);
            transform: translateY(-3px);
        }
        .overview-card .card-icon {
            width: 46px;
            height: 46px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 18px;
        }
        .icon-blue   { background: rgba(26,107,250,0.15); }
        .icon-green  { background: rgba(0,194,123,0.15); }
        .icon-purple { background: rgba(139,92,246,0.15); }
        .icon-orange { background: rgba(245,166,35,0.15); }
        .icon-cyan   { background: rgba(56,178,245,0.15); }
        .icon-red    { background: rgba(239,68,68,0.15); }

        .overview-card h3 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .overview-card p {
            font-size: 0.92rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        /* ─── FEATURE ROW (alternating) ──────────────────── */
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

        .feature-content h3 {
            font-size: 1.7rem;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 16px;
        }
        .feature-content p {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 24px;
        }
        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .feature-list li {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 0.95rem;
            color: var(--text-light);
        }
        .feature-list li::before {
            content: '✓';
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            background: rgba(0,194,123,0.15);
            color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            margin-top: 2px;
        }

        /* ─── MOCK UI SCREENS ─────────────────────────────── */
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
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .mock-topbar .dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }
        .dot-red    { background: #ef4444; }
        .dot-yellow { background: #f59e0b; }
        .dot-green  { background: #22c55e; }
        .mock-topbar .title {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-left: auto;
        }
        .mock-body {
            padding: 20px;
        }
        .mock-row-header {
            display: grid;
            grid-template-columns: 60px 90px 80px 1fr 80px 80px;
            gap: 8px;
            padding: 8px 12px;
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 4px;
        }
        .mock-row {
            display: grid;
            grid-template-columns: 60px 90px 80px 1fr 80px 80px;
            gap: 8px;
            padding: 9px 12px;
            font-size: 0.8rem;
            border-radius: 6px;
            margin-bottom: 2px;
            align-items: center;
        }
        .mock-row:hover { background: rgba(41,72,255,0.06); }
        .mock-row .date { color: var(--text-muted); font-size: 0.72rem; }
        .mock-row .facture { color: var(--primary); font-weight: 600; }
        .mock-row .client { font-weight: 500; }
        .mock-row .montant { color: var(--text-main); font-weight: 600; }
        .badge {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .badge-green  { background: var(--badge-green-bg); color: var(--badge-green-text); }
        .badge-orange { background: var(--badge-orange-bg); color: var(--badge-orange-text); }
        .mock-actions {
            display: flex;
            gap: 6px;
            margin-top: 14px;
            flex-wrap: wrap;
        }
        .mock-btn {
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 0.73rem;
            font-weight: 600;
            border: 1px solid var(--dark-border);
            background: transparent;
            color: var(--text-muted);
            cursor: default;
        }
        .mock-btn.primary { background: var(--primary); color: #fff; border-color: var(--primary); }

        /* ─── FORM MOCK ───────────────────────────────────── */
        .form-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .form-mock h4 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--dark-border);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }
        .form-field label {
            display: block;
            font-size: 0.73rem;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 6px;
        }
        .form-field .faux-input {
            background: #f8fafc;
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.82rem;
            color: var(--text-light);
            height: 36px;
        }
        .form-field .faux-input.blue { color: var(--primary); }
        .product-line {
            background: #f8fafc;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 12px;
            margin: 14px 0;
        }
        .product-line-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 8px;
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .product-line-body {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 8px;
        }
        .product-line-body div {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 5px;
            padding: 6px 8px;
            font-size: 0.78rem;
            color: var(--text-light);
            height: 30px;
        }
        .total-block {
            text-align: right;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--dark-border);
        }
        .total-block .label { font-size: 0.8rem; color: var(--text-muted); }
        .total-block .amount { font-size: 1.4rem; font-weight: 800; color: var(--primary); }

        /* ─── PAYMENT MODES ──────────────────────────────── */
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 32px;
        }
        .payment-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 20px;
            text-align: center;
            transition: border-color 0.2s;
        }
        .payment-card:hover { border-color: var(--accent); }
        .payment-card .payment-icon { font-size: 1.8rem; margin-bottom: 10px; }
        .payment-card h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 6px; }
        .payment-card p { font-size: 0.82rem; color: var(--text-muted); }

        /* ─── WORKFLOW STEPS ──────────────────────────────── */
        .workflow-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0;
            position: relative;
            margin: 48px 0;
        }
        .workflow-step {
            padding: 28px 20px;
            text-align: center;
            position: relative;
        }
        .workflow-step:not(:last-child)::after {
            content: '→';
            position: absolute;
            right: -10px;
            top: 36px;
            font-size: 1.2rem;
            color: var(--primary);
            font-weight: 300;
        }
        .step-num {
            width: 40px;
            height: 40px;
            background: rgba(26,107,250,0.15);
            border: 2px solid rgba(26,107,250,0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary);
            font-size: 0.9rem;
            margin: 0 auto 16px;
        }
        .workflow-step h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 8px; }
        .workflow-step p  { font-size: 0.82rem; color: var(--text-muted); }

        /* ─── METRICS ─────────────────────────────────────── */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }
        .metric-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 24px;
        }
        .metric-card .metric-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .metric-card .metric-value {
            font-size: 1.85rem;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .metric-card .metric-trend {
            font-size: 0.8rem;
            color: var(--accent);
        }
        .color-blue   { color: var(--primary); }
        .color-green  { color: var(--accent); }
        .color-purple { color: #a78bfa; }
        .color-orange { color: #f59e0b; }

        /* ─── FEATURE TABS ─────────────────────────────────── */
        .tabs-section {
            margin-top: 48px;
        }
        .tabs-nav {
            display: flex;
            gap: 4px;
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 32px;
            overflow-x: auto;
        }
        .tab-btn {
            padding: 10px 20px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 2px solid transparent;
            cursor: default;
            white-space: nowrap;
            transition: color 0.2s;
        }
        .tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }
        .tab-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 768px) {
            .tab-content-grid { grid-template-columns: 1fr; }
        }
        .tab-feature-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px;
        }
        .tab-feature-card .tfc-icon { font-size: 1.3rem; margin-bottom: 12px; }
        .tab-feature-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .tab-feature-card p  { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        /* ─── EXPORT SECTION ──────────────────────────────── */
        .export-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .export-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px 20px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        .export-card .ex-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .ex-green  { background: rgba(0,194,123,0.12); }
        .ex-blue   { background: rgba(26,107,250,0.12); }
        .ex-red    { background: rgba(239,68,68,0.12); }
        .ex-purple { background: rgba(139,92,246,0.12); }
        .export-card h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
        .export-card p  { font-size: 0.82rem; color: var(--text-muted); }

        /* ─── RETURNS SECTION ─────────────────────────────── */
        .returns-info {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 36px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }
        @media (max-width: 640px) { .returns-info { grid-template-columns: 1fr; } }
        .returns-info h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 14px; }
        .returns-info p { font-size: 0.95rem; color: var(--text-light); margin-bottom: 20px; }
        .returns-badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .returns-badge {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            color: #f87171;
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .returns-visual {
            background: #f8fafc;
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            padding: 20px;
        }
        .rv-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.83rem;
        }
        .rv-row:last-child { border-bottom: none; }
        .rv-row .rv-label { color: var(--text-muted); }
        .rv-row .rv-val   { font-weight: 600; }
        .rv-row .rv-val.red { color: #f87171; }
        .rv-row .rv-val.green { color: var(--accent); }

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

        /* ─── MISC ─────────────────────────────────────────── */
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 0;
        }
        @media (max-width: 640px) {
            .feature-row { gap: 32px; }
            .mock-row-header, .mock-row { grid-template-columns: 1fr 1fr 1fr; }
            .mock-row > *:nth-child(n+4) { display: none; }
        }
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
    <div class="hero-label">Module Ventes — Simplex Gestion</div>
    <h1>Pilotez chaque vente,<br><span>de la commande à l'encaissement</span></h1>
    <p>
        Une gestion des ventes complète et centralisée vous permet de piloter l’ensemble de votre cycle de vente avec précision, rapidité et efficacité. De la création de la facture à l’encaissement, en passant par les remises, taxes, expéditions et retours pensée pour les fournisseurs, grossistes et distributeurs tunisiens.
    </p>

</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Tout votre cycle de vente en un seul endroit</h2>
    <p class="section-subtitle">
        Du premier devis à la livraison finale, Simplex Gestion vous offre un tableau de bord complet pour maîtriser chaque étape de votre processus commercial.
    </p>

    <div class="overview-grid">
        <div class="overview-card">
            <div class="card-icon icon-blue">🧾</div>
            <h3>Factures & devis</h3>
            <p>Créez des factures conformes à la loi de finances en choisissant parmi ces 7 modèles de factures. Gérez vos devis clients et convertissez-les en factures en un seul clic.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-green">💰</div>
            <h3>Gestion des paiements</h3>
            <p>Enregistrez les paiements en espèces, par virement, avance, traite ou paiement multiple. Suivez en temps réel le solde payé, les ventes impayées et le reste à percevoir.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-purple">🏬</div>
            <h3>Multiples points de vente</h3>
            <p>Centralisez tous vos points de vente dans une seule plateforme : ventes, stocks, clients et caisses sont synchronisés en temps réel ce qui vous offre une vision 360° de votre activité</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-orange">🚚</div>
            <h3>Expéditions & Livraisons</h3>
            <p>Gérez les détails d'expédition, l'adresse de livraison, les frais de transport et le statut de livraison directement depuis la fiche de vente.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-cyan">↩️</div>
            <h3>Retours de vente</h3>
            <p>Traitez les retours clients avec fluidité. Chaque retour est lié à la vente d'origine, mis en évidence dans la liste et impacte automatiquement votre stock.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-red">📊</div>
            <h3>Remises & promotion</h3>
            <p>Exportez vos ventes au format CSV, Excel ou PDF. Filtrez par date, client, emplacement, mode de paiement ou statut pour des analyses précises.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  LISTE DES VENTES — MOCK UI                            -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Tableau de bord des ventes</div>
        <h2 class="section-title">Toutes vos ventes, visibles en un coup d'œil</h2>
        <p class="section-subtitle">
            Un tableau de bord puissant et filtrable qui affiche l'intégralité de votre activité commerciale : numéro de facture, client, montant, mode de paiement et statut d'expédition.
        </p>

        <!-- Mock Table -->
        <div class="mock-screen">
            <div class="mock-topbar">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
                <span class="title">Toutes les ventes — Simplex Gestion</span>
            </div>
            <div class="mock-body">
                <img src="/img/sales-table.png" alt="Mock Tableau de ventes" style="width:100%;border-radius:6px;">
            </div>
        </div>

        <!-- Features below the mock -->
        <div class="tabs-section">
            <div class="tab-content-grid">
                <div class="tab-feature-card">
                    <div class="tfc-icon">🔍</div>
                    <h4>Recherche et filtres puissants</h4>
                    <p>Filtrez vos ventes par client, date, emplacement, statut de paiement ou mode de règlement. Retrouvez n'importe quelle transaction en quelques secondes, même dans un historique de milliers de factures.</p>
                </div>
                <div class="tab-feature-card">
                    <div class="tfc-icon">⚙️</div>
                    <h4>Colonnes personnalisables</h4>
                    <p>Choisissez exactement les informations à afficher : montant total, total payé, ventes impayées, retour de vente, statut d'expédition… Adaptez la vue à votre façon de travailler.</p>
                </div>
                <div class="tab-feature-card">
                    <div class="tfc-icon">⚡</div>
                    <h4>Actions contextuelles</h4>
                    <p>Depuis le tableau principal, accédez directement à l'édition, l'impression, la duplication ou la suppression d'une vente. Moins de clics, plus d'efficacité au quotidien.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CRÉATION D'UNE VENTE                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag">Saisie des ventes</div>
            <h3>Créer une vente n'a jamais été aussi simple</h3>
            <p>
                Le formulaire de création de vente est pensé pour aller vite sans rien oublier. Sélectionnez le client, ajoutez les produits par nom, SKU ou code-barres, définissez les remises et la taxe — la facture se calcule automatiquement en temps réel.
            </p>
            <ul class="feature-list">
                <li>Recherche produit par nom, référence SKU ou scan de code-barres</li>
                <li>Remises en pourcentage ou montant fixe par ligne ou sur le total</li>
                <li>Taxes de commande configurables et timbre fiscal automatique</li>
                <li>Prix de vente par défaut ou personnalisé selon le profil client</li>
                <li>Numérotation automatique ou saisie manuelle du numéro de facture</li>
                <li>Note de vente et pièces jointes (PDF, images, documents)</li>
                <li>Sauvegarde ou impression directe en un seul bouton</li>
            </ul>
        </div>
        <div>
            <div class="form-mock">
                <h4>Ajouter une vente</h4>
                <div class="form-row">
                    <div class="form-field">
                        <label>Client *</label>
                        <div class="faux-input">Passager</div>
                    </div>
                    <div class="form-field">
                        <label>Note</label>
                        <div class="faux-input blue">Conditions d…</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Type de prix vente</label>
                        <div class="faux-input">Gros | Détail</div>
                    </div>
                    <div class="form-field">
                        <label>Facture n°</label>
                        <div class="faux-input" style="color:var(--text-muted);font-style:italic;font-size:0.77rem;">Auto-généré</div>
                    </div>
                </div>
                <div class="product-line">
                    <div class="product-line-header">
                        <span>Produit</span><span>Qté</span><span>P.U.</span><span>Remise</span><span>Total</span>
                    </div>
                    <div class="product-line-body">
                        <div>Produit A</div><div>3</div><div>12.500</div><div>0 %</div><div>37.500</div>
                    </div>
                </div>
                <div class="form-row" style="margin-top:14px;">
                    <div class="form-field">
                        <label>Type de remise</label>
                        <div class="faux-input">Pourcentage</div>
                    </div>
                    <div class="form-field">
                        <label>Montant de remise</label>
                        <div class="faux-input">0.000</div>
                    </div>
                </div>
                <div class="total-block">
                    <div class="label">Total à payer</div>
                    <div class="amount">TND 37.500</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  MODES DE PAIEMENT                                     -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Encaissement</div>
        <h2 class="section-title">Tous les modes de paiement, dans une seule interface</h2>
        <p class="section-subtitle">
            Simplex Gestion s'adapte à votre réalité terrain. Que votre client paie en espèces, par chèque ou en plusieurs fois, le système enregistre chaque règlement avec précision et calcule automatiquement le rendu-monnaie et le reste à percevoir.
        </p>

        <div class="payment-grid">
            <div class="payment-card">
                <div class="payment-icon">💵</div>
                <h4>En espèces</h4>
                <p>Paiement immédiat avec calcul automatique du solde restant.</p>
            </div>
            <div class="payment-card">
                <div class="payment-icon">⬆️</div>
                <h4>Avance</h4>
                <p>Enregistrez un acompte partiel et suivez le solde en attente jusqu'au solde complet.</p>
            </div>
            <div class="payment-card">
                <div class="payment-icon">💳</div>
                <h4>Paiement multiple</h4>
                <p>Combinez plusieurs modes de paiement sur une même facture pour plus de flexibilité.</p>
            </div>
            <div class="payment-card">
                <div class="payment-icon">🏦</div>
                <h4>Virement / Chèque / Traite</h4>
                <p>Enregistrez les règlements différés avec date d'échéance et note de paiement.</p>
            </div>
            <div class="payment-card">
                <div class="payment-icon">📋</div>
                <h4>Conditions personnalisées</h4>
                <p>Définissez des conditions de paiement spécifiques par client ou par type de vente.</p>
            </div>
        </div>

      {{--  <div class="metrics-grid" style="margin-top:40px;">
            <div class="metric-card">
                <div class="metric-label">Ventes totales</div>
                <div class="metric-value color-blue">TND 1,797.849</div>
                <div class="metric-trend">↑ Mise à jour en temps réel</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total encaissé</div>
                <div class="metric-value color-green">TND 1,797.849</div>
                <div class="metric-trend">↑ Payé intégralement</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Ventes impayées</div>
                <div class="metric-value color-orange">TND 0.000</div>
                <div class="metric-trend">Aucun impayé en cours</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Retours de vente</div>
                <div class="metric-value color-purple">TND 0.000</div>
                <div class="metric-trend">Suivi automatique</div>
            </div>
        </div>--}}
    </section>
</div>


<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  BROUILLONS & DEVIS                                     -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag">Brouillons & Devis</div>
                <h3>Travaillez à votre rythme,<br>sans perdre aucune donnée</h3>
                <p>
                    Pas encore prêt à facturer ? Enregistrez votre saisie comme brouillon et reprenez-la plus tard. Vous pouvez aussi créer un devis détaillé, le soumettre à votre client, puis le convertir en vente définitive dès son accord — sans ressaisie.
                </p>
                <ul class="feature-list">
                    <li>Brouillons illimités, modifiables à tout moment</li>
                    <li>Liste des brouillons centralisée et consultable</li>
                    <li>Création de devis avec tous les détails produit et conditions</li>
                    <li>Conversion devis → facture en un seul clic</li>
                    <li>Liste des devis avec statut (en attente, accepté, refusé)</li>
                    <li>Pièces jointes supportées (contrats, bons de commande…)</li>
                </ul>
            </div>
            <div>
                <div class="mock-screen">
                    <div class="mock-topbar">
                        <div class="dot dot-red"></div>
                        <div class="dot dot-yellow"></div>
                        <div class="dot dot-green"></div>
                        <span class="title">Liste des brouillons</span>
                    </div>
                    <div class="mock-body">
                        <div class="mock-actions">
                            <div class="mock-btn primary">+ Ajouter un brouillon</div>
                        </div>
                        <div style="margin-top:16px;">
                            <div class="mock-row-header">
                                <span>Réf.</span><span>Client</span><span>Montant</span><span>Date</span><span>Statut</span><span>Action</span>
                            </div>
                            <div class="mock-row">
                                <span class="facture">B-041</span>
                                <span class="client">Passager</span>
                                <span class="montant">TND 230.000</span>
                                <span class="date">19/04/2026</span>
                                <span><span class="badge badge-orange">Brouillon</span></span>
                                <span style="color:var(--primary);font-size:0.75rem;">Modifier</span>
                            </div>
                            <div class="mock-row">
                                <span class="facture">D-018</span>
                                <span class="client">Café Maatoug</span>
                                <span class="montant">TND 520.500</span>
                                <span class="date">15/04/2026</span>
                                <span><span class="badge badge-green">Accepté</span></span>
                                <span style="color:var(--accent);font-size:0.75rem;">Convertir</span>
                            </div>
                            <div class="mock-row">
                                <span class="facture">D-017</span>
                                <span class="client">Excel Ex</span>
                                <span class="montant">TND 1,200.000</span>
                                <span class="date">10/04/2026</span>
                                <span><span class="badge badge-orange">En attente</span></span>
                                <span style="color:var(--primary);font-size:0.75rem;">Voir</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  MODULE GRILLE TARIF                                          -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Des prix sur mesure</div>
    <h2 class="section-title">Grilles Tarifaires Personnalisées</h2>
    <p class="section-subtitle">
        Définissez des grilles tarifaires par client ou choisissez-les manuellement lors de la vente : gros, demi-gros, détail, fidèle, occasionnel, ou tout autre niveau personnalisé.
    </p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
        <div class="overview-card">
            <strong>Application automatique</strong>
            <p>Application automatique de la grille dès la sélection du client ou du produit.</p>
        </div>
        <div class="overview-card">
            <strong>Flexibilité totale</strong>
            <p>ajustement manuel du prix selon la négociation.</p>
        </div>
        <div class="overview-card">
            <h3>Historique des tarifs</h3>
            <p>Historique des tarifs appliqués par client pour une traçabilité totale.</p>
        </div>
    </div>
</section>




<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  EXPÉDITIONS                                            -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag">Logistique</div>
            <h3>Gérez vos expéditions directement depuis la vente</h3>
            <p>
                Simplex Gestion intègre un module d'expédition complet dans chaque fiche de vente. Renseignez l'adresse de livraison, le transporteur, les frais d'expédition et le statut de livraison — tout est lié à la facture et archivé automatiquement.
            </p>
            <ul class="feature-list">
                <li>Adresse de facturation et adresse de livraison distinctes</li>
                <li>Détails d'expédition (transporteur, référence de suivi)</li>
                <li>Frais d'expédition ajoutés automatiquement au total</li>
                <li>Statut de livraison : en cours, livré, retourné…</li>
                <li>Champ "Livré à" pour identifier le destinataire réel</li>
                <li>Documents d'expédition joignables (note ou contrat)</li>
            </ul>
        </div>
        <div>
            <div class="form-mock">
                <h4>Détails d'expédition</h4>
                <div class="form-row">
                    <div class="form-field" style="grid-column:1/-1;">
                        <label>Adresse de livraison</label>
                        <div class="faux-input" style="height:56px;padding-top:10px;">23 Rue Ibn Khaldoun, Tunis 1001</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Frais d'expédition</label>
                        <div class="faux-input">TND 8.000</div>
                    </div>
                    <div class="form-field">
                        <label>Statut d'expédition</label>
                        <div class="faux-input blue">En cours de livraison</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Livré à</label>
                        <div class="faux-input">M. Ahmed Ben Ali</div>
                    </div>
                    <div class="form-field">
                        <label>Documents d'expédition</label>
                        <div class="faux-input blue">📎 bon_livraison.pdf</div>
                    </div>
                </div>
                <div style="margin-top:12px; padding-top:12px; border-top:1px solid var(--dark-border); display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:0.82rem; color:var(--text-muted);">Total avec frais d'expédition</span>
                    <span style="font-size:1.2rem; font-weight:800; color:var(--primary);">TND 46.000</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RETOURS DE VENTE                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Retours & Remises</div>
        <h2 class="section-title">Retours de vente</h2>
        <p class="section-subtitle">
            Les retours font partie du quotidien du négoce. Simplex Gestion vous permet de les traiter proprement, de les relier à la vente d'origine et de mettre à jour votre stock en conséquence.
        </p>

        <div class="returns-info">
            <div>
                <h3>Retours de vente transparents</h3>
                <p>
                    Chaque retour est directement rattaché à la facture d'origine. Il est visible dans la colonne dédiée du tableau des ventes et génère automatiquement les ajustements nécessaires sur le stock et les montants dus. Vous gardez ainsi une vue claire de votre activité nette, sans confusion entre les ventes brutes et les retours.
                </p>
              {{--  <p>
                    Les remises, elles, sont gérées directement à la création : remise globale ou ligne par ligne, en pourcentage ou en valeur fixe, avec affichage du montant remisé en temps réel.
                </p>--}}
                <div class="returns-badge-list">
                    <span class="returns-badge">Retour lié à la facture d'origine</span>
                    <span class="returns-badge">Impact stock automatique</span>
                    <span class="returns-badge">Visible dans le tableau des ventes</span>
 {{--                   <span class="returns-badge">Remise ligne par ligne</span>
                    <span class="returns-badge">Remise globale sur commande</span>--}}
                </div>
            </div>
            <div class="returns-visual">
                <div class="rv-row">
                    <span class="rv-label">Vente brute</span>
                    <span class="rv-val">TND 1,797.849</span>
                </div>
                <div class="rv-row">
                    <span class="rv-label">Total remises accordées</span>
                    <span class="rv-val red">- TND 124.500</span>
                </div>
                <div class="rv-row">
                    <span class="rv-label">Retours de vente</span>
                    <span class="rv-val red">- TND 37.500</span>
                </div>
                <div class="rv-row">
                    <span class="rv-label">Taxe de commande</span>
                    <span class="rv-val">+ TND 18.000</span>
                </div>
                <div class="rv-row">
                    <span class="rv-label">Timbre fiscal</span>
                    <span class="rv-val">+ TND 1.000</span>
                </div>
                <div class="rv-row" style="font-weight:700;">
                    <span class="rv-label" style="color:var(--text-main);">Vente nette encaissée</span>
                    <span class="rv-val green">TND 1,654.849</span>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  EXPORTS & IMPRESSIONS                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Exports & Impressions</div>
    <h2 class="section-title">Vos données, dans le format qu'il vous faut</h2>
    <p class="section-subtitle">
        Exportez vos ventes et factures en un clic dans les formats les plus utilisés, pour votre comptable, votre direction ou vos archives.
    </p>

    <div class="export-cards">
        <div class="export-card">
            <div class="ex-icon ex-green">📊</div>
            <div>
                <h4>Export CSV</h4>
                <p>Format universel, compatible avec tous les tableurs et logiciels de comptabilité.</p>
            </div>
        </div>
        <div class="export-card">
            <div class="ex-icon ex-blue">📗</div>
            <div>
                <h4>Export Excel</h4>
                <p>Fichier .xlsx prêt à l'emploi avec toutes les colonnes : date, client, montant, statut…</p>
            </div>
        </div>
        <div class="export-card">
            <div class="ex-icon ex-red">📄</div>
            <div>
                <h4>Export PDF</h4>
                <p>Rapport de ventes formaté pour l'impression ou le partage — idéal pour les réunions de direction.</p>
            </div>
        </div>
        <div class="export-card">
            <div class="ex-icon ex-purple">🖨️</div>
            <div>
                <h4>Impression directe</h4>
                <p>Imprimez une facture individuelle ou une liste de ventes directement depuis l'interface, sans quitter l'écran.</p>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  IMPORT DES VENTES                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Importation</div>
    <h2 class="section-title">Importez vos ventes existantes en masse</h2>
    <p class="section-subtitle">
        Vous migrez depuis un autre système ? Simplex Gestion vous permet d'importer vos données de ventes historiques directement par fichier — sans ressaisie manuelle, sans perte de données.
    </p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
        <div class="overview-card">
            <div class="card-icon icon-blue">📥</div>
            <h3>Import par fichier</h3>
            <p>Importez vos ventes depuis un fichier CSV ou Excel. Le système mappe automatiquement les colonnes et vous signale les erreurs avant la validation.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-green">🔗</div>
            <h3>Correspondance automatique</h3>
            <p>Les clients, produits et modes de paiement sont reconnus et reliés automatiquement à vos données existantes dans Simplex Gestion.</p>
        </div>
        <div class="overview-card">
            <div class="card-icon icon-purple">✅</div>
            <h3>Validation avant import</h3>
            <p>Un écran de prévisualisation vous permet de vérifier et corriger les données avant leur enregistrement définitif dans le système.</p>
        </div>
    </div>
</section>


<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  WORKFLOW COMPLET                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Processus de vente</div>
    <h2 class="section-title">Un flux de travail complet, de A à Z</h2>
    <p class="section-subtitle">
        Simplex Gestion couvre l'intégralité du cycle commercial. Chaque étape s'enchaîne naturellement, sans double saisie et sans perte d'information.
    </p>

    <div class="workflow-steps">
        <div class="workflow-step">
            <div class="step-num">1</div>
            <h4>Devis client</h4>
            <p>Créez un devis, envoyez-le au client et attendez sa validation.</p>
        </div>
        <div class="workflow-step">
            <div class="step-num">2</div>
            <h4>Confirmation & Facture</h4>
            <p>Transformez en facture numérotée, prête à imprimer ou à envoyer.</p>
        </div>
        <div class="workflow-step">
            <div class="step-num">3</div>
            <h4>Expédition</h4>
            <p>Gérez la livraison, les frais et le statut d'expédition en direct.</p>
        </div>
        <div class="workflow-step">
            <div class="step-num">4</div>
            <h4>Encaissement</h4>
            <p>Enregistrez le paiement, partiellement ou en totalité, avec rendu de monnaie.</p>
        </div>
    </div>
</section>


<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CTA                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="cta-section">
    <h2>Prêt à transformer votre gestion commerciale ?</h2>
    <p>
        Rejoignez des centaines de grossistes et distributeurs tunisiens qui pilotent leurs ventes avec Simplex Gestion. Commencez dès aujourd'hui, sans engagement.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration: none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration: none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Aucune carte bancaire requise</span>
        <span style="font-size:0.85rem; color:white">✓ Language en arabe & français</span>
        <span style="font-size:0.85rem; color:white">✓ service client 7j/7</span>
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
