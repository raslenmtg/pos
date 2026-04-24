<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rapports et statistiques de gestion en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Analysez votre activité avec Simplex Gestion : rapports financiers, ventes, achats, stock, tiers, dépenses et exports PDF/Excel/CSV en temps réel.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Rapports et statistiques de gestion en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Prenez des décisions fiables grâce à des rapports métier complets, filtrables et exportables.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Rapports et statistiques de gestion en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="17+ rapports prêts à l'emploi pour piloter ventes, stock, achats et performance financière.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Module Rapports & Statistiques",
            "serviceType": "Logiciel de reporting de gestion",
            "description": "Solution de reporting pour analyser les performances commerciales, financières et opérationnelles.",
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
            --cyan: #2948ff;
            --cyan-light: #38b2f5;
            --cyan-dark: #1a35cc;
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
            color: var(--cyan);
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
            background: linear-gradient(90deg, var(--cyan), var(--cyan-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 720px; margin: 0 auto 40px;
            font-size: 1.15rem; color: var(--text-light);
        }
        .hero-stats { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; position: relative; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 800; color: var(--cyan); }
        .hero-stat span   { font-size: 0.88rem; color: var(--text-muted); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--cyan); margin-bottom: 16px;
        }
        .section-tag::before {
            content: ''; display: inline-block;
            width: 24px; height: 2px;
            background: var(--cyan); border-radius: 2px;
        }
        .section-tag.blue   { color: var(--primary); }
        .section-tag.blue::before   { background: var(--primary); }
        .section-tag.green  { color: var(--accent); }
        .section-tag.green::before  { background: var(--accent); }
        .section-tag.purple { color: var(--accent2); }
        .section-tag.purple::before { background: var(--accent2); }
        .section-tag.amber  { color: var(--amber); }
        .section-tag.amber::before  { background: var(--amber); }
        .section-tag.rose   { color: var(--rose); }
        .section-tag.rose::before   { background: var(--rose); }
        .section-tag.danger { color: var(--danger); }
        .section-tag.danger::before { background: var(--danger); }
        .section-tag.teal   { color: var(--teal); }
        .section-tag.teal::before   { background: var(--teal); }

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

        .card-icon {
            width: 44px; height: 44px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 16px;
        }
        .icon-cyan   { background: rgba(6,182,212,0.12); }
        .icon-blue   { background: rgba(26,107,250,0.12); }
        .icon-green  { background: rgba(0,194,123,0.12); }
        .icon-purple { background: rgba(167,139,250,0.12); }
        .icon-amber  { background: rgba(245,158,11,0.12); }
        .icon-rose   { background: rgba(236,72,153,0.12); }
        .icon-teal   { background: rgba(20,184,166,0.12); }
        .icon-red    { background: rgba(239,68,68,0.12); }
        .icon-indigo { background: rgba(99,102,241,0.12); }
        .icon-pos    { background: rgba(255,138,61,0.12); }

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
            background: rgba(6,182,212,0.15);
            color: var(--cyan);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }
        .feature-list li.blue::before   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .feature-list li.purple::before { background: rgba(167,139,250,0.15); color: var(--accent2); }
        .feature-list li.amber::before  { background: rgba(245,158,11,0.15); color: var(--amber); }
        .feature-list li.danger::before { background: rgba(239,68,68,0.15); color: var(--danger); }
        .feature-list li.rose::before   { background: rgba(236,72,153,0.15); color: var(--rose); }
        .feature-list li.teal::before   { background: rgba(20,184,166,0.15); color: var(--teal); }

        /* ─── REPORTS MENU MOCK ───────────────────────────── */
        .menu-mock {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            overflow: hidden;
            max-width: 320px;
            margin: 0 auto;
            color: #1f2937;
        }
        .menu-head {
            background: #f3f4f6;
            padding: 14px 16px;
            display: flex; align-items: center; gap: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 700;
            font-size: 0.95rem;
            color: #1f2937;
        }
        .menu-head .ic {
            width: 28px; height: 28px;
            background: rgba(6,182,212,0.15);
            color: var(--cyan);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
        }
        .menu-head .arrow { margin-left: auto; color: #9ca3af; }
        .menu-list { padding: 8px 0; }
        .menu-item {
            padding: 9px 18px 9px 50px;
            font-size: 0.85rem;
            color: #374151;
            cursor: pointer;
            position: relative;
        }
        .menu-item:hover { background: #f9fafb; color: var(--cyan-dark); }
        .menu-item::before {
            content: '';
            position: absolute;
            left: 28px; top: 50%; transform: translateY(-50%);
            width: 4px; height: 4px;
            border-radius: 50%;
            background: #d1d5db;
        }
        .menu-item.active {
            background: rgba(6,182,212,0.08);
            color: var(--cyan-dark);
            font-weight: 700;
        }
        .menu-item.active::before { background: var(--cyan); }

        /* ─── REPORT MOCK SHELL ─────────────────────────────── */
        .report-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .report-head {
            display: flex; justify-content: space-between; align-items: center;
            padding-bottom: 14px; margin-bottom: 18px;
            border-bottom: 1px solid var(--dark-border);
            gap: 12px; flex-wrap: wrap;
        }
        .report-title {
            font-size: 1rem; font-weight: 700;
            display: flex; align-items: center; gap: 10px;
        }
        .report-period {
            font-size: 0.78rem; color: var(--text-muted);
            background: #ffffff; border: 1px solid var(--dark-border);
            padding: 5px 12px; border-radius: 6px;
        }

        /* P&L mock */
        .pnl-line {
            display: flex; justify-content: space-between;
            padding: 10px 0;
            font-size: 0.88rem;
            border-bottom: 1px solid var(--dark-border);
        }
        .pnl-line .lbl { color: var(--text-light); }
        .pnl-line .val { font-weight: 700; }
        .pnl-line.indent .lbl { padding-left: 16px; color: var(--text-muted); }
        .pnl-line.indent .val { color: var(--text-light); font-weight: 500; }
        .pnl-line.subtotal {
            border-top: 1px solid var(--dark-border);
            border-bottom: 1px solid var(--dark-border);
            margin: 4px 0;
            padding: 12px 0;
        }
        .pnl-line.subtotal .lbl { font-weight: 700; color: var(--text-main); }
        .pnl-line.total {
            border-top: 2px solid var(--cyan);
            padding: 14px 0 0;
            margin-top: 6px;
            font-size: 1.05rem;
        }
        .pnl-line.total .lbl { font-weight: 800; color: var(--text-main); }
        .pnl-line.total .val { font-weight: 800; color: var(--accent); font-size: 1.2rem; }
        .pnl-pos { color: var(--accent); }
        .pnl-neg { color: var(--danger); }

        /* Bar/Chart mock */
        .chart-area {
            height: 200px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 18px 14px 8px;
            display: flex; align-items: flex-end; gap: 10px;
            position: relative;
        }
        .bar-pair {
            flex: 1;
            display: flex; gap: 4px; align-items: flex-end;
            justify-content: center;
            height: 100%;
            position: relative;
        }
        .bar-pair .bar {
            width: 18px;
            border-radius: 3px 3px 0 0;
        }
        .bar-pair .bar.b1 { background: var(--cyan); }
        .bar-pair .bar.b2 { background: var(--rose); }
        .bar-pair .bar.b3 { background: var(--amber); }
        .bar-pair .lbl-x {
            position: absolute;
            bottom: -22px; left: 50%; transform: translateX(-50%);
            font-size: 0.68rem; color: var(--text-muted);
        }
        .chart-legend {
            display: flex; gap: 14px; margin-top: 28px;
            justify-content: center;
            font-size: 0.75rem; color: var(--text-light);
            flex-wrap: wrap;
        }
        .legend-dot {
            display: inline-block; width: 10px; height: 10px;
            border-radius: 2px; margin-right: 6px; vertical-align: middle;
        }

        /* Table mock for reports */
        .rep-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
        .rep-table thead th {
            background: #ffffff;
            padding: 9px 10px;
            text-align: left;
            font-size: 0.7rem; font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em;
            border-bottom: 1px solid var(--dark-border);
        }
        .rep-table tbody td {
            padding: 10px;
            border-bottom: 1px solid var(--dark-border);
            color: var(--text-light);
        }
        .rep-table tbody tr:hover { background: rgba(6,182,212,0.04); }
        .rep-table tfoot td {
            padding: 12px 10px;
            border-top: 2px solid var(--cyan);
            font-weight: 800;
            color: var(--text-main);
        }

        /* Stat cards */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }
        .kpi-card {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 14px;
        }
        .kpi-card .kp-lbl {
            font-size: 0.7rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em; font-weight: 600;
        }
        .kpi-card .kp-val { font-size: 1.4rem; font-weight: 800; margin-top: 4px; }
        .kpi-card .kp-trend { font-size: 0.7rem; margin-top: 4px; }
        .kp-up   { color: var(--accent); }
        .kp-down { color: var(--danger); }

        /* Donut */
        .donut-wrap {
            display: flex; align-items: center; gap: 24px;
            flex-wrap: wrap;
        }
        .donut {
            width: 160px; height: 160px;
            border-radius: 50%;
            background: conic-gradient(
                    var(--cyan) 0% 35%,
                    var(--rose) 35% 58%,
                    var(--amber) 58% 75%,
                    var(--accent2) 75% 88%,
                    var(--accent) 88% 100%
            );
            position: relative;
            flex-shrink: 0;
        }
        .donut::after {
            content: '';
            position: absolute;
            inset: 32px;
            background: var(--dark-card);
            border-radius: 50%;
        }
        .donut-center {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            z-index: 1;
        }
        .donut-center .dval { font-size: 1.3rem; font-weight: 800; color: var(--cyan); }
        .donut-center .dlbl { font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; }
        .donut-legend { flex: 1; min-width: 180px; }
        .donut-legend .dl-row {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 0;
            font-size: 0.85rem;
        }
        .donut-legend .dl-row .col {
            width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0;
        }
        .donut-legend .dl-row .pct {
            margin-left: auto; font-weight: 700;
        }

        /* Line chart simulation */
        .line-chart {
            height: 180px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 16px;
            position: relative;
            overflow: hidden;
        }
        .line-chart svg { width: 100%; height: 100%; }
        .line-grid {
            stroke: #d1d5db;
            stroke-width: 1;
        }
        .line-path {
            fill: none;
            stroke-width: 2.5;
        }

        /* Stock badges */
        .stock-row {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr 1fr;
            gap: 10px;
            padding: 10px 8px;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.82rem;
            align-items: center;
        }
        .stock-row.head {
            font-size: 0.7rem; font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em;
            border-bottom: 1px solid var(--dark-border);
        }
        .stock-row .pname { font-weight: 600; color: var(--text-main); }
        .stock-row .qty   { font-weight: 700; }

        .badge {
            display: inline-block; padding: 2px 9px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .badge-ok      { background: rgba(0,194,123,0.15); color: #1fd89b; }
        .badge-warn    { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .badge-red     { background: rgba(239,68,68,0.15); color: #f87171; }
        .badge-cyan    { background: rgba(6,182,212,0.15); color: var(--cyan); }
        .badge-zero    { background: rgba(139,154,181,0.15); color: var(--text-muted); }

        /* Filter bar */
        .filter-mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
        }
        .filter-mock h4 {
            font-size: 1rem; font-weight: 700;
            margin-bottom: 16px;
            display: flex; align-items: center; gap: 10px;
        }
        .filter-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 12px;
        }
        .filter-input {
            background: #ffffff; border: 1px solid var(--dark-border);
            border-radius: 6px; padding: 9px 12px;
            font-size: 0.82rem; color: var(--text-light);
        }
        .filter-input .lbl { color: var(--text-muted); font-size: 0.7rem; display: block; margin-bottom: 4px; font-weight: 600; }
        .period-tabs {
            display: flex; gap: 6px; flex-wrap: wrap;
            margin: 14px 0;
        }
        .pt {
            padding: 5px 12px; font-size: 0.78rem;
            background: #ffffff; border: 1px solid var(--dark-border);
            color: var(--text-light);
            border-radius: 100px; cursor: pointer;
        }
        .pt.active { background: var(--cyan); color: #fff; border-color: var(--cyan); font-weight: 700; }

        .export-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 6px; }
        .export-btn-d {
            background: #ffffff; border: 1px solid var(--dark-border);
            color: var(--text-light);
            padding: 7px 12px; border-radius: 6px;
            font-size: 0.78rem;
            display: inline-flex; align-items: center; gap: 6px;
        }

        /* ─── ALERT BOX ───────────────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px; font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 14px;
        }
        .alert-cyan   { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.3); color: var(--cyan-light); }
        .alert-amber  { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3); color: #fbbf24; }
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.3); color: #1fd89b; }
        .alert-rose   { background: rgba(236,72,153,0.08); border: 1px solid rgba(236,72,153,0.3); color: #f9a8d4; }

        /* ─── REPORT GRID (17 reports list) ─────────────────── */
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 14px;
        }
        .rep-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-sm);
            padding: 18px 20px;
            display: flex; align-items: flex-start; gap: 14px;
            transition: border-color 0.2s, transform 0.15s;
            cursor: pointer;
        }
        .rep-card:hover {
            border-color: var(--cyan);
            transform: translateY(-2px);
        }
        .rep-icon {
            width: 38px; height: 38px;
            border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #fff;
        }
        .ri-cyan   { background: var(--cyan); }
        .ri-blue   { background: var(--primary); }
        .ri-green  { background: var(--accent); }
        .ri-purple { background: var(--accent2); }
        .ri-amber  { background: var(--amber); }
        .ri-rose   { background: var(--rose); }
        .ri-teal   { background: var(--teal); }
        .ri-red    { background: var(--danger); }
        .ri-indigo { background: var(--indigo); }
        .ri-pos    { background: var(--pos); }
        .rep-card h4 { font-size: 0.92rem; font-weight: 700; margin-bottom: 4px; }
        .rep-card p  { font-size: 0.78rem; color: var(--text-muted); line-height: 1.55; }

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

        /* family header */
        .family-head {
            display: flex; align-items: center; gap: 14px;
            margin: 40px 0 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--dark-border);
        }
        .family-head:first-of-type { margin-top: 0; }
        .family-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .family-head h3 { font-size: 1.2rem; font-weight: 800; }
        .family-head p { font-size: 0.85rem; color: var(--text-muted); margin-top: 2px; }

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
    <div class="hero-label">Module Rapports & Statistiques — Simplex Gestion</div>
    <h1>Toute votre activité,<br><span>en données claires & exploitables</span></h1>
    <p>
        17 rapports prêts à l'emploi pour piloter votre activité au quotidien : profit & perte, marges, stocks, ventes, achats, encaissements, dépenses, performance commerciaux. Filtrez par période, exportez en un clic, prenez les bonnes décisions.
    </p>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">Quatre familles de rapports,<br>une seule vérité comptable</h2>
    <p class="section-subtitle">
        Tous vos rapports sont alimentés en temps réel par les données de vos modules Ventes, Stock, Achats, Caisse, Tiers et Dépenses. Aucune ressaisie, aucun écart possible — vous avez la même information partout.
    </p>

    <div class="cards-grid">
        <div class="card">
            <div class="card-icon icon-cyan">📊</div>
            <h3>Rapports financiers</h3>
            <p>Profit & perte, achat & vente, impôts, encaissements, dépenses, caisse — la vue complète de votre santé financière.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-rose">👥</div>
            <h3>Rapports tiers</h3>
            <p>Suivi détaillé par fournisseur et client, par groupe de clients, et performance de chaque représentant commercial.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-green">📦</div>
            <h3>Rapports stock & produits</h3>
            <p>État de stock, expirations, pertes, tendance des produits les plus vendus, fiches produits détaillées.</p>
        </div>
        <div class="card">
            <div class="card-icon icon-amber">🛒</div>
            <h3>Rapports d'activité</h3>
            <p>Achats et ventes par produit, paiements aux fournisseurs, encaissements clients — flux opérationnels complets.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  MENU MOCK + LIST                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Le menu Rapports</div>
                <h3>17 rapports, accessibles depuis un seul menu</h3>
                <p>
                    Un clic sur le menu <strong>Rapports</strong> et vous accédez à l'ensemble des rapports disponibles, classés logiquement et identifiables d'un coup d'œil. Chaque rapport est interactif : filtrez par période, par lieu d'affaires, par utilisateur, exportez ou imprimez en un clic.
                </p>
                <ul class="feature-list">
                    <li>17 rapports métier prêts à l'emploi</li>
                    <li>Accès instantané depuis le menu latéral</li>
                    <li>Filtres communs : période, lieu d'affaires, utilisateur, statut</li>
                    <li>Données toujours à jour, calculées en temps réel</li>
                    <li>Permissions par utilisateur : qui voit quel rapport</li>
                </ul>
            </div>
            <div>
                <div class="menu-mock">
                    <div class="menu-head">
                        <div class="ic">📊</div>
                        <span>Rapports</span>
                        <span class="arrow">▾</span>
                    </div>
                    <div class="menu-list">
                        <div class="menu-item active">Rapport Profit / Perte</div>
                        <div class="menu-item">Achat & Vente</div>
                        <div class="menu-item">Rapport d'impôt</div>
                        <div class="menu-item">Rapport fournisseur et client</div>
                        <div class="menu-item">Rapport des groupes de clients</div>
                        <div class="menu-item">État de stock</div>
                        <div class="menu-item">Rapport d'expiration du stock</div>
                        <div class="menu-item">Rapport perte du stock</div>
                        <div class="menu-item">Tendance des produits</div>
                        <div class="menu-item">Rapport des produits</div>
                        <div class="menu-item">Rapport d'achat de produits</div>
                        <div class="menu-item">Rapport de vente de produit</div>
                        <div class="menu-item">Rapport de paiement des achats</div>
                        <div class="menu-item">Rapport des encaissements</div>
                        <div class="menu-item">Rapport de dépenses</div>
                        <div class="menu-item">Rapport de caisse</div>
                        <div class="menu-item">Rapport du représentant</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  LISTE COMPLÈTE DES 17 RAPPORTS                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Catalogue complet</div>
    <h2 class="section-title">Les 17 rapports en un coup d'œil</h2>
    <p class="section-subtitle">
        Voici la liste exhaustive des rapports disponibles, regroupés par famille. Chacun est détaillé plus bas avec un aperçu visuel.
    </p>

    <!-- Family 1: Financiers -->
    <div class="family-head">
        <div class="family-icon icon-cyan" style="color:var(--cyan);">📊</div>
        <div>
            <h3>Rapports financiers</h3>
            <p>La photo de votre santé économique</p>
        </div>
    </div>
    <div class="reports-grid">
        <div class="rep-card">
            <div class="rep-icon ri-cyan">📈</div>
            <div>
                <h4>Rapport Profit / Perte</h4>
                <p>Le compte de résultat synthétique : revenus, coûts, marges, bénéfice net, bénéfice brut, pertes, frais d'expédition, retours ...</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-blue">⚖️</div>
            <div>
                <h4>Achat & Vente</h4>
                <p>Comparaison des achats et ventes sur la période — flux entrants vs sortants.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-amber">🧾</div>
            <div>
                <h4>Rapport d'impôt</h4>
                <p>TVA collectée, TVA déductible — éléments pour vos déclarations fiscales.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-green">💵</div>
            <div>
                <h4>Rapport des encaissements</h4>
                <p>Toutes les entrées d'argent par mode de paiement et par période.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-red">💸</div>
            <div>
                <h4>Rapport de dépenses</h4>
                <p>Vos sorties d'argent par catégorie, sous-catégorie et bénéficiaire.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-pos">🛒</div>
            <div>
                <h4>Rapport de caisse</h4>
                <p>Bilan détaillé d'une session de caisse : ouverture, encaissements, clôture.</p>
            </div>
        </div>
    </div>

    <!-- Family 2: Tiers -->
    <div class="family-head">
        <div class="family-icon icon-rose" style="color:var(--rose);">👥</div>
        <div>
            <h3>Rapports Client & Fournisseur</h3>
            <p>Performance de vos relations commerciales</p>
        </div>
    </div>
    <div class="reports-grid">
        <div class="rep-card">
            <div class="rep-icon ri-rose">🤝</div>
            <div>
                <h4>Rapport fournisseur et client</h4>
                <p>Soldes, encours, totaux d'achat, vente, retours, impayés.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-indigo">👨‍👩‍👧</div>
            <div>
                <h4>Rapport des groupes de clients</h4>
                <p>Total des ventes par segment client (ex: particuliers, gros, VIP, partenaires).</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-teal">💼</div>
            <div>
                <h4>Rapport du représentant</h4>
                <p>Performance individuelle de chaque commercial : ventes, commision, dépenses.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-blue">🏭</div>
            <div>
                <h4>Rapport de paiement des achats</h4>
                <p>Suivi des règlements faits aux fournisseurs, par mode et période.</p>
            </div>
        </div>
    </div>

    <!-- Family 3: Stock -->
    <div class="family-head">
        <div class="family-icon icon-green" style="color:var(--accent);">📦</div>
        <div>
            <h3>Rapports stock & produits</h3>
            <p>L'état physique et financier de votre marchandise</p>
        </div>
    </div>
    <div class="reports-grid">
        <div class="rep-card">
            <div class="rep-icon ri-green">📦</div>
            <div>
                <h4>État de stock</h4>
                <p>Inventaire valorisé en temps réel : quantités, valeurs, bénéfice .</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-amber">⏰</div>
            <div>
                <h4>Rapport d'expiration du stock</h4>
                <p>Produits avec leur DLC / DLUO pour déclencher des promos.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-red">⚠️</div>
            <div>
                <h4>Rapport perte du stock</h4>
                <p>Casse, vol, périmé — pour comprendre et réduire la démarque.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-purple">📈</div>
            <div>
                <h4>Tendance des produits</h4>
                <p>Top des produits qui montent, qui descendent, qui stagnent.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-cyan">📋</div>
            <div>
                <h4>Rapport des produits</h4>
                <p>Fiche complète par produit : achats, ventes, marge, rotation.</p>
            </div>
        </div>
    </div>

    <!-- Family 4: Activity -->
    <div class="family-head">
        <div class="family-icon icon-amber" style="color:var(--amber);">🔄</div>
        <div>
            <h3>Rapports d'activité par produit</h3>
            <p>Le détail du flux marchand</p>
        </div>
    </div>
    <div class="reports-grid">
        <div class="rep-card">
            <div class="rep-icon ri-blue">🛍️</div>
            <div>
                <h4>Rapport d'achat de produits</h4>
                <p>Quels produits ont été achetés, en quelle quantité, à quel prix.</p>
            </div>
        </div>
        <div class="rep-card">
            <div class="rep-icon ri-green">💰</div>
            <div>
                <h4>Rapport de vente de produit</h4>
                <p>Ventes ventilées par produit, avec prix, quantités, marges.</p>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORT 1 : PROFIT & PERTE                             -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Rapport Profit / Perte</div>
                <h3>Combien avez-vous réellement gagné ce mois-ci ?</h3>
                <p>
                    Le rapport Profit & Perte agrège tous vos revenus et toutes vos charges sur la période choisie pour vous donner la réponse la plus simple — et la plus importante — qui soit : votre activité est-elle bénéficiaire ?
                </p>
                <ul class="feature-list">
                    <li>Chiffre d'affaires brut, retours et net détaillés</li>
                    <li>Coût des marchandises vendues (COGS)</li>
                    <li>Marge brute calculée automatiquement</li>
                    <li>Détail des charges d'exploitation par catégorie</li>
                    <li>Résultat net avant et après impôt</li>
                    <li>Comparaison automatique vs période précédente</li>
                </ul>
            </div>
            <div>
                <div class="report-mock">
                    <div class="report-head">
                        <div class="report-title">📈 Profit & Perte</div>
                        <div class="report-period">Avril 2026</div>
                    </div>

                    <div class="pnl-line">
                        <span class="lbl">Chiffre d'affaires</span>
                        <span class="val pnl-pos">TND 87,420</span>
                    </div>
                    <div class="pnl-line indent">
                        <span class="lbl">− Retours de vente</span>
                        <span class="val">− TND 1,820</span>
                    </div>
                    <div class="pnl-line subtotal">
                        <span class="lbl">CA net</span>
                        <span class="val">TND 85,600</span>
                    </div>
                    <div class="pnl-line indent">
                        <span class="lbl">− Coût d'achat (CAMV)</span>
                        <span class="val pnl-neg">− TND 52,140</span>
                    </div>
                    <div class="pnl-line subtotal">
                        <span class="lbl">Marge brute</span>
                        <span class="val pnl-pos">TND 33,460 <span class="badge badge-cyan" style="margin-left:6px;">39 %</span></span>
                    </div>
                    <div class="pnl-line indent">
                        <span class="lbl">− Salaires & RH</span>
                        <span class="val">− TND 12,200</span>
                    </div>
                    <div class="pnl-line indent">
                        <span class="lbl">− Loyer & charges</span>
                        <span class="val">− TND 4,800</span>
                    </div>
                    <div class="pnl-line indent">
                        <span class="lbl">− Autres dépenses</span>
                        <span class="val">− TND 3,140</span>
                    </div>
                    <div class="pnl-line total">
                        <span class="lbl">Résultat net</span>
                        <span class="val">+ TND 13,320</span>
                    </div>

                    <div class="alert-box alert-green">
                        <span>✓</span>
                        <span><strong>+ 18 %</strong> par rapport à mars 2026 — la marge brute s'améliore.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORT 2 : ACHAT & VENTE                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag blue">Achat & Vente</div>
            <h3>Comparez vos flux entrants et sortants,<br>jour après jour</h3>
            <p>
                Ce rapport vous montre côte à côte vos achats et vos ventes sur la période choisie, avec un graphique comparatif et des totaux par jour, semaine ou mois. Idéal pour repérer les déséquilibres et les pics d'activité.
            </p>
            <ul class="feature-list">
                <li class="blue">Détail par lieu d'affaires, par catégorie produit</li>
                <li class="blue">Calcul automatique du ratio achats / ventes</li>
                <li class="blue">Identification des pics et creux d'activité</li>
                <li class="blue">Prévisions basées sur l'historique</li>
            </ul>
        </div>
        <div>
            <div class="report-mock">
                <div class="report-head">
                    <div class="report-title">⚖️ Achat & Vente — par semaine</div>
                    <div class="report-period">Avril 2026</div>
                </div>

                <div class="kpi-row">
                    <div class="kpi-card">
                        <div class="kp-lbl">Achats</div>
                        <div class="kp-val" style="color:var(--rose);">TND 52,140</div>
                        <div class="kp-trend kp-up">▲ + 8 %</div>
                    </div>
                    <div class="kpi-card">
                        <div class="kp-lbl">Ventes</div>
                        <div class="kp-val" style="color:var(--cyan);">TND 87,420</div>
                        <div class="kp-trend kp-up">▲ + 12 %</div>
                    </div>
                    <div class="kpi-card">
                        <div class="kp-lbl">Ratio</div>
                        <div class="kp-val" style="color:var(--accent);">1.68</div>
                        <div class="kp-trend kp-up">Sain</div>
                    </div>
                </div>

                <div class="chart-area">
                    <div class="bar-pair">
                        <div class="bar b1" style="height:55%;"></div>
                        <div class="bar b2" style="height:35%;"></div>
                        <span class="lbl-x">S1</span>
                    </div>
                    <div class="bar-pair">
                        <div class="bar b1" style="height:75%;"></div>
                        <div class="bar b2" style="height:48%;"></div>
                        <span class="lbl-x">S2</span>
                    </div>
                    <div class="bar-pair">
                        <div class="bar b1" style="height:62%;"></div>
                        <div class="bar b2" style="height:40%;"></div>
                        <span class="lbl-x">S3</span>
                    </div>
                    <div class="bar-pair">
                        <div class="bar b1" style="height:88%;"></div>
                        <div class="bar b2" style="height:52%;"></div>
                        <span class="lbl-x">S4</span>
                    </div>
                </div>

                <div class="chart-legend">
                    <span><span class="legend-dot" style="background:var(--cyan);"></span>Ventes</span>
                    <span><span class="legend-dot" style="background:var(--rose);"></span>Achats</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORT 3 : IMPÔT                                      -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag amber">Rapport d'impôt</div>
                <h3>Vos déclarations fiscales,<br>préparées d'avance</h3>
                <p>
                    Simplex Gestion calcule en continu votre TVA collectée, votre TVA déductible.
                </p>
                <ul class="feature-list">
                    <li class="amber">TVA collectée détaillée par taux (7 %, 13 %, 19 %)</li>
                    <li class="amber">TVA déductible sur vos achats et dépenses</li>
                    <li class="amber">TVA nette à payer (collectée − déductible)</li>
                    <li class="amber">Retenue à la source cumulée</li>
                </ul>
            </div>
            <div>
                <div class="report-mock">
                    <div class="report-head">
                        <div class="report-title">🧾 Rapport d'impôt</div>
                        <div class="report-period">Avril 2026</div>
                    </div>

                    <table class="rep-table">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Base HT</th>
                            <th>Taux</th>
                            <th style="text-align:right;">TVA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="badge badge-cyan">Collectée</span></td>
                            <td>TND 38,200</td>
                            <td>19 %</td>
                            <td style="text-align:right; color:var(--accent);">+ 7,258</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-cyan">Collectée</span></td>
                            <td>TND 24,100</td>
                            <td>13 %</td>
                            <td style="text-align:right; color:var(--accent);">+ 3,133</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-cyan">Collectée</span></td>
                            <td>TND 12,700</td>
                            <td>7 %</td>
                            <td style="text-align:right; color:var(--accent);">+ 889</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-warn">Déductible</span></td>
                            <td>TND 28,400</td>
                            <td>19 %</td>
                            <td style="text-align:right; color:var(--danger);">− 5,396</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-red">RAS</span></td>
                            <td>TND 4,800</td>
                            <td>5 %</td>
                            <td style="text-align:right;">240</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">TVA </td>
                            <td style="text-align:right; color:var(--amber); font-size:1rem;">TND 5,884</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORT TIERS + GROUPES + REPRÉSENTANT                 -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag rose">Rapports tiers</div>
            <h3>Vos meilleurs partenaires,<br>vos plus mauvais payeurs</h3>
            <p>
                Trois rapports complémentaires pour piloter vos relations commerciales : performance de chaque fournisseur et client, analyse par segment (<strong>groupes de clients</strong>) et performance commerciale par vendeur (<strong>rapport du représentant</strong>).
            </p>
            <ul class="feature-list">
                <li class="rose">Top clients / fournisseurs par CA, marge ou impayés</li>
                <li class="rose">Analyse par segment (ex: particulier, gros, VIP, partenaire)</li>
                <li class="rose">Performance par commercial : CA, marges, fidélisation</li>
                <li class="rose">Détection des comptes dormants ou décroissants</li>
                <li class="rose">Suivi jusqu'à la facture individuelle</li>
            </ul>
        </div>
        <div>
            <div class="report-mock">
                <div class="report-head">
                    <div class="report-title">🏆 Top 5 clients — par CA</div>
                    <div class="report-period">Avril 2026</div>
                </div>

                <table class="rep-table">
                    <thead>
                    <tr>
                        <th>Client</th>
                        <th>Ventes</th>
                        <th>Marge</th>
                        <th style="text-align:right;">Impayé</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>Société Carthago</strong><br><span style="color:var(--text-muted); font-size:0.7rem;">Gros</span></td>
                        <td>TND 12,840</td>
                        <td>TND 4,820</td>
                        <td style="text-align:right;"><span class="badge badge-red">4,820</span></td>
                    </tr>
                    <tr>
                        <td><strong>Pharmacie Centrale</strong><br><span style="color:var(--text-muted); font-size:0.7rem;">VIP</span></td>
                        <td>TND 9,450</td>
                        <td>TND 3,778</td>
                        <td style="text-align:right;"><span class="badge badge-zero">0</span></td>
                    </tr>
                    <tr>
                        <td><strong>Sami Ben Ali</strong><br><span style="color:var(--text-muted); font-size:0.7rem;">Détail</span></td>
                        <td>TND 4,820</td>
                        <td>TND 1,640</td>
                        <td style="text-align:right;"><span class="badge badge-warn">142</span></td>
                    </tr>
                    <tr>
                        <td><strong>Mehdi Trabelsi</strong><br><span style="color:var(--text-muted); font-size:0.7rem;">Détail</span></td>
                        <td>TND 3,200</td>
                        <td>TND 1,120</td>
                        <td style="text-align:right;"><span class="badge badge-red">685</span></td>
                    </tr>
                    <tr>
                        <td><strong>Société Marsa Tex</strong><br><span style="color:var(--text-muted); font-size:0.7rem;">Gros</span></td>
                        <td>TND 2,890</td>
                        <td>TND 980</td>
                        <td style="text-align:right;"><span class="badge badge-zero">0</span></td>
                    </tr>
                    </tbody>
                </table>

                <div style="border-top:1px solid var(--dark-border); margin-top:14px; padding-top:14px;">
                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:10px;">
                        Performance des représentants
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; padding:8px 0; font-size:0.85rem;">
                        <span style="width:24px; height:24px; background:var(--cyan); color:#fff; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:0.7rem; font-weight:700;">A</span>
                        <span style="flex:1;">Ahmed K.</span>
                        <strong>TND 38,400</strong>
                        <span class="badge badge-ok">17 ventes</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; padding:8px 0; font-size:0.85rem;">
                        <span style="width:24px; height:24px; background:var(--rose); color:#fff; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:0.7rem; font-weight:700;">Y</span>
                        <span style="flex:1;">Yasmine B.</span>
                        <strong>TND 28,200</strong>
                        <span class="badge badge-ok">14 ventes</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; padding:8px 0; font-size:0.85rem;">
                        <span style="width:24px; height:24px; background:var(--amber); color:#fff; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:0.7rem; font-weight:700;">M</span>
                        <span style="flex:1;">Mehdi T.</span>
                        <strong>TND 20,820</strong>
                        <span class="badge badge-warn">9 ventes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORTS STOCK                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag green">Rapports stock</div>
                <h3>5 rapports pour piloter votre marchandise<br>au gramme près</h3>
                <p>
                    L'<strong>État de stock</strong> donne la photo en temps réel. Le <strong>Rapport d'expiration</strong> alerte sur les DLC qui approchent. Le <strong>Rapport perte du stock</strong> trace casse, vol et démarque. La <strong>Tendance des produits</strong> révèle les vedettes et les invendus. Et le <strong>Rapport des produits</strong> donne la fiche détaillée par référence.
                </p>
                <ul class="feature-list">
                    <li class="green">Inventaire valorisé</li>
                    <li class="green">Alertes seuils : rupture, sur-stock, expiration</li>
                    <li class="green">Suivi des pertes par cause (casse, vol, périmé, autre)</li>
                    <li class="green">Top des produits qui montent / descendent / stagnent</li>
                    <li class="green">Filtres par catégorie, fournisseur, lieu d'affaires</li>
                </ul>
            </div>
            <div>
                <div class="report-mock">
                    <div class="report-head">
                        <div class="report-title">📦 État de stock — alertes</div>
                        <div class="report-period">Aujourd'hui</div>
                    </div>

                    <div class="stock-row head">
                        <span>Produit</span>
                        <span>Stock</span>
                        <span>Statut</span>
                        <span style="text-align:right;">Valeur</span>
                    </div>
                    <div class="stock-row">
          <span>
            <span class="pname">Lait UHT 1L</span>
            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. P-0124</div>
          </span>
                        <span class="qty">12 u.</span>
                        <span><span class="badge badge-red">⚠ Rupture</span></span>
                        <span style="text-align:right;">TND 24</span>
                    </div>
                    <div class="stock-row">
          <span>
            <span class="pname">Yaourt nature 4×125g</span>
            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. P-0089</div>
          </span>
                        <span class="qty">42 u.</span>
                        <span><span class="badge badge-warn">⏰ Expire 15j</span></span>
                        <span style="text-align:right;">TND 168</span>
                    </div>
                    <div class="stock-row">
          <span>
            <span class="pname">Huile olive 1L</span>
            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. P-0042</div>
          </span>
                        <span class="qty">186 u.</span>
                        <span><span class="badge badge-ok">✓ OK</span></span>
                        <span style="text-align:right;">TND 3,720</span>
                    </div>
                    <div class="stock-row">
          <span>
            <span class="pname">Pâtes spaghetti 500g</span>
            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. P-0056</div>
          </span>
                        <span class="qty">8 u.</span>
                        <span><span class="badge badge-red">⚠ Rupture</span></span>
                        <span style="text-align:right;">TND 12</span>
                    </div>
                    <div class="stock-row">
          <span>
            <span class="pname">Conserve thon 200g</span>
            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. P-0078</div>
          </span>
                        <span class="qty">524 u.</span>
                        <span><span class="badge badge-warn">📈 Sur-stock</span></span>
                        <span style="text-align:right;">TND 1,572</span>
                    </div>

                    <div style="border-top:2px solid var(--cyan); margin-top:14px; padding-top:14px; display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px;">
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Valeur totale</div>
                            <div style="font-size:1.1rem; font-weight:800; color:var(--cyan); margin-top:4px;">TND 84,250</div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Alertes</div>
                            <div style="font-size:1.1rem; font-weight:800; color:var(--danger); margin-top:4px;">8</div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Réf. actives</div>
                            <div style="font-size:1.1rem; font-weight:800; color:var(--accent); margin-top:4px;">412</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  TENDANCE DES PRODUITS                                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag purple">Tendance des produits</div>
            <h3>Quels produits font votre chiffre,<br>quels produits dorment ?</h3>
            <p>
                Le rapport Tendance classe vos produits selon leur progression : ceux qui montent fort, ceux qui s'effondrent, ceux qui stagnent. Idéal pour ajuster vos commandes, lancer des promotions sur les invendus, ou capitaliser sur les best-sellers.
            </p>
            <ul class="feature-list">
                <li class="purple">Variation période sur période en % et en valeur</li>
                <li class="purple">Top 10 produits en croissance</li>
                <li class="purple">Top 10 produits en décroissance</li>
                <li class="purple">Produits dormants (aucune vente sur N jours)</li>
            </ul>
        </div>
        <div>
            <div class="report-mock">
                <div class="report-head">
                    <div class="report-title">📈 Tendance des produits</div>
                    <div class="report-period">30 derniers jours</div>
                </div>

                <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">
                    🚀 En forte croissance
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Eau minérale 1.5L</span>
                    <span class="qty">+ 142 %</span>
                    <span style="text-align:right;"><span class="badge badge-ok">↗ Boost</span></span>
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Café moulu 250g</span>
                    <span class="qty">+ 88 %</span>
                    <span style="text-align:right;"><span class="badge badge-ok">↗ Boost</span></span>
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Biscuits chocolat</span>
                    <span class="qty">+ 56 %</span>
                    <span style="text-align:right;"><span class="badge badge-ok">↗ Boost</span></span>
                </div>

                <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin: 18px 0 8px;">
                    📉 En forte baisse
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Sirop concentré 1L</span>
                    <span class="qty" style="color:var(--danger);">− 64 %</span>
                    <span style="text-align:right;"><span class="badge badge-red">↘ Promo ?</span></span>
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Conserve thon 200g</span>
                    <span class="qty" style="color:var(--danger);">− 38 %</span>
                    <span style="text-align:right;"><span class="badge badge-red">↘ Promo ?</span></span>
                </div>

                <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin: 18px 0 8px;">
                    😴 Dormants (0 vente)
                </div>
                <div class="stock-row" style="grid-template-columns:1.5fr 80px 80px;">
                    <span class="pname">Confiture fraise 350g</span>
                    <span class="qty" style="color:var(--text-muted);">0 vente</span>
                    <span style="text-align:right;"><span class="badge badge-warn">⚠ 60 j</span></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  ENCAISSEMENTS / PAIEMENTS                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag green">Encaissements & paiements</div>
                <h3>Tous les flux de trésorerie,<br>par mode et par période</h3>
                <p>
                    Le <strong>Rapport des encaissements</strong> ventile vos entrées d'argent par mode de paiement (espèces, chèque, virement, carte, traite ...). Le <strong>Rapport de paiement des achats</strong> fait pareil pour les sorties — un véritable journal de trésorerie en temps réel.
                </p>
                <ul class="feature-list">
                    <li class="green">Encaissements par mode : espèces, chèque, virement, carte, traite ...</li>
                    <li class="green">Détail par jour, par caisse, par utilisateur</li>
                    <li class="green">Paiements aux fournisseurs avec dates d'émission et d'échéance</li>
                    <li class="green">Suivi des chèques et traites en circulation</li>
                    <li class="green">Rapprochement bancaire facilité</li>
                </ul>
            </div>
            <div>
                <div class="report-mock">
                    <div class="report-head">
                        <div class="report-title">💵 Encaissements par mode</div>
                        <div class="report-period">Avril 2026</div>
                    </div>

                    <div class="donut-wrap">
                        <div class="donut">
                            <div class="donut-center">
                                <span class="dval">87.4k</span>
                                <span class="dlbl">TND total</span>
                            </div>
                        </div>
                        <div class="donut-legend">
                            <div class="dl-row">
                                <span class="col" style="background:var(--cyan);"></span>
                                <span>Espèces</span>
                                <span class="pct">35 %</span>
                            </div>
                            <div class="dl-row">
                                <span class="col" style="background:var(--rose);"></span>
                                <span>Carte</span>
                                <span class="pct">23 %</span>
                            </div>
                            <div class="dl-row">
                                <span class="col" style="background:var(--amber);"></span>
                                <span>Virement</span>
                                <span class="pct">17 %</span>
                            </div>
                            <div class="dl-row">
                                <span class="col" style="background:var(--accent2);"></span>
                                <span>Chèque</span>
                                <span class="pct">13 %</span>
                            </div>
                            <div class="dl-row">
                                <span class="col" style="background:var(--accent);"></span>
                                <span>Traite</span>
                                <span class="pct">12 %</span>
                            </div>
                        </div>
                    </div>

                    <div style="border-top:1px solid var(--dark-border); margin-top:18px; padding-top:14px;">
                        <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                            <span style="color:var(--text-muted);">Encaissements jour</span>
                            <span style="font-weight:700;">TND 3,820</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                            <span style="color:var(--text-muted);">Chèques en circulation</span>
                            <span style="font-weight:700; color:var(--accent2);">TND 11,360</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; padding:6px 0; font-size:0.85rem;">
                            <span style="color:var(--text-muted);">Traites à échoir 30 j</span>
                            <span style="font-weight:700; color:var(--amber);">TND 8,200</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RAPPORT CAISSE                                         -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag" style="color:var(--pos);"><span style="background:var(--pos);"></span>Rapport de caisse</div>
            <h3>Le rapport Z, automatisé pour chaque session</h3>
            <p>
                À chaque clôture de caisse, Simplex Gestion génère un rapport Z détaillé : ouverture, encaissements par mode, dépenses, et clôture. Toutes les sessions sont archivées et accessibles à tout moment depuis le module Rapports.
            </p>
            <ul class="feature-list">
                <li>Détail par session : ouverture, durée, caissier responsable</li>
                <li>Encaissements ventilés par mode de paiement</li>
                <li>Dépenses payées en espèces depuis la caisse</li>
                <li>Historique complet des rapports Z</li>
                <li>Filtre par caissier, par lieu d'affaires, par période</li>
            </ul>
        </div>
        <div>
            <div class="report-mock">
                <div class="report-head">
                    <div class="report-title">🛒 Rapport Z — Caisse #1</div>
                    <div class="report-period">23/04/2026 — Ahmed K.</div>
                </div>

                <div style="padding:14px; background:#ffffff; border:1px solid var(--dark-border); border-radius:8px; margin-bottom:14px;">
                    <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">Fond d'ouverture</span>
                        <span style="font-weight:600;">TND 200.000</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">Heure d'ouverture</span>
                        <span style="font-weight:600;">08:00</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">Heure de clôture</span>
                        <span style="font-weight:600;">20:30</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:5px 0; font-size:0.85rem;">
                        <span style="color:var(--text-muted);">Nombre de tickets</span>
                        <span style="font-weight:600; color:var(--cyan);">47</span>
                    </div>
                </div>

                <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">
                    Encaissements par mode
                </div>
                <table class="rep-table">
                    <tbody>
                    <tr><td>💵 Espèces</td><td style="text-align:right;">TND 1,420.500</td></tr>
                    <tr><td>💳 Carte</td><td style="text-align:right;">TND 980.000</td></tr>
                    <tr><td>🤝 Crédit</td><td style="text-align:right;">TND 480.000</td></tr>
                    <tr><td>📝 Chèque</td><td style="text-align:right;">TND 320.000</td></tr>
                    </tbody>
                    <tfoot>
                    <tr><td>Total</td><td style="text-align:right; color:var(--accent);">TND 3,200.500</td></tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  FILTRES & EXPORT                                       -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag">Filtres & exports</div>
                <h3>Une logique commune à tous les rapports</h3>
                <p>
                    Tous les rapports partagent les mêmes filtres standardisés. Une fois que vous savez utiliser un rapport, vous savez les utiliser tous.
                </p>
                <ul class="feature-list">
                    <li>Sélecteur de période rapide : aujourd'hui, semaine, mois, trimestre, année</li>
                    <li>Période personnalisée via date de début / date de fin</li>
                    <li>Filtre par lieu d'affaires (magasin, dépôt, succursale)</li>
                    <li>Filtre par utilisateur (qui a effectué l'opération)</li>
                    <li>Filtre par catégorie, statut, mode de paiement selon le rapport</li>
                </ul>
            </div>
            <div>
                <div class="filter-mock">
                    <h4>🔍 Filtres du rapport</h4>

                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:600; margin-bottom:6px;">Période</div>
                    <div class="period-tabs">
                        <span class="pt">Aujourd'hui</span>
                        <span class="pt">7 j</span>
                        <span class="pt active">Mois</span>
                        <span class="pt">Trimestre</span>
                        <span class="pt">Année</span>
                        <span class="pt">Personnalisé</span>
                    </div>

                    <div class="filter-row">
                        <div class="filter-input">
                            <span class="lbl">Du</span>
                            01/04/2026
                        </div>
                        <div class="filter-input">
                            <span class="lbl">Au</span>
                            30/04/2026
                        </div>
                    </div>

                    <div class="filter-row">
                        <div class="filter-input">
                            <span class="lbl">Lieu d'affaires</span>
                            Tous ▾
                        </div>
                        <div class="filter-input">
                            <span class="lbl">Utilisateur</span>
                            Tous ▾
                        </div>
                    </div>

                    <div class="filter-row">
                        <div class="filter-input">
                            <span class="lbl">Catégorie</span>
                            Toutes ▾
                        </div>
                        <div class="filter-input">
                            <span class="lbl">Statut</span>
                            Tous ▾
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
    <h2>Pilotez votre commerce<br>avec des données, pas avec votre intuition</h2>
    <p>
        17 rapports prêts à l'emploi, alimentés en temps réel. Fini les tableaux Excel manuels et les bilans de fin de mois bricolés.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:32px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ 17 rapports prêts à l'emploi</span>
        <span style="font-size:0.85rem; color:white;">✓ Séléction par période</span>
        <span style="font-size:0.85rem; color:white;">✓ Données en temps réel</span>
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
