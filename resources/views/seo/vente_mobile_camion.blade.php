<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Logiciel de vente en camion & vente terrain en Tunisie | Simplex Gestion</title>

    <meta name="description"
          content="Gérez vos ventes en camion et votre équipe terrain avec Simplex Gestion : stock par véhicule, transferts depuis l'entrepôt, ventes, clients, encaissements et dépenses synchronisés en temps réel.">

    <meta property="og:title"
          content="Vente en camion & vente terrain : gérez chaque véhicule comme un point de vente mobile">

    <meta property="og:description"
          content="Chaque camion possède son propre stock et son activité commerciale. Suivez les ventes, clients, encaissements et dépenses en temps réel avec Simplex Gestion.">

    <meta name="twitter:title"
          content="Logiciel de vente en camion & vente terrain | Simplex Gestion">

    <meta name="twitter:description"
          content="Stock par véhicule, ventes, clients, encaissements et dépenses synchronisés en temps réel.">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Logiciel de vente en camion et vente terrain",
            "serviceType": "Logiciel de gestion commerciale",
            "description": "Solution de gestion commerciale pour les entreprises qui vendent et distribuent sur le terrain avec des camions ou véhicules commerciaux. Gestion du stock par véhicule, transferts de stock, ventes, clients, encaissements et dépenses en temps réel.",
            "areaServed": "TN",
            "audience": {
                "@type": "BusinessAudience",
                "audienceType": "Fournisseurs, Grossistes, Distributeurs et entreprises de vente terrain"
            },
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

        .hero p { max-width: 800px; margin: 0 auto 40px; font-size: 1.15rem; color: var(--text-light); }
        .hero-cta { margin-top: 36px; display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; }

        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }
        .section-alt .section { margin: 0 auto; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--accent); margin-bottom: 16px;
        }

        .section-tag::before {
            content: ''; display: inline-block; width: 24px; height: 2px;
            background: var(--accent); border-radius: 2px;
        }

        .section-title { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; line-height: 1.25; margin-bottom: 16px; }
        .section-subtitle { font-size: 1.05rem; color: var(--text-light); max-width: 700px; margin-bottom: 56px; }

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

        .mock-row {
            display: grid; grid-template-columns: 90px 1fr 100px 95px;
            gap: 8px; padding: 9px 12px; font-size: 0.8rem;
            border-radius: 6px; margin-bottom: 2px; align-items: center;
        }

        .mock-row.header {
            color: var(--text-muted); font-size: 0.72rem;
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;
            border-bottom: 1px solid var(--dark-border); border-radius: 0; margin-bottom: 4px;
        }

        .mock-row:hover { background: rgba(41,72,255,0.06); }
        .mock-row .date { color: var(--text-muted); font-size: 0.72rem; }
        .mock-row .facture { color: var(--primary); font-weight: 600; }
        .mock-row .client { font-weight: 500; }
        .mock-row .montant { font-weight: 600; }

        .badge { display: inline-block; padding: 2px 9px; border-radius: 100px; font-size: 0.7rem; font-weight: 700; }
        .badge-green  { background: var(--badge-green-bg); color: var(--badge-green-text); }
        .badge-orange { background: var(--badge-orange-bg); color: var(--badge-orange-text); }
        .badge-blue   { background: rgba(41,72,255,0.12); color: var(--primary); }

        .mobile-device {
            background: linear-gradient(145deg, #f8fafc, #eef3ff);
            border: 1px solid var(--dark-border);
            border-radius: 28px;
            padding: 10px;
            max-width: 330px;
            margin: 0 auto;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.10);
        }

        .mobile-device .screen {
            background: #fff;
            border: 1px solid var(--dark-border);
            border-radius: 21px;
            overflow: hidden;
        }

        .phone-head {
            padding: 14px 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .phone-title { font-size: 0.88rem; font-weight: 800; }
        .phone-meta { font-size: 0.7rem; color: var(--text-muted); }
        .phone-body { padding: 14px; }

        .phone-card {
            background: #f8fafc;
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .phone-card .label { font-size: 0.68rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; }
        .phone-card .value { font-size: 1rem; font-weight: 800; margin-top: 3px; }
        .phone-line { display:flex; justify-content:space-between; gap:12px; font-size:0.76rem; padding:8px 0; border-bottom:1px solid var(--dark-border); }
        .phone-line:last-child { border-bottom:none; }

        .transfer-flow {
            display: grid; grid-template-columns: 1fr 100px 1fr; gap: 18px; align-items: center;
            margin-top: 34px;
        }

        .transfer-node {
            background: #fff; border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 24px; text-align: center;
        }

        .transfer-node .node-icon {
            width: 50px; height: 50px; border-radius: 14px;
            margin: 0 auto 12px;
            display:flex; align-items:center; justify-content:center; font-size:1.5rem;
        }

        .node-blue { background: rgba(41,72,255,0.12); }
        .node-green { background: rgba(16,185,129,0.12); }
        .transfer-node h4 { font-size: 0.95rem; font-weight: 800; margin-bottom: 6px; }
        .transfer-node p { font-size: 0.8rem; color: var(--text-muted); margin: 0; }

        .transfer-arrow {
            text-align:center; color:var(--primary); font-size:2rem; font-weight:700;
        }

        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        .metric-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 24px; }
        .metric-card .metric-label { font-size: 0.78rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.07em; font-weight: 600; margin-bottom: 10px; }
        .metric-card .metric-value { font-size: 1.7rem; font-weight: 800; margin-bottom: 6px; }
        .metric-card .metric-trend { font-size: 0.8rem; color: var(--accent); }
        .color-blue { color: var(--primary); }
        .color-green { color: var(--accent); }
        .color-orange { color: #f59e0b; }
        .color-purple { color: #7c3aed; }

        .workflow-steps {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0; position: relative; margin: 48px 0;
        }

        .workflow-step { padding: 28px 20px; text-align: center; position: relative; }
        .workflow-step:not(:last-child)::after {
            content: '→'; position: absolute; right: -10px; top: 36px;
            font-size: 1.2rem; color: var(--primary); font-weight: 300;
        }

        .step-num {
            width: 40px; height: 40px;
            background: rgba(26,107,250,0.15); border: 2px solid rgba(26,107,250,0.4);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: var(--primary); font-size: 0.9rem; margin: 0 auto 16px;
        }

        .workflow-step h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 8px; }
        .workflow-step p  { font-size: 0.82rem; color: var(--text-muted); }

        .faq-list { display: flex; flex-direction: column; gap: 12px; max-width: 900px; margin: 0 auto; }
        .faq-item { background: #ffffff; border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 20px 24px; }
        .faq-item h4 { font-size: 1rem; font-weight: 700; margin-bottom: 10px; color: var(--text-main); }
        .faq-item p  { font-size: 0.9rem; color: var(--text-light); }

        .cta-section {
            padding: 80px 24px; text-align: center;
            background: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            color: #fff;
        }

        .cta-section h2 { font-size: clamp(1.6rem, 3.5vw, 2.4rem); font-weight: 800; margin-bottom: 16px; }
        .cta-section p { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 640px; margin: 0 auto 36px; }
        .cta-buttons { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

        .btn-primary {
            background: var(--primary); color: #fff; border: none; padding: 14px 32px;
            border-radius: 8px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: background 0.2s;
        }

        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline {
            background: transparent; color: var(--dark); border: 2px solid #e2e8f0;
            padding: 14px 32px; border-radius: 8px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: border-color 0.2s;
        }
        .btn-outline:hover { border-color: var(--dark); background: var(--dark); color: #fff; }

        .cta-section .btn-outline { border-color: rgba(255,255,255,0.85); color: #fff; }
        .cta-section .btn-outline:hover { background: #fff; color: var(--primary); border-color: #fff; }

        .divider { height: 1px; background: #e2e8f0; margin: 0; }

        .highlight-box {
            background: rgba(41,72,255,0.06);
            border: 1px solid rgba(41,72,255,0.14);
            border-radius: var(--radius);
            padding: 24px 26px;
            margin-top: 28px;
        }
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

        .highlight-box strong { color: var(--primary); }
        .highlight-box p { margin:0; color:var(--text-light); font-size:0.92rem; }

        /* CAMIONS = DÉPÔTS MOBILES */
        .truck-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-top: 32px; }
        .truck-card {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 24px;
            border-top: 4px solid var(--primary);
        }
        .rv-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--dark-border); font-size: 0.83rem; }
        .rv-row:last-child { border-bottom: none; }
        .rv-row .rv-label { color: var(--text-muted); }
        .rv-row .rv-val { font-weight: 600; }
        .rv-row .rv-val.red { color: #b91c1c; }
        .rv-row .rv-val.green { color: var(--accent); }

        .truck-card .truck-name { font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 14px; display:flex; align-items:center; gap:8px; }
        .truck-card .truck-live { display:inline-flex; align-items:center; gap:6px; font-size:0.72rem; color:var(--accent); font-weight:700; }
        .truck-card .truck-live::before { content:''; width:8px; height:8px; border-radius:50%; background:var(--accent); animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:0.35; } }
        .truck-card .truck-stats { display: flex; flex-direction: column; gap: 8px; margin-top: 14px; }
        .truck-card .truck-stat { display: flex; justify-content: space-between; font-size: 0.85rem; padding: 7px 0; border-bottom: 1px dashed var(--dark-border); }
        .truck-card .truck-stat:last-child { border-bottom: none; }
        .truck-card .truck-stat .ts-label { color: var(--text-muted); }
        .truck-card .truck-stat .ts-val { font-weight: 700; }


        .tab-content-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        @media (max-width: 768px) { .tab-content-grid { grid-template-columns: 1fr; } }
        .tab-feature-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 22px; }
        .tab-feature-card .tfc-icon { font-size: 1.3rem; margin-bottom: 12px; }
        .tab-feature-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .tab-feature-card p  { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }


        @media (max-width: 768px) {
            .transfer-flow { grid-template-columns: 1fr; }
            .transfer-arrow { transform: rotate(90deg); }
            .workflow-step:not(:last-child)::after { display:none; }
        }

        @media (max-width: 640px) {
            .feature-row { gap: 32px; }
            .mock-row { grid-template-columns: 1fr 1fr 1fr; }
            .mock-row > *:nth-child(4) { display: none; }
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

    <!-- HERO -->
    <section class="hero">
        <div class="hero-label">Vente en camion · Vente terrain · Distribution</div>

        <h1>
            Gérez vos ventes en camion
            <br>
            comme un <span>point de vente mobile</span>
        </h1>

        <p>
            Vos commerciaux vendent directement chez les clients ? Chaque camion peut disposer de son propre stock,
            réaliser ses ventes et enregistrer ses encaissements et dépenses, pendant que l'administration conserve
            une vision centralisée de l'activité.
        </p>

        <div class="hero-cta">
            <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
            <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
        </div>
    </section>

    <div class="divider"></div>

    <!-- POSITIONING -->
    <section class="section">
        <div class="section-tag">Pensé pour la vente terrain</div>
        <h2 class="section-title">Un seul système pour le dépôt, les camions et les magasins</h2>
        <p class="section-subtitle">
            Le vrai besoin d'une équipe de distribution n'est pas forcément de planifier chaque tournée.
            Il est souvent plus simple : donner au commercial le bon stock, lui permettre de vendre chez le client,
            suivre les mouvements et garder les chiffres visibles depuis l'administration.
        </p>

        <div class="overview-grid">
            <div class="overview-card">
                <div class="card-icon icon-blue">🚚</div>
                <h3>Synchronisation temps réel</h3>
                <p>
                    Une vente faite à Sfax est visible instantanément à Tunis. Plus besoin d'attendre le soir pour connaître vos chiffres.
                </p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-green">🔄</div>
                <h3>Transfert de stock</h3>
                <p>
                    Chargez un camion depuis le dépôt central via un bon de transfert classique. Le stock quitte un entrepôt et entre dans un autre, traçabilité incluse.
                </p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-purple">🧾</div>
                <h3>Ventes depuis le mobile</h3>
                <p>
                    Le commercial peut créer ses devis et ventes depuis un smartphone ou une tablette, chez le client,
                    avec recherche produit, prix et remises.
                </p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-orange">💵</div>
                <h3>Encaissements sur le terrain</h3>
                <p>
                    Enregistrez les paiements en espèces, avances, chèques, virements, traites ou paiements multiples
                    et suivez le reste à percevoir.
                </p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-cyan">💸</div>
                <h3>Dépenses du commercial</h3>
                <p>
                    Carburant, entretien, péages : rattachez chaque dépense au véhicule concerné pour connaître son coût réel d'exploitation.
                </p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-red">🏷️</div>
                <h3>Multi-tarifs & grilles de prix</h3>
                <p>
                    Prix Gros, Demi-Gros, Détail. Le bon tarif est appliqué automatiquement selon la catégorie du client — zéro erreur de prix.
                </p>
            </div>
        </div>
    </section>

    <div class="divider"></div>



    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  TRANSFERT DE STOCK VERS LE CAMION                      -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Chargement du véhicule</div>
                <h3>Transférez le stock du dépôt vers le camion en quelques clics</h3>
                <p>
                    Avant chaque tournée, transférez les articles nécessaires du dépôt central vers l'entrepôt mobile du camion. Le stock est déduit d'un côté et ajouté de l'autre instantanément — aucune double saisie, aucune estimation à l'œil.
                </p>
                <ul class="feature-list">
                    <li>Bon de transfert</li>
                    <li>Sélection des articles par nom, référence ou code-barres</li>
                    <li>Quantités déduites du dépôt d'origine et ajoutées au camion en temps réel</li>
                    <li>Historique complet des transferts par véhicule et par date</li>
                </ul>
            </div>
            <div>
                <div class="form-mock">
                    <h4>Nouveau transfert de stock</h4>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Entrepôt source</label>
                            <div class="faux-input">Dépôt Central</div>
                        </div>
                        <div class="form-field">
                            <label>Entrepôt destination</label>
                            <div class="faux-input blue">Camion 01 — Sfax</div>
                        </div>
                    </div>
                    <div class="product-line">
                        <div class="product-line-header">
                            <span>Produit</span><span>Qté</span><span>P.U.</span><span>Unité</span><span>Total</span>
                        </div>
                        <div class="product-line-body">
                            <div>Produit A</div><div>50</div><div>12.500</div><div>Carton</div><div>625.000</div>
                        </div>
                    </div>
                    <div class="total-block">
                        <div class="label">Valeur du transfert</div>
                        <div class="amount">TND 625.000</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- MOBILE SALES -->
    <div class="section-alt">
        <section class="section">
            <div class="feature-row">
                <div class="feature-content">
                    <div class="section-tag">Vendre en déplacement</div>
                    <h3>Le commercial vend depuis la marchandise chargée dans son camion</h3>
                    <p>Le commercial ouvre Simplex Gestion sur sa tablette ou son smartphone, sélectionne le client, ajoute les produits déjà présents dans le stock du camion et encaisse sur place. </p>
                    <ul class="feature-list">
                        <li>Transfert de stock dépôt → camion avec bon de transfert traçable</li>
                        <li>Stock du camion décrémenté à chaque vente, en temps réel</li>
                        <li>Ventes rattachées au camion et au commercial qui les a passées</li>
                        <li>Dépenses de route (carburant, péages, frais) enregistrées par camion</li>
                        <li>Retour de marchandise non vendue par transfert inverse en fin de journée</li>
                    </ul>
                </div>
                <div>
                    <div class="form-mock">
                        <h4>Camion 03 — Karim (route Sfax)</h4>
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px; margin-bottom:16px;">
                            <div style="background:#f8fafc; border:1px solid var(--dark-border); border-radius:8px; padding:14px;">
                                <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Stock camion</div>
                                <div style="font-size:1.25rem; font-weight:800; margin-top:6px;">42 références</div>
                            </div>
                            <div style="background:#dcfce7; border:1px solid #bbf7d0; border-radius:8px; padding:14px;">
                                <div style="font-size:0.72rem; color:#15803d; text-transform:uppercase; font-weight:600;">Ventes du jour</div>
                                <div style="font-size:1.25rem; font-weight:800; color:#15803d; margin-top:6px;">TND 3 240.500</div>
                            </div>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Chargement matin (TR-0158)</span>
                            <span class="rv-val">TND 8 500.000</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Ventes facturées (7 clients)</span>
                            <span class="rv-val green">- TND 3 240.500</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Encaissements espèces</span>
                            <span class="rv-val green">TND 1 900.000</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Traites reçues</span>
                            <span class="rv-val">TND 1 340.500</span>
                        </div>
                        <div class="rv-row">
                            <span class="rv-label">Dépenses (carburant, péages)</span>
                            <span class="rv-val red">- TND 85.000</span>
                        </div>
                        <div class="rv-row" style="font-weight:700;">
                            <span class="rv-label" style="color:var(--text-main);">Valeur marchandise restante</span>
                            <span class="rv-val" style="color:var(--primary);">TND 5 174.500</span>
                        </div>
                    </div>
                </div>
            </div>
                <div class="truck-grid">
                    <div class="truck-card">
                        <div class="truck-name">🚚 Dépôt central — Tunis <span class="truck-live">En direct</span></div>
                        <div class="truck-stats">
                            <div class="truck-stat"><span class="ts-label">Stock actuel</span><span class="ts-val">TND 148 200.000</span></div>
                            <div class="truck-stat"><span class="ts-label">Transferts vers camions (aujourd'hui)</span><span class="ts-val">4</span></div>
                        </div>
                    </div>
                    <div class="truck-card">
                        <div class="truck-name">🚛 Camion 01 — Ahmed <span class="truck-live">En direct</span></div>
                        <div class="truck-stats">
                            <div class="truck-stat"><span class="ts-label">Stock chargé restant</span><span class="ts-val">TND 6 830.000</span></div>
                            <div class="truck-stat"><span class="ts-label">Ventes du jour</span><span class="ts-val">TND 2 410.000</span></div>

                        </div>
                    </div>
                    <div class="truck-card">
                        <div class="truck-name">🚛 Camion 03 — Karim <span class="truck-live">En direct</span></div>
                        <div class="truck-stats">
                            <div class="truck-stat"><span class="ts-label">Stock chargé restant</span><span class="ts-val">TND 5 174.500</span></div>
                            <div class="truck-stat"><span class="ts-label">Ventes du jour</span><span class="ts-val">TND 3 240.500</span></div>
                        </div>
                    </div>
                </div>

        </section>
    </div>

    <div class="divider"></div>

    <!-- REAL TIME -->
    <div class="section-alt">
        <section class="section">
            <div class="feature-row reverse">
                <div class="feature-content">
                    <div class="section-tag">Suivi en temps réel</div>
                    <h3>Vous n'attendez pas le retour du camion pour savoir ce qui s'est vendu</h3>

                    <p>
                        Lorsqu'une opération est enregistrée dans Simplex, l'administration peut suivre l'activité
                        depuis la plateforme centrale : ventes, paiements, stock et dépenses, selon les données
                        disponibles sur chaque camion.
                    </p>

                    <ul class="feature-list">
                        <li>Ventes rattachées à l'emplacement qui les réalise</li>
                        <li>Stock consultable par camion</li>
                        <li>Suivi des paiements et du reste à percevoir</li>
                        <li>Suivi des dépenses du commercial</li>
                        <li>Rapports consolidés ou filtrés par camion</li>
                        <li>Activité centralisée dans une seule plateforme</li>
                    </ul>
                </div>

                <div>
                    <div class="mock-screen">
                        <div class="mock-topbar">
                            <div class="dot dot-red"></div>
                            <div class="dot dot-yellow"></div>
                            <div class="dot dot-green"></div>
                            <span class="title">Activité terrain — Simplex Gestion</span>
                        </div>

                        <div class="mock-body">
                            <div class="mock-row header">
                                <div>Heure</div><div>Opération</div><div>Montant</div><div>Statut</div>
                            </div>

                            <div class="mock-row">
                                <div class="date">09:14</div>
                                <div class="client">Vente — T-04</div>
                                <div class="montant">420.000</div>
                                <div><span class="badge badge-green">Payée</span></div>
                            </div>

                            <div class="mock-row">
                                <div class="date">10:37</div>
                                <div class="client">Vente — T-02</div>
                                <div class="montant">685.500</div>
                                <div><span class="badge badge-green">Payée</span></div>
                            </div>

                            <div class="mock-row">
                                <div class="date">11:22</div>
                                <div class="client">Acompte — T-04</div>
                                <div class="montant">250.000</div>
                                <div><span class="badge badge-orange">Partiel</span></div>
                            </div>

                            <div class="mock-row">
                                <div class="date">12:05</div>
                                <div class="client">Dépense — T-02</div>
                                <div class="montant">35.000</div>
                                <div><span class="badge badge-blue">Enregistrée</span></div>
                            </div>

                            <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--dark-border);display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                                <div style="background:#f8fafc;border:1px solid var(--dark-border);border-radius:8px;padding:12px;">
                                    <div style="font-size:0.68rem;color:var(--text-muted);text-transform:uppercase;font-weight:700;">CA terrain</div>
                                    <div style="font-size:1.2rem;font-weight:800;color:var(--primary);margin-top:4px;">TND 8 450</div>
                                </div>
                                <div style="background:#f8fafc;border:1px solid var(--dark-border);border-radius:8px;padding:12px;">
                                    <div style="font-size:0.68rem;color:var(--text-muted);text-transform:uppercase;font-weight:700;">Camions actifs</div>
                                    <div style="font-size:1.2rem;font-weight:800;color:var(--accent);margin-top:4px;">8</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- PRICE AND CUSTOMER -->
    <section class="section">
        <div class="section-tag">Prix & clients</div>
        <h2 class="section-title">Le commercial retrouve les mêmes règles de vente sur le terrain</h2>
        <p class="section-subtitle">
            Un client n'a pas toujours le même prix qu'un autre. Simplex permet d'utiliser des grilles tarifaires
            personnalisées et de gérer le cycle devis → vente, avec les informations du client au même endroit.
        </p>

        <div class="overview-grid">
            <div class="overview-card">
                <div class="card-icon icon-blue">💰</div>
                <h3>Prix gros / demi-gros / détail</h3>
                <p>Appliquez la grille tarifaire correspondant au profil du client ou choisissez-la manuellement.</p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-purple">📄</div>
                <h3>Devis → facture</h3>
                <p>Préparez une proposition chez le client puis transformez-la en vente définitive sans ressaisir les données.</p>
            </div>

            <div class="overview-card">
                <div class="card-icon icon-orange">💳</div>
                <h3>Crédit & encaissements</h3>
                <p>Suivez le payé, le restant dû et les règlements différés selon les conditions définies.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- DAILY OPERATIONS -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Une journée dans Simplex</div>
            <h2 class="section-title">Du chargement du camion au bilan de la journée</h2>
            <p class="section-subtitle">
                Le parcours peut rester simple : le dépôt alimente le véhicule, le commercial vend et encaisse,
                puis la direction retrouve les opérations dans la même base.
            </p>

            <div class="workflow-steps">
                <div class="workflow-step">
                    <div class="step-num">1</div>
                    <h4>Chargement du camion</h4>
                    <p>Transfert de stock du dépôt central vers le camion concerné.</p>
                </div>

                <div class="workflow-step">
                    <div class="step-num">2</div>
                    <h4>Vente sur le terrain</h4>
                    <p>Facturation depuis le stock du camion, sur tablette ou smartphone.</p>
                </div>

                <div class="workflow-step">
                    <div class="step-num">3</div>
                    <h4>Encaissement</h4>
                    <p>Espèces, traite, chèque ou mixte. Le règlement est enregistré sur place et visible au bureau immédiatement..</p>
                </div>

                <div class="workflow-step">
                    <div class="step-num">4</div>
                    <h4>Dépenses de route</h4>
                    <p>Carburant, péages, petites dépenses : photographiées et enregistrées, rattachées au camion.</p>
                </div>
                <div class="workflow-step">
                    <div class="step-num">5</div>
                    <h4>Retour & retour stock</h4>
                    <p>La marchandise non vendue repart en transfert inverse vers le dépôt. Le compte du camion est soldé.</p>
                </div>
            </div>

            <div class="tab-content-grid">
                <div class="tab-feature-card">
                    <div class="tfc-icon">🧾</div>
                    <h4>Facture conforme imprimée chez le client</h4>
                    <p>Imprimez le BL ou la facture sur une petite imprimante portable Bluetooth, ou envoyez-la par WhatsApp au client avant même de repartir.</p>
                </div>
                <div class="tab-feature-card">
                    <div class="tfc-icon">💳</div>
                    <h4>Encaissements mixtes</h4>
                    <p>Un client paie une partie en espèces et le solde par traite à 30 jours ? Simplex gère les paiements multiples sur une même facture.</p>
                </div>
                <div class="tab-feature-card">
                    <div class="tfc-icon">👁️</div>
                    <h4>Le bureau voit tout, en direct</h4>
                    <p>Ventes par commercial, encaissements du jour, stock restant dans chaque camion : votre tableau de bord se met à jour à chaque opération.</p>
                </div>
            </div>

        </section>
    </div>

    <div class="divider"></div>

    <!-- CTA -->
    <section class="cta-section">
        <h2>Donnez à vos commerciaux un outil à la hauteur du terrain</h2>
        <p>
            Du dépôt au camion, de la vente au paiement, centralisez votre activité de distribution avec Simplex Gestion.
            Chaque véhicule peut fonctionner comme un emplacement commercial mobile, tout en restant piloté depuis une seule plateforme.
        </p>

        <div class="cta-buttons">
            <a href="/business/register" style="text-decoration: none" class="btn-primary">Démarrer gratuitement</a>
            <a href="https://wa.me/21693796501" style="text-decoration: none" class="btn-outline">Demander une démo</a>
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
