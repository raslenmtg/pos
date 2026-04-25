<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel de gestion pour Fournisseurs, Grossistes & Distributeurs en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Simplex Gestion équipe les fournisseurs, grossistes et distributeurs tunisiens : facturation, les paiements, les achats, les crédit client, les dépenses, multi-dépôts et tableaux de bord.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Solution de gestion commerciale pour Fournisseurs & Distributeurs | Simplex Gestion">
    <meta property="og:description" content="Pilotez votre activité de gros et de distribution : facturation, les paiements, les achats, les crédit client, les dépenses et multi-dépôts.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Solution de gestion commerciale pour Fournisseurs & Distributeurs | Simplex Gestion">
    <meta name="twitter:description" content="Une plateforme complète pour fournisseurs, grossistes et distributeurs en Tunisie.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Solution de gestion commerciale pour Fournisseurs & Distributeurs",
            "serviceType": "Logiciel de gestion commerciale",
            "description": "Plateforme tout-en-un pour gérer la facturation, les paiements, les achats, les crédit client, les dépenses et le multi-dépôt.",
            "areaServed": "TN",
            "audience": { "@type": "BusinessAudience", "audienceType": "Fournisseurs, Grossistes, Distributeurs" },
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

        .navbar-brand { font-weight: 800; font-size: 1.4rem; letter-spacing: -0.4px; }
        .navbar .btn-primary, .navbar .btn-outline { padding: 8px 14px; font-size: 0.85rem; border-radius: 12px; }

        .hero {
            background: radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 70%);
            padding: 130px 24px 70px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 60% at 50% 0%, rgba(26,107,250,0.18) 0%, transparent 70%);
        }
        .hero-label {
            display: inline-block;
            background: rgba(26,107,250,0.15);
            border: 1px solid rgba(26,107,250,0.4);
            color: var(--primary);
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 6px 18px; border-radius: 100px; margin-bottom: 24px;
        }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.4rem); font-weight: 800; line-height: 1.18; margin-bottom: 24px; position: relative; }
        .hero h1 span {
            background: linear-gradient(90deg, var(--primary), #38b2f5);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero p { max-width: 760px; margin: 0 auto 40px; font-size: 1.15rem; color: var(--text-light); }
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat { text-align: center; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--primary); }
        .hero-stat span { font-size: 0.88rem; color: var(--text-muted); }
        .hero-cta { margin-top: 36px; display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; }

        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }
        .section-alt .section { margin: 0 auto; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--accent); margin-bottom: 16px;
        }
        .section-tag::before { content: ''; display: inline-block; width: 24px; height: 2px; background: var(--accent); border-radius: 2px; }
        .section-title { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .section-subtitle { font-size: 1.05rem; color: var(--text-light); max-width: 640px; margin-bottom: 56px; }

        .overview-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .overview-card {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 28px 28px 26px;
            transition: border-color 0.25s, transform 0.2s;
        }
        .overview-card:hover { border-color: rgba(26,107,250,0.45); transform: translateY(-3px); }
        .overview-card .card-icon {
            width: 46px; height: 46px; border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 18px;
        }
        .icon-blue   { background: rgba(26,107,250,0.15); }
        .icon-green  { background: rgba(0,194,123,0.15); }
        .icon-purple { background: rgba(139,92,246,0.15); }
        .icon-orange { background: rgba(245,166,35,0.15); }
        .icon-cyan   { background: rgba(56,178,245,0.15); }
        .icon-red    { background: rgba(239,68,68,0.15); }

        .overview-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
        .overview-card p  { font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; }

        .feature-row { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; margin-bottom: 80px; }
        .feature-row.reverse { direction: rtl; }
        .feature-row.reverse > * { direction: ltr; }
        @media (max-width: 768px) {
            .feature-row { grid-template-columns: 1fr; direction: ltr; }
            .feature-row.reverse { direction: ltr; }
        }
        .feature-content h3 { font-size: 1.7rem; font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .feature-content p  { font-size: 1rem; color: var(--text-light); margin-bottom: 24px; }
        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .feature-list li { display: flex; gap: 12px; align-items: flex-start; font-size: 0.95rem; color: var(--text-light); }
        .feature-list li::before {
            content: '✓'; flex-shrink: 0; width: 22px; height: 22px;
            background: rgba(0,194,123,0.15); color: var(--accent); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }

        .mock-screen {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius); overflow: hidden;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .mock-topbar {
            background: #f8fafc; border-bottom: 1px solid var(--dark-border);
            padding: 10px 16px; display: flex; align-items: center; gap: 10px;
        }
        .mock-topbar .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-red { background: #ef4444; } .dot-yellow { background: #f59e0b; } .dot-green { background: #22c55e; }
        .mock-topbar .title { font-size: 0.78rem; color: var(--text-muted); margin-left: auto; }
        .mock-body { padding: 20px; }
        .mock-row-header {
            display: grid; grid-template-columns: 70px 1fr 110px 90px 90px 80px;
            gap: 8px; padding: 8px 12px; font-size: 0.72rem; color: var(--text-muted);
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid var(--dark-border); margin-bottom: 4px;
        }
        .mock-row {
            display: grid; grid-template-columns: 70px 1fr 110px 90px 90px 80px;
            gap: 8px; padding: 9px 12px; font-size: 0.8rem;
            border-radius: 6px; margin-bottom: 2px; align-items: center;
        }
        .mock-row:hover { background: rgba(41,72,255,0.06); }
        .mock-row .date { color: var(--text-muted); font-size: 0.72rem; }
        .mock-row .facture { color: var(--primary); font-weight: 600; }
        .mock-row .client { font-weight: 500; }
        .mock-row .montant { color: var(--text-main); font-weight: 600; }
        .badge { display: inline-block; padding: 2px 9px; border-radius: 100px; font-size: 0.7rem; font-weight: 700; }
        .badge-green  { background: var(--badge-green-bg); color: var(--badge-green-text); }
        .badge-orange { background: var(--badge-orange-bg); color: var(--badge-orange-text); }
        .badge-red    { background: rgba(239,68,68,0.15); color: #b91c1c; }
        .badge-blue   { background: rgba(41,72,255,0.12); color: var(--primary); }
        .mock-actions { display: flex; gap: 6px; margin-top: 14px; flex-wrap: wrap; }
        .mock-btn {
            padding: 5px 12px; border-radius: 5px; font-size: 0.73rem; font-weight: 600;
            border: 1px solid var(--dark-border); background: transparent; color: var(--text-muted); cursor: default;
        }
        .mock-btn.primary { background: var(--primary); color: #fff; border-color: var(--primary); }

        .form-mock {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
        }
        .form-mock h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid var(--dark-border); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
        .form-field label { display: block; font-size: 0.73rem; color: var(--text-muted); font-weight: 600; margin-bottom: 6px; }
        .form-field .faux-input {
            background: #f8fafc; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 8px 12px; font-size: 0.82rem;
            color: var(--text-light); height: 36px;
        }
        .form-field .faux-input.blue { color: var(--primary); }
        .total-block { text-align: right; margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--dark-border); }
        .total-block .label { font-size: 0.8rem; color: var(--text-muted); }
        .total-block .amount { font-size: 1.4rem; font-weight: 800; color: var(--primary); }

        .payment-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 32px; }
        .payment-card {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm); padding: 20px;
            text-align: center; transition: border-color 0.2s;
        }
        .payment-card:hover { border-color: var(--accent); }
        .payment-card .payment-icon { font-size: 1.8rem; margin-bottom: 10px; }
        .payment-card h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 6px; }
        .payment-card p { font-size: 0.82rem; color: var(--text-muted); }

        .workflow-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0; position: relative; margin: 48px 0; }
        .workflow-step { padding: 28px 20px; text-align: center; position: relative; }
        .workflow-step:not(:last-child)::after { content: '→'; position: absolute; right: -10px; top: 36px; font-size: 1.2rem; color: var(--primary); font-weight: 300; }
        .step-num {
            width: 40px; height: 40px;
            background: rgba(26,107,250,0.15); border: 2px solid rgba(26,107,250,0.4);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: var(--primary); font-size: 0.9rem; margin: 0 auto 16px;
        }
        .workflow-step h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 8px; }
        .workflow-step p  { font-size: 0.82rem; color: var(--text-muted); }

        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top: 16px; }
        .metric-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 24px; }
        .metric-card .metric-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.07em; font-weight: 600; margin-bottom: 10px; }
        .metric-card .metric-value { font-size: 1.85rem; font-weight: 800; margin-bottom: 6px; }
        .metric-card .metric-trend { font-size: 0.8rem; color: var(--accent); }
        .color-blue   { color: var(--primary); }
        .color-green  { color: var(--accent); }
        .color-purple { color: #a78bfa; }
        .color-orange { color: #f59e0b; }

        .tabs-section { margin-top: 48px; }
        .tab-content-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        @media (max-width: 768px) { .tab-content-grid { grid-template-columns: 1fr; } }
        .tab-feature-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 22px; }
        .tab-feature-card .tfc-icon { font-size: 1.3rem; margin-bottom: 12px; }
        .tab-feature-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .tab-feature-card p  { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        .export-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        .export-card {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm); padding: 22px 20px;
            display: flex; align-items: flex-start; gap: 16px;
        }
        .export-card .ex-icon {
            width: 42px; height: 42px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; flex-shrink: 0;
        }
        .ex-green  { background: rgba(0,194,123,0.12); }
        .ex-blue   { background: rgba(26,107,250,0.12); }
        .ex-red    { background: rgba(239,68,68,0.12); }
        .ex-purple { background: rgba(139,92,246,0.12); }
        .export-card h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
        .export-card p  { font-size: 0.82rem; color: var(--text-muted); }

        /* PRICING TIERS — fournisseurs spécifique */
        .tier-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top: 32px; }
        .tier-card {
            background: #ffffff; border: 1px solid var(--dark-border); border-radius: var(--radius);
            padding: 22px; position: relative; overflow: hidden;
        }
        .tier-card::before {
            content: ''; position: absolute; top: 0; left: 0; height: 4px; width: 100%;
            background: linear-gradient(90deg, var(--primary), #38b2f5);
        }
        .tier-card .tier-name { font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 10px; }
        .tier-card .tier-price { font-size: 1.7rem; font-weight: 800; color: var(--primary); margin-bottom: 4px; }
        .tier-card .tier-old { font-size: 0.85rem; color: var(--text-muted); text-decoration: line-through; margin-bottom: 14px; }
        .tier-card .tier-desc { font-size: 0.82rem; color: var(--text-muted); }

        /* RETURNS / RECAP */
        .returns-info {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 36px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;
        }
        @media (max-width: 768px) { .returns-info { grid-template-columns: 1fr; } }
        .returns-info h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 14px; }
        .returns-info p  { font-size: 0.95rem; color: var(--text-light); margin-bottom: 20px; }
        .returns-badge-list { display: flex; flex-wrap: wrap; gap: 8px; }
        .returns-badge {
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25);
            color: #b91c1c; padding: 5px 14px; border-radius: 100px;
            font-size: 0.8rem; font-weight: 600;
        }
        .returns-visual { background: #f8fafc; border: 1px solid var(--dark-border); border-radius: 10px; padding: 20px; }
        .rv-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--dark-border); font-size: 0.83rem; }
        .rv-row:last-child { border-bottom: none; }
        .rv-row .rv-label { color: var(--text-muted); }
        .rv-row .rv-val { font-weight: 600; }
        .rv-row .rv-val.red { color: #b91c1c; }
        .rv-row .rv-val.green { color: var(--accent); }

        /* TESTIMONIALS */
        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 32px; }
        .testimonial-card {
            background: #ffffff; border: 1px solid var(--dark-border); border-radius: var(--radius);
            padding: 28px; position: relative;
        }
        .testimonial-card::before {
            content: '“'; position: absolute; top: 8px; left: 18px;
            font-size: 4rem; color: rgba(41,72,255,0.12); font-family: Georgia, serif; line-height: 1;
        }
        .testimonial-card p { font-size: 0.95rem; color: var(--text-light); margin-bottom: 18px; position: relative; z-index: 1; }
        .testimonial-author { display: flex; align-items: center; gap: 12px; }
        .testimonial-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #38b2f5);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 1rem;
        }
        .testimonial-author .name { font-size: 0.92rem; font-weight: 700; color: var(--text-main); }
        .testimonial-author .role { font-size: 0.78rem; color: var(--text-muted); }

        /* FAQ */
        .faq-list { display: flex; flex-direction: column; gap: 12px; max-width: 880px; margin: 0 auto; }
        .faq-item {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm); padding: 20px 24px;
        }
        .faq-item h4 { font-size: 1rem; font-weight: 700; margin-bottom: 10px; color: var(--text-main); }
        .faq-item p  { font-size: 0.9rem; color: var(--text-light); }

        .cta-section {
            padding: 80px 24px; text-align: center;
            background: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            color: #fff;
        }
        .cta-section h2 { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; margin-bottom: 16px; }
        .cta-section p { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 580px; margin: 0 auto 36px; }
        .cta-buttons { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn-primary { background: var(--primary); color: #fff; border: none; padding: 14px 32px; border-radius: 8px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: background 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: transparent; color: var(--dark); border: 2px solid #e2e8f0; padding: 14px 32px; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: border-color 0.2s; }
        .btn-outline:hover { border-color: var(--dark); background: var(--dark); color: #fff; }
        .cta-section .btn-outline { border-color: rgba(255,255,255,0.85); color: #fff; }
        .cta-section .btn-outline:hover { background: #fff; color: var(--primary); border-color: #fff; }

        .divider { height: 1px; background: #e2e8f0; margin: 0; }

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
        <div class="hero-label">Pour Fournisseurs · Grossistes · Distributeurs</div>
        <h1>Le moteur commercial de votre activité<br><span>de gros et de distribution</span></h1>
        <p>
            Devis, factures conformes, grilles tarifaires multi-niveaux, paiements, impayés, achats, retours, dépenses, multi-dépôts et tableaux de bord et d'autres modules : Simplex Gestion centralise tout votre cycle commercial dans une plateforme pensée pour les entreprises tunisiennes qui livrent, distribuent et facturent en gros.
        </p>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  POURQUOI                                               -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Pensé pour la distribution</div>
        <h2 class="section-title">Vous livrez à des dizaines, voire des centaines de clients.<br>Vous méritez un outil à votre échelle.</h2>
        <p class="section-subtitle">
            Les feuilles Excel, les bons sur carnet et les factures Word ne suivent plus le rythme. Quand vos commerciaux sont sur la route, vos camions partent au dépôt et vos clients réclament des grilles tarifaires différentes — vous avez besoin d'une seule plateforme qui parle le langage du gros et de la distribution.
        </p>

        <div class="overview-grid">
            <div class="overview-card">
                <div class="card-icon icon-blue">📦</div>
                <h3>Catalogue produits</h3>
                <p>Gérez des milliers de références avec variantes, lots, dates de péremption, codes-barres EAN-13 et photos produit. Importez votre catalogue existant en quelques minutes via Excel ou CSV.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-green">💰</div>
                <h3>Grilles tarifaires multi-niveaux</h3>
                <p>Définissez des prix gros, demi-gros, détail, fidèle ou personnalisés par client. La grille s'applique automatiquement à la sélection du client ou produit — fini les erreurs de prix sur la facture.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-purple">🏬</div>
                <h3>Multi-dépôts & multi-points de vente</h3>
                <p>Centralisez tous vos dépôts, magasins et entrepôts dans une seule plateforme. Visualisez le stock par emplacement, transférez en interne et synchronisez les ventes en temps réel.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-orange">🚚</div>
                <h3>Expéditions & livraisons</h3>
                <p>Adresse de livraison, transporteur, frais de transport, statut "en cours / livré / retourné" — tout est rattaché à la facture et au bon de livraison automatiquement.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-cyan">🧑‍🚚</div>
                <h3>Caisse digital</h3>
                <p>Suivez l'activité de vos commerciaux terrain : ventes, devis clients, prises de commande, encaissements en route et dépenses.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-red">📊</div>
                <h3>Tableaux de bord en temps réel</h3>
                <p>Chiffre d'affaires par client, top produits, marges par catégorie, encours, retards de paiement, performance par commercial — tout sur un seul écran, mis à jour à la seconde.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  FACTURATION B2B — MOCK UI                              -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Facturation</div>
            <h2 class="section-title">Facturez en gros, sans une erreur, sans un retard</h2>
            <p class="section-subtitle">
                Votre tableau de ventes en un coup d'œil : numéro de facture, client, montant, mode de règlement, statut d'expédition et solde restant. Filtrable, exportable, partageable avec votre comptable en deux clics.
            </p>

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

            <div class="tabs-section">
                <div class="tab-content-grid">
                    <div class="tab-feature-card">
                        <div class="tfc-icon">🔍</div>
                        <h4>Recherche & filtres avancés</h4>
                        <p>Filtrez vos factures par client, dépôt, commercial, période, statut de paiement ou type de règlement. Retrouvez n'importe quelle vente parmi des milliers de lignes en moins de 3 secondes.</p>
                    </div>
                    <div class="tab-feature-card">
                        <div class="tfc-icon">⚙️</div>
                        <h4>Colonnes & vues personnalisables</h4>
                        <p>Affichez les colonnes qui comptent pour vous : status de paiement, client, retours, montant total, mode de paiement et statut d'expédition.</p>
                    </div>
                    <div class="tab-feature-card">
                        <div class="tfc-icon">⚡</div>
                        <h4>Performance optimale</h4>
                        <p>Que vous ayez des centaines ou des milliers de produits, la recherche et l’ajout restent fluides et rapides. Les catégories, marques et résultats s’affichent sans délai.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  CRÉATION D'UNE VENTE B2B                              -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Saisie des ventes</div>
                <h3>Établissez une facture en gros, en moins d'une minute</h3>
                <p>
                    Sélectionnez le client — sa grille tarifaire, son adresse de livraison, ses conditions de paiement et son encours autorisé s'affichent automatiquement. Ajoutez les produits par nom, SKU ou code-barres, choisissez le dépôt source, appliquez les remises de volume — la facture se calcule en temps réel, taxes et timbres inclus.
                </p>
                <ul class="feature-list">
                    <li>Auto-complétion intelligente sur les noms clients et produits</li>
                    <li>Application automatique de la grille tarifaire du client</li>
                    <li>Vérification en direct du stock disponible par dépôt</li>
                    <li>Alerte si l'encours du client dépasse la limite autorisée</li>
                    <li>Remises ligne par ligne ou globale, en % ou en valeur fixe</li>
                    <li>Calcul automatique de la TVA, du timbre fiscal et des frais</li>
                    <li>Génération automatique du bon de livraison associé</li>
                </ul>
            </div>
            <div>
                <div class="form-mock">
                    <h4>Nouvelle facture</h4>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Client</label>
                            <div class="faux-input blue">Café  — Sousse</div>
                        </div>
                        <div class="form-field">
                            <label>Grille tarifaire</label>
                            <div class="faux-input">Demi-gros</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Dépôt source</label>
                            <div class="faux-input">Dépôt Tunis Centre</div>
                        </div>
                        <div class="form-field">
                            <label>Représentant</label>
                            <div class="faux-input">Karim</div>
                        </div>
                    </div>
                    <div style="background:#f8fafc; border:1px solid var(--dark-border); border-radius:8px; padding:12px; margin:14px 0;">
                        <div style="display:grid; grid-template-columns:2fr 70px 90px 90px; gap:8px; font-size:0.7rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; margin-bottom:8px;">
                            <span>Produit</span><span>Qté</span><span>P.U. HT</span><span>Total</span>
                        </div>
                        <div style="display:grid; grid-template-columns:2fr 70px 90px 90px; gap:8px; font-size:0.78rem; padding:6px 0; border-top:1px solid var(--dark-border);">
                            <span style="color:var(--text-light);">Café moulu Délice 250g</span>
                            <span>120</span><span>4.200</span><span style="font-weight:600;">504.000</span>
                        </div>
                        <div style="display:grid; grid-template-columns:2fr 70px 90px 90px; gap:8px; font-size:0.78rem; padding:6px 0; border-top:1px solid var(--dark-border);">
                            <span style="color:var(--text-light);">Sucre cristal SOTUSU 1kg</span>
                            <span>200</span><span>1.850</span><span style="font-weight:600;">370.000</span>
                        </div>
                        <div style="display:grid; grid-template-columns:2fr 70px 90px 90px; gap:8px; font-size:0.78rem; padding:6px 0; border-top:1px solid var(--dark-border);">
                            <span style="color:var(--text-light);">Eau minérale Safia 1.5L</span>
                            <span>360</span><span>0.580</span><span style="font-weight:600;">208.800</span>
                        </div>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-top:12px; border-top:1px solid var(--dark-border);">
                        <span style="font-size:0.82rem; color:var(--text-muted);">Total TTC (TVA 19% incluse)</span>
                        <span style="font-size:1.4rem; font-weight:800; color:var(--primary);">TND 1 287.612</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  GRILLES TARIFAIRES — section vedette                  -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Avantage compétitif</div>
            <h2 class="section-title">Vos prix, votre stratégie, votre marge</h2>
            <p class="section-subtitle">
                Dans la distribution, le bon prix au bon client fait toute la différence. Simplex Gestion vous laisse créer autant de niveaux tarifaires que vous voulez et appliquer la bonne grille automatiquement, sans calcul mental, sans erreur de saisie, sans perte de marge.
            </p>

            <div class="tier-grid">
                <div class="tier-card">
                    <div class="tier-name">Gros</div>
                    <div class="tier-price">TND 3.20</div>
                    <div class="tier-old">Détail : TND 4.50</div>
                    <div class="tier-desc">Tarif appliqué aux distributeurs et grands volumes (palette).</div>
                </div>
                <div class="tier-card">
                    <div class="tier-name">Demi-gros</div>
                    <div class="tier-price">TND 3.65</div>
                    <div class="tier-old">Détail : TND 4.50</div>
                    <div class="tier-desc">Pour les supérettes, mini-markets et grossistes secondaires.</div>
                </div>
                <div class="tier-card">
                    <div class="tier-name">Détail</div>
                    <div class="tier-price">TND 4.20</div>
                    <div class="tier-old">Public : TND 4.50</div>
                    <div class="tier-desc">Pour les épiceries de quartier et boutiques indépendantes.</div>
                </div>
                <div class="tier-card">
                    <div class="tier-name">Client fidèle</div>
                    <div class="tier-price">TND 3.45</div>
                    <div class="tier-old">Détail : TND 4.50</div>
                    <div class="tier-desc">Tarif négocié pour vos meilleurs partenaires historiques.</div>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px; margin-top:32px;">
                <div class="overview-card">
                    <div class="card-icon icon-blue">🎯</div>
                    <h3>Application automatique</h3>
                    <p>La grille du client est appliquée dès la sélection sur la facture. Plus besoin de mémoriser les tarifs négociés client par client.</p>
                </div>
                <div class="overview-card">
                    <div class="card-icon icon-green">⚖️</div>
                    <h3>Flexibilité totale</h3>
                    <p>Le commercial peut ajuster manuellement le prix selon la négociation. Toute modification est tracée et soumise à validation si vous le souhaitez.</p>
                </div>
                <div class="overview-card">
                    <div class="card-icon icon-purple">🕒</div>
                    <h3>Historique des tarifs</h3>
                    <p>Conservez l'historique complet des prix appliqués par client, par produit et par période. Une traçabilité totale pour vos audits et négociations.</p>
                </div>
                <div class="overview-card">
                    <div class="card-icon icon-cyan">🏷️</div>
                    <h3>Promotions ciblées</h3>
                    <p>Lancez des opérations promotionnelles sur des catégories, des produits avec date de début et date de fin.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  COMPTES CLIENTS & ENCOURS                              -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag">Comptes clients & encours</div>
                <h3>Plus jamais aveugle sur ce qu'on vous doit</h3>
                <p>
                    Chaque client a sa fiche complète : crédit autorisé, historique des ventes, échéancier des traites, historique des paiements et des relances. Une alerte se déclenche dès qu'un client dépasse sa limite ou qu'une échéance approche.
                </p>
                <ul class="feature-list">
                    <li>Limite crédit configurable par client</li>
                    <li>Alerte automatique si limite est dépassé</li>
                    <li>Suivi des traites, chèques et virements en attente</li>
                    <li>Échéancier visuel : ce qui est dû cette semaine, ce mois</li>
                    <li>Relances automatiques par WhatsApp</li>
                    <li>Historique complet des transactions par client</li>
                </ul>
            </div>
            <div>
                <div class="mock-screen">
                    <div class="mock-topbar">
                        <div class="dot dot-red"></div>
                        <div class="dot dot-yellow"></div>
                        <div class="dot dot-green"></div>
                        <span class="title">Fiche client — Café Maatoug</span>
                    </div>
                    <div class="mock-body">
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px; margin-bottom:18px;">
                            <div style="background:#f8fafc; border:1px solid var(--dark-border); border-radius:8px; padding:14px;">
                                <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Crédit autorisé</div>
                                <div style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin-top:6px;">TND 15 000.000</div>
                            </div>
                            <div style="background:#fef3c7; border:1px solid #fde68a; border-radius:8px; padding:14px;">
                                <div style="font-size:0.72rem; color:#b45309; text-transform:uppercase; font-weight:600;">Crédit actuel</div>
                                <div style="font-size:1.3rem; font-weight:800; color:#b45309; margin-top:6px;">TND 12 480.500</div>
                            </div>
                        </div>
                        <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; margin-bottom:10px;">Échéancier des traites</div>
                        <div class="rv-row">
                            <span class="rv-label">Traite F-0398 — échéance 28/04/2024</span>
                            <span class="rv-val">TND 4 200.000</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Traite F-0412 — échéance 15/05/2024</span>
                            <span class="rv-val">TND 3 850.000</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Traite F-0418 — échéance 22/06/2024</span>
                            <span class="rv-val">TND 4 430.500</span>
                        </div>
                        <div class="rv-row" style="font-weight:700;">
                            <span class="rv-label" style="color:var(--text-main);">Total à percevoir</span>
                            <span class="rv-val green">TND 12 480.500</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  MULTI-DÉPÔTS                                           -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Multi-dépôts & multi-PDV</div>
                <h3>Une seule plateforme,<br>tous vos dépôts synchronisés</h3>
                <p>
                    Vous avez un dépôt principal à Tunis, un secondaire à Sousse et un point de relais à Sfax ? Simplex Gestion orchestre les stocks, les transferts internes, les ventes et les achats sur l'ensemble de votre réseau, en temps réel.
                </p>
                <ul class="feature-list">
                    <li>Stock disponible visible par dépôt et globalement</li>
                    <li>Transferts internes entre dépôts avec bons de mouvement</li>
                    <li>Affectation des ventes au dépôt source automatiquement</li>
                    <li>Inventaires séparés par dépôt avec rapprochement</li>
                    <li>Réapprovisionnement intelligent</li>
                    <li>Rapports consolidés ou par site</li>
                </ul>
            </div>
            <div>
                <div class="form-mock">
                    <h4>Stock par dépôt — Café moulu Délice 250g</h4>
                    <div class="rv-row">
                        <span class="rv-label">Dépôt Tunis Centre</span>
                        <span class="rv-val">1 240 unités</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Dépôt Sousse</span>
                        <span class="rv-val">680 unités</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Relais Sfax</span>
                        <span class="rv-val" style="color:#b91c1c;">12 unités — alerte</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">En transit (transfert TR-0091)</span>
                        <span class="rv-val">200 unités</span>
                    </div>
                    <div class="rv-row" style="font-weight:700;">
                        <span class="rv-label" style="color:var(--text-main);">Stock global disponible</span>
                        <span class="rv-val green">2 132 unités</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  MODES DE PAIEMENT                                      -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Encaissements</div>
            <h2 class="section-title">Espèces, traites, chèques, virements — tout est tracé</h2>
            <p class="section-subtitle">
                Dans la distribution, un client paie rarement en une seule fois. Avance à la commande, traite à 30 jours, chèque à 60 jours, solde par virement — Simplex Gestion enregistre chaque règlement et calcule automatiquement le reste à percevoir.
            </p>

            <div class="payment-grid">
                <div class="payment-card">
                    <div class="payment-icon">💵</div>
                    <h4>Espèces</h4>
                    <p>Encaissement immédiat.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">⬆️</div>
                    <h4>Avance à la commande</h4>
                    <p>Acompte partiel à la facturation, solde réglé à la livraison ou plus tard.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">📝</div>
                    <h4>Traite</h4>
                    <p>Enregistrez la traite.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">🏦</div>
                    <h4>Chèque & virement</h4>
                    <p>Enregistrement avec numéro de chèque.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">💳</div>
                    <h4>Paiement multiple</h4>
                    <p>Combinez plusieurs modes sur une même facture : espèces + traite + chèque.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  EXPÉDITIONS & BL                                       -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Logistique & livraisons</div>
                <h3>Du dépôt au client, sans rien perdre en route</h3>
                <p>
                 Vous renseignez l'adresse, les frais, le statut — tout reste lié à la vente d'origine et apparaît dans le tableau de bord du chauffeur ou du livreur.
                </p>
                <ul class="feature-list">
                    <li>Adresse de facturation et adresse de livraison distinctes</li>
                    <li>Bon de livraison imprimable</li>
                    <li>Frais de transport ou facturés à part</li>
                    <li>Statut : préparation, en route, livré, refusé, retourné</li>
                </ul>
            </div>
            <div>
                <div class="form-mock">
                    <h4>Bon de livraison — BL-2024-0818</h4>
                    <div class="form-row">
                        <div class="form-field" style="grid-column:1/-1;">
                            <label>Adresse de livraison</label>
                            <div class="faux-input" style="height:56px;padding-top:10px;">Café Maatoug<br>14 Avenue Habib Bourguiba, Sousse 4000</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Frais d'expédition</label>
                            <div class="faux-input">TND 35.000</div>
                        </div>
                        <div class="form-field">
                            <label>Statut</label>
                            <div class="faux-input blue">En cours de livraison</div>
                        </div>
                    </div>
                    <div style="margin-top:12px; padding-top:12px; border-top:1px solid var(--dark-border); display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:0.82rem; color:var(--text-muted);">Total avec frais d'expédition</span>
                        <span style="font-size:1.2rem; font-weight:800; color:var(--primary);">TND 4 855.000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  RETOURS & AVOIRS                                       -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Retours & Avoirs</div>
            <h2 class="section-title">Gérez les retours sans bouleverser vos comptes</h2>
            <p class="section-subtitle">
                Dans le négoce, les retours sont inévitables : produit cassé, mauvaise commande, fin de date courte. Simplex Gestion les traite proprement, met à jour le stock et génère l'avoir client automatiquement.
            </p>

            <div class="returns-info">
                <div>
                    <h3>Chaque retour est rattaché à sa facture d'origine</h3>
                    <p>
                        Un retour ne flotte jamais dans le vide. Il est lié à la vente d'origine, visible dans la colonne dédiée du tableau des ventes et impacte automatiquement le stock du dépôt concerné. Vous gardez ainsi une vision nette de votre activité réelle, sans confusion entre ventes brutes et ventes nettes.
                    </p>
                    <div class="returns-badge-list">
                        <span class="returns-badge">Retour lié à la facture d'origine</span>
                        <span class="returns-badge">Avoir client auto-généré</span>
                        <span class="returns-badge">Impact stock automatique</span>
                        <span class="returns-badge">Motif de retour traçable</span>
                    </div>
                </div>
                <div class="returns-visual">
                    <div class="rv-row">
                        <span class="rv-label">Vente brute</span>
                        <span class="rv-val">TND 4 820.000</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Remise client</span>
                        <span class="rv-val red">- TND 240.000</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Retours de vente</span>
                        <span class="rv-val red">- TND 86.500</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">TVA 19%</span>
                        <span class="rv-val">+ TND 854.265</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Timbre fiscal</span>
                        <span class="rv-val">+ TND 1.000</span>
                    </div>
                    <div class="rv-row" style="font-weight:700;">
                        <span class="rv-label" style="color:var(--text-main);">Vente nette à encaisser</span>
                        <span class="rv-val green">TND 5 348.765</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  EXPORTS COMPTABLES                                     -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Exports & comptabilité</div>
        <h2 class="section-title">Vos données prêtes pour votre comptable, en un clic</h2>
        <p class="section-subtitle">
            Fini les nuits blanches en fin de mois. Exportez vos ventes, achats, encaissements et écritures comptables dans le format attendu par votre cabinet. Compatible avec les logiciels de comptabilité utilisés en Tunisie.
        </p>

        <div class="export-cards">
            <div class="export-card">
                <div class="ex-icon ex-green">📊</div>
                <div>
                    <h4>Export CSV</h4>
                    <p>Format universel, compatible avec tous les tableurs et logiciels de comptabilité tunisiens.</p>
                </div>
            </div>
            <div class="export-card">
                <div class="ex-icon ex-blue">📗</div>
                <div>
                    <h4>Export Excel</h4>
                    <p>Fichier .xlsx prêt à l'emploi avec toutes les colonnes nécessaires à la déclaration fiscale.</p>
                </div>
            </div>
            <div class="export-card">
                <div class="ex-icon ex-red">📄</div>
                <div>
                    <h4>Export PDF</h4>
                    <p>Rapports formatés pour impression, archivage ou présentation en réunion de direction.</p>
                </div>
            </div>
            <div class="export-card">
                <div class="ex-icon ex-purple">📒</div>
                <div>
                    <h4>Journaux comptables</h4>
                    <p>Génération du journal de ventes, du journal de caisse et du grand-livre client.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  WORKFLOW                                               -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Processus de distribution</div>
            <h2 class="section-title">De la commande client à l'encaissement, sans rupture</h2>
            <p class="section-subtitle">
                Simplex Gestion orchestre tout votre cycle de distribution. Aucun document à ressaisir, aucune information perdue entre le commercial, le dépôt, la facturation et la comptabilité.
            </p>

            <div class="workflow-steps">
                <div class="workflow-step">
                    <div class="step-num">1</div>
                    <h4>Prise de commande</h4>
                    <p>Le commercial saisit la commande sur mobile, chez le client.</p>
                </div>
                <div class="workflow-step">
                    <div class="step-num">2</div>
                    <h4>Devis ou facture</h4>
                    <p>Conversion automatique en devis ou facture numérotée.</p>
                </div>
                <div class="workflow-step">
                    <div class="step-num">3</div>
                    <h4>Préparation dépôt</h4>
                    <p>Bon de préparation envoyé au magasinier du bon dépôt.</p>
                </div>
                <div class="workflow-step">
                    <div class="step-num">4</div>
                    <h4>Livraison & BL</h4>
                    <p>Camion en route, BL signé à la réception par le client.</p>
                </div>
                <div class="workflow-step">
                    <div class="step-num">5</div>
                    <h4>Encaissement</h4>
                    <p>Règlement enregistré (espèces, traite, chèque, virement).</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  TÉMOIGNAGES                                            -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Ils nous font confiance</div>
        <h2 class="section-title">Des distributeurs tunisiens nous parlent</h2>
        <p class="section-subtitle">
            Plus de 50 fournisseurs et distributeurs ont remplacé leurs feuilles Excel et leurs carnets par Simplex Gestion. Voici ce qu'ils en disent.
        </p>

        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p>« Avant, mes commerciaux revenaient le soir avec des bons sur papier que ma secrétaire ressaisissait toute la nuit. Aujourd'hui, dès que la commande est validée chez le client, elle est dans le système. J'ai gagné une journée par semaine. »</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">RT</div>
                    <div>
                        <div class="name">Riadh Trabelsi</div>
                        <div class="role">Gérant — Distribution alimentaire, Sfax</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>« Les grilles tarifaires ont changé ma vie. J'ai 3 niveaux de prix selon le client et la quantité. Plus aucune erreur de facturation, plus aucune perte de marge. C'est juste impeccable. »</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">SM</div>
                    <div>
                        <div class="name">Sami Mahjoubi</div>
                        <div class="role">Directeur commercial — Grossiste boissons, Tunis</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>« Je vois en temps réel les impayées, à quelle date. Mon recouvrement s'est amélioré. »</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">FB</div>
                    <div>
                        <div class="name">Fatma Bouzid</div>
                        <div class="role">Responsable financière — Distribution cosmétiques, Sousse</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  FAQ                                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Questions fréquentes</div>
            <h2 class="section-title">Tout ce que vous voulez savoir avant de démarrer</h2>
            <p class="section-subtitle">
                Une équipe d'experts est disponible 7j/7 pour répondre à vos questions.
            </p>

            <div class="faq-list">
                <div class="faq-item">
                    <h4>Combien de temps faut-il pour démarrer ?</h4>
                    <p>Vous pouvez créer votre compte en moins de 5 minutes et émettre votre première facture le jour même. Notre équipe vous accompagne pour importer votre catalogue produits, vos clients et votre historique en moins d'une journée.</p>
                </div>
                <div class="faq-item">
                    <h4>Est-ce que les factures sont conformes à la loi de finances tunisienne ?</h4>
                    <p>Oui, à 100%. Nos modèles de factures intègrent toutes les mentions obligatoires.</p>
                </div>
                <div class="faq-item">
                    <h4>Mes commerciaux peuvent-ils utiliser Simplex sur le terrain, sans connexion internet ?</h4>
                    <p>Non.</p>
                </div>
                <div class="faq-item">
                    <h4>Puis-je gérer plusieurs dépôts dans une seule plateforme ?</h4>
                    <p>Bien sûr. Simplex Gestion est nativement multi-dépôt et multi-points de vente. Vous gérez les transferts internes, les inventaires séparés et les rapports consolidés sans aucune limite sur le nombre d'emplacements.</p>
                </div>
                <div class="faq-item">
                    <h4>Je veux exporter mes données pour mon comptable ?</h4>
                    <p>Tout s'exporte en un clic : ventes, achats, encaissements, journaux comptables. Les formats CSV, Excel et PDF sont compatibles avec les logiciels de comptabilité utilisés en Tunisie. Votre comptable vous remerciera.</p>
                </div>
                <div class="faq-item">
                    <h4>Est-ce que mes données sont sécurisées ?</h4>
                    <p>Absolument. Vos données sont chiffrées, sauvegardées quotidiennement et hébergées sur des serveurs sécurisés. Vous restez propriétaire de vos données à tout moment et pouvez les exporter quand vous le souhaitez.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  CTA                                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="cta-section">
        <h2>Reprenez le contrôle de votre activité de distribution</h2>
        <p>
            Rejoignez les centaines de fournisseurs, grossistes et distributeurs tunisiens qui pilotent leurs ventes, leur stock et leur trésorerie avec Simplex Gestion. Démarrez aujourd'hui, sans engagement.
        </p>
        <div class="cta-buttons">
            <a href="/business/register" style="text-decoration: none" class="btn-primary">Démarrer gratuitement</a>
            <a href="https://wa.me/21693796501" style="text-decoration: none" class="btn-outline">Demander une démo</a>
        </div>
        <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
            <span style="font-size:0.85rem; color:white;">✓ Aucune carte bancaire requise</span>
            <span style="font-size:0.85rem; color:white;">✓ Interface en français & arabe</span>
            <span style="font-size:0.85rem; color:white;">✓ Support client 7j/7</span>
            <span style="font-size:0.85rem; color:white;">✓ Données hébergées en sécurité</span>
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
