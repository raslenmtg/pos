<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simplex Gestion – Logiciel gestion commerciale pour Détaillants & Commerces</title>
    <meta name="description" content="Simplex Gestion : logiciel gestion commerciale complet pour détaillants. Gestion de stock, Multi-emplacement, clients fidélité, et rapports en temps réel. Essai gratuit.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Simplex Gestion – Logiciel gestion commerciale pour Détaillants">
    <meta property="og:description" content="Logiciel gestion commerciale pour détaillants. Multi-emplacement, fidélité client, et rapports détaillés.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:locale" content="fr_FR">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Simplex Gestion – Logiciel gestion commerciale pour Détaillants">
    <meta name="twitter:description" content="Logiciel de gestion commerciale pour détaillants. Gestion de stock, ventes multi-emplacement, fidélité client et rapports en temps réel.">
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "name": "Simplex Gestion - gestion commerciale pour Détaillants",
      "description": "Gestion commerciale complet pour gestion de caisse, ventes, stock, achats et clients pour détaillants tunisiens.",
      "provider": {
        "@type": "Organization",
        "name": "Simplex Gestion",
        "url": "https://simplexgestion.tn"
      },
      "areaServed": "TN",
      "serviceType": "Point of Sale Software"
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
            --warm: #f59e0b;
            --warm-bg: #fff7ed;
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

        .badge { display: inline-block; padding: 2px 9px; border-radius: 100px; font-size: 0.7rem; font-weight: 700; }
        .badge-green  { background: var(--badge-green-bg); color: var(--badge-green-text); }
        .badge-orange { background: var(--badge-orange-bg); color: var(--badge-orange-text); }
        .badge-red    { background: rgba(239,68,68,0.15); color: #b91c1c; }
        .badge-blue   { background: rgba(41,72,255,0.12); color: var(--primary); }
        .mock-actions { display: flex; gap: 6px; flex-wrap: wrap; }
        .mock-btn {
            padding: 5px 12px; border-radius: 5px; font-size: 0.73rem; font-weight: 600;
            border: 1px solid var(--dark-border); background: transparent; color: var(--text-muted); cursor: default;
        }
        .mock-btn.primary { background: var(--primary); color: #fff; border-color: var(--primary); }

        /* ─── POS SCREEN MOCK ─────────────────────────────── */
        .pos-screen {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius); overflow: hidden;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.10);
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            min-height: 460px;
        }
        @media (max-width: 768px) { .pos-screen { grid-template-columns: 1fr; } }
        .pos-products {
            padding: 18px;
            background: #f8fafc;
            border-right: 1px solid var(--dark-border);
        }
        .pos-search {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 8px; padding: 10px 14px; font-size: 0.85rem;
            color: var(--text-muted); margin-bottom: 14px;
            display: flex; align-items: center; gap: 10px;
        }
        .pos-product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .pos-product {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 8px; padding: 10px; text-align: center;
            font-size: 0.74rem; cursor: default;
        }
        .pos-product .pp-name { font-weight: 600; color: var(--text-main); margin-bottom: 4px; line-height: 1.3; }
        .pos-product .pp-price { color: var(--primary); font-weight: 700; font-size: 0.8rem; }
        .pos-product.cat { background: linear-gradient(135deg, rgba(41,72,255,0.08), rgba(56,178,245,0.06)); border-color: rgba(41,72,255,0.2); }

        .pos-cart { padding: 18px; display: flex; flex-direction: column; }
        .pos-cart-header { font-size: 0.78rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.06em; margin-bottom: 12px; }
        .pos-cart-items { flex: 1; }
        .pos-cart-row { display: grid; grid-template-columns: 1fr 30px 80px; gap: 8px; padding: 8px 0; border-bottom: 1px solid var(--dark-border); font-size: 0.82rem; align-items: center; }
        .pos-cart-row .pcr-name { color: var(--text-main); font-weight: 500; }
        .pos-cart-row .pcr-qty { color: var(--text-muted); text-align: center; }
        .pos-cart-row .pcr-total { color: var(--text-main); font-weight: 700; text-align: right; }
        .pos-cart-totals { margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--dark-border); }
        .pos-total-row { display: flex; justify-content: space-between; font-size: 0.82rem; padding: 4px 0; }
        .pos-total-row.grand { font-size: 1.1rem; font-weight: 800; color: var(--primary); padding-top: 8px; border-top: 1px solid var(--dark-border); margin-top: 6px; }
        .pos-pay-btn {
            margin-top: 14px; background: var(--accent); color: #fff;
            border-radius: 8px; padding: 12px; text-align: center;
            font-weight: 700; font-size: 0.9rem;
        }

        /* ─── TICKET MOCK ─────────────────────────────────── */
        .ticket {
            background: #ffffff; border: 1px dashed var(--dark-border);
            border-radius: 6px; padding: 18px;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem; max-width: 280px; margin: 0 auto;
            color: var(--text-main);
        }
        .ticket-header { text-align: center; border-bottom: 1px dashed var(--dark-border); padding-bottom: 10px; margin-bottom: 10px; }
        .ticket-header strong { font-size: 0.95rem; }
        .ticket-line { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .ticket-total { border-top: 1px dashed var(--dark-border); margin-top: 8px; padding-top: 8px; font-weight: 700; }
        .ticket-footer { text-align: center; margin-top: 12px; padding-top: 10px; border-top: 1px dashed var(--dark-border); font-size: 0.72rem; color: var(--text-muted); }

        /* ─── PAYMENT METHODS ─────────────────────────────── */
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

        /* ─── METRICS ─────────────────────────────────────── */
        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top: 16px; }
        .metric-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 24px; }
        .metric-card .metric-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.07em; font-weight: 600; margin-bottom: 10px; }
        .metric-card .metric-value { font-size: 1.85rem; font-weight: 800; margin-bottom: 6px; }
        .metric-card .metric-trend { font-size: 0.8rem; color: var(--accent); }
        .color-blue   { color: var(--primary); }
        .color-green  { color: var(--accent); }
        .color-purple { color: #a78bfa; }
        .color-orange { color: var(--warm); }

        /* ─── WORKFLOW ────────────────────────────────────── */
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

        /* ─── LOYALTY CARD ────────────────────────────────── */
        .loyalty-card-mock {
            background: linear-gradient(135deg, var(--primary), #38b2f5);
            color: #fff; border-radius: var(--radius); padding: 26px;
            box-shadow: 0 18px 40px rgba(41,72,255,0.25);
            position: relative; overflow: hidden;
        }
        .loyalty-card-mock::before {
            content: ''; position: absolute; right: -40px; top: -40px;
            width: 180px; height: 180px;
            background: rgba(255,255,255,0.08); border-radius: 50%;
        }
        .loyalty-card-mock .lc-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.85; }
        .loyalty-card-mock .lc-name { font-size: 1.2rem; font-weight: 800; margin-top: 4px; }
        .loyalty-card-mock .lc-points { font-size: 2.2rem; font-weight: 800; margin: 16px 0 4px; position: relative; z-index: 1; }
        .loyalty-card-mock .lc-status { font-size: 0.82rem; opacity: 0.9; position: relative; z-index: 1; }
        .loyalty-card-mock .lc-progress { background: rgba(255,255,255,0.2); border-radius: 100px; height: 6px; margin-top: 12px; overflow: hidden; position: relative; z-index: 1; }
        .loyalty-card-mock .lc-progress-fill { background: #ffffff; height: 100%; width: 68%; border-radius: 100px; }

        /* ─── EXPORTS ─────────────────────────────────────── */
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

        /* ─── TABS / FEATURES ────────────────────────────── */
        .tabs-section { margin-top: 48px; }
        .tab-content-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        @media (max-width: 768px) { .tab-content-grid { grid-template-columns: 1fr; } }
        .tab-feature-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: var(--radius-sm); padding: 22px; }
        .tab-feature-card .tfc-icon { font-size: 1.3rem; margin-bottom: 12px; }
        .tab-feature-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .tab-feature-card p  { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        /* ─── DAILY CASH SUMMARY ──────────────────────────── */
        .daily-info {
            background: var(--dark-card); border: 1px solid var(--dark-border);
            border-radius: var(--radius); padding: 36px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;
        }
        @media (max-width: 768px) { .daily-info { grid-template-columns: 1fr; } }
        .daily-info h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 14px; }
        .daily-info p  { font-size: 0.95rem; color: var(--text-light); margin-bottom: 20px; }
        .daily-badge-list { display: flex; flex-wrap: wrap; gap: 8px; }
        .daily-badge {
            background: rgba(0,194,123,0.1); border: 1px solid rgba(0,194,123,0.25);
            color: var(--accent); padding: 5px 14px; border-radius: 100px;
            font-size: 0.8rem; font-weight: 600;
        }
        .daily-visual { background: #f8fafc; border: 1px solid var(--dark-border); border-radius: 10px; padding: 20px; }
        .rv-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--dark-border); font-size: 0.83rem; }
        .rv-row:last-child { border-bottom: none; }
        .rv-row .rv-label { color: var(--text-muted); }
        .rv-row .rv-val { font-weight: 600; }
        .rv-row .rv-val.red { color: #b91c1c; }
        .rv-row .rv-val.green { color: var(--accent); }

        /* ─── TESTIMONIALS ────────────────────────────────── */
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

        /* ─── FAQ ─────────────────────────────────────────── */
        .faq-list { display: flex; flex-direction: column; gap: 12px; max-width: 880px; margin: 0 auto; }
        .faq-item {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm); padding: 20px 24px;
        }
        .faq-item h4 { font-size: 1rem; font-weight: 700; margin-bottom: 10px; color: var(--text-main); }
        .faq-item p  { font-size: 0.9rem; color: var(--text-light); }

        /* ─── HARDWARE COMPATIBILITY ──────────────────────── */
        .hardware-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 32px; }
        .hardware-card {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm); padding: 22px; text-align: center;
        }
        .hardware-card .hw-icon { font-size: 2rem; margin-bottom: 10px; }
        .hardware-card h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 6px; }
        .hardware-card p { font-size: 0.8rem; color: var(--text-muted); }


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
        <div class="hero-label">Pour Détaillants</div>
        <h1>La caisse moderne<br><span>pour votre point de vente</span></h1>
        <p>
            Encaissez en moins de 10 secondes. Imprimez le ticket sur l'imprimante thermique. Suivez votre stock en temps réel. Fidélisez vos clients. Faites votre journée de caisse en deux clics. Simplex Gestion équipe les détaillants tunisiens avec une caisse rapide, simple et puissante — du comptoir au tableau de bord.
        </p>
        <div class="hero-stats">
            <div class="hero-stat"><strong>+1 200</strong><span>points de vente actifs</span></div>
            <div class="hero-stat"><strong>&lt; 10s</strong><span>par encaissement</span></div>
            <div class="hero-stat"><strong>100%</strong><span>conforme loi de finances</span></div>
            <div class="hero-stat"><strong>7j/7</strong><span>support en français & arabe</span></div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  POURQUOI                                               -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Pensé pour le comptoir</div>
        <h2 class="section-title">Caisse ultra rapide pour les environnements difficiles</h2>
        <p class="section-subtitle">
            Quand la file s'allonge, que le client veut un sachet en plus, que sa carte de fidélité ne marche pas et que l'imprimante bloque — votre logiciel ne doit pas être un obstacle. Simplex Gestion a été conçu avec des détaillants tunisiens, pour la réalité du terrain : vite, fiable, sans formation interminable.
        </p>

        <div class="overview-grid">
            <div class="overview-card">
                <div class="card-icon icon-blue">⚡</div>
                <h3>Encaissement éclair</h3>
                <p>Scannez un code-barres, tapez la quantité, encaissez. L'écran tactile, les raccourcis clavier et le scanner pistolet rendent chaque vente fluide, même aux heures de pointe.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-green">🖨️</div>
                <h3>Ticket de caisse imprimante thermique</h3>
                <p>Compatible avec toutes les imprimantes thermiques 58mm et 80mm du marché tunisien. Personnalisez votre logo, vos messages, vos infos légales.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-purple">🏪</div>
                <h3>Multi-caisses synchronisées</h3>
                <p>Plusieurs caisses dans le même magasin ? Plusieurs magasins dans plusieurs villes ? Tout est synchronisé en temps réel sur une plateforme cloud. Vos chiffres consolidés à la seconde.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-orange">🎁</div>
                <h3>Fidélité client intégrée</h3>
                <p>Programme de points, promotions personnalisées. Transformez vos clients de passage en clients réguliers.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-cyan">📦</div>
                <h3>Stock en temps réel</h3>
                <p>Chaque vente déduit automatiquement le stock. Alertes de rupture, suggestion de réapprovisionnement intelligent, inventaire mensuel rapide — vous ne vendez plus jamais ce que vous n'avez plus.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-red">📊</div>
                <h3>Journée de caisse </h3>
                <p>Ouverture de caisse avec fond initial, rapport caisse détaillé par mode de paiement. Votre comptable a toutes les pièces dont il a besoin.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  POS SCREEN MOCK                                        -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Écran de caisse</div>
            <h2 class="section-title">Une interface pensée pour aller vite</h2>
            <p class="section-subtitle">
                Tout ce qu'il faut, là où il faut. Catégories en grille, recherche instantanée, panier visible, total en gros, bouton d'encaissement vert. Aucune formation nécessaire — votre nouveau caissier est opérationnel en moins d'une heure.
            </p>

            <div class="pos-mock">
                <div class="pos-topbar">
                    <div class="dot dot-red"></div>
                    <div class="dot dot-yellow"></div>
                    <div class="dot dot-green"></div>
                    <span class="ttitle">Caisse — Simplex Gestion</span>
                </div>

                <!-- HEADER BAR -->
                <div class="pos-header-bar">
                    <div class="pill"><span style="color: var(--text-muted); --darkreader-inline-color: var(--darkreader-text--text-muted, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">Emplacement :</span> <strong>Ariana (A1)</strong> ▾</div>
                    <div class="pill date">📅 23/08/2024 20:32</div>
                    <span style="margin-left:auto"></span>
                    <div class="icon-btn ib-blue" title="Transactions récentes">⏪</div>
                    <div class="icon-btn ib-red" title="Fermer la caisse">⛔</div>
                    <div class="icon-btn ib-green" title="Détails caissier">📊</div>
                    <div class="icon-btn ib-green" title="Calculatrice">🖩</div>
                    <div class="icon-btn ib-orange" title="Retour de vente">↩️</div>
                    <div class="icon-btn ib-purple" title="Plein écran">⛶</div>
                    <div class="icon-btn ib-dark" title="Paramètres">⚙️</div>
                    <div class="pill" style="background: rgb(255, 255, 255); border: 1px solid var(--dark-border); cursor: pointer; --darkreader-inline-border-short: 1px solid var(--darkreader-border--dark-border); --darkreader-inline-bgimage: initial; --darkreader-inline-bgcolor: var(--darkreader-background-ffffff, #131516);" data-darkreader-inline-border-short="" data-darkreader-inline-bgimage="" data-darkreader-inline-bgcolor="">
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
                            <span style="font-size: 0.72rem; color: var(--text-muted); margin-left: auto; --darkreader-inline-color: var(--darkreader-text--text-muted, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">Type de prix :</span>
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
                                <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 6px; --darkreader-inline-color: var(--darkreader-text--text-muted, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">pièce ▾</div>
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
                                <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 6px; --darkreader-inline-color: var(--darkreader-text--text-muted, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">pièce ▾</div>
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
                                <span class="val" style="color: var(--accent); --darkreader-inline-color: var(--darkreader-text--accent, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">● Caisse ouverte</span>
                            </div>
                        </div>
                        <div class="cart-totals-row">
                            <span class="totlabel">Remise <span style="color: var(--pos); --darkreader-inline-color: var(--darkreader-text--pos, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">✎</span></span>
                            <span class="totval">− TND 0.000</span>
                        </div>
                        <div class="cart-totals-row">
                            <span class="totlabel">Taxe de commande <span style="color: var(--pos); --darkreader-inline-color: var(--darkreader-text--pos, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">✎</span></span>
                            <span class="totval">+ TND 1.000</span>
                        </div>
                        <div class="cart-totals-row">
                            <span class="totlabel">Expédition <span style="color: var(--pos); --darkreader-inline-color: var(--darkreader-text--pos, var(--darkreader-text-000000, #edebe8));" data-darkreader-inline-color="">✎</span></span>
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

            <div class="tabs-section">
                <div class="tab-content-grid">
                    <div class="tab-feature-card">
                        <div class="tfc-icon">⌨️</div>
                        <h4>Raccourcis clavier puissants</h4>
                        <p>Vos doigts mémorisent, votre vitesse explose.</p>
                    </div>
                    <div class="tab-feature-card">
                        <div class="tfc-icon">🛒</div>
                        <h4>Tickets en attente</h4>
                        <p>Le client a oublié son portefeuille à la voiture ? Mettez le ticket en attente, encaissez le client suivant, reprenez sans rien perdre.</p>
                    </div>
                    <div class="tab-feature-card">
                        <div class="tfc-icon">↩️</div>
                        <h4>Annulation et avoir</h4>
                        <p>Erreur de saisie ? Annulez la ligne d'un clic. Retour client ? Générez un avoir lié au ticket d'origine, valable en magasin.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  SCANNER & CODES-BARRES                                 -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Code-barres & étiquettes</div>
                <h3>Scannez. Encaissez. Suivant.</h3>
                <p>
                    Tous les scanners code-barres fonctionnent avec Simplex Gestion. Et si un produit n'a pas de code-barres ? Imprimez vos propres étiquettes.
                </p>
                <ul class="feature-list">
                    <li>Génération d'étiquettes code-barres pour vos produits maison</li>
                    <li>Impression d'étiquettes prix avec promotion en cours</li>
                    <li>Recherche par nom, SKU, référence fournisseur ou code-barres</li>
                </ul>
            </div>
            <div>
                <div class="mock-screen">
                    <div class="mock-topbar">
                        <div class="dot dot-red"></div>
                        <div class="dot dot-yellow"></div>
                        <div class="dot dot-green"></div>
                        <span class="title">Scanner — produit détecté</span>
                    </div>
                    <div class="mock-body" style="text-align:center; padding:40px 20px;">
                        <div style="font-size:3rem; margin-bottom:14px;">📷</div>
                        <div style="font-family:monospace; font-size:1.3rem; letter-spacing:0.2em; color:var(--primary); font-weight:700; margin-bottom:18px;">6 191234 567890</div>
                        <div style="background:#f8fafc; border:1px solid var(--dark-border); border-radius:8px; padding:16px; text-align:left;">
                            <div style="font-size:0.95rem; font-weight:700; margin-bottom:6px;">Eau minérale Safia 1.5L</div>
                            <div style="font-size:0.82rem; color:var(--text-muted); margin-bottom:10px;">Catégorie : Boissons · Stock : 142 unités</div>
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <span style="font-size:0.8rem; color:var(--text-muted);">Prix de vente</span>
                                <span style="font-size:1.3rem; font-weight:800; color:var(--primary);">TND 0.850</span>
                            </div>
                        </div>
                        <div style="margin-top:14px; font-size:0.78rem; color:var(--accent); font-weight:600;">✓ Ajouté au panier · 0.3s</div>
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
            <div class="section-tag">Encaissement</div>
            <h2 class="section-title">Tous les moyens de paiement de vos clients, dans une seule caisse</h2>
            <p class="section-subtitle">
                Espèces, carte bancaire, chèque, ticket restaurant, bon d'achat, paiement en plusieurs fois — Simplex Gestion enregistre chaque centime, calcule le rendu-monnaie automatiquement et imprime le ticket en quelques secondes.
            </p>

            <div class="payment-grid">
                <div class="payment-card">
                    <div class="payment-icon">💵</div>
                    <h4>Espèces</h4>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">💳</div>
                    <h4>Carte bancaire</h4>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">🧾</div>
                    <h4>Chèque</h4>
                    <p>Enregistrement avec numéro et date. Suivi des chèques à encaisser.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">🍴</div>
                    <h4>Ticket restaurant</h4>
                    <p>Acceptation des tickets restaurant.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">🎟️</div>
                    <h4>Avoir</h4>
                    <p>Utilisation des avoirs émis suite à un retour.</p>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">🧮</div>
                    <h4>Paiement multiple</h4>
                    <p>Combinez plusieurs moyens sur une même vente (ex : 50 TND espèces + carte).</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  TICKET DE CAISSE                                       -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag">Ticket imprimante thermique</div>
                <h3>Un ticket à votre image, en 2 secondes</h3>
                <p>
                    Personnalisez votre ticket de caisse avec votre logo, vos infos commerciales, vos messages promotionnels et vos infos légales (matricule fiscal, TVA). Compatible avec toutes les imprimantes thermiques 58mm et 80mm.
                </p>
                <ul class="feature-list">
                    <li>Logo et infos magasin imprimés en haut du ticket</li>
                    <li>Détail des articles, quantités, prix unitaire et total</li>
                    <li>TVA et timbre fiscal calculés automatiquement</li>
                    <li>Messages promotionnels en bas (ex : « Suivez-nous sur Facebook »)</li>
                    <li>QR Code de fidélité ou de parrainage personnalisé</li>
                    <li>Réimpression du dernier ticket d'un seul clic</li>
                </ul>
            </div>
            <div>
                <div class="ticket">
                    <div class="ticket-header">
                        <strong>SUPÉRETTE EL FATH</strong><br>
                        14 Avenue Habib Bourguiba<br>
                        Sousse 4000 — TN<br>
                        MF : 1234567/A/M/000
                    </div>
                    <div class="ticket-line"><span>Eau Safia 1.5L ×3</span><span>2.550</span></div>
                    <div class="ticket-line"><span>Pain baguette ×2</span><span>0.500</span></div>
                    <div class="ticket-line"><span>Lait Délice 1L ×1</span><span>1.450</span></div>
                    <div class="ticket-line"><span>Yaourt Vitalait ×4</span><span>2.720</span></div>
                    <div class="ticket-line"><span>Sucre cristal 1kg ×1</span><span>1.850</span></div>
                    <div class="ticket-line"><span>Sous-total HT</span><span>7.244</span></div>
                    <div class="ticket-line"><span>TVA 19%</span><span>1.376</span></div>
                    <div class="ticket-line"><span>Remise fidélité</span><span>-0.450</span></div>
                    <div class="ticket-total">
                        <div class="ticket-line"><span>TOTAL TTC</span><span>TND 8.620</span></div>
                    </div>
                    <div class="ticket-line" style="margin-top:8px;"><span>Espèces reçues</span><span>10.000</span></div>
                    <div class="ticket-line"><span>Rendu-monnaie</span><span>1.380</span></div>
                    <div class="ticket-footer">
                        Merci de votre visite !<br>
                        Caisse 1 · Faten · 22/08/2024 19:42<br>
                        Ticket n° T-2024-0818-001<br>
                        Carte fidélité : 1 240 points
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  FIDÉLITÉ                                               -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Programme de fidélité</div>
            <h2 class="section-title">Transformez vos clients de passage en habitués</h2>
            <p class="section-subtitle">
                Un client fidèle dépense en moyenne 3 fois plus qu'un client occasionnel. Avec Simplex Gestion, vous lancez votre programme de fidélité en 5 minutes, sans surcoût et sans logiciel tiers.
            </p>

            <div class="feature-row" style="margin-top:32px; margin-bottom:0;">
                <div>
                    <div class="loyalty-card-mock">
                        <div class="lc-label">Carte de fidélité</div>
                        <div class="lc-name">Faten</div>
                        <div class="lc-points">1 240 pts</div>
                        <div class="lc-progress"><div class="lc-progress-fill"></div></div>
                    </div>
                </div>
                <div class="feature-content">
                    <h3>Une fidélité simple, mais redoutable</h3>
                    <p>
                       Votre client cumule, vous le récompensez à votre rythme.
                    </p>
                    <ul class="feature-list">
                        <li>Cumul de points configurable (par dinar, par produit, par jour)</li>
                        <li>Paliers de statut (Bronze, Argent, Or, Platine) avec avantages</li>
                        <li>Récompenses : remise en caisse, produit offert, bon d'achat</li>
                        <li>Anniversaires clients : promo automatique le jour J</li>
                        <li>Historique des achats consultable par le client lui-même</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  STOCK EN TEMPS RÉEL                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Stock en temps réel</div>
                <h3>Plus jamais cette phrase :<br>« Désolé, je viens de vendre le dernier »</h3>
                <p>
                    Chaque vente déduit automatiquement le stock. Chaque réception le rajoute. Chaque inventaire l'ajuste. Vous savez à tout instant ce qui est disponible, ce qui va manquer cette semaine, et ce qui dort sur l'étagère depuis trois mois.
                </p>
                <ul class="feature-list">
                    <li>Stock disponible visible directement à la caisse</li>
                    <li>Alertes automatiques de seuil minimum par produit</li>
                    <li>Alerte intelligentes pour commander avant 15 jours</li>
                    <li>Inventaire mensuel rapide</li>
                    <li>Suivi des dates de consommation pour les produits frais</li>
                    <li>Identification des produits à rotation lente (stocks dormants)</li>
                    <li>Réception fournisseur en quelques clics avec mise à jour du prix d'achat</li>
                </ul>
            </div>
            <div>
                <div class="mock-screen">
                    <div class="mock-topbar">
                        <div class="dot dot-red"></div>
                        <div class="dot dot-yellow"></div>
                        <div class="dot dot-green"></div>
                        <span class="title">Alertes stock — Supérette El Fath</span>
                    </div>
                    <div class="mock-body">
                        <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; margin-bottom:12px;">À réapprovisionner cette semaine</div>
                        <div class="rv-row">
                            <span><span class="badge badge-red">Rupture</span> &nbsp;Lait Délice 1L</span>
                            <span class="rv-val red">0 unités</span>
                        </div>
                        <div class="rv-row">
                            <span><span class="badge badge-orange">Faible</span> &nbsp;Pain baguette</span>
                            <span class="rv-val">8 unités</span>
                        </div>
                        <div class="rv-row">
                            <span><span class="badge badge-orange">Faible</span> &nbsp;Sucre cristal 1kg</span>
                            <span class="rv-val">12 unités</span>
                        </div>
                        <div class="rv-row">
                            <span><span class="badge badge-blue">Suggéré</span> &nbsp;Eau Safia 1.5L</span>
                            <span class="rv-val">142 unités</span>
                        </div>
                        <div style="margin-top:18px; padding:14px; background:#fef3c7; border:1px solid #fde68a; border-radius:8px; font-size:0.82rem; color:#92400e;">
                            <strong>4 produits à date courte</strong><br>
                            Yaourt Vitalait — péremption dans 3 jours (24 unités)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  JOURNÉE DE CAISSE & Z REPORT                           -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Journée de caisse</div>
            <h2 class="section-title">Ouverture, fermeture, rapport détaillé — en deux clics</h2>
            <p class="section-subtitle">
                Le matin, vous ouvrez la caisse avec votre fond initial. Le soir, vous comptez la caisse, le système imprime le rapport caisse par mode de paiement. Plus jamais de comptes approximatifs sur un coin de cahier.
            </p>

            <div class="daily-info">
                <div>
                    <h3>Une fermeture de caisse irréprochable</h3>
                    <p>
                        À la fin du service génère le rapport caisse avec mode de paiement (espèces, carte, chèque, ticket ...). Tout est archivé, exportable et transmissible à votre patron.
                    </p>
                    <div class="daily-badge-list">
                        <span class="daily-badge">Fond de caisse initial</span>
                        <span class="daily-badge">Ventilation par mode de paiement</span>
                        <span class="daily-badge">Rapport caisse imprimable</span>
                        <span class="daily-badge">Historique consultable</span>
                    </div>
                </div>
                <div class="daily-visual">
                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; margin-bottom:10px;">Z — 22/01/2025 · Caisse 1 — Faten</div>
                    <div class="rv-row">
                        <span class="rv-label">Fond de caisse initial</span>
                        <span class="rv-val">TND 100.000</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Espèces encaissées</span>
                        <span class="rv-val">+ TND 1 285.500</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Carte bancaire</span>
                        <span class="rv-val">+ TND 642.300</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Tickets restaurant</span>
                        <span class="rv-val">+ TND 84.000</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Avoirs utilisés</span>
                        <span class="rv-val red">- TND 24.500</span>
                    </div>
                    <div class="rv-row">
                        <span class="rv-label">Sortie de caisse (livreur)</span>
                        <span class="rv-val red">- TND 50.000</span>
                    </div>
                    <div class="rv-row" style="font-weight:700;">
                        <span class="rv-label" style="color:var(--text-main);">Total caisse</span>
                        <span class="rv-val green">TND 2 037.300</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  MULTI-CAISSES & MULTI-MAGASINS                         -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Multi-caisses & Multi-magasins</div>
        <h2 class="section-title">Une seule plateforme, tous vos points de vente</h2>
        <p class="section-subtitle">
            Vous avez ouvert un deuxième magasin ? Vous voulez ajouter une caisse au comptoir bar ? Tout se synchronise en temps réel sur le cloud. Stocks, ventes, fidélité, tarifs — vos chiffres consolidés, où que vous soyez.
        </p>

        <div class="metrics-grid" style="margin-top:32px;">
            <div class="metric-card">
                <div class="metric-label">Total ventes du jour</div>
                <div class="metric-value color-blue">TND 4 287.300</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Magasin Sousse</div>
                <div class="metric-value color-green">TND 2 037.300</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Magasin Tunis</div>
                <div class="metric-value color-purple">TND 1 685.500</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Magasin Sfax</div>
                <div class="metric-value color-orange">TND 564.500</div>
            </div>
        </div>

        <div class="overview-grid" style="margin-top:32px;">
            <div class="overview-card">
                <div class="card-icon icon-blue">☁️</div>
                <h3>Synchronisation cloud</h3>
                <p>Toutes vos caisses, tous vos magasins, mis à jour en temps réel. Une vente à Tunis apparaît immédiatement sur le tableau de bord du gérant à Sfax.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-purple">👥</div>
                <h3>Gestion des caissiers</h3>
                <p>Chaque caissier a son code personnel. Le système trace qui a encaissé quoi, à quelle heure, avec quel mode de paiement. Responsabilités claires, contrôle total.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-orange">🎯</div>
                <h3>Tarifs par magasin</h3>
                <p>Définissez des prix différents par magasin si vous le souhaitez (zone touristique, zone résidentielle). Ou un tarif unique pour tout le réseau, c'est vous qui décidez.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  HARDWARE COMPATIBILITY                                 -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Compatibilité matérielle</div>
            <h2 class="section-title">Branchez votre matériel actuel, ça marche</h2>
            <p class="section-subtitle">
                Pas besoin de tout racheter. Simplex Gestion fonctionne avec tout le matériel : tablette, PC, écran tactile, scanner code-barres, imprimante thermique, tiroir-caisse, balance électronique.
            </p>

            <div class="hardware-grid">
                <div class="hardware-card">
                    <div class="hw-icon">📱</div>
                    <h4>Mobile / Tablette</h4>
                    <p>plateforme web qui s'ouvre sur n'importe quelle mobile / tablette.</p>
                </div>
                <div class="hardware-card">
                    <div class="hw-icon">💻</div>
                    <h4>PC & écran tactile</h4>
                    <p>Windows, Linux ou Mac — tout fonctionne dans le navigateur.</p>
                </div>
                <div class="hardware-card">
                    <div class="hw-icon">📷</div>
                    <h4>Scanner code-barres</h4>
                    <p>USB ou Bluetooth, modèle pistolet ou de comptoir — plug-and-play.</p>
                </div>
                <div class="hardware-card">
                    <div class="hw-icon">🖨️</div>
                    <h4>Imprimante thermique</h4>
                    <p>Compatible 58mm et 80mm.</p>
                </div>
                <div class="hardware-card">
                    <div class="hw-icon">💰</div>
                    <h4>Tiroir-caisse</h4>
                    <p>Ouverture automatique à l'encaissement via l'imprimante thermique.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  RAPPORTS & ANALYSES                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Rapports & analyses</div>
        <h2 class="section-title">Comprenez votre commerce, prenez de meilleures décisions</h2>
        <p class="section-subtitle">
            Quels sont vos meilleurs produits ? À quelles heures vendez-vous le plus ? Qui sont vos meilleurs clients ? Combien d'argent dort dans votre stock ? Simplex Gestion répond à toutes ces questions, en temps réel.
        </p>

        <div class="overview-grid">
            <div class="overview-card">
                <div class="card-icon icon-blue">📈</div>
                <h3>Top produits & catégories</h3>
                <p>Identifiez vos best-sellers et vos produits qui ne se vendent plus. Optimisez votre catalogue, libérez de la place sur l'étagère.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-green">⏰</div>
                <h3>Heures de pointe</h3>
                <p>Visualisez vos ventes par heure et par jour de la semaine. Adaptez vos horaires de personnel pour maximiser le service.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-purple">👤</div>
                <h3>Meilleurs clients</h3>
                <p>Classement de vos clients par chiffre d'affaires. Fidèliser ceux qui vous font vivre.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-orange">💰</div>
                <h3>Marge par produit</h3>
                <p>Connaissez votre marge réelle sur chaque produit, après remises, retours et casses. Ajustez vos prix de vente en conséquence.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-cyan">📦</div>
                <h3>Valeur du stock</h3>
                <p>Combien d'argent dort dans votre magasin ? Identifiez les stocks dormants pour les remettre en mouvement avec une promotion.</p>
            </div>
            <div class="overview-card">
                <div class="card-icon icon-red">🧾</div>
                <h3>TVA collectée</h3>
                <p>Calcul automatique de la TVA collectée par taux et par période.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  EXPORTS                                                -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Exports & impressions</div>
            <h2 class="section-title">Vos données prêtes pour votre comptable, en un clic</h2>
            <p class="section-subtitle">
                Fini les nuits blanches en fin de mois. Exportez vos ventes, vos encaissements et vos rapports Z dans le format attendu par votre cabinet comptable. Compatible avec les logiciels utilisés en Tunisie.
            </p>

            <div class="export-cards">
                <div class="export-card">
                    <div class="ex-icon ex-green">📊</div>
                    <div>
                        <h4>Export CSV</h4>
                        <p>Format universel, compatible avec Excel et tous les logiciels de comptabilité.</p>
                    </div>
                </div>
                <div class="export-card">
                    <div class="ex-icon ex-blue">📗</div>
                    <div>
                        <h4>Export Excel</h4>
                        <p>Fichier Excel avec toutes les colonnes utiles.</p>
                    </div>
                </div>
                <div class="export-card">
                    <div class="ex-icon ex-red">📄</div>
                    <div>
                        <h4>Export PDF</h4>
                        <p>Rapports formatés pour impression ou archivage.</p>
                    </div>
                </div>
                <div class="export-card">
                    <div class="ex-icon ex-purple">🖨️</div>
                    <div>
                        <h4>Impression directe</h4>
                        <p>Réimprimez n'importe quel ticket ou rapport sans quitter l'écran.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  WORKFLOW                                               -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Une journée type au comptoir</div>
        <h2 class="section-title">De l'ouverture à la clôture, sans accroc</h2>
        <p class="section-subtitle">
            Voici comment Simplex Gestion accompagne votre journée, du moment où vous levez le rideau jusqu'à la fermeture des comptes.
        </p>

        <div class="workflow-steps">
            <div class="workflow-step">
                <div class="step-num">1</div>
                <h4>Ouverture de caisse</h4>
                <p>Saisissez le fond initial, la caisse est prête.</p>
            </div>
            <div class="workflow-step">
                <div class="step-num">2</div>
                <h4>Encaissement</h4>
                <p>Scannez, encaissez, imprimez le ticket.</p>
            </div>
            <div class="workflow-step">
                <div class="step-num">3</div>
                <h4>Fidélité & promo</h4>
                <p>Le système applique automatiquement les avantages clients.</p>
            </div>
            <div class="workflow-step">
                <div class="step-num">4</div>
                <h4>Réception fournisseur</h4>
                <p>Le livreur arrive, scannez les produits reçus, le stock se met à jour.</p>
            </div>
            <div class="workflow-step">
                <div class="step-num">5</div>
                <h4>Clôture </h4>
                <p>Comptez la caisse, imprimez le rapport du caiise.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  TÉMOIGNAGES                                            -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Ils nous font confiance</div>
            <h2 class="section-title">Des détaillants tunisiens nous parlent</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p>« La fermeture de caisse, c'était mon cauchemar. Je restais une heure à recompter. Avec Simplex, je clôture en deux minutes, j'imprime le rapport caisse, mon comptable a tout ce qu'il faut. Je rentre chez moi à l'heure. »</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">HK</div>
                        <div>
                            <div class="name">Hatem</div>
                            <div class="role">Matériel informatique — Tunis</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  FAQ                                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag">Questions fréquentes</div>
        <h2 class="section-title">Tout ce que vous voulez savoir avant d'ouvrir votre caisse</h2>
        <p class="section-subtitle">
            Notre équipe est joignable 7j/7 par WhatsApp, par téléphone et par e-mail.
        </p>

        <div class="faq-list">
            <div class="faq-item">
                <h4>Combien de temps faut-il pour démarrer ?</h4>
                <p>Notre équipe vous aide à importer votre catalogue, configurer votre imprimante et former votre premier caissier — tout dans la même journée.</p>
            </div>
            <div class="faq-item">
                <h4>Est-ce que ça marche si Internet tombe en panne ?</h4>
                <p>Non.</p>
            </div>
            <div class="faq-item">
                <h4>Faut-il acheter du nouveau matériel ?</h4>
                <p>Non, Simplex Gestion fonctionne sur votre PC, votre téléphone ou votre tablette.</p>
            </div>
            <div class="faq-item">
                <h4>Combien de caisses puis-je ouvrir ?</h4>
                <p>Autant que vous voulez. Vous pouvez démarrer avec une caisse, en ajouter une deuxième pour le comptoir bar, puis ouvrir un deuxième magasin — tout reste synchronisé sur la même plateforme. Pas de limite technique.</p>
            </div>
            <div class="faq-item">
                <h4>Mes données sont-elles en sécurité ?</h4>
                <p>Absolument. Vos données sont chiffrées, sauvegardées quotidiennement et hébergées sur des serveurs sécurisés. Vous restez propriétaire de vos données à tout moment et pouvez les exporter quand vous le souhaitez.</p>
            </div>
            <div class="faq-item">
                <h4>Si j'ai un problème un samedi soir à 21h ?</h4>
                <p>Notre support est disponible 7j/7, par WhatsApp, par téléphone et par e-mail. Pour les détaillants, on sait que les heures de travail ne sont pas celles d'un bureau. On est là quand vous en avez besoin.</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  CTA                                                    -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="cta-section">
        <h2>Votre caisse mérite mieux qu'un cahier et une calculette</h2>
        <p>
            Encaissent plus vite, fidélisent mieux et clôturent votre journée en deux clics avec Simplex Gestion. Démarrez aujourd'hui, sans engagement.
        </p>
        <div class="cta-buttons">
            <a href="/business/register" style="text-decoration: none" class="btn-primary">Démarrer gratuitement</a>
            <a href="https://wa.me/21693796501" style="text-decoration: none" class="btn-outline">Demander une démo</a>
        </div>
        <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
            <span style="font-size:0.85rem; color:white;">✓ Aucune carte bancaire requise</span>
            <span style="font-size:0.85rem; color:white;">✓ Compatible avec votre matériel actuel</span>
            <span style="font-size:0.85rem; color:white;">✓ Support 7j/7 en français & arabe</span>
            <span style="font-size:0.85rem; color:white;">✓ Données sécurisées & sauvegardées</span>
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
