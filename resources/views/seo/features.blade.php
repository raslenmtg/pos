<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fonctionnalités du logiciel de gestion en Tunisie | Simplex Gestion</title>
    <meta name="description" content="Découvrez toutes les fonctionnalités Simplex Gestion : ventes, stock, achats, caisse POS, tiers, dépenses, rapports, utilisateurs, automatisations et sécurité cloud.">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fr_TN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Simplex Gestion">
    <meta property="og:title" content="Fonctionnalités du logiciel de gestion en Tunisie | Simplex Gestion">
    <meta property="og:description" content="Une plateforme complète avec modules connectés pour piloter toute votre activité commerciale.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Fonctionnalités du logiciel de gestion en Tunisie | Simplex Gestion">
    <meta name="twitter:description" content="Explorez les fonctionnalités métiers et transverses de Simplex Gestion.">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "Fonctionnalités générales Simplex Gestion",
            "serviceType": "Plateforme logicielle de gestion",
            "description": "Solution avec modules intégrés pour ventes, achats, stock, caisse, tiers, dépenses et reporting.",
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
            --indigo-dark: #1e40af;
            --indigo-light: #93c5fd;
            --amber: #2948ff;
            --cyan: #38b2f5;
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
            background:
                    radial-gradient(ellipse 80% 60% at 20% 0%, rgba(41,72,255,0.16) 0%, transparent 60%),
                    radial-gradient(ellipse 80% 60% at 80% 100%, rgba(56,178,245,0.1) 0%, transparent 60%),
                    radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 70%);
            padding: 130px 24px 90px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-label {
            display: inline-block;
            background: rgba(41,72,255,0.1);
            border: 1px solid rgba(41,72,255,0.35);
            color: var(--indigo-light);
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 6px 18px; border-radius: 100px;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: clamp(2rem, 5.2vw, 3.6rem);
            font-weight: 800; line-height: 1.15;
            margin-bottom: 24px; position: relative;
        }
        .hero h1 .grad {
            background: linear-gradient(90deg, var(--indigo), var(--cyan), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            max-width: 740px; margin: 0 auto 46px;
            font-size: 1.18rem; color: var(--text-light);
        }
        .module-pills {
            display: flex; justify-content: center; flex-wrap: wrap;
            gap: 10px; max-width: 760px; margin: 0 auto;
        }
        .pill {
            padding: 8px 16px; border-radius: 100px;
            font-size: 0.82rem; font-weight: 600;
            border: 1px solid var(--dark-border);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .pill.blue   { background: rgba(26,107,250,0.1);  color: #93c5fd; border-color: rgba(26,107,250,0.3); }
        .pill.green  { background: rgba(0,194,123,0.1);   color: #6ee7b7; border-color: rgba(0,194,123,0.3); }
        .pill.purple { background: rgba(167,139,250,0.1); color: #c4b5fd; border-color: rgba(167,139,250,0.3); }
        .pill.orange { background: rgba(255,138,61,0.1);  color: #fdba74; border-color: rgba(255,138,61,0.3); }
        .pill.teal   { background: rgba(20,184,166,0.1);  color: #5eead4; border-color: rgba(20,184,166,0.3); }
        .pill.rose   { background: rgba(236,72,153,0.1);  color: #f9a8d4; border-color: rgba(236,72,153,0.3); }
        .pill.amber  { background: rgba(245,158,11,0.1);  color: #fbbf24; border-color: rgba(245,158,11,0.3); }
        .pill.cyan   { background: rgba(6,182,212,0.1);   color: #67e8f9; border-color: rgba(6,182,212,0.3); }

        /* ─── SECTION ─────────────────────────────────────────── */
        .section { padding: 80px 24px; max-width: 1200px; margin: 0 auto; }
        .section-alt { background: #f8fafc; }

        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--indigo); margin-bottom: 16px;
        }
        .section-tag::before {
            content: ''; display: inline-block;
            width: 24px; height: 2px;
            background: var(--indigo); border-radius: 2px;
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
        .section-tag.teal   { color: var(--teal); }
        .section-tag.teal::before   { background: var(--teal); }
        .section-tag.cyan   { color: var(--cyan); }
        .section-tag.cyan::before   { background: var(--cyan); }
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
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: ''; position: absolute;
            top: 0; left: 0; height: 3px; width: 0;
            transition: width 0.3s;
        }
        .card:hover { transform: translateY(-3px); }
        .card:hover::before { width: 100%; }
        .card.indigo:hover { border-color: rgba(99,102,241,0.4); }
        .card.indigo::before { background: var(--indigo); }
        .card.blue:hover   { border-color: rgba(26,107,250,0.4); }
        .card.blue::before   { background: var(--primary); }
        .card.green:hover  { border-color: rgba(0,194,123,0.4); }
        .card.green::before  { background: var(--accent); }
        .card.purple:hover { border-color: rgba(167,139,250,0.4); }
        .card.purple::before { background: var(--accent2); }
        .card.amber:hover  { border-color: rgba(245,158,11,0.4); }
        .card.amber::before  { background: var(--amber); }
        .card.cyan:hover   { border-color: rgba(6,182,212,0.4); }
        .card.cyan::before   { background: var(--cyan); }
        .card.teal:hover   { border-color: rgba(20,184,166,0.4); }
        .card.teal::before   { background: var(--teal); }
        .card.rose:hover   { border-color: rgba(236,72,153,0.4); }
        .card.rose::before   { background: var(--rose); }
        .card.orange:hover { border-color: rgba(255,138,61,0.4); }
        .card.orange::before { background: var(--pos); }
        .card.danger:hover { border-color: rgba(239,68,68,0.4); }
        .card.danger::before { background: var(--danger); }

        .card-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 16px;
        }
        .icon-indigo { background: rgba(99,102,241,0.12); color: var(--indigo-light); }
        .icon-blue   { background: rgba(26,107,250,0.12); color: #93c5fd; }
        .icon-green  { background: rgba(0,194,123,0.12); color: #6ee7b7; }
        .icon-purple { background: rgba(167,139,250,0.12); color: #c4b5fd; }
        .icon-amber  { background: rgba(245,158,11,0.12); color: #fbbf24; }
        .icon-cyan   { background: rgba(6,182,212,0.12); color: #67e8f9; }
        .icon-teal   { background: rgba(20,184,166,0.12); color: #5eead4; }
        .icon-rose   { background: rgba(236,72,153,0.12); color: #f9a8d4; }
        .icon-orange { background: rgba(255,138,61,0.12); color: #fdba74; }
        .icon-red    { background: rgba(239,68,68,0.12); color: #fca5a5; }

        .card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
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
            background: rgba(99,102,241,0.15);
            color: var(--indigo-light);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; margin-top: 2px;
        }
        .feature-list li.blue::before   { background: rgba(26,107,250,0.15); color: var(--primary); }
        .feature-list li.green::before  { background: rgba(0,194,123,0.15); color: var(--accent); }
        .feature-list li.purple::before { background: rgba(167,139,250,0.15); color: var(--accent2); }
        .feature-list li.amber::before  { background: rgba(245,158,11,0.15); color: var(--amber); }
        .feature-list li.cyan::before   { background: rgba(6,182,212,0.15); color: var(--cyan); }
        .feature-list li.teal::before   { background: rgba(20,184,166,0.15); color: var(--teal); }
        .feature-list li.rose::before   { background: rgba(236,72,153,0.15); color: var(--rose); }
        .feature-list li.danger::before { background: rgba(239,68,68,0.15); color: var(--danger); }

        /* ─── MOCK SHELL ──────────────────────────────────── */
        .mock {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }
        .mock h4 {
            font-size: 1rem; font-weight: 700;
            padding-bottom: 12px; margin-bottom: 16px;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 10px;
        }

        /* ─── USERS / ROLES MOCK ─────────────────────────── */
        .role-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 10px;
            padding: 12px 8px;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.85rem;
            align-items: center;
        }
        .role-row.head {
            font-size: 0.7rem; font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em;
            border-bottom: 1px solid var(--dark-border);
        }
        .user-cell {
            display: flex; align-items: center; gap: 10px;
        }
        .avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 0.78rem;
            flex-shrink: 0;
        }
        .av-1 { background: var(--indigo); }
        .av-2 { background: var(--rose); }
        .av-3 { background: var(--amber); }
        .av-4 { background: var(--teal); }
        .av-5 { background: var(--accent); }
        .uname { font-weight: 600; color: var(--text-main); font-size: 0.85rem; }
        .uemail { font-size: 0.7rem; color: var(--text-muted); }
        .role-badge {
            display: inline-block; padding: 3px 10px;
            border-radius: 100px; font-size: 0.7rem; font-weight: 700;
        }
        .rb-admin   { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .rb-manager { background: rgba(99,102,241,0.15); color: var(--indigo-light); }
        .rb-cashier { background: rgba(255,138,61,0.15); color: #fdba74; }
        .rb-stock   { background: rgba(0,194,123,0.15); color: #6ee7b7; }
        .rb-comm    { background: rgba(236,72,153,0.15); color: #f9a8d4; }

        .perms {
            display: flex; gap: 4px; flex-wrap: wrap;
        }
        .perm-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #ffffff;
        }
        .perm-dot.on { background: var(--accent); }

        /* ─── LOCATIONS GRID ─────────────────────────── */
        .loc-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .loc-card {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 14px;
            position: relative;
        }
        .loc-card .lc-head {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 8px;
        }
        .lc-icon {
            width: 28px; height: 28px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }
        .lc-name { font-weight: 700; font-size: 0.88rem; }
        .lc-stats { font-size: 0.75rem; color: var(--text-muted); }
        .lc-stats span { color: var(--text-light); font-weight: 600; }

        /* ─── DEVICES MOCK ─────────────────────────────── */
        .devices-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 14px;
        }
        @media (max-width: 600px) { .devices-row { grid-template-columns: 1fr; } }
        .device {
            text-align: center;
            padding: 18px 14px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 10px;
        }
        .device .icon {
            font-size: 2rem; margin-bottom: 8px;
        }
        .device h5 { font-size: 0.92rem; font-weight: 700; margin-bottom: 4px; }
        .device p  { font-size: 0.75rem; color: var(--text-muted); }

        .sync-bar {
            display: flex; align-items: center; gap: 10px;
            padding: 12px;
            background: rgba(0,194,123,0.08);
            border: 1px solid rgba(0,194,123,0.3);
            border-radius: 8px;
            font-size: 0.85rem;
            color: #6ee7b7;
        }
        .sync-bar .pulse {
            width: 10px; height: 10px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(0,194,123,0.6);
            animation: pulse 1.6s infinite;
        }
        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(0,194,123,0.6); }
            70%  { box-shadow: 0 0 0 10px rgba(0,194,123,0); }
            100% { box-shadow: 0 0 0 0 rgba(0,194,123,0); }
        }

        /* ─── NOTIFICATIONS MOCK ─────────────────────── */
        .notif-item {
            display: flex; gap: 12px; align-items: flex-start;
            padding: 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            margin-bottom: 10px;
            position: relative;
        }
        .notif-item .nicon {
            width: 36px; height: 36px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }
        .notif-item .ntext { flex: 1; }
        .notif-item .ntitle { font-weight: 600; font-size: 0.88rem; color: var(--text-main); }
        .notif-item .ndesc  { font-size: 0.78rem; color: var(--text-muted); margin-top: 2px; }
        .notif-item .ntime  { font-size: 0.7rem; color: var(--text-muted); }
        .notif-item.unread::before {
            content: ''; position: absolute;
            top: 16px; right: 16px;
            width: 8px; height: 8px;
            background: var(--indigo);
            border-radius: 50%;
        }

        .channels {
            display: flex; gap: 8px; flex-wrap: wrap;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--dark-border);
        }
        .channel {
            padding: 6px 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 100px;
            font-size: 0.78rem;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .channel.active {
            background: rgba(99,102,241,0.1);
            border-color: var(--indigo);
            color: var(--indigo-light);
        }

        /* ─── INVOICE TEMPLATE MOCK ─────────────────────── */
        .inv-mock {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            color: #1f2937;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .inv-head {
            display: flex; justify-content: space-between; align-items: flex-start;
            padding-bottom: 14px; margin-bottom: 14px;
            border-bottom: 2px solid var(--indigo);
        }
        .inv-logo {
            width: 48px; height: 48px;
            background: var(--indigo);
            color: #fff; font-weight: 800;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .inv-title {
            font-size: 1.4rem; font-weight: 800;
            color: var(--indigo);
        }
        .inv-meta {
            font-size: 0.7rem; color: #6b7280;
            text-align: right;
        }
        .inv-meta strong { color: #1f2937; }
        .inv-body { font-size: 0.78rem; }
        .inv-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 14px; margin-bottom: 14px;
        }
        .inv-block {
            background: #f9fafb;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        .inv-block .label {
            font-size: 0.65rem;
            color: #6b7280;
            text-transform: uppercase; letter-spacing: 0.04em;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .inv-block strong { color: #1f2937; font-size: 0.78rem; }
        .inv-table { width: 100%; border-collapse: collapse; font-size: 0.72rem; }
        .inv-table th, .inv-table td {
            padding: 6px 4px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .inv-table th { color: #6b7280; font-weight: 700; }
        .inv-totals {
            margin-top: 10px; text-align: right;
            font-size: 0.78rem;
        }
        .inv-totals .ttl-line { padding: 3px 0; }
        .inv-totals .ttl-grand {
            font-weight: 800; font-size: 0.95rem;
            color: var(--indigo);
            border-top: 1px solid #e5e7eb;
            padding-top: 6px; margin-top: 4px;
        }
        .template-tabs {
            display: flex; gap: 6px; margin-bottom: 14px; flex-wrap: wrap;
        }
        .tt {
            padding: 6px 14px; font-size: 0.78rem;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            color: var(--text-light);
            border-radius: 100px; cursor: pointer;
        }
        .tt.active { background: var(--indigo); color: #fff; border-color: var(--indigo); font-weight: 700; }

        /* ─── IMPORT/EXPORT MOCK ─────────────────────────── */
        .ie-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        @media (max-width: 600px) { .ie-grid { grid-template-columns: 1fr; } }
        .ie-card {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            padding: 18px;
        }
        .ie-card .ie-head {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 12px;
            font-weight: 700;
            font-size: 0.95rem;
        }
        .ie-card .ie-list {
            list-style: none; font-size: 0.78rem;
            color: var(--text-light);
        }
        .ie-card .ie-list li {
            padding: 5px 0;
            border-bottom: 1px solid var(--dark-border);
            display: flex; align-items: center; gap: 8px;
        }
        .ie-card .ie-list li:last-child { border-bottom: none; }
        .format-pill {
            display: inline-block; padding: 1px 7px;
            border-radius: 4px; font-size: 0.65rem; font-weight: 700;
            margin-left: auto;
        }
        .fp-pdf { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .fp-xls { background: rgba(0,194,123,0.15); color: #6ee7b7; }
        .fp-csv { background: rgba(99,102,241,0.15); color: var(--indigo-light); }

        /* ─── SECURITY MOCK ────────────────────────────── */
        .sec-row {
            display: flex; align-items: center; gap: 12px;
            padding: 12px;
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .sec-row .sicon {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: rgba(0,194,123,0.15);
            color: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }
        .sec-row .stext { flex: 1; }
        .sec-row .stitle { font-weight: 600; font-size: 0.88rem; }
        .sec-row .sdesc { font-size: 0.75rem; color: var(--text-muted); margin-top: 2px; }
        .sec-row .sbadge {
            background: var(--accent); color: #fff;
            padding: 3px 10px; border-radius: 100px;
            font-size: 0.7rem; font-weight: 700;
        }

        /* ─── AUDIT LOG MOCK ───────────────────────────── */
        .log-line {
            display: grid;
            grid-template-columns: 70px 32px 1fr 90px;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--dark-border);
            font-size: 0.82rem;
            align-items: center;
        }
        .log-line .ltime { font-size: 0.72rem; color: var(--text-muted); font-family: monospace; }
        .log-line .laction { color: var(--text-light); }
        .log-line .luser { font-size: 0.72rem; color: var(--text-muted); text-align: right; }
        .log-line .laction strong { color: var(--text-main); }
        .log-action-icon {
            width: 26px; height: 26px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem;
        }
        .lai-create { background: rgba(0,194,123,0.15); color: #6ee7b7; }
        .lai-edit   { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .lai-delete { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .lai-login  { background: rgba(99,102,241,0.15); color: var(--indigo-light); }
        .lai-pay    { background: rgba(20,184,166,0.15); color: #5eead4; }

        /* ─── SEARCH MOCK ─────────────────────────────── */
        .search-mock {
            background: #ffffff;
            border: 2px solid var(--indigo);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 0 30px rgba(99,102,241,0.3);
        }
        .search-bar {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 12px 14px;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 14px;
        }
        .search-bar .si { color: var(--indigo-light); font-size: 1.1rem; }
        .search-bar .stxt { flex: 1; color: var(--text-main); font-size: 0.92rem; }
        .search-bar .skbd {
            background: #ffffff; padding: 3px 8px;
            border-radius: 4px; font-size: 0.7rem;
            color: var(--text-muted); font-family: monospace;
        }
        .search-cat {
            font-size: 0.7rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
            font-weight: 700;
            padding: 8px 4px 4px;
        }
        .search-result {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 4px;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
        }
        .search-result:hover { background: var(--dark-card); }
        .search-result .sr-icon {
            width: 26px; height: 26px;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .search-result .sr-name { flex: 1; }
        .search-result .sr-meta { font-size: 0.7rem; color: var(--text-muted); }

        /* ─── DASHBOARD MOCK ──────────────────────────── */
        .dash-mock {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.6);
        }
        .dash-head {
            display: flex; justify-content: space-between; align-items: center;
            padding-bottom: 14px; margin-bottom: 14px;
            border-bottom: 1px solid var(--dark-border);
        }
        .dash-title { font-size: 1rem; font-weight: 700; }
        .kpi-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .kpi-tile {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 14px;
            position: relative;
        }
        .kpi-tile .kp-lbl {
            font-size: 0.7rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.04em; font-weight: 600;
        }
        .kpi-tile .kp-val { font-size: 1.4rem; font-weight: 800; margin-top: 4px; }
        .kpi-tile .kp-trend { font-size: 0.7rem; margin-top: 4px; }
        .kp-up   { color: var(--accent); }
        .kp-down { color: var(--danger); }

        .mini-chart {
            margin-top: 14px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 12px;
        }
        .mini-bars {
            height: 60px;
            display: flex; align-items: flex-end; gap: 4px;
        }
        .mini-bars .mb {
            flex: 1;
            background: linear-gradient(180deg, var(--indigo), var(--cyan));
            border-radius: 2px 2px 0 0;
            opacity: 0.85;
        }

        /* ─── BARCODE MOCK ────────────────────────────── */
        .barcode-mock {
            background: #fff;
            border-radius: 8px;
            padding: 18px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
            color: #1f2937;
        }
        .bc-lines {
            display: flex; justify-content: center; gap: 1px;
            height: 70px; margin: 12px 0;
        }
        .bc-lines .bcl { background: #000; }
        .bc-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
        .bc-code { font-family: monospace; font-size: 0.78rem; color: #6b7280; }
        .bc-price { font-size: 1.4rem; font-weight: 800; color: var(--indigo); margin-top: 8px; }

        .scan-options {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin-top: 14px;
        }
        .scan-opt {
            background: #ffffff;
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 12px 8px;
            text-align: center;
            font-size: 0.75rem;
        }
        .scan-opt .icn { font-size: 1.4rem; display: block; margin-bottom: 4px; }

        /* ─── ALERT BOX ──────────────────────────────── */
        .alert-box {
            border-radius: var(--radius-sm);
            padding: 12px 16px; font-size: 0.85rem;
            display: flex; align-items: flex-start; gap: 10px;
            margin-top: 14px;
        }
        .alert-indigo { background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.3); color: var(--indigo-light); }
        .alert-green  { background: rgba(0,194,123,0.08); border: 1px solid rgba(0,194,123,0.3); color: #6ee7b7; }
        .alert-amber  { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3); color: #fbbf24; }
        .alert-cyan   { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.3); color: #67e8f9; }

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

        /* compact stats row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-top: 56px;
        }
        .stat-tile {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            padding: 22px;
            text-align: center;
        }
        .stat-tile .sval {
            font-size: 1.8rem; font-weight: 800;
            background: linear-gradient(90deg, var(--indigo), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-tile .slbl { font-size: 0.85rem; color: var(--text-muted); margin-top: 4px; }

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
    <div class="hero-label">Fonctionnalités générales — Simplex Gestion</div>
    <h1>Une plateforme,<br><span class="grad">tous vos modules connectés</span></h1>
    <p>
        Au-delà de chaque module métier, Simplex Gestion vous offre une gestion complète pour les entreprises tunisiennes : multi-utilisateurs, multi-emplacements, cloud sécurisé, notifications, modèles factures personnalisables, imports & exports massifs, audit complet et bien plus.
    </p>
    <div class="module-pills">
        <span class="pill blue">📊 Ventes</span>
        <span class="pill green">📦 Stock</span>
        <span class="pill purple">🛒 Achats</span>
        <span class="pill orange">🏪 Caisse</span>
        <span class="pill teal">👥 Client / Fournisseur</span>
        <span class="pill amber">💸 Dépenses</span>
        <span class="pill cyan">📈 Rapports</span>
        <span class="pill rose">⚙️ Et tous les autres…</span>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  VUE D'ENSEMBLE — 12 fonctionnalités transversales      -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="section-tag">Vue d'ensemble</div>
    <h2 class="section-title">12 fonctionnalités qui font la différence</h2>
    <p class="section-subtitle">
        Ces fonctionnalités traversent l'ensemble de l'application et démultiplient la puissance de chaque module métier. Vous gagnez en rapidité, en sécurité et en sérénité — au quotidien comme à la croissance.
    </p>

    <div class="cards-grid">
        <div class="card indigo">
            <div class="card-icon icon-indigo">👤</div>
            <h3>Multi-utilisateurs & rôles</h3>
            <p>Créez autant de comptes que nécessaire et contrôlez précisément qui voit quoi et qui peut faire quoi.</p>
        </div>
        <div class="card blue">
            <div class="card-icon icon-blue">📍</div>
            <h3>Multi-emplacements</h3>
            <p>Pilotez plusieurs magasins, dépôts depuis une seule interface, avec stocks et caisses indépendants.</p>
        </div>
        <div class="card cyan">
            <div class="card-icon icon-cyan">☁️</div>
            <h3>100 % cloud, 0 installation</h3>
            <p>Connectez-vous depuis n'importe quel appareil avec un navigateur — données toujours sauvegardées et synchronisées.</p>
        </div>
        <div class="card teal">
            <div class="card-icon icon-teal">📱</div>
            <h3>Multi-appareils</h3>
            <p>Ordinateur, tablette ou smartphone : la même expérience, partout, en parfaite synchronisation.</p>
        </div>
        <div class="card amber">
            <div class="card-icon icon-amber">🔔</div>
            <h3>Notifications & alertes</h3>
            <p>alertes intelligentes du stocks , factures impayées , dépassement de crédit : soyez prévenu au bon moment, par le bon canal.</p>
        </div>
        <div class="card purple">
            <div class="card-icon icon-purple">🎨</div>
            <h3>Modèles personnalisables</h3>
            <p>Personnalisez vos factures, devis, avec votre logo, vos couleurs et votre numérotation.</p>
        </div>
        <div class="card green">
            <div class="card-icon icon-green">📥</div>
            <h3>Imports & exports massifs</h3>
            <p>Importez vos clients, produits, fournisseurs depuis Excel. Exportez n'importe quelle donnée en CSV, Excel ou PDF.</p>
        </div>
        <div class="card danger">
            <div class="card-icon icon-red">🔒</div>
            <h3>Sécurité & sauvegardes</h3>
            <p>Chiffrement des données, authentification renforcée, sauvegardes automatiques quotidiennes — sans rien faire.</p>
        </div>
        <div class="card indigo">
            <div class="card-icon icon-indigo">📜</div>
            <h3>Audit & traçabilité</h3>
            <p>Chaque action est tracée : qui, quoi, quand. Une transparence totale pour vous et pour vos collaborateurs.</p>
        </div>
        <div class="card cyan">
            <div class="card-icon icon-cyan">🔍</div>
            <h3>Recherche globale</h3>
            <p>Trouvez instantanément un client, un produit, une facture ou une dépense depuis n'importe où dans l'application.</p>
        </div>
        <div class="card rose">
            <div class="card-icon icon-rose">📊</div>
            <h3>Tableau de bord centralisé</h3>
            <p>Tous vos KPIs — ventes, stock, paiements, commandes ... — en un seul écran à l'ouverture de l'application.</p>
        </div>
        <div class="card orange">
            <div class="card-icon icon-orange">🏷️</div>
            <h3>Codes-barres & étiquettes</h3>
            <p>Scannez à la caisse, à la réception, à l'inventaire. Imprimez des étiquettes prêtes à coller en quelques clics.</p>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-tile">
            <div class="sval">100 %</div>
            <div class="slbl">en français / arabe / anglais</div>
        </div>
        <div class="stat-tile">
            <div class="sval">24 / 7</div>
            <div class="slbl">disponibilité</div>
        </div>
        <div class="stat-tile">
            <div class="sval">illimités</div>
            <div class="slbl">utilisateurs & emplacements</div>
        </div>
        <div class="stat-tile">
            <div class="sval">🇹🇳</div>
            <div class="slbl">conforme fiscalité tunisienne</div>
        </div>
    </div>
</section>


<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  MULTI-EMPLACEMENTS                                     -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag blue">Multi-emplacements</div>
            <h3>Plusieurs magasins, plusieurs dépôts,<br>une seule plateforme</h3>
            <p>
                Que vous ayez une, deux ou dix boutiques — un dépôt central et des points de vente — Simplex Gestion gère chaque emplacement de manière indépendante tout en consolidant les données au niveau global. Stocks, caisses, ventes, achats : tout est attribué au bon site.
            </p>
            <ul class="feature-list">
                <li class="blue">Magasins, dépôts — emplacements illimités</li>
                <li class="blue">Stock indépendant par site, avec transferts entre sites</li>
                <li class="blue">Caisses séparées par boutique avec leurs propres caissiers</li>
                <li class="blue">Restriction d'accès par utilisateur sur ses emplacements</li>
            </ul>
        </div>
        <div>
            <div class="mock">
                <h4>📍 Tous vos emplacements</h4>

                <div class="loc-grid">
                    <div class="loc-card">
                        <div class="lc-head">
                            <div class="lc-icon" style="background:rgba(26,107,250,0.15); color:#93c5fd;">🏪</div>
                            <div>
                                <div class="lc-name">Magasin La Marsa</div>
                                <div class="lc-stats">Magasin principal</div>
                            </div>
                        </div>
                        <div class="lc-stats">CA jour : <span>TND 3,820</span></div>
                        <div class="lc-stats">Stock : <span>412 réf.</span></div>
                    </div>

                    <div class="loc-card">
                        <div class="lc-head">
                            <div class="lc-icon" style="background:rgba(0,194,123,0.15); color:#6ee7b7;">🏪</div>
                            <div>
                                <div class="lc-name">Magasin Tunis Centre</div>
                                <div class="lc-stats">Succursale</div>
                            </div>
                        </div>
                        <div class="lc-stats">CA jour : <span>TND 2,140</span></div>
                        <div class="lc-stats">Stock : <span>318 réf.</span></div>
                    </div>

                    <div class="loc-card">
                        <div class="lc-head">
                            <div class="lc-icon" style="background:rgba(245,158,11,0.15); color:#fbbf24;">🏪</div>
                            <div>
                                <div class="lc-name">Magasin Sousse</div>
                                <div class="lc-stats">Succursale</div>
                            </div>
                        </div>
                        <div class="lc-stats">CA jour : <span>TND 1,680</span></div>
                        <div class="lc-stats">Stock : <span>284 réf.</span></div>
                    </div>

                    <div class="loc-card">
                        <div class="lc-head">
                            <div class="lc-icon" style="background:rgba(167,139,250,0.15); color:#c4b5fd;">🏭</div>
                            <div>
                                <div class="lc-name">Dépôt central Mégrine</div>
                                <div class="lc-stats">Entrepôt</div>
                            </div>
                        </div>
                        <div class="lc-stats">Mouvements : <span>24 aujourd'hui</span></div>
                        <div class="lc-stats">Stock : <span>1,840 réf.</span></div>
                    </div>
                </div>

                <div style="border-top:2px solid var(--indigo); margin-top:16px; padding-top:14px; display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                    <div style="text-align:center;">
                        <div style="font-size:0.7rem; color:var(--text-muted);">CA groupe / jour</div>
                        <div style="font-size:1.1rem; font-weight:800; color:var(--accent); margin-top:4px;">TND 7,640</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-size:0.7rem; color:var(--text-muted);">Sites actifs</div>
                        <div style="font-size:1.1rem; font-weight:800; color:var(--indigo-light); margin-top:4px;">4</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-size:0.7rem; color:var(--text-muted);">Transferts en cours</div>
                        <div style="font-size:1.1rem; font-weight:800; color:var(--amber); margin-top:4px;">2</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CLOUD & MULTI-APPAREILS                                -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag cyan">Cloud & multi-appareils</div>
                <h3>Travaillez où vous voulez,<br>quand vous voulez, avec ce que vous avez</h3>
                <p>
                    Simplex Gestion fonctionne dans le cloud : aucune installation, aucune maintenance, aucun serveur à gérer. Connectez-vous depuis votre ordinateur de bureau le matin, votre tablette en magasin l'après-midi, votre téléphone en déplacement le soir. Toujours les mêmes données, toujours à jour.
                </p>
                <ul class="feature-list">
                    <li class="cyan">Aucune installation, aucun téléchargement requis</li>
                    <li class="cyan">Compatible Windows, macOS, Linux, iOS, Android</li>
                    <li class="cyan">Synchronisation cloud en temps réel entre appareils</li>
                    <li class="cyan">Mises à jour automatiques transparentes</li>
                    <li class="cyan">Disponibilité 24 / 7</li>
                </ul>
            </div>
            <div>
                <div class="mock">
                    <h4>☁️ Synchronisation multi-appareils</h4>

                    <div class="devices-row">
                        <div class="device">
                            <div class="icon">🖥️</div>
                            <h5>Bureau</h5>
                            <p>Windows, macOS, Linux</p>
                        </div>
                        <div class="device">
                            <div class="icon">📱</div>
                            <h5>Tablette</h5>
                            <p>iPad, Android</p>
                        </div>
                        <div class="device">
                            <div class="icon">📲</div>
                            <h5>Smartphone</h5>
                            <p>iOS, Android</p>
                        </div>
                    </div>

                    <div class="sync-bar">
                        <span class="pulse"></span>
                        <span><strong>Tous vos appareils sont synchronisés</strong></span>
                    </div>

                    <div style="margin-top:14px; padding-top:14px; border-top:1px solid var(--dark-border); display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Chiffrement</div>
                            <div style="font-size:1rem; font-weight:800; color:var(--accent); margin-top:3px;">Haute</div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Sauvegardes</div>
                            <div style="font-size:1rem; font-weight:800; color:var(--cyan); margin-top:3px;">Quotidiennes</div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-size:0.7rem; color:var(--text-muted);">Hébergement</div>
                            <div style="font-size:1rem; font-weight:800; color:var(--indigo-light); margin-top:3px;">Cloud sécurisé</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  NOTIFICATIONS & ALERTES                                -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag amber">Notifications & alertes</div>
            <h3>Soyez prévenu au bon moment,<br>par le bon canal</h3>
            <p>
                Simplex Gestion vous alerte automatiquement sur tous les événements importants : stocks bas, factures impayées, dépassement de limite de crédit, traites à échéance, dépenses récurrentes générées… Choisissez le canal qui vous convient : centre de notifications dans l'app.
            </p>
            <ul class="feature-list">
                <li class="amber">Centre de notifications intégré dans l'application</li>
                <li class="amber">Alertes par e-mail aux personnes concernées</li>
                <li class="amber">Seuils configurables (stock min, crédit max …)</li>
                <li class="amber">Historique complet des alertes envoyées</li>
            </ul>
        </div>
        <div>
            <div class="mock">
                <h4>🔔 Centre de notifications</h4>

                <div class="notif-item unread">
                    <div class="nicon" style="background:rgba(239,68,68,0.15); color:#fca5a5;">⚠️</div>
                    <div class="ntext">
                        <div class="ntitle">Stock critique : Lait UHT 1L</div>
                        <div class="ndesc">Il ne reste que 12 unités — seuil minimum 30. Pensez à recommander.</div>
                        <div class="ntime">Il y a 5 minutes</div>
                    </div>
                </div>

                <div class="notif-item unread">
                    <div class="nicon" style="background:rgba(245,158,11,0.15); color:#fbbf24;">💳</div>
                    <div class="ntext">
                        <div class="ntitle">Limite de crédit dépassée</div>
                        <div class="ndesc">Société Carthago SARL a atteint 96 % de sa limite de crédit (TND 4,820 / 5,000).</div>
                        <div class="ntime">Il y a 23 minutes</div>
                    </div>
                </div>

                <div class="notif-item">
                    <div class="nicon" style="background:rgba(99,102,241,0.15); color:var(--indigo-light);">📅</div>
                    <div class="ntext">
                        <div class="ntitle">Traite arrive à échéance</div>
                        <div class="ndesc">Traite n° T-0058 de TND 2,400 échoit dans 3 jours.</div>
                        <div class="ntime">Il y a 1 heure</div>
                    </div>
                </div>

                <div class="notif-item">
                    <div class="nicon" style="background:rgba(0,194,123,0.15); color:#6ee7b7;">🔄</div>
                    <div class="ntext">
                        <div class="ntitle">Dépense récurrente générée</div>
                        <div class="ndesc">Loyer du local principal (TND 1,200) — prête à être payée.</div>
                        <div class="ntime">Il y a 2 heures</div>
                    </div>
                </div>

                <div class="channels">
                    <span class="channel active">🔔 Notifications app</span>
                    <span class="channel active">📧 E-mail</span>
                    <span class="channel">📱 SMS</span>
                    <span class="channel">📲 Push mobile</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  MODÈLES DE DOCUMENTS                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag purple">Modèles de documents</div>
                <h3>Vos factures, devis à votre image</h3>
                <p>
                    Personnalisez l'apparence de vos factures. Ajoutez votre logo, texte, background, sélectionnez parmi plusieurs modèles prédéfinis. Vos clients reconnaissent votre marque sur chaque document.
                </p>
                <ul class="feature-list">
                    <li class="purple">Modèles prédéfinis : classique, Détaillé, colones, élégant, svelte 1, svelt 2</li>
                    <li class="purple">Logo personnalisable, texte aux choix de votre marque</li>
                    <li class="purple">Numérotation automatique avec préfixe personnalisé</li>
                    <li class="purple">Afficher ou cacher des champs</li>
                    <li class="purple">Multi-langue : français, arabe, anglais</li>
                    <li class="purple">Aperçu en direct avant impression ou envoi</li>
                </ul>
            </div>
            <div>
                <div class="template-tabs">
                    <span class="tt">Classique</span>
                    <span class="tt active">Détaillé</span>
                    <span class="tt">Élégant</span>
                    <span class="tt">colones</span>
                    <span class="tt">svelte 1</span>
                    <span class="tt">svelte 2</span>
                </div>

                <div class="inv-mock">
                    <div class="inv-head">
                        <div style="display:flex; gap:12px; align-items:center;">
                            <div class="inv-logo">SG</div>
                            <div>
                                <div style="font-weight:700; font-size:0.95rem;">Simplex Boutique</div>
                                <div style="font-size:0.7rem; color:#6b7280;">Avenue H. Bourguiba, La Marsa</div>
                            </div>
                        </div>
                        <div>
                            <div class="inv-title">FACTURE</div>
                            <div class="inv-meta">N° <strong>FA-2026-0067</strong></div>
                            <div class="inv-meta">Date : <strong>24/04/2026</strong></div>
                        </div>
                    </div>

                    <div class="inv-body">
                        <div class="inv-grid">
                            <div class="inv-block">
                                <div class="label">Émetteur</div>
                                <strong>Simplex Boutique SARL</strong><br>
                                MF : 1234567 / A / M / 000<br>
                                71 234 567
                            </div>
                            <div class="inv-block">
                                <div class="label">Client</div>
                                <strong>Société Carthago SARL</strong><br>
                                MF : 1564782 / K / P / 000<br>
                                Sfax
                            </div>
                        </div>

                        <table class="inv-table">
                            <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Qté</th>
                                <th>P.U.</th>
                                <th style="text-align:right;">Total HT</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td>Huile olive 1L</td><td>12</td><td>20.000</td><td style="text-align:right;">240.000</td></tr>
                            <tr><td>Café moulu 250g</td><td>20</td><td>14.000</td><td style="text-align:right;">280.000</td></tr>
                            <tr><td>Conserve thon 200g</td><td>30</td><td>3.500</td><td style="text-align:right;">105.000</td></tr>
                            </tbody>
                        </table>

                        <div class="inv-totals">
                            <div class="ttl-line">Total HT : <strong>625.000</strong></div>
                            <div class="ttl-line">TVA 19 % : <strong>118.750</strong></div>
                            <div class="ttl-line">Timbre fiscal : <strong>1.000</strong></div>
                            <div class="ttl-line ttl-grand">TOTAL TTC : TND 744.750</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  IMPORT / EXPORT                                        -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag green">Imports & exports massifs</div>
            <h3>Migrez vos données existantes en un clic,<br>Importez tout, à tout moment</h3>
            <p>
                Vous démarrez avec Simplex Gestion ? Importez en masse vos clients, fournisseurs, produits, stocks d'ouverture depuis un fichier Excel ou CSV. Vous voulez analyser vos données ailleurs ? Exportez n'importe quel rapport ou liste en PDF, Excel ou CSV en un clic.
            </p>
            <ul class="feature-list">
                <li class="green">Import massif depuis Excel ou CSV (modèles fournis)</li>
                <li class="green">Validation automatique des données avant import</li>
                <li class="green">Export Excel pour vos retraitements et tableaux croisés</li>
                <li class="green">Export CSV pour intégration avec d'autres outils</li>
            </ul>
        </div>
        <div>
            <div class="mock">
                <h4>📥 Imports & 📤 Exports</h4>

                <div class="ie-grid">
                    <div class="ie-card">
                        <div class="ie-head"><span style="color:var(--accent);">📥</span> Importer</div>
                        <ul class="ie-list">
                            <li>Liste clients <span class="format-pill fp-xls">XLSX</span></li>
                            <li>Liste fournisseurs <span class="format-pill fp-xls">XLSX</span></li>
                            <li>Catalogue produits <span class="format-pill fp-csv">CSV</span></li>
                            <li>Stock d'ouverture <span class="format-pill fp-xls">XLSX</span></li>
                            <li>Catégories produits <span class="format-pill fp-csv">CSV</span></li>
                            <li>Grilles tarifaires <span class="format-pill fp-xls">XLSX</span></li>
                        </ul>
                    </div>

                    <div class="ie-card">
                        <div class="ie-head"><span style="color:var(--cyan);">📤</span> Exporter</div>
                        <ul class="ie-list">
                            <li>Factures du mois <span class="format-pill fp-pdf">PDF</span></li>
                            <li>Liste clients <span class="format-pill fp-xls">XLSX</span></li>
                            <li>État de stock <span class="format-pill fp-xls">XLSX</span></li>
                            <li>Rapport P&L <span class="format-pill fp-pdf">PDF</span></li>
                            <li>Journal des dépenses <span class="format-pill fp-csv">CSV</span></li>
                            <li>Tous les rapports <span class="format-pill fp-pdf">PDF</span></li>
                        </ul>
                    </div>
                </div>

                <div class="alert-box alert-green">
                    <span>✓</span>
                    <span>Modèles d'import fournis avec en-têtes prêts à remplir — <strong>aucune compétence technique requise</strong>.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SÉCURITÉ & SAUVEGARDES                                 -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row">
            <div class="feature-content">
                <div class="section-tag danger">Sécurité & sauvegardes</div>
                <h3>Vos données sont en sécurité,<br>aujourd'hui et dans 10 ans</h3>
                <p>
                    Vos données sont chiffrées et sécurisés. Sauvegardes quotidiennes automatiques. Authentification renforcée. Chaque connexion est tracée. Vous pouvez désactiver un utilisateur en 1 clic en cas de départ ou de doute.
                </p>
                <ul class="feature-list">
                    <li class="danger">Chiffrement de bout en bout</li>
                    <li class="danger">Sauvegardes automatiques quotidiennes</li>
                    <li class="danger">Hébergement conforme aux normes internationales</li>
                </ul>
            </div>
            <div>
                <div class="mock">
                    <h4>🔒 Sécurité de votre compte</h4>

                    <div class="sec-row">
                        <div class="sicon">🔐</div>
                        <div class="stext">
                            <div class="stitle">Chiffrement des données</div>
                            <div class="sdesc">Toutes les données sont chiffrées en transit et au repos</div>
                        </div>
                        <span class="sbadge">✓ Actif</span>
                    </div>



                    <div class="sec-row">
                        <div class="sicon">💾</div>
                        <div class="stext">
                            <div class="stitle">Sauvegardes automatiques</div>
                            <div class="sdesc">Dernière sauvegarde : aujourd'hui à 03:00</div>
                        </div>
                        <span class="sbadge">✓ OK</span>
                    </div>

                    <div class="sec-row">
                        <div class="sicon">🌐</div>
                        <div class="stext">
                            <div class="stitle">Sessions actives</div>
                            <div class="sdesc">3 appareils connectés (vous + 2 autres)</div>
                        </div>
                        <span class="sbadge">✓ Vues</span>
                    </div>

                    <div class="sec-row">
                        <div class="sicon">🛡️</div>
                        <div class="stext">
                            <div class="stitle">Connexion sécurisée </div>
                            <div class="sdesc">Certificat TLS</div>
                        </div>
                        <span class="sbadge">✓ OK</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    <div class="divider"></div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!--  MULTI-UTILISATEURS & RÔLES                             -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <div class="section-alt">
        <section class="section">
            <div class="feature-row">
                <div class="feature-content">
                    <div class="section-tag">Multi-utilisateurs & rôles</div>
                    <h3>Chaque collaborateur, son accès,<br>ses permissions, ses limites</h3>
                    <p>
                        Créez autant de comptes utilisateurs que vous le souhaitez et attribuez à chacun un rôle précis : administrateur, gérant, caissier, magasinier, commercial, comptable… Définissez finement qui peut voir, ajouter, modifier ou supprimer dans chaque module.
                    </p>
                    <ul class="feature-list">
                        <li>Utilisateurs illimités</li>
                        <li>Rôles prédéfinis : admin, caissier, comptable</li>
                        <li>Rôles personnalisés avec permissions granulaires module par module</li>
                        <li>Restriction par lieu d'affaires (ne voit que sa propre boutique)</li>
                        <li>Historique de connexion et sessions actives</li>
                        <li>Désactivation immédiate en cas de départ</li>
                    </ul>
                </div>
                <div>
                    <div class="mock">
                        <h4>👤 Utilisateurs & rôles</h4>

                        <div class="role-row head">
                            <span>Utilisateur</span>
                            <span>Rôle</span>
                            <span>Permissions</span>
                        </div>

                        <div class="role-row">
                            <div class="user-cell">
                                <div class="avatar av-1">A</div>
                                <div>
                                    <div class="uname">Ahmed Ahmed</div>
                                    <div class="uemail">ahmed@simplex.tn</div>
                                </div>
                            </div>
                            <span><span class="role-badge rb-admin">Admin</span></span>
                            <div class="perms">
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                            </div>
                        </div>

                        <div class="role-row">
                            <div class="user-cell">
                                <div class="avatar av-2">Y</div>
                                <div>
                                    <div class="uname">Yasmine Yasmine</div>
                                    <div class="uemail">yasmine@simplex.tn</div>
                                </div>
                            </div>
                            <span><span class="role-badge rb-manager">Gérante</span></span>
                            <div class="perms">
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                            </div>
                        </div>

                        <div class="role-row">
                            <div class="user-cell">
                                <div class="avatar av-3">M</div>
                                <div>
                                    <div class="uname">Mehdi Mehdi</div>
                                    <div class="uemail">mehdi@simplex.tn</div>
                                </div>
                            </div>
                            <span><span class="role-badge rb-cashier">Caissier</span></span>
                            <div class="perms">
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                            </div>
                        </div>

                        <div class="role-row">
                            <div class="user-cell">
                                <div class="avatar av-4">S</div>
                                <div>
                                    <div class="uname">Sami Sami</div>
                                    <div class="uemail">sami@simplex.tn</div>
                                </div>
                            </div>
                            <span><span class="role-badge rb-stock">Magasinier</span></span>
                            <div class="perms">
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                            </div>
                        </div>

                        <div class="role-row">
                            <div class="user-cell">
                                <div class="avatar av-5">N</div>
                                <div>
                                    <div class="uname">Nour Nour</div>
                                    <div class="uemail">nour@simplex.tn</div>
                                </div>
                            </div>
                            <span><span class="role-badge rb-comm">Commerciale</span></span>
                            <div class="perms">
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot on"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                                <span class="perm-dot"></span>
                            </div>
                        </div>

                        <div class="alert-box alert-indigo">
                            <span>💡</span>
                            <span>Créez vos propres rôles et personnalisez les permissions <strong>module par module, action par action</strong>.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  AUDIT & TRAÇABILITÉ                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row reverse">
        <div class="feature-content">
            <div class="section-tag">Audit & traçabilité</div>
            <h3>Qui a fait quoi, quand, depuis où ?<br>Vous le savez toujours</h3>
            <p>
                Chaque action significative dans l'application est enregistrée dans un journal d'audit : création, modification, suppression de factures, ventes, paiements, ajustements de stock, connexions et déconnexions. La transparence est totale, et en cas de doute ou de litige, vous avez toujours la trace.
            </p>
            <ul class="feature-list">
                <li>Journal complet de toutes les actions sensibles</li>
                <li>Date, heure, utilisateur, action et données concernées</li>
                <li>Filtre par utilisateur, par module, par type d'action</li>
            </ul>
        </div>
        <div>
            <div class="mock">
                <h4>📜 Journal d'audit — aujourd'hui</h4>

                <div class="log-line">
                    <span class="ltime">14:23</span>
                    <span class="log-action-icon lai-create">+</span>
                    <span class="laction"><strong>Ahmed K.</strong> a créé la facture <strong>FA-2026-0067</strong></span>
                    <span class="luser">Bureau</span>
                </div>
                <div class="log-line">
                    <span class="ltime">14:18</span>
                    <span class="log-action-icon lai-pay">💵</span>
                    <span class="laction"><strong>Mehdi T.</strong> a encaissé <strong>TND 1,420</strong> (espèces)</span>
                    <span class="luser">Caisse #1</span>
                </div>
                <div class="log-line">
                    <span class="ltime">13:55</span>
                    <span class="log-action-icon lai-edit">✏</span>
                    <span class="laction"><strong>Yasmine .</strong> a modifié le client <strong>Société A</strong></span>
                    <span class="luser">Bureau</span>
                </div>
                <div class="log-line">
                    <span class="ltime">13:42</span>
                    <span class="log-action-icon lai-create">+</span>
                    <span class="laction"><strong>Sami B.</strong> a réceptionné <strong>BC-0142</strong> (180 articles)</span>
                    <span class="luser">Dépôt</span>
                </div>
                <div class="log-line">
                    <span class="ltime">12:30</span>
                    <span class="log-action-icon lai-delete">×</span>
                    <span class="laction"><strong>Ahmed K.</strong> a supprimé le devis <strong>DE-2026-0012</strong></span>
                    <span class="luser">Bureau</span>
                </div>
                <div class="log-line">
                    <span class="ltime">10:15</span>
                    <span class="log-action-icon lai-login">→</span>
                    <span class="laction"><strong>Nour C.</strong> s'est connectée depuis <strong>Sfax</strong></span>
                    <span class="luser">Mobile</span>
                </div>
                <div class="log-line">
                    <span class="ltime">08:00</span>
                    <span class="log-action-icon lai-login">→</span>
                    <span class="laction"><strong>Mehdi T.</strong> a ouvert la <strong>Caisse #1</strong> (TND 200)</span>
                    <span class="luser">Tablette</span>
                </div>

                <div class="alert-box alert-cyan">
                    <span>🔍</span>
                    <span>Filtrez par utilisateur, module ou type d'action — et exportez le journal en un clic.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  RECHERCHE GLOBALE + TABLEAU DE BORD                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="feature-row reverse" style="margin-top:80px;">
            <div class="feature-content">
                <div class="section-tag rose">Tableau de bord</div>
                <h3>Le pouls de votre activité,<br>dès l'ouverture de l'application</h3>
                <p>
                    À chaque connexion, le tableau de bord vous donne une vue immédiate sur ce qui compte : ventes du jour, panier moyen, stock à surveiller, encours clients, trésorerie. Un coup d'œil — vous savez où vous en êtes.
                </p>
                <ul class="feature-list">
                    <li class="rose">Métriques essentiels</li>
                    <li class="rose">Mini-graphiques sur 30 jours</li>
                    <li class="rose">affichage configurables selon votre rôle</li>
                    <li class="rose">Vue spécifique par lieu d'affaires si besoin</li>
                    <li class="rose">Liens rapides vers les actions les plus utilisées</li>
                </ul>
            </div>
            <div>
                <div class="dash-mock">
                    <div class="dash-head">
                        <div class="dash-title">📊 Tableau de bord</div>
                        <span style="font-size:0.78rem; color:var(--text-muted);">Aujourd'hui • Tous magasins</span>
                    </div>

                    <div class="kpi-grid">
                        <div class="kpi-tile">
                            <div class="kp-lbl">Total des ventes</div>
                            <div class="kp-val" style="color:var(--accent);">TND 7,640</div>
                            <div class="kp-trend kp-up">▲ + 18 % vs hier</div>
                        </div>
                        <div class="kpi-tile">
                            <div class="kp-lbl">Net</div>
                            <div class="kp-val" style="color:var(--cyan);">TND 142</div>
                            <div class="kp-trend kp-up">▲ + 6 %</div>
                        </div>
                        <div class="kpi-tile">
                            <div class="kp-lbl">Impayées</div>
                            <div class="kp-val" style="color:var(--indigo-light);">TND 540</div>
                            <div class="kp-trend kp-up">▲ + 12 %</div>
                        </div>
                        <div class="kpi-tile">
                            <div class="kp-lbl">Retour clients</div>
                            <div class="kp-val" style="color:var(--amber);">TND 23</div>
                            <div class="kp-trend kp-down">▼ − 4 %</div>
                        </div>
                    </div>

                    <div class="mini-chart">
                        <div style="font-size:0.78rem; color:var(--text-muted); margin-bottom:8px;">Ventes des 14 derniers jours</div>
                        <div class="mini-bars">
                            <div class="mb" style="height:40%;"></div>
                            <div class="mb" style="height:55%;"></div>
                            <div class="mb" style="height:48%;"></div>
                            <div class="mb" style="height:65%;"></div>
                            <div class="mb" style="height:60%;"></div>
                            <div class="mb" style="height:72%;"></div>
                            <div class="mb" style="height:58%;"></div>
                            <div class="mb" style="height:50%;"></div>
                            <div class="mb" style="height:62%;"></div>
                            <div class="mb" style="height:78%;"></div>
                            <div class="mb" style="height:70%;"></div>
                            <div class="mb" style="height:82%;"></div>
                            <div class="mb" style="height:75%;"></div>
                            <div class="mb" style="height:92%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CODES-BARRES & ÉTIQUETTES                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="feature-row">
        <div class="feature-content">
            <div class="section-tag" style="color:var(--pos);"><span style="background:var(--pos);"></span>Codes-barres & étiquettes</div>
            <h3>Scannez à la caisse,<br>imprimez en quelques clics</h3>
            <p>
                Chaque produit possède son code-barres. Scannez-le à la caisse pour ajouter le produit au panier en un instant. Réceptionnez vos achats en scannant les colis. Imprimez vos propres étiquettes prêtes à coller, avec ou sans prix. Compatible avec tous les scanners du marché.
            </p>
            <ul class="feature-list">
                <li>Compatible avec les codes-barres EAN, UPC, Code 128, QR</li>
                <li>Génération automatique de codes-barres pour vos produits</li>
                <li>Scan à la caisse pour ajout instantané au panier</li>
                <li>Impression d'étiquettes avec ou sans prix, multi-formats</li>
                <li>Compatible avec tous les scanners USB et Bluetooth</li>
            </ul>
        </div>
        <div>
            <div class="barcode-mock">
                <div class="bc-name">Huile d'olive Premium 1L</div>
                <div class="bc-code">Réf. P-0042</div>
                <div class="bc-lines">
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:3px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:4px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:3px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:3px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:4px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:3px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:4px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                    <div class="bcl" style="width:3px;"></div>
                    <div class="bcl" style="width:1px;"></div>
                    <div class="bcl" style="width:2px;"></div>
                </div>
                <div class="bc-code">6 191 234 567 890</div>
                <div class="bc-price">TND 24.000</div>

                <div class="scan-options">
                    <div class="scan-opt">
                        <span class="icn">🔫</span>
                        Scanner USB
                    </div>
                    <div class="scan-opt">
                        <span class="icn">📡</span>
                        Bluetooth
                    </div>
                    <div class="scan-opt">
                        <span class="icn">📷</span>
                        Caméra mobile
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SUPPORT & FORMATION                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="section-alt">
    <section class="section">
        <div class="section-tag teal">Support & accompagnement</div>
        <h2 class="section-title">Vous n'êtes jamais seul avec Simplex Gestion</h2>
        <p class="section-subtitle">
            Une équipe tunisienne 100 %, qui comprend votre métier et votre contexte fiscal. Un guide intégré dans l'application, et un support réactif.
        </p>

        <div class="cards-grid">
            <div class="card teal">
                <div class="card-icon icon-teal">📘</div>
                <h3>Guide intégré dans l'app</h3>
                <p>Un bouton « Guide » présent dans chaque écran : explications, captures et exemples concrets — toujours sous la main.</p>
            </div>
            <div class="card teal">
                <div class="card-icon icon-teal">💬</div>
                <h3>Chat & e-mail</h3>
                <p>Une équipe support tunisienne joignable 7/7 pour répondre à toutes vos questions.</p>
            </div>
            <div class="card teal">
                <div class="card-icon icon-teal">🚀</div>
                <h3>Mise en place assistée</h3>
                <p>Import de vos données, configuration de votre compte, formation de votre équipe : on s'occupe de tout au démarrage.</p>
            </div>
            <div class="card teal">
                <div class="card-icon icon-teal">🔄</div>
                <h3>Mises à jour automatiques</h3>
                <p>Nouvelles fonctionnalités, améliorations, corrections : déployées automatiquement, sans rien faire de votre côté.</p>
            </div>
        </div>
    </section>
</div>

<div class="divider"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  CTA                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="cta-section">
    <h2>Une plateforme,<br>tout votre commerce</h2>
    <p>
        Modules métier riches + fonctionnalités générales puissantes = la solution la plus complète pour piloter votre activité commerciale en Tunisie.
    </p>
    <div class="cta-buttons">
        <a href="/business/register" style="text-decoration:none" class="btn-primary">Démarrer gratuitement</a>
        <a href="https://wa.me/21693796501" style="text-decoration:none" class="btn-outline">Demander une démo</a>
    </div>
    <div style="margin-top:36px; display:flex; justify-content:center; gap:36px; flex-wrap:wrap;">
        <span style="font-size:0.85rem; color:white;">✓ Sans installation</span>
        <span style="font-size:0.85rem; color:white;">✓ Utilisateurs illimités</span>
        <span style="font-size:0.85rem; color:white;">✓ Multi-emplacements</span>
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
