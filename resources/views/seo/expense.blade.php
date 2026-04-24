<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logiciel de gestion des dépenses en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Suivez et contrôlez vos dépenses avec Simplex Gestion : catégories, récurrence, pièces justificatives, retenue à la source et tableaux analytiques pour entreprises en Tunisie.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Logiciel de gestion des dépenses en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Centralisez vos sorties d'argent, justifiez chaque dépense et améliorez votre rentabilité avec des rapports clairs.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Logiciel de gestion des dépenses en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Maîtrisez vos dépenses professionnelles avec suivi, catégories et conformité fiscale.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module Dépenses",
            "serviceType": "Logiciel de gestion des dépenses",
            "description": "Solution pour enregistrer, classer, analyser et suivre les dépenses avec pièces justificatives et règles fiscales.",
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
            --accent2: #a78bfa;
            --pos: #ff8a3d;
            --teal: #3b82f6;
            --rose: #1d4ed8;
            --indigo: #2563eb;
            --amber: #2948ff;
            --amber-dark: #1a35cc;
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
            color: var(--amber);
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
            background: linear-gradient(90deg, var(--amber), #38b2f5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 720px; margin: 0 auto 40px;
            font-size: 1.15rem; color: var(--text-light);
        }
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--amber); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--amber); margin-bottom: 16px;
        }
        .section-tag::before {
            content: ''; display: inline-block;
            width: 24px; height: 2px;
            background: var(--amber); border-radius: 2px;
        }
        .section-tag.blue   { color: var(--primary); }
        .section-tag.blue::before   { background: var(--primary); }
        .section-tag.green  { color: var(--accent); }
        .section-tag.green::before  { background: var(--accent); }
        .section-tag.purple { color: var(--accent2); }
        .section-tag.purple::before { background: var(--accent2); }
        .section-tag.teal   { color: var(--teal); }
        .section-tag.teal::before   { background: var(--teal); }
        .section-tag.danger { color: var(--danger); }
        .section-tag.danger::before { background: var(--danger); }

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
        .card.blue:hover   { border-color: rgba(26,107,250,0.4); }
        .card.green:hover  { border-color: rgba(0,194,123,0.4); }
        .card.purple:hover { border-color: rgba(167,139,250,0.4); }
        .card.teal:hover   { border-color: rgba(20,184,166,0.4); }

        .card-icon {
            width: 44px; height: 44px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 16px;
        }
        .icon-amber  { background: rgba(245,158,11,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }
        .icon-green  { background: rgba(0,194,123,0.12); }
        .icon-purple { background: rgba(167,139,250,0.12); }
        .icon-teal   { background: rgba(20,184,166,0.12); }
        .icon-rose   { background: rgba(236,72,153,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }

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
            background: rgba(245,158,11,0.15);
            color: var(--amber);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }
        .feature-list li.blue::before   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .feature-list li.purple::before { background: rgba(167,139,250,0.15); color: var(--accent2); }
        .feature-list li.teal::before   { background: rgba(20,184,166,0.15); color: var(--teal); }
        .feature-list li.danger::before { background: rgba(239,68,68,0.15); color: var(--danger); }

        /* ─── FORM MOCK ───────────────────────────────────────── */
        .form-mock {
            background: #f5f6fa;
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            color: #1f2937;
        }
        .form-topbar {
            background: #1a3aa8;
            padding: 10px 16px;
            display: flex; align-items: center; gap: 8px;
            color: #fff;
        }
        .form-topbar .ttitle { font-size: 0.78rem; opacity: 0.9; margin-left: auto; }
        .form-topbar .pill {
            background: rgba(255,255,255,0.15);
            padding: 4px 10px; border-radius: 100px;
            font-size: 0.7rem;
        }

        .form-title-bar {
            background: #fff;
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1f2937;
        }

        .form-section {
            background: #fff;
            padding: 22px 20px;
            margin: 12px 12px 0;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
        .form-section:first-of-type { margin-top: 12px; }
        .form-section.no-bg { background: transparent; border: none; padding: 0; margin: 0; }

        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .form-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        @media (max-width: 768px) {
            .form-grid-3, .form-grid-2 { grid-template-columns: 1fr; }
        }

        .form-field { margin-bottom: 12px; }
        .form-field label {
            display: block;
            font-size: 0.75rem;
            color: #374151;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-field label .req { color: #ef4444; }
        .form-field .input {
            width: 100%;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 7px 10px;
            font-size: 0.78rem;
            color: #6b7280;
            display: flex; align-items: center; gap: 6px;
            min-height: 32px;
        }
        .form-field .input.dropdown::after {
            content: '▾';
            margin-left: auto;
            color: #9ca3af;
        }
        .form-field .input.date {
            background: #e5e7eb;
            color: #1f2937;
            font-weight: 500;
        }
        .form-field .input.placeholder { font-style: italic; color: #9ca3af; }
        .form-field textarea {
            width: 100%;
            min-height: 60px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 7px 10px;
            font-size: 0.78rem;
            resize: vertical;
            background: #fff;
        }
        .form-field .help {
            font-size: 0.7rem;
            color: #9ca3af;
            margin-top: 3px;
        }

        .file-attach {
            display: flex; gap: 0;
        }
        .file-attach .input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right: none;
            flex: 1;
        }
        .file-attach .browse-btn {
            background: #2563eb;
            color: #fff;
            padding: 7px 14px;
            border-radius: 0 4px 4px 0;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            cursor: pointer;
            white-space: nowrap;
        }

        .form-check {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.82rem;
            color: #374151;
            padding: 6px 0;
        }
        .form-check .cbx {
            width: 14px; height: 14px;
            border: 1px solid #9ca3af;
            border-radius: 3px;
            background: #fff;
        }
        .form-check .cbx.checked { background: var(--amber); border-color: var(--amber); }

        .form-bottom-bar {
            background: #fff;
            padding: 18px 20px;
            margin: 12px 12px 0;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .impaye-display .lbl { font-size: 0.78rem; color: #6b7280; text-align: right; }
        .impaye-display .val { font-size: 1.5rem; font-weight: 800; color: #1f2937; text-align: right; }

        .save-btn-row {
            padding: 22px;
            text-align: center;
            background: #f5f6fa;
        }
        .save-btn {
            background: linear-gradient(135deg, var(--accent2), #c084fc);
            color: #fff;
            padding: 11px 36px;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
        }

        /* ─── CATEGORIES TREE ─────────────────────────────── */
        .cat-tree {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .cat-tree h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 14px;
            border-bottom: 1px solid var(--dark-border);
        }
        .cat-item {
            padding: 10px 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            margin-bottom: 8px;
        }
        .cat-item .cat-head {
            display: flex; align-items: center; gap: 10px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .cat-icon {
            width: 28px; height: 28px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }
        .ci-blue   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .ci-green  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .ci-purple { background: rgba(167,139,250,0.15); color: var(--accent2); }
        .ci-rose   { background: rgba(236,72,153,0.15); color: var(--rose); }
        .ci-amber  { background: rgba(245,158,11,0.15); color: var(--amber); }
        .ci-teal   { background: rgba(20,184,166,0.15); color: var(--teal); }
        .ci-red    { background: rgba(239,68,68,0.15); color: var(--danger); }

        .cat-amount {
            margin-left: auto;
            font-weight: 700;
            color: var(--amber);
        }
        .sub-list {
            margin-top: 8px; padding-left: 38px;
            font-size: 0.8rem; color: var(--text-muted);
            display: flex; flex-direction: column; gap: 4px;
        }
        .sub-list span::before {
            content: '└ '; color: var(--text-muted); margin-right: 4px;
        }

        /* ─── ALERT BOX ───────────────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px; font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 14px;
        }
        .alert-amber  { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3); color: #fbbf24; }
        .alert-blue   { background: rgba(26,107,250,0.08); border: 1px solid rgba(26,107,250,0.3); color: #93c5fd; }
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.3); color: #1fd89b; }
        .alert-rose   { background: rgba(236,72,153,0.08); border: 1px solid rgba(236,72,153,0.3); color: #f9a8d4; }

        /* ─── RECURRENCE MOCK ─────────────────────────────── */
        .recur-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .recur-mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
        }
        .recur-toggle {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            margin-bottom: 14px;
        }
        .toggle {
            width: 36px; height: 20px;
            background: #ffffff;
            border-radius: 100px; position: relative;
            flex-shrink: 0;
        }
        .toggle::after {
            content: ''; position: absolute;
            width: 14px; height: 14px; border-radius: 50%;
            background: var(--text-muted);
            top: 3px; left: 3px;
        }
        .toggle.on { background: var(--amber); }
        .toggle.on::after { left: 19px; background: #fff; }

        .interval-options {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 8px; margin: 12px 0;
        }
        .int-opt {
            text-align: center; padding: 10px 6px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            font-size: 0.78rem;
            color: var(--text-light);
            cursor: pointer;
        }
        .int-opt.active {
            background: rgba(245,158,11,0.12);
            border-color: var(--amber);
            color: var(--amber);
            font-weight: 700;
        }

        .timeline-rec {
            display: flex; align-items: center; gap: 8px;
            flex-wrap: wrap; margin-top: 16px;
        }
        .tl-dot {
            flex: 1;
            text-align: center;
            padding: 8px 4px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            font-size: 0.7rem;
        }
        .tl-dot.done { border-color: var(--accent); color: var(--accent); }
        .tl-dot.next { border-color: var(--amber); color: var(--amber); background: rgba(245,158,11,0.05); }
        .tl-dot .tld-day { font-weight: 700; display: block; font-size: 0.85rem; }

        /* ─── PAYMENT MODES ─────────────────────────────────── */
        .pay-modes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }
        .pay-mode {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 18px 14px;
            text-align: center;
            transition: border-color 0.2s, transform 0.15s;
            cursor: pointer;
        }
        .pay-mode:hover { border-color: var(--amber); transform: translateY(-2px); }
        .pay-mode .pm-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            margin: 0 auto 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .pay-mode h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
        .pay-mode p  { font-size: 0.75rem; color: var(--text-muted); }

        /* ─── RAS MOCK ─────────────────────────────────────── */
        .ras-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .ras-mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 14px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 10px;
        }
        .ras-line {
            display: flex; justify-content: space-between;
            padding: 10px 0;
            font-size: 0.88rem;
            border-bottom: 1px solid var(--dark-border);
        }
        .ras-line:last-of-type { border-bottom: none; }
        .ras-line .rl-lbl { color: var(--text-muted); }
        .ras-line .rl-val { font-weight: 600; }
        .ras-line.minus .rl-val { color: var(--danger); }
        .ras-line.total {
            border-top: 2px solid var(--amber);
            margin-top: 8px;
            padding-top: 12px;
            font-size: 1rem;
            font-weight: 700;
        }
        .ras-line.total .rl-val { color: var(--amber); font-size: 1.1rem; }

        /* ─── REPORT BARS ─────────────────────────────────── */
        .report-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .report-mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .report-mock h4 .period {
            font-size: 0.78rem; font-weight: 500;
            color: var(--text-muted);
        }
        .report-row {
            display: grid;
            grid-template-columns: 130px 1fr 80px;
            gap: 12px;
            align-items: center;
            padding: 8px 0;
        }
        .rr-label { font-size: 0.85rem; color: var(--text-light); }
        .rr-bar {
            height: 14px;
            background: #ffffff;
            border-radius: 100px;
            overflow: hidden;
            border: 1px solid var(--dark-border);
        }
        .rr-fill {
            height: 100%;
            border-radius: 100px;
        }
        .rrf-1 { background: linear-gradient(90deg, var(--amber), #fbbf24); }
        .rrf-2 { background: linear-gradient(90deg, var(--rose), #f9a8d4); }
        .rrf-3 { background: linear-gradient(90deg, var(--teal), #5eead4); }
        .rrf-4 { background: linear-gradient(90deg, var(--accent2), #c084fc); }
        .rrf-5 { background: linear-gradient(90deg, var(--primary), #60a5fa); }
        .rrf-6 { background: linear-gradient(90deg, var(--accent), #34d399); }
        .rr-amount { font-weight: 700; text-align: right; font-size: 0.85rem; }

        .report-summary {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 12px; margin-top: 18px; padding-top: 18px;
            border-top: 1px solid var(--dark-border);
        }
        .rs-card {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 14px;
            text-align: center;
        }
        .rs-card .lbl { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600; }
        .rs-card .val { font-size: 1.3rem; font-weight: 800; margin-top: 4px; }

        /* ─── HEADER BTN GRID ─────────────────────────────── */
        .feat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
            margin-top: 28px;
        }
        .feat-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 18px 20px;
            display: flex; align-items: flex-start; gap: 14px;
            transition: border-color 0.2s;
        }
        .feat-card:hover { border-color: var(--amber); }
        .feat-icon {
            width: 38px; height: 38px;
            border-radius: 7px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; color: #fff;
        }
        .fi-amber  { background: var(--amber); }
        .fi-blue   { background: var(--primary); }
        .fi-green  { background: var(--accent); }
        .fi-purple { background: var(--accent2); }
        .fi-teal   { background: var(--teal); }
        .fi-rose   { background: var(--rose); }
        .fi-red    { background: var(--danger); }
        .fi-dark   { background: #ffffff; border: 1px solid var(--dark-border); color: var(--text-light); }
        .feat-card h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 4px; }
        .feat-card p  { font-size: 0.82rem; color: var(--text-muted); line-height: 1.55; }

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
        .badge-amber  { background: rgba(245,158,11,0.12); color: var(--amber); }
        .badge-green  { background: rgba(0,194,123,0.12); color: #1fd89b; }
        .badge-red    { background: rgba(239,68,68,0.12); color: #f87171; }
        .badge-blue   { background: rgba(26,107,250,0.12); color: var(--primary); }
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
    <div class="hero-label">Module Dépenses — Simplex Gestion</div>
    <h1>Suivez chaque dinar qui sort,<br><span>avec la même rigueur que vos ventes</span></h1>
    <p>
        Loyer, salaires, fournitures, frais de déplacement, abonnements, dépenses récurrentes ou ponctuelles : enregistrez, classez, justifiez et payez vos dépenses depuis une seule interface, avec pièces justificatives, retenue à la source et récurrence automatique.
    </p>
    <div class="hero-stats">
        <div class="hero-stat">
            <strong>Récurrence auto</strong>
            <span>Quotidienne, mensuelle…</span>
        </div>
        <div class="hero-stat">
            <strong>TEJ intégré</strong>
            <span>Retenue à la source</span>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Tout ce qu'il faut pour maîtriser vos sorties d'argent</h2>
    <p class="section-subtitle">
        Une dépense bien enregistrée, c'est une marge mieux mesurée et une comptabilité plus juste. Simplex Gestion vous donne tous les outils pour ne rien oublier et tout justifier.
    </p>

    <div class="cards-grid">
        <div class="card">
            <div class="card-icon icon-amber">📂</div>
            <h3>Catégories & sous-catégories</h3>
            <p>Organisez vos dépenses en arborescence : loyer, énergie, salaires, fournitures, marketing, transport… avec sous-catégories illimitées.</p>
        </div>
        <div class="card blue">
            <div class="card-icon icon-blue">📍</div>
            <h3>Multi-emplacements</h3>
            <p>Affectez chaque dépense à un lieu d'affaires précis (magasin, dépôt, succursale) pour analyser la rentabilité par site.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">🔄</div>
            <h3>Dépenses récurrentes</h3>
            <p>Loyer mensuel, abonnements, salaires : configurez une fois et Simplex Gestion les régénère automatiquement à la bonne date.</p>
        </div>
        <div class="card green">
            <div class="card-icon icon-green">📎</div>
            <h3>Pièces justificatives</h3>
            <p>Joignez factures, reçus, photos ou contrats à chaque dépense pour une comptabilité irréprochable et auditable.</p>
        </div>
        <div class="card teal">
            <div class="card-icon icon-teal">💼</div>
            <h3>Retenue à la source (TEJ)</h3>
            <p>Calcul automatique de la retenue selon le taux applicable au type de dépense (services, honoraires, locations…).</p>
        </div>
        <div class="card">
            <div class="card-icon icon-rose">↩️</div>
            <h3>Dépenses remboursables</h3>
            <p>Marquez une dépense comme remboursable (frais avancés par un employé, par exemple) et suivez son remboursement.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  FORM MOCK                                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag">Le formulaire de saisie</div>
        <h2 class="section-title">Une saisie complète,<br>en un seul écran clair et structuré</h2>
        <p class="section-subtitle">
            Tous les champs nécessaires à une dépense bien renseignée sont organisés en sections claires : informations générales, récurrence, paiement. Vous saisissez tout en quelques secondes, sans naviguer entre dix écrans.
        </p>

        <div class="form-mock">
            <div class="form-topbar">
                <span style="display:inline-flex; align-items:center; gap:6px;">📑</span>
                <span class="ttitle"></span>
                <span class="pill">📘 guide</span>
                <span class="pill">📅</span>
                <span class="pill">🛒 Caisse</span>
                <span class="pill">📊</span>
                <span class="pill">24/04/2025</span>
                <span class="pill">🔔 ⚠</span>
                <span class="pill">👤 ffffff fffff</span>
            </div>

            <div class="form-title-bar">Ajouter des dépenses</div>

            <!-- Section 1: Infos générales -->
            <div class="form-section">
                <div class="form-grid-3">
                    <div class="form-field">
                        <label>Lieu d'affaires : <span class="req">*</span></label>
                        <div class="input dropdown">Veuillez sélectionner</div>
                    </div>
                    <div class="form-field">
                        <label>Catégorie de dépenses :</label>
                        <div class="input dropdown">Veuillez sélectionner</div>
                    </div>
                    <div class="form-field">
                        <label>Sous-catégorie :</label>
                        <div class="input dropdown">Veuillez sélectionner</div>
                    </div>
                </div>

                <div class="form-grid-3">
                    <div class="form-field">
                        <label>Numéro de référence :</label>
                        <div class="input"></div>
                        <div class="help">Laisser vide pour générer automatiquement</div>
                    </div>
                    <div class="form-field">
                        <label>Dépense pour : ⓘ</label>
                        <div class="input dropdown">ali</div>
                    </div>
                    <div class="form-field">
                        <label>Dépense de la part :</label>
                        <div class="input dropdown">– société marmouri (CO0006)</div>
                    </div>
                </div>

                <div class="form-grid-3">
                    <div class="form-field">
                        <label>Date : <span class="req">*</span></label>
                        <div class="input date">📅 24/04/2026 14:20</div>
                    </div>
                    <div class="form-field">
                        <label>Taxe applicable :</label>
                        <div class="input dropdown">Aucun</div>
                    </div>
                    <div class="form-field">
                        <label>Montant total :</label>
                        <div class="input placeholder">Montant TTC</div>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-field">
                        <label>Joindre un document :</label>
                        <div class="file-attach">
                            <div class="input"></div>
                            <span class="browse-btn">📁 Feuilleter…</span>
                        </div>
                        <div class="help">Taille max : 5 Mo — pdf, csv, zip, doc, docx, jpeg, jpg, png</div>
                    </div>
                    <div class="form-field">
                        <label>Note de frais :</label>
                        <textarea placeholder=""></textarea>
                    </div>
                </div>

                <div class="form-check">
                    <span class="cbx"></span> Est remboursé ? ⓘ
                </div>
            </div>

            <!-- Section 2: Récurrence -->
            <div class="form-section">
                <div class="form-grid-3">
                    <div class="form-field" style="margin-bottom:0;">
                        <label>&nbsp;</label>
                        <div class="form-check" style="padding-top:6px;">
                            <span class="cbx"></span> Est récurrent ? ⓘ
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Intervalle récurrent : <span class="req">*</span></label>
                        <div style="display:flex; gap:8px;">
                            <div class="input" style="flex:0.5;"></div>
                            <div class="input dropdown" style="flex:1;">Journées</div>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Nombre de répétitions :</label>
                        <div class="input"></div>
                        <div class="help">Si vide, dépense générée des fois infinies</div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Ajouter un paiement -->
            <div class="form-section">
                <div style="font-size:1rem; font-weight:700; color:#1f2937; margin-bottom:14px;">Ajouter un paiement</div>

                <div class="form-grid-2">
                    <div class="form-field">
                        <label>Montant : <span class="req">*</span></label>
                        <div class="input">💵 0.000</div>
                    </div>
                    <div class="form-field">
                        <label>Payer le : <span class="req">*</span></label>
                        <div class="input date">📅 24/04/2025 14:20</div>
                    </div>
                </div>

                <div class="form-field">
                    <label>Mode de paiement : <span class="req">*</span></label>
                    <div class="input dropdown">💵 En espèces</div>
                </div>

                <div class="form-field">
                    <label>Note de paiement :</label>
                    <textarea></textarea>
                </div>

                <div class="form-check" style="border-top:1px solid #e5e7eb; padding-top:12px; margin-top:8px;">
                    <span class="cbx"></span> Appliquer retenue à la source
                </div>
            </div>

            <!-- Bottom bar with Impayé -->
            <div class="form-bottom-bar">
                <div></div>
                <div class="impaye-display">
                    <div class="lbl">Impayé :</div>
                    <div class="val">0.000</div>
                </div>
            </div>

            <div class="save-btn-row">
                <button class="save-btn">💾 Sauvegarder</button>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CATÉGORIES & SOUS-CATÉGORIES                           -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag">Catégories & sous-catégories</div>
            <h3>Une arborescence à votre image,<br>pour des analyses précises</h3>
            <p>
                Créez vos propres catégories de dépenses et déclinez chacune en autant de sous-catégories que nécessaire. Vous obtenez ainsi des rapports financiers d'une précision chirurgicale : combien dépensez-vous en énergie ? En transport ? En marketing digital vs print ?
            </p>
            <ul class="feature-list">
                <li>Catégories principales illimitées (loyer, salaires, fournitures, marketing…)</li>
                <li>Sous-catégories illimitées par catégorie</li>
                <li>Création à la volée depuis le formulaire de dépense</li>
                <li>Réorganisation libre, fusion ou archivage de catégories</li>
                <li>Couleurs et icônes personnalisables pour chaque catégorie</li>
                <li>Rapports automatiques par catégorie et sous-catégorie</li>
            </ul>
        </div>
        <div>
            <div class="cat-tree">
                <h4>📂 Arborescence des catégories</h4>

                <div class="cat-item">
                    <div class="cat-head">
                        <div class="cat-icon ci-blue">🏢</div>
                        <span>Loyer & charges</span>
                        <span class="cat-amount">TND 12,400</span>
                    </div>
                    <div class="sub-list">
                        <span>Loyer du local principal</span>
                        <span>Loyer du dépôt</span>
                        <span>Charges locatives</span>
                    </div>
                </div>

                <div class="cat-item">
                    <div class="cat-head">
                        <div class="cat-icon ci-green">⚡</div>
                        <span>Énergie & utilities</span>
                        <span class="cat-amount">TND 3,840</span>
                    </div>
                    <div class="sub-list">
                        <span>Électricité STEG</span>
                        <span>Eau SONEDE</span>
                        <span>Internet & téléphonie</span>
                    </div>
                </div>

                <div class="cat-item">
                    <div class="cat-head">
                        <div class="cat-icon ci-purple">👔</div>
                        <span>Salaires & RH</span>
                        <span class="cat-amount">TND 28,500</span>
                    </div>
                    <div class="sub-list">
                        <span>Salaires nets</span>
                        <span>CNSS — part patronale</span>
                        <span>Primes & indemnités</span>
                    </div>
                </div>

                <div class="cat-item">
                    <div class="cat-head">
                        <div class="cat-icon ci-rose">📣</div>
                        <span>Marketing</span>
                        <span class="cat-amount">TND 1,820</span>
                    </div>
                    <div class="sub-list">
                        <span>Publicité Facebook</span>
                        <span>Impression flyers</span>
                    </div>
                </div>

                <div class="cat-item">
                    <div class="cat-head">
                        <div class="cat-icon ci-amber">🚗</div>
                        <span>Transport & déplacements</span>
                        <span class="cat-amount">TND 940</span>
                    </div>
                    <div class="sub-list">
                        <span>Carburant véhicules</span>
                        <span>Entretien véhicules</span>
                    </div>
                </div>

                <div class="alert-box alert-amber">
                    <span>💡</span>
                    <span>Aucune limite : ajoutez autant de catégories et sous-catégories que votre activité le nécessite.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CHAMPS DÉTAILLÉS                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag blue">Champs intelligents</div>
        <h2 class="section-title">Chaque champ a un sens — et fait gagner du temps</h2>
        <p class="section-subtitle">
            Le formulaire de dépense ne se contente pas de capturer un montant : il enrichit chaque saisie avec le contexte nécessaire pour des analyses fines et une traçabilité complète.
        </p>

        <div class="feat-grid">
            <div class="feat-card">
                <div class="feat-icon fi-blue">📍</div>
                <div>
                    <h4>Lieu d'affaires</h4>
                    <p>Affectez la dépense à un magasin, dépôt ou succursale précis pour analyser la rentabilité par site.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-amber">📂</div>
                <div>
                    <h4>Catégorie & sous-catégorie</h4>
                    <p>Classement à 2 niveaux pour des rapports financiers précis sur chaque type de dépense.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-purple">🔢</div>
                <div>
                    <h4>Numéro de référence</h4>
                    <p>Saisi manuellement ou généré automatiquement — pour retrouver chaque dépense en un clin d'œil.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-teal">📅</div>
                <div>
                    <h4>Date & heure</h4>
                    <p>Saisissez la date réelle de la dépense, indépendante de la date de saisie. Idéal pour la régularisation.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-rose">👤</div>
                <div>
                    <h4>Dépense pour</h4>
                    <p>Bénéficiaire de la dépense : un employé, un fournisseur, un partenaire — relié à votre carnet de tiers.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-blue">🏭</div>
                <div>
                    <h4>Dépense de la part</h4>
                    <p>Société qui a engagé la dépense, utile en cas de gestion multi-sociétés ou de groupe.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-green">🧾</div>
                <div>
                    <h4>Taxe applicable</h4>
                    <p>TVA, droits ou taxes spécifiques à la dépense — calcul automatique du HT/TTC.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-amber">💰</div>
                <div>
                    <h4>Montant TTC</h4>
                    <p>Le montant total payé, taxes comprises. Le HT et les taxes sont déduits automatiquement.</p>
                </div>
            </div>
            <div class="feat-card">
                <div class="feat-icon fi-dark">📝</div>
                <div>
                    <h4>Note de frais</h4>
                    <p>Champ libre pour décrire la dépense, justifier un montant ou laisser un commentaire interne.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  PIÈCES JOINTES                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag green">Pièces justificatives</div>
            <h3>Une comptabilité irréprochable,<br>en cas de contrôle fiscal comme au quotidien</h3>
            <p>
                Joignez à chaque dépense la facture, le reçu, la photo du ticket de caisse ou tout document justificatif. En cas de contrôle ou d'audit, vous retrouvez tout en un clic — fini les classeurs poussiéreux et les recherches interminables.
            </p>
            <ul class="feature-list">
                <li class="green">Stockage sécurisé dans le cloud Simplex</li>
            </ul>
        </div>
        <div>
            <div class="cat-tree">
                <h4>📎 Pièces jointes — Loyer mars 2026</h4>

                <div style="display:flex; gap:12px; align-items:center; padding:14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:10px;">
                    <div style="width:42px; height:42px; background:rgba(239,68,68,0.15); color:#f87171; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0;">📄</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.9rem;">Quittance loyer mars 2026.pdf</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:3px;">2.1 Mo — 01/03/2026</div>
                    </div>
                    <span style="color:var(--teal); cursor:pointer;">👁</span>
                    <span style="color:var(--text-muted); cursor:pointer;">⬇</span>
                </div>

                <div style="display:flex; gap:12px; align-items:center; padding:14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:10px;">
                    <div style="width:42px; height:42px; background:rgba(20,184,166,0.15); color:var(--teal); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0;">🖼️</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.9rem;">Reçu propriétaire.jpg</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:3px;">1.4 Mo — 01/03/2026</div>
                    </div>
                    <span style="color:var(--teal); cursor:pointer;">👁</span>
                    <span style="color:var(--text-muted); cursor:pointer;">⬇</span>
                </div>

                <div style="display:flex; gap:12px; align-items:center; padding:14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:10px;">
                    <div style="width:42px; height:42px; background:rgba(26,107,250,0.15); color:var(--primary); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0;">📑</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.9rem;">Contrat bail 2024-2027.docx</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:3px;">340 Ko — 01/01/2024</div>
                    </div>
                    <span style="color:var(--teal); cursor:pointer;">👁</span>
                    <span style="color:var(--text-muted); cursor:pointer;">⬇</span>
                </div>

                <button style="width:100%; background:transparent; border:1px dashed var(--amber); color:var(--amber); padding:10px; border-radius:8px; font-size:0.85rem; font-weight:600; margin-top:6px; cursor:pointer;">
                    ⊕ Ajouter une pièce justificative
                </button>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RÉCURRENCE                                             -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag purple">Dépenses récurrentes</div>
                <h3>Configurez une fois,<br>Simplex Gestion s'occupe du reste</h3>
                <p>
                    Loyer mensuel, abonnement internet, salaires, primes d'assurance : automatisez la création de toutes vos dépenses récurrentes. Choisissez l'intervalle (jour, semaine, mois, année) et le nombre de répétitions — la dépense est générée automatiquement à la bonne date, prête à être payée.
                </p>
                <ul class="feature-list">
                    <li class="purple">Intervalles disponibles : journées, semaines, mois, années</li>
                    <li class="purple">Nombre de répétitions personnalisable (ou infini)</li>
                    <li class="purple">Génération automatique à l'échéance prévue</li>
                    <li class="purple">Notification avant chaque génération pour validation</li>
                    <li class="purple">Possibilité de modifier ou suspendre la récurrence à tout moment</li>
                    <li class="purple">Historique complet des occurrences générées et payées</li>
                </ul>
            </div>
            <div>
                <div class="recur-mock">
                    <h4>🔄 Configuration de récurrence</h4>

                    <div class="recur-toggle">
                        <div>
                            <div style="font-size:0.92rem; font-weight:700;">Est récurrent ?</div>
                            <div style="font-size:0.78rem; color:var(--text-muted); margin-top:2px;">Génère la dépense automatiquement</div>
                        </div>
                        <span class="toggle on"></span>
                    </div>

                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin: 14px 0 8px;">
                        Intervalle
                    </div>
                    <div class="interval-options">
                        <div class="int-opt">Journées</div>
                        <div class="int-opt">Semaines</div>
                        <div class="int-opt active">Mois</div>
                        <div class="int-opt">Années</div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:14px;">
                        <div style="padding:12px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px;">
                            <div style="font-size:0.7rem; color:var(--text-muted); margin-bottom:5px;">Tous les</div>
                            <div style="font-size:1.4rem; font-weight:800; color:var(--amber);">1 mois</div>
                        </div>
                        <div style="padding:12px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px;">
                            <div style="font-size:0.7rem; color:var(--text-muted); margin-bottom:5px;">Répétitions</div>
                            <div style="font-size:1.4rem; font-weight:800; color:var(--amber);">12 fois</div>
                        </div>
                    </div>

                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin: 18px 0 8px;">
                        Prochaines occurrences
                    </div>
                    <div class="timeline-rec">
                        <div class="tl-dot done"><span class="tld-day">01/04</span>Payée</div>
                        <div class="tl-dot done"><span class="tld-day">01/05</span>Payée</div>
                        <div class="tl-dot next"><span class="tld-day">01/06</span>À venir</div>
                        <div class="tl-dot"><span class="tld-day">01/07</span>Prévue</div>
                        <div class="tl-dot"><span class="tld-day">01/08</span>Prévue</div>
                    </div>

                    <div class="alert-box alert-amber">
                        <span>💡</span>
                        <span>Si le champ <strong>Nombre de répétitions</strong> est laissé vide, la dépense sera régénérée indéfiniment.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  PAIEMENT — MODES                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag teal">Paiement de la dépense</div>
    <h2 class="section-title">Plusieurs modes, un seul écran</h2>
    <p class="section-subtitle">
        Réglez tout ou partie de la dépense au moment de la saisie ou plus tard. Chaque dépense peut être payée par espèces, virement, chèque, traite ou par paiement multiple — avec une vue claire sur ce qui reste impayé.
    </p>

    <div class="pay-modes-grid">
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(0,194,123,0.15); color:var(--accent);">💵</div>
            <h4>En espèces</h4>
            <p>Paiement immédiat en cash, depuis la caisse</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(26,107,250,0.15); color:var(--primary);">🏦</div>
            <h4>Virement bancaire</h4>
            <p>Transfert vers le compte du bénéficiaire</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(245,158,11,0.15); color:var(--amber);">📝</div>
            <h4>Chèque</h4>
            <p>Avec saisie du n° de chèque et banque</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(167,139,250,0.15); color:var(--accent2);">📜</div>
            <h4>Traite (LCR)</h4>
            <p>Lettre de change avec date d'échéance</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(20,184,166,0.15); color:var(--teal);">💳</div>
            <h4>Carte bancaire</h4>
            <p>Paiement par TPE ou en ligne</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(236,72,153,0.15); color:var(--rose);">💰</div>
            <h4>Paiement multiple</h4>
            <p>Combinaison de plusieurs modes</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(139,154,181,0.15); color:var(--text-muted);">⏳</div>
            <h4>À payer plus tard</h4>
            <p>Dépense enregistrée, réglée ultérieurement</p>
        </div>
        <div class="pay-mode">
            <div class="pm-icon" style="background:rgba(99,102,241,0.15); color:var(--indigo);">⚙</div>
            <h4>Mode personnalisé</h4>
            <p>Définissez vos propres moyens de paiement</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAS — RETENUE À LA SOURCE                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag teal">Retenue à la source (TEJ)</div>
                <h3>Conformité fiscale tunisienne,<br>calcul automatique</h3>
                <p>
                    Cochez la case <strong>« Appliquer retenue à la source »</strong> et Simplex Gestion calcule automatiquement le montant de la RAS selon le taux applicable au type de dépense (services, honoraires, locations, commissions…). Le montant net à payer est ajusté en conséquence et la retenue est tracée pour votre déclaration mensuelle.
                </p>
                <ul class="feature-list">
                    <li class="teal">Application en un clic depuis le formulaire de dépense</li>
                    <li class="teal">Taux RAS configurables par catégorie de dépense</li>
                    <li class="teal">Calcul automatique du net à payer</li>
                    <li class="teal">Génération du certificat de retenue à la source</li>
                </ul>
            </div>
            <div>
                <div class="ras-mock">
                    <h4>💼 Calcul de la retenue à la source</h4>

                    <div style="padding: 14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:14px;">
                        <div style="font-size:0.78rem; color:var(--text-muted); margin-bottom:6px;">Type de dépense</div>
                        <div style="font-size:0.95rem; font-weight:700; color:var(--text-main);">Honoraires de consulting</div>
                        <div style="display:inline-block; margin-top:6px;" class="badge badge-amber">Taux RAS : 5 %</div>
                    </div>

                    <div class="ras-line">
                        <span class="rl-lbl">Montant brut HT</span>
                        <span class="rl-val">TND 1,500.000</span>
                    </div>
                    <div class="ras-line">
                        <span class="rl-lbl">+ TVA (19 %)</span>
                        <span class="rl-val">TND 285.000</span>
                    </div>
                    <div class="ras-line">
                        <span class="rl-lbl"><strong>Montant TTC</strong></span>
                        <span class="rl-val">TND 1,785.000</span>
                    </div>
                    <div class="ras-line minus">
                        <span class="rl-lbl">− Retenue à la source (5 % du HT)</span>
                        <span class="rl-val">− TND 75.000</span>
                    </div>
                    <div class="ras-line total">
                        <span class="rl-lbl">Net à payer au fournisseur</span>
                        <span class="rl-val">TND 1,710.000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  REMBOURSEMENTS                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag danger">Dépenses remboursables</div>
            <h3>Suivez les frais avancés,<br>jamais une dépense ne sera oubliée</h3>
            <p>
                Un employé qui avance des frais professionnels, un fournisseur qui doit vous rembourser une avance, une dépense engagée pour le compte d'un client à refacturer : cochez simplement <strong>« Est remboursé ? »</strong> et Simplex Gestion suit automatiquement le statut de remboursement.
            </p>
            <ul class="feature-list">
                <li class="danger">Marquage en un clic depuis le formulaire de dépense</li>
                <li class="danger">Refacturation automatique</li>
                <li class="danger">Notes de frais imprimables pour les employés</li>
                <li class="danger">Rappels automatiques en cas de remboursement en retard</li>
            </ul>
        </div>
        <div>
            <div class="cat-tree">
                <h4>↩️ Dépenses en attente de remboursement</h4>

                <div style="display:flex; align-items:center; padding:12px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:10px;">
                    <div style="width:42px; height:42px; background:rgba(245,158,11,0.15); color:var(--amber); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; margin-right:12px;">⛽</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.88rem;">Carburant déplacement Sfax</div>
                        <div style="font-size:0.74rem; color:var(--text-muted); margin-top:2px;">Avancé par <strong>Mehdi T.</strong> — 18/04/2026</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-weight:700; font-size:0.95rem;">TND 145.000</div>
                        <span class="badge badge-red" style="margin-top:2px; display:inline-block;">⏳ En attente</span>
                    </div>
                </div>

                <div style="display:flex; align-items:center; padding:12px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:10px;">
                    <div style="width:42px; height:42px; background:rgba(20,184,166,0.15); color:var(--teal); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; margin-right:12px;">🍽️</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.88rem;">Repas client Société Carthago</div>
                        <div style="font-size:0.74rem; color:var(--text-muted); margin-top:2px;">Avancé par <strong>Yasmine B.</strong> — 22/04/2026</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-weight:700; font-size:0.95rem;">TND 87.500</div>
                        <span class="badge badge-amber" style="margin-top:2px; display:inline-block;">⌛ Partiel</span>
                    </div>
                </div>

                <div style="display:flex; align-items:center; padding:12px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:14px;">
                    <div style="width:42px; height:42px; background:rgba(167,139,250,0.15); color:var(--accent2); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; margin-right:12px;">📦</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:0.88rem;">Fournitures bureau urgentes</div>
                        <div style="font-size:0.74rem; color:var(--text-muted); margin-top:2px;">Avancé par <strong>Ahmed K.</strong> — 23/04/2026</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-weight:700; font-size:0.95rem;">TND 64.000</div>
                        <span class="badge badge-green" style="margin-top:2px; display:inline-block;">✓ Remboursé</span>
                    </div>
                </div>

                <div style="display:flex; justify-content:space-between; padding:14px 0 0; border-top:2px solid var(--danger);">
                    <span style="font-weight:700;">Total à rembourser</span>
                    <span style="font-size:1.2rem; font-weight:800; color:#f87171;">TND 232.500</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  REPORTING                                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row reverse">
            <div class="feature-content">
                <div class="section-tag">Analyse des dépenses</div>
                <h3>Visualisez où va votre argent,<br>en un coup d'œil</h3>
                <p>
                    Toutes les dépenses enregistrées alimentent automatiquement vos rapports financiers. Visualisez la répartition par catégorie, par lieu d'affaires, par bénéficiaire ou par période, et identifiez en quelques secondes les postes qui pèsent le plus sur votre marge.
                </p>
                <ul class="feature-list">
                    <li>Répartition par catégorie / sous-catégorie</li>
                    <li>Comparaison période sur période (mois, trimestre, année)</li>
                    <li>Répartition par lieu d'affaires</li>
                    <li>Évolution mensuelle des dépenses récurrentes</li>
                    <li>Export Excel et PDF pour partage et archivage</li>
                </ul>
            </div>
            <div>
                <div class="report-mock">
                    <h4>
                        📊 Répartition des dépenses
                        <span class="period">Avril 2026</span>
                    </h4>

                    <div class="report-row">
                        <span class="rr-label">Salaires & RH</span>
                        <div class="rr-bar"><div class="rr-fill rrf-1" style="width:88%;"></div></div>
                        <span class="rr-amount">28,500</span>
                    </div>
                    <div class="report-row">
                        <span class="rr-label">Loyer & charges</span>
                        <div class="rr-bar"><div class="rr-fill rrf-2" style="width:38%;"></div></div>
                        <span class="rr-amount">12,400</span>
                    </div>
                    <div class="report-row">
                        <span class="rr-label">Énergie & utilities</span>
                        <div class="rr-bar"><div class="rr-fill rrf-3" style="width:12%;"></div></div>
                        <span class="rr-amount">3,840</span>
                    </div>
                    <div class="report-row">
                        <span class="rr-label">Marketing</span>
                        <div class="rr-bar"><div class="rr-fill rrf-4" style="width:6%;"></div></div>
                        <span class="rr-amount">1,820</span>
                    </div>
                    <div class="report-row">
                        <span class="rr-label">Transport</span>
                        <div class="rr-bar"><div class="rr-fill rrf-5" style="width:3%;"></div></div>
                        <span class="rr-amount">940</span>
                    </div>
                    <div class="report-row">
                        <span class="rr-label">Fournitures bureau</span>
                        <div class="rr-bar"><div class="rr-fill rrf-6" style="width:2%;"></div></div>
                        <span class="rr-amount">580</span>
                    </div>

                    <div class="report-summary">
                        <div class="rs-card">
                            <div class="lbl">Total mois</div>
                            <div class="val" style="color:var(--amber);">TND 48,080</div>
                        </div>
                        <div class="rs-card">
                            <div class="lbl">Récurrentes</div>
                            <div class="val" style="color:var(--accent2);">TND 41,200</div>
                        </div>
                    </div>
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
    <h2>Reprenez le contrôle<br>de vos sorties d'argent</h2>
    <p>
        Une dépense bien tracée, c'est une marge protégée. Démarrez gratuitement avec Simplex Gestion et structurez vos dépenses dès aujourd'hui.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Catégories illimitées</span>
        <span style="font-size:0.85rem; color:white;">✓ Récurrence automatique</span>
        <span style="font-size:0.85rem; color:white;">✓ RAS & conformité fiscale</span>
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
