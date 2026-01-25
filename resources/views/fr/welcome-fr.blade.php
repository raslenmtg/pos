<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Logiciel de gestion commerciale complet pour la Tunisie. Simplex Gestion centralise Facturation, Stock, POS, Achats et Conformité Fiscale (FODEC, TVA).">
    <title>Simplex Gestion | La Suite ERP Complète pour Entreprises Tunisiennes</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2948ff;
            --primary-dark: #1a35cc;
            --secondary: #64748b;
            --accent: #ff6b35;
            --success: #10b981;
            --warning: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark);
            background-color: #fff;
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* --- UI COMPONENTS --- */

        /* Navbar */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0;
            transition: all 0.3s;
            width: 100%;
        }

        .navbar .container-fluid {
            width: 100%;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--secondary);
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(41, 72, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(41, 72, 255, 0.4);
        }

        .btn-outline {
            border: 2px solid #e2e8f0;
            color: var(--dark);
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 700;
            background: transparent;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            border-color: var(--dark);
            background: var(--dark);
            color: white;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 100px 0 100px;
            background: radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 50%);
            position: relative;
            overflow: hidden;
        }

        .hero-badge {
            background: rgba(41, 72, 255, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 1.5rem;
            background: -webkit-linear-gradient(315deg, #1e293b 0%, #334155 74%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-lead {
            font-size: 1.25rem;
            color: var(--secondary);
            margin-bottom: 2.5rem;
            max-width: 600px;
        }

        /* --- STATS & TRUST --- */
        .stats-strip {
            background: var(--dark);
            padding: 60px 0;
            color: white;
            margin-top: -50px;
            position: relative;
            z-index: 10;
            border-radius: 0;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 0;
        }

        .stat-item p {
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- FEATURE BLOCKS (Deep Dive) --- */
        .feature-block {
            padding: 100px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .feature-block:last-child {
            border-bottom: none;
        }

        .feature-tag {
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: block;
        }

        .feature-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .feature-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: start;
            font-size: 1.05rem;
            color: var(--secondary);
        }

        .feature-list i {
            color: var(--success);
            font-size: 1.4rem;
            margin-right: 12px;
            flex-shrink: 0;
            margin-top: 3px;
        }

        /* --- CARDS & GRID --- */
        .module-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .module-icon {
            width: 64px;
            height: 64px;
            background: #eff6ff;
            color: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 25px;
        }

        /* --- COMPLIANCE SECTION --- */
        .compliance-section {
            background: #f8fafc;
            padding: 100px 0;
        }

        .compliance-check {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow-sm);
            font-weight: 600;
        }

        .compliance-check i {
            color: var(--primary);
            font-size: 1.5rem;
            margin-right: 15px;
        }

        /* --- STEPS / PROCESS --- */
        .step-number {
            font-size: 4rem;
            font-weight: 900;
            color: #e2e8f0;
            line-height: 1;
            margin-bottom: 1rem;
        }

        /* --- PRICING --- */
        .pricing-table {
            background: var(--dark);
            color: white;
            border-radius: 30px;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .pricing-table::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: var(--primary);
            filter: blur(100px);
            opacity: 0.3;
            border-radius: 50%;
        }

        /* --- FAQ --- */
        .accordion-item {
            border: none;
            margin-bottom: 15px;
            background: transparent;
        }

        .accordion-button {
            background: white !important;
            padding: 25px;
            border-radius: 16px !important;
            font-weight: 700;
            color: var(--dark);
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .accordion-body {
            background: white;
            border-radius: 0 0 16px 16px;
            padding: 25px;
            color: var(--secondary);
            margin-top: -10px;
        }

        .compliance-badges {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin: 3rem 0;
        }

        .compliance-badge {
            background: white;
            border: 2px solid var(--primary);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }


        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Responsiveness */
        @media (max-width: 991px) {
            .hero-title { font-size: 2.8rem; }
            .feature-block { text-align: center; }
            .feature-list li { justify-content: flex-start; text-align: left; }
            .pricing-table { padding: 40px 20px; }
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="100">

<nav class="navbar fixed-top">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100 py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('login') }}" class="btn btn-outline">
                    <i class='bx bx-log-in'></i>
                    Login
                </a>
                <a href="{{ route('business.getRegister') }}" class="btn btn-primary" style="margin: 0 10px">
                  Inscription
                    <i class='bx bx-plus'></i>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <span class="navbar-brand m-0" style="align-self: end"> Simplex<span class="text-primary">.</span></span>
                <a href="/" class="navbar-brand">

                    <img src="img/logo.png" alt="Simplex Gestion Logo" width="40" height="40">
                </a>
            </div>
        </div>
    </div>
</nav>


<section class="hero-section" id="accueil">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <h1 class="hero-title">
                    Solution de Gestion Commerciale pour les Grossistes, Distributeurs et PME.<br>
                </h1>
                <p class="hero-lead">
                    Synchronisez vos stocks, vos operations et votre facturation en temps réel.
                    <strong>100% Conforme</strong> à la législation tunisienne (TVA, Retenue à la source TEJ).
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#contact" class="btn btn-primary btn-lg">
                        <i class='bx bx-rocket me-2'></i> Commencer Maintenant
                    </a>

                </div>
                <div class="mt-4 text-muted small">
                    <i class='bx bx-check-circle text-success'></i> Configuration rapide
                    <span class="mx-2">•</span>
                    <i class='bx bx-check-circle text-success'></i> Données sécurisées
                    <span class="mx-2">•</span>
                    <i class='bx bx-check-circle text-success'></i> Support 7j/7
                </div>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0" data-aos="fade-left">
                <div class="position-relative">
                    <div class="bg-white p-2 rounded-4 shadow-lg border">
                        <img src="img/Screenshot_simplex.png" alt="Dashboard Simplex" class="img-fluid rounded-3">
                    </div>
                    <div class="position-absolute top-0 end-0 translate-middle-y bg-white p-3 rounded-4 shadow-lg border d-none d-md-block" style="margin-top: -10px; margin-right: -20px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success"><i class='bx bx-trending-up fs-4'></i></div>
                            <div>
                                <small class="text-muted d-block">Chiffre d'affaire du jour</small>
                                <span class="fw-bold">1,250DT</span>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 translate-middle-x bg-white p-3 rounded-4 shadow-lg border d-none d-md-block" style="margin-bottom: -70px; margin-left: 80px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle text-warning"><i class='bx bx-bell fs-4'></i></div>
                            <div>
                                <small class="text-muted d-block">Alerte Stock</small>
                                <span class="fw-bold text-danger">3 articles critiques</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="stats-strip">
    <div class="container">
        <div class="section-title text-center">
            <h1>Conçue pour les entreprises tunisiennes</h1>
            <p class="w-50 mx-auto">Simplex Gestion intègre toutes les spécificités fiscales tunisiennes.</p>
        </div>

        <div class="compliance-badges">
            <span class="compliance-badge"><i class="bx bx-check"></i> TVA Multiple (7%, 13%, 19%)</span>
            <span class="compliance-badge"><i class="bx bx-check"></i> Retenue à la Source</span>
            <span class="compliance-badge"><i class="bx bx-check"></i> Timbre Fiscal</span>
            <span class="compliance-badge"><i class="bx bx-check"></i> FODEC</span>
            <span class="compliance-badge"><i class="bx bx-check"></i> Numérotation Séquentielle</span>
        </div>


    </div>
</div>

<section class="py-5 bg-light" id="cloud">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">TECHNOLOGIE</span>
            <h2 class="fw-800 display-6">Pourquoi passer au Cloud ?</h2>
            <p class="text-muted">Fini les serveurs poussiéreux dans le placard. Place à la sécurité.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="mb-3 text-primary fs-1"><i class="bx bx-server"></i></div>
                    <h4 class="fw-bold">Zéro Installation</h4>
                    <p class="text-secondary small">Aucun materiél à acheter. Aucun technicien à appeler pour une panne. Connectez-vous simplement.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="mb-3 text-primary fs-1"><i class="bx bx-lock-alt"></i></div>
                    <h4 class="fw-bold">Sécurité Bancaire</h4>
                    <p class="text-secondary small">Vos données sont cryptées et sauvegardées sur des serveurs sécurisés.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="mb-3 text-primary fs-1"><i class="bx bx-refresh"></i></div>
                    <h4 class="fw-bold">Toujours à Jour</h4>
                    <p class="text-secondary small">Profitez des nouvelles fonctionnalités et des mises à jour instantanément, sans frais.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-block" id="ventes">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <img src="https://via.placeholder.com/600x400/e2e8f0/94a3b8?text=Interface+Vente+POS" alt="POS System" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <h2 class="feature-title">Vendez au comptoir ou en déplacement.</h2>
                <p class="lead text-secondary mb-4">
                    Vos commerciaux sont sur le terrain ? Vos vendeurs sont en boutique ? Simplex synchronise tout en temps réel.
                </p>
                <ul class="list-unstyled feature-list">
                    <li>
                        <i class='bx bxs-check-circle'></i>
                        <div>
                            <strong>Synchronisation Temps Réel</strong>
                            <p class="small mb-0">Une vente faite à Sfax est visible instantanément à Tunis. Plus besoin d'attendre le soir.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-check-circle'></i>
                        <div>
                            <strong>Accessible sur Tablette & Mobile & ordinateur</strong>
                            <p class="small mb-0">Faites des devis directement chez le client depuis votre smartphone. Validez les commandes à distance.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-check-circle'></i>
                        <div>
                            <strong>Transformation Devis → Facture en 1 Clic</strong>
                            <p class="small mb-0">Ne ressaisissez jamais une information. Convertissez un devis accepté en facture instantanément.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-check-circle'></i>
                        <div>
                            <strong>Multi-Tarifs & Grilles de Prix</strong>
                            <p class="small mb-0">Prix Gros, Demi-Gros, Détail. Assignez automatiquement le bon tarif selon la catégorie du client.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="feature-block bg-light" id="stock">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://via.placeholder.com/600x400/e2e8f0/94a3b8?text=Gestion+Stock+Inventaire" alt="Stock Management" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="feature-tag">Logistique & Inventaire</span>
                <h2 class="feature-title">Un stock juste, tout le temps.</h2>
                <p class="lead text-secondary mb-4">
                    Fini le stock fantôme et les ruptures surprises. Ayez une vision claire de ce qui entre et ce qui sort.
                </p>
                <ul class="list-unstyled feature-list">
                    <li>
                        <i class='bx bxs-bell-ring'></i>
                        <div>
                            <strong>Alertes de Réapprovisionnement</strong>
                            <p class="small mb-0">Définissez des seuils minimums. Le logiciel vous prévient avant la rupture de stock.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-buildings'></i>
                        <div>
                            <strong>Multi-Dépôts & Transferts</strong>
                            <p class="small mb-0">Gérez plusieurs magasins ou entrepôts. Effectuez des bons de transfert inter-agences suivis.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-layer'></i>
                        <div>
                            <strong>Articles Composés & Kits</strong>
                            <p class="small mb-0">Assemblez plusieurs produits en un seul "Kit". Le stock des composants est déduit automatiquement à la vente.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-barcode'></i>
                        <div>
                            <strong>Inventaire & Étiquetage</strong>
                            <p class="small mb-0">Générez et imprimez vos propres codes-barres. Réalisez des inventaires partiels ou globaux facilement.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="feature-block" id="finance">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <img src="https://via.placeholder.com/600x400/e2e8f0/94a3b8?text=Comptabilite+Fiscale" alt="Finance Compliance" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <span class="feature-tag">Finance & Légal</span>
                <h2 class="feature-title">Dormez tranquille, vous êtes conforme.</h2>
                <p class="lead text-secondary mb-4">
                    La législation tunisienne est complexe. Simplex Gestion l'automatise pour vous éviter les redressements.
                </p>
                <ul class="list-unstyled feature-list">
                    <li>
                        <i class='bx bxs-shield-check'></i>
                        <div>
                            <strong>FODEC & TVA Automatiques</strong>
                            <p class="small mb-0">Calcul automatique du FODEC (0.1% ou 1%) et application des taux de TVA (7, 13, 19%) selon l'article.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-file-pdf'></i>
                        <div>
                            <strong>Retenue à la Source & Timbre</strong>
                            <p class="small mb-0">Génération automatique des certificats de retenue à la source fournisseurs. Application du timbre fiscal.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-user-account'></i>
                        <div>
                            <strong>Gestion des Crédits Clients</strong>
                            <p class="small mb-0">Plafonnez l'encours de vos clients. Bloquez la facturation si le seuil de crédit est dépassé.</p>
                        </div>
                    </li>
                    <li>
                        <i class='bx bxs-report'></i>
                        <div>
                            <strong>Exports Comptables</strong>
                            <p class="small mb-0">Envoyez vos journaux de vente et d'achat à votre expert-comptable en un clic (Excel/PDF).</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light" id="fonctionnalites">
    <div class="container">
        <div class="section-title">
            <h2>Une Gestion à 360°</h2>
            <p class="text-muted">Des outils puissants pour piloter votre activité.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon mb-0 me-3" style="width: 60px; height: 60px; font-size: 1.5rem;"><i class="bx bx-cart"></i></div>
                        <h3 class="mb-0">Gestion des Ventes &amp; POS</h3>
                    </div>
                    <p>Du devis à l'encaissement, fluidifiez votre cycle de vente. Idéal pour la vente au comptoir ou en gros.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="feature-list mt-0">
                                <li>Point de vente tactile (POS)</li>
                                <li>Tickets de caisse &amp; Factures A4</li>
                                <li>Suivi des commerciaux &amp; commissions</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list mt-0">
                                <li>Suivi des règlements temps réel</li>
                                <li>Gestion des impayés &amp; plafonds</li>
                                <li>Grilles tarifaires par client</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon mb-0 me-3" style="width: 60px; height: 60px; font-size: 1.5rem;"><i class="bx bx-package"></i></div>
                        <h3 class="mb-0">Stock &amp; Approvisionnement</h3>
                    </div>
                    <p>Ne soyez plus jamais en rupture. Une gestion proactive pour assurer la continuité de votre activité.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="feature-list mt-0">
                                <li>Alertes de réapprovisionnement</li>
                                <li>Multi-dépôts &amp; transferts</li>
                                <li>Gestion par Code-barres</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list mt-0">
                                <li>Articles composés &amp; Kits</li>
                                <li>Inventaire physique &amp; global</li>
                                <li>Valorisation CMP (Coût Moyen)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon mb-0 me-3" style="width: 60px; height: 60px; font-size: 1.5rem;"><i class="bx bx-purchase-tag"></i></div>
                        <h3 class="mb-0">Achats &amp; Dépenses</h3>
                    </div>
                    <p>Maîtrisez vos coûts et gérez vos relations fournisseurs.</p>
                    <ul class="feature-list">
                        <li>Suivi commandes fournisseurs &amp; réceptions</li>
                        <li>Calcul automatique du Prix de Revient</li>
                        <li>Gestion des dépenses &amp; notes de frais</li>
                        <li>Achats import en devises (Multi-devises)</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon mb-0 me-3" style="width: 60px; height: 60px; font-size: 1.5rem;"><i class="bx bx-shield-quarter"></i></div>
                        <h3 class="mb-0">Sécurité &amp; Permissions</h3>
                    </div>
                    <p>Assurez la sécurité des données en gérant finement qui peut accéder à quoi.</p>
                    <ul class="feature-list">
                        <li>Masquage des prix d'achat/marges</li>
                        <li>Permissions par rôle utilisateur</li>
                        <li>Traçabilité complète des mouvements</li>
                        <li>Sauvegarde automatique</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="contact">
    <div class="container">
        <div class="pricing-table text-center">
            <h2 class="display-4 fw-bold mb-4">L'offre Tout-en-Un</h2>
            <p class="lead text-white-50 mb-5">Tout ce dont vous avez besoin pour gérer votre entreprise, sans frais cachés.</p>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-white text-dark rounded-4 p-5 shadow-lg">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">OFFRE POPULAIRE</span>
                        <div class="display-2 fw-bold mb-2">90 <span class="fs-4 text-muted">DT/mois</span></div>
                        <p class="text-muted mb-4">Ou achat licence à vie (Nous contacter)</p>

                        <ul class="list-unstyled text-start mb-5 d-inline-block mx-auto">
                            <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Utilisateurs Illimités</strong></li>
                            <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Tous les modules</strong> (Vente, Achat, Stock)</li>
                            <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Formation</strong> sur site ou en ligne</li>
                            <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Installation</strong> et configuration</li>
                            <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Mises à jour</strong> légales gratuites</li>
                        </ul>

                        <div class="d-grid gap-3">
                            <a href="https://wa.me/21600000000" class="btn btn-primary btn-lg fw-bold">
                                <i class='bx bxl-whatsapp me-2'></i> Commander sur WhatsApp
                            </a>
                            <a href="tel:+21600000000" class="btn btn-outline-dark fw-bold">
                                Appeler le Commercial
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Questions Fréquentes</h2>
            <p class="text-muted">Tout ce que vous devez savoir avant de commencer.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Le logiciel fonctionne-t-il sans internet ?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <strong>Oui, absolument.</strong> Simplex Gestion est un logiciel hybride. Il s'installe localement sur votre ordinateur pour garantir une vitesse maximale et fonctionne parfaitement sans connexion internet. La synchronisation cloud (optionnelle) se fait quand internet revient.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Est-ce compatible avec mon imprimante ticket ?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oui. Simplex est compatible avec 99% du matériel disponible en Tunisie : imprimantes thermiques (Epson, Xprinter, etc.), douchettes code-barres, tiroirs-caisses et imprimantes A4/A5 standard.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Comment gérer le FODEC et la Retenue à la source ?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                C'est automatique. Vous cochez simplement "Assujetti au FODEC" dans la fiche client ou fournisseur. Le logiciel calcule tout seul les montants. Pour la retenue à la source, un bouton permet d'imprimer le certificat officiel directement.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Puis-je récupérer mes anciennes données ?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oui, nous proposons un module d'importation Excel. Vous pouvez importer votre liste de clients, fournisseurs et votre catalogue articles (avec stock initial) en quelques minutes.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Mes données sont-elles en sécurité ?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Vos données sont stockées chez vous, sur votre machine. Personne d'autre n'y a accès. De plus, le système effectue des sauvegardes automatiques que vous pouvez copier sur un disque dur externe ou sur Google Drive pour une double sécurité.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h3 class="fw-bold mb-4">Simplex<span class="text-primary">.</span></h3>
                <p class="text-secondary">
                    Le logiciel ERP de référence pour les PME en Tunisie. Conçu pour simplifier la gestion quotidienne des commerçants, grossistes et prestataires de services.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-white fs-4"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#" class="text-white fs-4"><i class='bx bxl-linkedin-square'></i></a>
                    <a href="#" class="text-white fs-4"><i class='bx bxl-instagram-alt'></i></a>
                    <a href="#" class="text-white fs-4"><i class='bx bxl-youtube'></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6 mb-4">
                <h5 class="fw-bold mb-3">Produit</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Facturation</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Point de Vente</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Gestion de Stock</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Achats</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">CRM</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6 mb-4">
                <h5 class="fw-bold mb-3">Secteurs</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Commerce de Détail</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Grossistes</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Quincaillerie</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Superettes</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Services</a></li>
                </ul>
            </div>
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Nous Contacter</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-3 d-flex align-items-center"><i class='bx bx-map me-2 text-primary'></i> Les Berges du Lac, Tunis</li>
                    <li class="mb-3 d-flex align-items-center"><i class='bx bx-phone me-2 text-primary'></i> +216 00 000 000</li>
                    <li class="mb-3 d-flex align-items-center"><i class='bx bx-envelope me-2 text-primary'></i> contact@simplexgestion.tn</li>
                    <li class="mb-3 d-flex align-items-center"><i class='bx bxl-whatsapp me-2 text-primary'></i> Support WhatsApp 7j/7</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-4 opacity-25">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start text-secondary small">
                &copy; 2026 Simplex Gestion Tunisie. Tous droits réservés.
            </div>
            <div class="col-md-6 text-center text-md-end text-secondary small">
                <a href="#" class="text-secondary text-decoration-none me-3">Mentions Légales</a>
                <a href="#" class="text-secondary text-decoration-none">Politique de Confidentialité</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Init Animate On Scroll
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Navbar Transition
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.querySelector('.navbar').classList.add('shadow-sm');
            document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.98)';
        } else {
            document.querySelector('.navbar').classList.remove('shadow-sm');
            document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.95)';
        }
    });
</script>
</body>
</html>