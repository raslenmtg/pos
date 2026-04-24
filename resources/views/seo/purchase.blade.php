<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel de gestion des achats en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Pilotez vos achats fournisseurs avec Simplex Gestion : demandes d'achat, bons de commande, réceptions, retours, retenue à la source et suivi des paiements en Tunisie.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Logiciel de gestion des achats en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Centralisez le cycle d'achat complet : demande, commande, réception, retours et conformité fiscale tunisienne.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Logiciel de gestion des achats en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Un module achats complet pour maîtriser fournisseurs, coûts, paiements et conformité.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module de gestion des achats",
            "serviceType": "Logiciel de gestion des achats",
            "description": "Solution pour gérer demandes d'achat, commandes fournisseurs, réceptions, retours et paiements.",
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
            --accent2: #8b5cf6;
            --ai: #38bdf8;
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
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 55% at 50% 0%, rgba(41,72,255,0.14) 0%, transparent 70%);
        }
        .hero-label {
            display: inline-block;
            background: rgba(41,72,255,0.1);
            border: 1px solid rgba(41,72,255,0.35);
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
            background: linear-gradient(90deg, var(--primary), var(--ai));
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
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--primary); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }
        .section-alt .section { margin: 0 auto; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--accent2); margin-bottom: 16px;
        }
        .section-tag::before { content: ''; display: inline-block; width: 24px; height: 2px; background: var(--accent2); border-radius: 2px; }
        .section-tag.blue   { color: var(--primary); }
        .section-tag.blue::before   { background: var(--primary); }
        .section-tag.green  { color: var(--accent); }
        .section-tag.green::before  { background: var(--accent); }
        .section-tag.orange { color: var(--warn); }
        .section-tag.orange::before { background: var(--warn); }
        .section-tag.red    { color: var(--danger); }
        .section-tag.red::before    { background: var(--danger); }
        .section-tag.ai     { color: var(--ai); }
        .section-tag.ai::before     { background: var(--ai); }

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
        .card:hover { border-color: rgba(41,72,255,0.35); transform: translateY(-3px); }
        .card.blue:hover   { border-color: rgba(26,107,250,0.4); }
        .card.green:hover  { border-color: rgba(0,194,123,0.4); }
        .card.orange:hover { border-color: rgba(245,158,11,0.4); }
        .card.red:hover    { border-color: rgba(239,68,68,0.4); }
        .card.ai:hover     { border-color: rgba(56,189,248,0.5); }

        .card-icon {
            width: 46px; height: 46px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 18px;
        }
        .icon-purple { background: rgba(167,139,250,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }
        .icon-green  { background: rgba(0,194,123,0.12); }
        .icon-orange { background: rgba(245,158,11,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }
        .icon-ai     { background: rgba(56,189,248,0.12); }

        .card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
        .card p  { font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; }

        /* ─── FEATURE ROW ─────────────────────────────────────── */
        .feature-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px; align-items: center;
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
            background: rgba(167,139,250,0.15);
            color: var(--accent2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700;
            margin-top: 2px;
        }
        .feature-list li.blue::before   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .feature-list li.orange::before { background: rgba(245,158,11,0.15); color: var(--warn); }
        .feature-list li.red::before    { background: rgba(239,68,68,0.15); color: var(--danger); }
        .feature-list li.ai::before     { background: rgba(56,189,248,0.15); color: var(--ai); }

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
            padding: 5px 12px; border-radius: 5px;
            font-size: 0.73rem; font-weight: 600;
            border: 1px solid var(--dark-border);
            background: transparent; color: var(--text-muted);
        }
        .mock-btn.primary { background: var(--primary); color: #fff; border-color: var(--primary); }
        .mock-btn.purple  { background: var(--accent2); color: #fff; border-color: var(--accent2); }
        .mock-btn.ai      { background: linear-gradient(135deg, var(--ai), var(--accent2)); color: #fff; border: none; }

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
        .tbl-row:hover { background: rgba(41,72,255,0.05); }
        .cols-5 { grid-template-columns: 1fr 1.2fr 1fr 1fr 1fr; }
        .cols-6 { grid-template-columns: 1fr 1fr 1.2fr 1fr 1fr 1fr; }
        .cols-4 { grid-template-columns: 2fr 1fr 1fr 1fr; }

        .badge {
            display: inline-block; padding: 2px 9px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .badge-green  { background: rgba(0,194,123,0.12); color: #1fd89b; }
        .badge-orange { background: rgba(245,158,11,0.12); color: #f5a623; }
        .badge-red    { background: rgba(239,68,68,0.12);  color: #f87171; }
        .badge-blue   { background: rgba(26,107,250,0.12); color: #60a5fa; }
        .badge-purple { background: rgba(167,139,250,0.12); color: #a78bfa; }
        .badge-ai     { background: rgba(56,189,248,0.12); color: var(--ai); }

        .val-blue   { color: var(--primary); font-weight: 600; }
        .val-purple { color: var(--accent2); font-weight: 600; }
        .val-green  { color: var(--accent); font-weight: 600; }
        .val-orange { color: var(--warn); font-weight: 600; }
        .val-red    { color: var(--danger); font-weight: 600; }
        .val-muted  { color: var(--text-muted); }
        .val-bold   { font-weight: 700; }

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
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 8px 12px;
            font-size: 0.82rem; color: var(--text-light); height: 36px;
        }
        .form-field .fi.purple { color: var(--accent2); }
        .form-field .fi.blue   { color: var(--primary); }
        .form-field .fi.green  { color: var(--accent); }
        .form-field .fi.warn   { color: var(--warn); }
        .form-field .fi.danger { color: var(--danger); }
        .form-field .fi.ai     { color: var(--ai); }

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
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.25); color: #34d399; }
        .alert-ai     { background: rgba(56,189,248,0.08); border: 1px solid rgba(56,189,248,0.3);  color: #7dd3fc; }
        .alert-blue   { background: rgba(26,107,250,0.08); border: 1px solid rgba(26,107,250,0.25); color: #93c5fd; }

        /* ─── PROCESS STEPS ──────────────────────────────────── */
        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 0; margin: 48px 0;
        }
        .process-step { padding: 26px 18px; text-align: center; position: relative; }
        .process-step:not(:last-child)::after {
            content: '→';
            position: absolute; right: -8px; top: 32px;
            font-size: 1.2rem; color: var(--accent2); font-weight: 300;
        }
        .step-num {
            width: 40px; height: 40px;
            background: rgba(167,139,250,0.12);
            border: 2px solid rgba(167,139,250,0.35);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: var(--accent2); font-size: 0.9rem;
            margin: 0 auto 14px;
        }
        .process-step h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 6px; }
        .process-step p  { font-size: 0.8rem; color: var(--text-muted); }

        /* ─── AI SCANNER UI ──────────────────────────────────── */
        .scanner-frame {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .scan-zone {
            border: 2px dashed rgba(56,189,248,0.4);
            border-radius: var(--radius-sm);
            padding: 28px 20px;
            text-align: center;
            background: rgba(56,189,248,0.06);
            margin-bottom: 18px;
            position: relative;
            overflow: hidden;
        }
        .scan-zone::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--ai), transparent);
            animation: scanline 2.5s ease-in-out infinite;
        }
        @keyframes scanline {
            0%   { transform: translateY(0); }
            50%  { transform: translateY(160px); }
            100% { transform: translateY(0); }
        }
        .scan-icon { font-size: 2.4rem; margin-bottom: 10px; color: var(--ai); }
        .scan-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 4px; }
        .scan-sub   { font-size: 0.78rem; color: var(--text-muted); }

        .scan-result {
            background: #ffffff;
            border: 1px solid rgba(56,189,248,0.25);
            border-radius: var(--radius-sm);
            padding: 16px;
        }
        .scan-result-title {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8rem; font-weight: 700; color: var(--ai);
            margin-bottom: 12px;
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .scan-field {
            display: flex; justify-content: space-between;
            padding: 7px 0; font-size: 0.85rem;
            border-bottom: 1px solid var(--dark-border);
        }
        .scan-field:last-child { border-bottom: none; }
        .scan-field .sf-label { color: var(--text-muted); }
        .scan-field .sf-val { color: var(--text-light); font-weight: 600; }
        .scan-field .sf-val.match { color: var(--accent); }
        .scan-confidence {
            display: inline-block;
            background: rgba(0,194,123,0.12);
            color: var(--accent);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 100px;
            margin-left: 8px;
        }

        /* ─── TEJ / RAS Calculator ───────────────────────────── */
        .tej-calc {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .tej-calc h4 {
            font-size: 1.05rem; font-weight: 700; margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--dark-border);
        }
        .tej-line {
            display: flex; justify-content: space-between; align-items: center;
            padding: 11px 0; font-size: 0.9rem;
            border-bottom: 1px solid var(--dark-border);
        }
        .tej-line:last-child { border-bottom: none; padding-top: 16px; margin-top: 6px; border-top: 2px solid var(--dark-border); font-weight: 700; }
        .tej-label { color: var(--text-muted); }
        .tej-val   { font-weight: 600; }
        .tej-val.green { color: var(--accent); }
        .tej-val.red   { color: var(--danger); }
        .tej-val.blue  { color: var(--primary); }
        .tej-val.bold  { font-size: 1.15rem; }

        /* ─── TRAITES VISUAL ─────────────────────────────────── */
        .traite-card {
            background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            position: relative;
        }
        .traite-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0; width: 4px;
            background: linear-gradient(180deg, var(--primary), var(--accent2));
            border-radius: 4px 0 0 4px;
        }
        .traite-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px dashed var(--dark-border);
        }
        .traite-header .tnum { font-size: 0.75rem; color: var(--text-muted); }
        .traite-header .ttitle { font-size: 0.95rem; font-weight: 700; margin-top: 4px; }
        .traite-amount {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
        }
        .traite-row {
            display: flex; justify-content: space-between;
            padding: 6px 0; font-size: 0.82rem;
        }
        .traite-row .trl { color: var(--text-muted); }
        .traite-row .trv { color: var(--text-light); font-weight: 600; }
        .traite-footer {
            margin-top: 14px; padding-top: 12px;
            border-top: 1px dashed var(--dark-border);
            display: flex; justify-content: space-between; align-items: center;
        }

        /* ─── STAT CARDS ─────────────────────────────────────── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px; margin-top: 32px;
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

        /* ─── AI BENEFITS ────────────────────────────────────── */
        .ai-benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-top: 32px;
        }
        .ai-benefit-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 22px;
            position: relative;
            overflow: hidden;
        }
        .ai-benefit-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--ai), var(--accent2));
        }
        .ai-benefit-card .ab-icon { font-size: 1.6rem; margin-bottom: 10px; }
        .ai-benefit-card h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 6px; }
        .ai-benefit-card p  { font-size: 0.83rem; color: var(--text-muted); line-height: 1.6; }

        /* ─── COMPARISON TABLE ──────────────────────────────── */
        .compare-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-top: 32px;
        }
        .compare-table th, .compare-table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.9rem;
        }
        .compare-table th {
            background: #f8fafc;
            font-size: 0.78rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 700;
        }
        .compare-table tr:last-child td { border-bottom: none; }
        .compare-table .yes { color: var(--accent); font-weight: 700; }
        .compare-table .no  { color: var(--text-muted); }

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

        @media (max-width: 640px) {
            .cols-5, .cols-6 { grid-template-columns: 1fr 1fr 1fr; }
            .tbl-row > *:nth-child(n+4), .tbl-head > *:nth-child(n+4) { display: none; }
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
    <div class="hero-label">Module Achats — Simplex Gestion</div>
    <h1>Vos achats fournisseurs,<br><span>boostés par l'intelligence artificielle</span></h1>
    <p>
        De la demande d'achat à l'impression des traites, gérez tout votre cycle d'approvisionnement dans une interface unique. Scanner intelligent de factures, retenue à la source automatique et gestion complète des effets de commerce — pensé pour la réglementation tunisienne.
    </p>
    <div class="hero-stats">
        <div class="hero-stat">
            <strong>IA intégrée</strong>
            <span>Scan facture & saisie auto</span>
        </div>
        <div class="hero-stat">
            <strong>TEJ</strong>
            <span>Retenu à la source automatique</span>
        </div>
        <div class="hero-stat">
            <strong>Traites</strong>
            <span>Impression Traites préremplies </span>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Tout votre processus d'achat, de A à Z</h2>
    <p class="section-subtitle">
        Simplex Gestion couvre l'intégralité du cycle d'approvisionnement : de l'expression du besoin interne jusqu'au paiement du fournisseur, en passant par la commande, la réception et les éventuels retours.
    </p>

    <div class="cards-grid">
        <div class="card orange">
            <div class="card-icon icon-orange">💰</div>
            <h3>Retenue à la source (RAS)</h3>
            <p>Calcul automatique de la retenue à la source selon les taux légaux tunisiens, avec génération du certificat de retenue à fournir au prestataire.</p>
        </div>
        <div class="card ai">
            <div class="card-icon icon-ai">🤖</div>
            <h3>Scan IA des factures</h3>
            <p>Photographiez ou téléversez une facture fournisseur. L'intelligence artificielle extrait automatiquement le fournisseur, les lignes, les montants et la TVA.</p>
        </div>


        <div class="card green">
            <div class="card-icon icon-green">📦</div>
            <h3>Historique Détaillé</h3>
            <p>Suivi les paiements, impayés, total d'achats, vos échéances, solde et vos factures en attente. Fini les oublis et les mauvaises surprises.</p>
        </div>
        <div class="card red">
            <div class="card-icon icon-red">↩️</div>
            <h3>Retour d'achat</h3>
            <p>Gérez les retours de marchandise au fournisseur — produits non conformes, défectueux ou en surplus — avec traçabilité complète et impact stock automatique.</p>
        </div>
        <div class="card blue">
            <div class="card-icon icon-blue">📋</div>
            <h3>Bon de commande</h3>
            <p>Émettez des bons de commande professionnels à vos fournisseurs avec produits, quantités, prix négociés et conditions de livraison clairement définies.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-purple">📝</div>
            <h3>Demande d'achat</h3>
            <p>Centralisez les besoins exprimés par vos équipes. Validez, modifiez ou refusez chaque demande avant de la transformer en bon de commande officiel.</p>
        </div>
    </div>
</section>

<div class="divider"></div>


    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  SCAN IA DES FACTURES                                   -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag ai">⚡ Intelligence artificielle</div>
            <h2 class="section-title">Scannez vos factures fournisseurs,<br>l'IA fait le reste</h2>
            <p class="section-subtitle">
                Fini la saisie manuelle interminable. Scannez une facture fournisseur — l'intelligence artificielle à Simplex Gestion lit, comprend et extrait automatiquement toutes les informations clés en quelques secondes.
            </p>

            <div class="feature-row">
                <div>
                    <div class="scanner-frame">
                        <div class="scan-zone">
                            <div class="scan-icon">📸</div>
                            <div class="scan-title">Glissez votre facture ici ou cliquez pour téléverser</div>
                            <div class="scan-sub">Formats supportés : PDF, JPG, PNG · Max 10 Mo</div>
                        </div>

                        <div class="scan-result">
                            <div class="scan-result-title">
                                ✨ Données extraites par l'IA <span class="scan-confidence">98 % confiance</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Fournisseur détecté</span>
                                <span class="sf-val match">SOTUNAL S.A. ✓</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Matricule fiscal</span>
                                <span class="sf-val match">1234567/A/M/000</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">N° de facture</span>
                                <span class="sf-val">FA-2487/2026</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Date facture</span>
                                <span class="sf-val">18/04/2026</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Montant HT</span>
                                <span class="sf-val">TND 8,900.000</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">TVA (19 %)</span>
                                <span class="sf-val">TND 1,691.000</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Montant TTC</span>
                                <span class="sf-val match">TND 10,591.000</span>
                            </div>
                            <div class="scan-field">
                                <span class="sf-label">Lignes détectées</span>
                                <span class="sf-val">12 articles</span>
                            </div>
                        </div>
                        <div style="display:flex; gap:8px; margin-top:14px;">
                            <div class="mock-btn">Modifier</div>
                            <div class="mock-btn ai" style="margin-left:auto">✓ Valider et enregistrer</div>
                        </div>
                    </div>
                </div>
                <div class="feature-content">
                    <div class="section-tag ai">L'IA au service de vos achats</div>
                    <h3>Gagnez des heures sur la saisie comptable</h3>
                    <p>
                        Le scanner intelligent reconnaît automatiquement les formats de factures les plus courants en Tunisie. Il identifie le fournisseur grâce au matricule fiscal, extrait les lignes de produits, calcule la TVA et propose un rapprochement avec vos bons de commande existants.
                    </p>
                    <ul class="feature-list">
                        <li class="ai">Identification automatique du fournisseur par matricule fiscal</li>
                        <li class="ai">Extraction des lignes : désignation, quantité, prix, remise, TVA</li>
                        <li class="ai">Rapprochement intelligent avec un bon de commande existant</li>
                        <li class="ai">Détection des écarts (prix, quantités) entre commande et facture</li>
                        <li class="ai">Indice de confiance par champ extrait</li>
                        <li class="ai">Apprentissage continu : plus vous l'utilisez, plus l'IA devient précise pour vos fournisseurs habituels</li>
                    </ul>

                    <div class="ai-benefits" style="margin-top:24px;">
                        <div class="ai-benefit-card">
                            <div class="ab-icon">⏱️</div>
                            <h4>−90 % de temps</h4>
                            <p>Saisie d'une facture en 8 secondes au lieu de 5 minutes en moyenne.</p>
                        </div>
                        <div class="ai-benefit-card">
                            <div class="ab-icon">🎯</div>
                            <h4>Zéro erreur</h4>
                            <p>Élimination des erreurs de saisie manuelle et des montants mal recopiés.</p>
                        </div>
                        <div class="ai-benefit-card">
                            <div class="ab-icon">📂</div>
                            <h4>Archivage auto</h4>
                            <p>Le PDF original est conservé et lié à l'écriture comptable correspondante.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  RETENUE À LA SOURCE (TEJ)                              -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="section-tag orange">Fiscalité tunisienne</div>
        <h2 class="section-title">Retenue à la source (TEJ)<br>conforme et automatisée</h2>
        <p class="section-subtitle">
            La retenue à la source est une obligation fiscale incontournable en Tunisie. Simplex Gestion intègre nativement le calcul de la RS selon les taux légaux en vigueur, génère les certificats à remettre aux fournisseurs et alimente votre déclaration mensuelle d'employeur.
        </p>

        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag orange">Calcul automatique</div>
                <h3>La bonne retenue, au bon taux, à chaque facture</h3>
                <p>
                    Dès qu'une facture fournisseur est enregistrée. Vous obtenez instantanément le montant net à payer au fournisseur et le montant à reverser au Trésor public.
                </p>
                <ul class="feature-list">
                    <li class="orange">Taux de RS configurés selon la réglementation tunisienne (0,5 %, 1 %, 1.5 % …)</li>
                    <li class="orange">Génération du certificat(TEJ) de retenue à la source pour le fournisseur</li>
                    <li class="orange">Export prêt à intégrer dans la déclaration TEJ</li>
                    <li class="orange">Historique complet par fournisseur et par période</li>
                </ul>
            </div>
            <div>
                <div class="tej-calc">
                    <h4>💰 Calcul du paiement fournisseur — FA-2487</h4>
                    <div class="tej-line">
                        <span class="tej-label">Montant HT facture</span>
                        <span class="tej-val">TND 8,900.000</span>
                    </div>
                    <div class="tej-line">
                        <span class="tej-label">+ TVA (19 %)</span>
                        <span class="tej-val blue">TND 1,691.000</span>
                    </div>
                    <div class="tej-line">
                        <span class="tej-label">Montant TTC</span>
                        <span class="tej-val bold">TND 10,591.000</span>
                    </div>
                    <div class="tej-line">
          <span class="tej-label">
            <span style="display:inline-block; background:rgba(245,158,11,0.12); color:var(--warn); font-size:0.7rem; padding:1px 7px; border-radius:100px; font-weight:700; margin-right:6px;">RAS 1,5 %</span>
            Retenue à la source
          </span>
                        <span class="tej-val red">− TND 158.865</span>
                    </div>
                    <div class="tej-line">
                        <span class="tej-label">Montant net à payer au fournisseur</span>
                        <span class="tej-val green bold">TND 10,432.135</span>
                    </div>
                    <div class="tej-line" style="border-top: 2px dashed rgba(245,158,11,0.3); margin-top:12px; padding-top: 14px;">
                        <span class="tej-label">À reverser (TEJ)</span>
                        <span class="tej-val" style="color:var(--warn); font-size:1.15rem;">TND 158.865</span>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  TRAITES — LETTRES DE CHANGE                            -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag blue">Lettres de change</div>
            <h2 class="section-title">Impression des traites</h2>
            <p class="section-subtitle">
                Réglez vos fournisseurs avec des traites bancaires conformes au format légal tunisien. Simplex Gestion imprime vos données directement sur les traites, prêtes à être signées et envoyées.
            </p>

            <div class="feature-row reverse">
                <div class="feature-content">
                    <div class="section-tag blue">Génération automatique</div>
                    <h3>Vos lettres de change, parfaitement formatées</h3>
                    <p>
                        Plus de lettres de change remplies à la main, avec le risque d'erreurs ou d'oublis. Simplex Gestion édite des traites conformes au format bancaire tunisien (LCR), avec montant en chiffres et en lettres, échéance, RIB du tiré et du bénéficiaire, le tout aligné précisément sur l'imprimé pré-formaté.
                    </p>
                    <ul class="feature-list">
                        <li class="blue">Génération automatique à partir d'une facture fournisseur</li>
                        <li class="blue">Création d'un échéancier multi-traites (1, 2, 3, 6 effets…)</li>
                        <li class="blue">Impression alignée</li>
                    </ul>
                </div>
                <div>
                    <div class="traite-card">
                        <div class="traite-header">
                            <div>
                                <div class="tnum">Lettre de change n° 8648</div>
                                <div class="ttitle">Bénéficiaire : SOCIETE B.</div>
                            </div>
                            <div class="traite-amount">TND 5,216.067</div>
                        </div>
                        <img src="/img/lettre de change-9625-v.jpg" alt="Lettre de change préremplie" style="width:100%; border:1px solid var(--dark-border); border-radius:var(--radius-sm);">
                        <div class="traite-footer">
                            <span style="font-size:0.78rem; color:var(--text-muted);">1<sup>re</sup> traite sur 2</span>
                            <span class="badge badge-blue">Prête à imprimer</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards-grid" style="margin-top:32px;">
                <div class="card blue">
                    <div class="card-icon icon-blue">🖨️</div>
                    <h3>Impression sur imprimé pré-formaté</h3>
                    <p>Les coordonnées sont positionnées au pixel près sur les traites. Insérez la traite dans l'imprimante et lancez l'impression — c'est tout.</p>
                </div>
                <div class="card blue">
                    <div class="card-icon icon-blue">📊</div>
                    <h3>Échéancier consolidé</h3>
                    <p>Visualisez en un coup d'œil toutes vos traites à payer et à recevoir, classées par échéance. Anticipez vos besoins de trésorerie sans surprise.</p>
                </div>
                <div class="card blue">
                    <div class="card-icon icon-blue">🔔</div>
                    <h3>Alertes avant échéance</h3>
                    <p>Recevez des notifications avant chaque échéance pour préparer la provision bancaire et éviter tout incident de paiement (rejet, frais).</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  BON DE COMMANDE                                        -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag blue">Bon de commande</div>
            <h2 class="section-title">Des bons de commande professionnels, en quelques clics</h2>
            <p class="section-subtitle">
                Créer des bons de commande conformes et professionnels à vos fournisseurs.  conditions de paiement, délai de livraison, remises négociées — tout est géré en un seul écran.
            </p>

            <div class="mock-screen">
                <div class="mock-topbar">
                    <div class="dot dot-red"></div>
                    <div class="dot dot-yellow"></div>
                    <div class="dot dot-green"></div>
                    <span class="mtitle">Liste des bons de commande</span>
                </div>
                <div class="mock-body">
                    <div class="mock-actions">
                        <div class="mock-btn">⬇ Exporter CSV</div>
                        <div class="mock-btn">⬇ Exporter PDF</div>
                        <div class="mock-btn">🖨 Imprimer</div>
                        <div class="mock-btn primary" style="margin-left:auto">+ Nouveau bon de commande</div>
                    </div>

                    <div class="tbl-head cols-6">
                        <span>Date</span>
                        <span>BC n°</span>
                        <span>Fournisseur</span>
                        <span>Montant HT</span>
                        <span>Montant TTC</span>
                        <span>Statut</span>
                    </div>
                    <div class="tbl-row cols-6">
                        <span class="val-muted">20/04/2026</span>
                        <span class="val-blue">BC-0214</span>
                        <span class="val-bold">SOTUNAL</span>
                        <span>TND 4,250.000</span>
                        <span class="val-blue">TND 5,057.500</span>
                        <span><span class="badge badge-orange">En attente</span></span>
                    </div>
                    <div class="tbl-row cols-6">
                        <span class="val-muted">18/04/2026</span>
                        <span class="val-blue">BC-0213</span>
                        <span class="val-bold">Médina Distribution</span>
                        <span>TND 8,900.000</span>
                        <span class="val-blue">TND 10,591.000</span>
                        <span><span class="badge badge-blue">Envoyée</span></span>
                    </div>
                    <div class="tbl-row cols-6">
                        <span class="val-muted">15/04/2026</span>
                        <span class="val-blue">BC-0212</span>
                        <span class="val-bold">Carthago Trade</span>
                        <span>TND 12,400.000</span>
                        <span class="val-blue">TND 14,756.000</span>
                        <span><span class="badge badge-green">Réceptionnée</span></span>
                    </div>
                    <div class="tbl-row cols-6">
                        <span class="val-muted">12/04/2026</span>
                        <span class="val-blue">BC-0211</span>
                        <span class="val-bold">Sahara Foods</span>
                        <span>TND 3,200.000</span>
                        <span class="val-blue">TND 3,808.000</span>
                        <span><span class="badge badge-green">Facturée</span></span>
                    </div>
                    <div class="tbl-row cols-6">
                        <span class="val-muted">10/04/2026</span>
                        <span class="val-blue">BC-0210</span>
                        <span class="val-bold">SOTUNAL</span>
                        <span>TND 6,750.000</span>
                        <span class="val-blue">TND 8,032.500</span>
                        <span><span class="badge badge-purple">Payée</span></span>
                    </div>
                </div>
            </div>

            <div class="cards-grid" style="margin-top:32px;">
                <div class="card blue">
                    <div class="card-icon icon-blue">🔢</div>
                    <h3>Numérotation automatique</h3>
                    <p>Chaque bon de commande reçoit un numéro unique séquentiel pour faciliter le suivi et le rapprochement avec les factures fournisseurs.</p>
                </div>
                <div class="card blue">
                    <div class="card-icon icon-blue">📤</div>
                    <h3>Envoi direct par e-mail / Whatsapp</h3>
                    <p>Envoyez le bon de commande au fournisseur en PDF directement depuis l'application.</p>
                </div>
                <div class="card blue">
                    <div class="card-icon icon-blue">🔁</div>
                    <h3>Conversion en réception</h3>
                    <p>À l'arrivée de la marchandise, transformez le bon de commande en facture en un clic — les quantités sont pré-remplies.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>


<!-- ═══════════════════════════════════════════════════════ -->
<!--  DEMANDE D'ACHAT                                        -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag purple">Demande d'achat</div>
            <h3>Centralisez les besoins de vos équipes en un point unique</h3>
            <p>
                Plus de demandes d'achat éparpillées sur des e-mails ou des feuilles volantes. Simplex Gestion offre un formulaire structuré pour exprimer chaque besoin interne, avec validation hiérarchique avant d'engager la dépense.
            </p>
            <ul class="feature-list">
                <li>Saisie rapide du besoin avec quantité </li>
                <li>Saisie date du besoin</li>
                <li>Notification automatique au demandeur lors de chaque changement de statut</li>
                <li>Conversion directe en bon de commande après confirmation</li>
                <li>Historique complet par demandeur, par service ou par période</li>
            </ul>
        </div>
        <div>
            <div class="form-mock">
                <h4>Nouvelle demande d'achat</h4>
                <div class="form-row">
                    <div class="form-field">
                        <label>Demandeur *</label>
                        <div class="fi">Sonia — Responsable magasin</div>
                    </div>
                    <div class="form-field">
                        <label>Date du besoin *</label>
                        <div class="fi">25/04/2026</div>
                    </div>
                </div>
                <div class="tbl-head" style="grid-template-columns: 2fr 1fr 1fr; margin-top: 6px;">
                    <span>Produit</span><span>Qté souhaitée</span>
                </div>
                <div class="tbl-row" style="grid-template-columns: 2fr 1fr 1fr;">
                    <span class="val-bold">Café Arabica 1kg</span>
                    <span class="val-purple">200 sachets</span>
                </div>
                <div class="tbl-row" style="grid-template-columns: 2fr 1fr 1fr;">
                    <span class="val-bold">Sucre cristallisé 50kg</span>
                    <span class="val-purple">25 sacs</span>
                </div>
                <div class="tbl-row" style="grid-template-columns: 2fr 1fr 1fr;">
                    <span class="val-bold">Eau minérale 1,5L (×12)</span>
                    <span class="val-purple">50 cartons</span>
                </div>

                <div class="alert-box alert-orange" style="margin-top:14px;">
                    <span>⏳</span>
                    <span>En attente de validation par le responsable des achats — créée le 20/04/2026 à 10:45.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>



<!-- ═══════════════════════════════════════════════════════ -->
<!--  RETOUR D'ACHAT                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag red">Retour d'achat</div>
            <h3>Gérez les retours fournisseurs avec rigueur</h3>
            <p>
                Marchandise non conforme, produit défectueux, erreur de livraison ou simple surplus ? Simplex Gestion vous permet de créer un retour d'achat formel, lié à la facture fournisseur d'origine, qui ajuste automatiquement votre stock et le solde dû au fournisseur.
            </p>
            <ul class="feature-list">
                <li class="red">Retour lié à une facture d'achat ou un bon de réception spécifique</li>
                <li class="red">Sélection des articles à retourner avec quantité partielle ou totale</li>
                <li class="red">Motif du retour : non conforme, défectueux, surplus, erreur, autre</li>
                <li class="red">Avoir fournisseur généré automatiquement avec montant à déduire</li>
                <li class="red">Mise à jour du stock en temps réel (déduction automatique)</li>
                <li class="red">Historique consultable des retours par fournisseur ou par produit</li>
            </ul>
        </div>
        <div>
            <div class="form-mock">
                <h4 style="color:#f87171;">Nouveau retour d'achat</h4>
                <div class="form-row">
                    <div class="form-field">
                        <label>Fournisseur *</label>
                        <div class="fi">Médina Distribution</div>
                    </div>
                    <div class="form-field">
                        <label>Facture d'origine *</label>
                        <div class="fi blue">FA-2487 (18/04/2026)</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Date du retour *</label>
                        <div class="fi">20/04/2026</div>
                    </div>
                </div>

                <div class="tbl-head" style="grid-template-columns: 2fr 1fr 1fr 1fr; margin-top:6px;">
                    <span>Produit</span><span>Qté reçue</span><span>Qté retournée</span><span>Valeur</span>
                </div>
                <div class="tbl-row" style="grid-template-columns: 2fr 1fr 1fr 1fr;">
                    <span>Huile d'olive 5L</span>
                    <span class="val-muted">50</span>
                    <span class="val-red">−6</span>
                    <span class="val-red">TND 300.000</span>
                </div>
                <div class="tbl-row" style="grid-template-columns: 2fr 1fr 1fr 1fr;">
                    <span>Farine T55 50kg</span>
                    <span class="val-muted">30</span>
                    <span class="val-red">−2</span>
                    <span class="val-red">TND 120.000</span>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:14px; padding-top:12px; border-top:1px solid var(--dark-border);">
                    <span style="font-size:0.85rem; color:var(--text-muted);">Avoir fournisseur à percevoir</span>
                    <span style="font-size:1.3rem; font-weight:800; color:var(--danger);">TND 420.000</span>
                </div>
                <div class="alert-box alert-red">
                    <span>⚠</span>
                    <span>Ce retour déduira <strong>8 articles</strong> du stock et générera un avoir fournisseur de TND 420.000 à avoir.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>



<!-- ═══════════════════════════════════════════════════════ -->
<!--  COMPARATIF AVEC / SANS SIMPLEX                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Pourquoi Simplex Gestion ?</div>
    <h2 class="section-title">Le module achats le plus complet du marché tunisien</h2>
    <p class="section-subtitle">
        Comparez ce que vous obtenez avec Simplex Gestion par rapport à une gestion manuelle ou à un logiciel généraliste non adapté à la Tunisie.
    </p>

    <table class="compare-table">
        <thead>
        <tr>
            <th>Fonctionnalité</th>
            <th style="text-align:center;">Gestion manuelle / Excel</th>
            <th style="text-align:center;">Logiciel générique</th>
            <th style="text-align:center; color:var(--accent2);">Simplex Gestion</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><strong>Demande d'achat avec workflow</strong></td>
            <td style="text-align:center;" class="no">—</td>
            <td style="text-align:center;" class="no">Partiel</td>
            <td style="text-align:center;" class="yes">✓ Complet</td>
        </tr>
        <tr>
            <td><strong>Bon de commande professionnel</strong></td>
            <td style="text-align:center;" class="no">Manuel</td>
            <td style="text-align:center;" class="yes">✓</td>
            <td style="text-align:center;" class="yes">✓</td>
        </tr>
        <tr>
            <td><strong>Retour d'achat avec avoir</strong></td>
            <td style="text-align:center;" class="no">Difficile</td>
            <td style="text-align:center;" class="no">Limité</td>
            <td style="text-align:center;" class="yes">✓ Automatisé</td>
        </tr>
        <tr>
            <td><strong>Scan IA de facture fournisseur</strong></td>
            <td style="text-align:center;" class="no">—</td>
            <td style="text-align:center;" class="no">—</td>
            <td style="text-align:center;" class="yes">✓ Inclus</td>
        </tr>
        <tr>
            <td><strong>Retenue à la source (TEJ) tunisienne</strong></td>
            <td style="text-align:center;" class="no">Calcul manuel</td>
            <td style="text-align:center;" class="no">Non adapté</td>
            <td style="text-align:center;" class="yes">✓ Conforme</td>
        </tr>
        <tr>
            <td><strong>Impression de traites (LCR)</strong></td>
            <td style="text-align:center;" class="no">À la main</td>
            <td style="text-align:center;" class="no">—</td>
            <td style="text-align:center;" class="yes">✓ Format normalisé</td>
        </tr>
        <tr>
            <td><strong>Échéancier des effets</strong></td>
            <td style="text-align:center;" class="no">Tableur</td>
            <td style="text-align:center;" class="no">Basique</td>
            <td style="text-align:center;" class="yes">✓ Avec alertes</td>
        </tr>
        <tr>
            <td><strong>Support en français</strong></td>
            <td style="text-align:center;" class="no">—</td>
            <td style="text-align:center;" class="no">Variable</td>
            <td style="text-align:center;" class="yes">✓ FR & AR</td>
        </tr>
        </tbody>
    </table>
</section>

<div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  CYCLE COMPLET                                          -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="section-tag">Cycle d'approvisionnement</div>
            <h2 class="section-title">Un workflow complet, sans rupture entre les étapes</h2>
            <p class="section-subtitle">
                Chaque document découle du précédent. Pas de double saisie, pas de rupture de traçabilité — la demande devient commande, la commande devient réception, la réception devient facture.
            </p>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-num">1</div>
                    <h4>Demande d'achat</h4>
                    <p>Expression du besoin par un collaborateur ou un service.</p>
                </div>
                <div class="process-step">
                    <div class="step-num">2</div>
                    <h4>Validation</h4>
                    <p>Approbation par le responsable des achats avec contrôle budgétaire.</p>
                </div>
                <div class="process-step">
                    <div class="step-num">3</div>
                    <h4>Bon de commande</h4>
                    <p>Génération du bon officiel et envoi au fournisseur.</p>
                </div>
                <div class="process-step">
                    <div class="step-num">4</div>
                    <h4>Réception</h4>
                    <p>Contrôle de la marchandise et entrée en stock automatique.</p>
                </div>
                <div class="process-step">
                    <div class="step-num">5</div>
                    <h4>Facturation</h4>
                    <p>Saisie ou scan IA de la facture fournisseur, rapprochement automatique.</p>
                </div>
                <div class="process-step">
                    <div class="step-num">6</div>
                    <h4>Paiement</h4>
                    <p>Règlement avec RAS, génération de traites ou virement direct.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CTA                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="cta-section">
    <h2>Modernisez votre gestion d'achats dès aujourd'hui</h2>
    <p>
        Simplex Gestion combine la puissance de l'intelligence artificielle et la conformité fiscale tunisienne pour simplifier radicalement votre cycle d'achat. Testez gratuitement, sans engagement.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Scan facture IA</span>
        <span style="font-size:0.85rem; color:white;">✓ Conforme TEJ Tunisie</span>
        <span style="font-size:0.85rem; color:white;">✓ Impression traite</span>

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
