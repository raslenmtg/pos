<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme Partenaire Simplex Gestion | Digitalisons la Tunisie Ensemble</title>
    <meta name="description" content="Rejoignez le programme d'affiliation Simplex Gestion. Solutions dédiées pour experts-comptables, entreprises IT et apporteurs d'affaires en Tunisie.">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "Service",
              "name": "Programme Partenaire Simplex Gestion",
              "serviceType": "Affiliate Program",
              "description": "Programme de partenariat pour la digitalisation des entreprises tunisiennes, ciblant les experts-comptables et les intégrateurs IT.",
              "provider": {
                "@type": "Organization",
                "name": "Simplex Gestion",
                "url": "https://simplexgestion.tn"
              },
              "areaServed": "TN"
            },
            {
              "@type": "BreadcrumbList",
              "itemListElement": [
                { "@type": "ListItem", "position": 1, "name": "Accueil", "item": "https://simplexgestion.tn/" },
                { "@type": "ListItem", "position": 2, "name": "Partenariat", "item": "https://simplexgestion.tn/affiliate" }
              ]
            }
          ]
        }
    </script>

    <style>
        :root {
            --primary: #2948ff;
            --primary-dark: #1a35cc;
            --secondary: #333d50;
            --dark: #0f172a;
            --light: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--dark);
            background: radial-gradient(circle at 100% 0%, #eff4ff 0%, #ffffff 50%);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.4px;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(41, 72, 255, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            border: 2px solid #e2e8f0;
            color: var(--dark);
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 700;
            background: transparent;
        }

        .btn-outline:hover {
            border-color: var(--dark);
            background: var(--dark);
            color: #fff;
        }

        .affiliate-hero {
            padding-top: 130px;
            padding-bottom: 34px;
        }

        .affiliate-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .affiliate-hero p {
            max-width: 800px;
            color: var(--secondary);
        }

        .affiliate-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(41, 72, 255, 0.2);
            color: var(--primary);
            background: #eef2ff;
            border-radius: 999px;
            padding: 6px 14px;
            font-weight: 700;
            font-size: 0.86rem;
            margin-bottom: 16px;
        }

        .section {
            padding: 20px 0 54px;
        }

        .partner-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 28px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .partner-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--primary);
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            margin-bottom: 14px;
        }

        .partner-card h3 {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .partner-card p,
        .partner-card li {
            color: var(--secondary);
        }

        .advantages {
            background: var(--dark);
            color: #fff;
            border-radius: 24px;
            padding: 40px 28px;
        }

        .advantage-item {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .advantage-item i {
            color: var(--primary);
            font-size: 1.5rem;
            margin-top: 2px;
        }

        .income-box {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 30px 24px;
            text-align: center;
        }

        .income-box h3 {
            color: var(--primary);
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 6px;
        }

        .cta-block {
            background: linear-gradient(135deg, #2948ff 0%, #6366f1 100%);
            border-radius: 22px;
            padding: 36px 24px;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .affiliate-hero {
                padding-top: 108px;
                padding-bottom: 22px;
            }

            .affiliate-hero h1 {
                font-size: 1.75rem;
            }

            .partner-card {
                padding: 22px 18px;
                border-radius: 14px;
            }

            .advantages {
                padding: 26px 16px;
                border-radius: 14px;
            }

            .cta-block {
                border-radius: 14px;
                padding: 26px 16px;
            }

            .navbar .btn {
                font-size: 0.85rem;
                padding: 8px 14px;
            }
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
    <section class="affiliate-hero">
        <div class="container text-center">
            <span class="affiliate-badge"><i class='bx bx-network-chart'></i> Partenariat</span>
            <h1>Grandissez avec Simplex Gestion</h1>
            <p class="mx-auto">Développez vos revenus en recommandant une solution de gestion moderne adaptée aux grossistes, distributeurs et fournisseurs.</p>
            <div class="mt-4 d-flex justify-content-center flex-wrap gap-2">
                <a href="#apply" class="btn btn-primary">Devenir Partenaire</a>
                <a href="/contact" class="btn btn-outline">Nous contacter</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Nos Modèles de Partenariat</h2>
                <p class="text-secondary">Un programme adapté à chaque profil professionnel.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <article class="partner-card">
                        <div class="partner-icon"><i class='bx bxs-calculator'></i></div>
                        <h3>Comptables</h3>
                        <p>Simplifiez la collecte des factures de vos clients. Accédez directement aux journaux de ventes et rapports de TVA.</p>
                        <ul class="list-unstyled mt-3 mb-0">
                            <li><i class='bx bx-check text-success me-2'></i> Outil conforme (TVA, retenue à la source)</li>
                            <li><i class='bx bx-check text-success me-2'></i> Commission sur les recommandations</li>
                        </ul>
                    </article>
                </div>

                <div class="col-lg-4">
                    <article class="partner-card">
                        <div class="partner-icon"><i class='bx bxs-business'></i></div>
                        <h3>Entreprises</h3>
                        <p>Ajoutez une offre SaaS robuste à vos services. Idéal pour les revendeurs de matériel de caisse ou consultants en gestion.</p>
                        <ul class="list-unstyled mt-3 mb-0">
                            <li><i class='bx bx-check text-success me-2'></i> Recommandation Simplex Gestion</li>
                            <li><i class='bx bx-check text-success me-2'></i> Commissions sur abonnements</li>
                        </ul>
                    </article>
                </div>

                <div class="col-lg-4">
                    <article class="partner-card">
                        <div class="partner-icon"><i class='bx bxs-user-plus'></i></div>
                        <h3>Apporteurs d'Affaires</h3>
                        <p>Vous avez un large réseau dans le secteur commercial ? Recommandez Simplex Gestion et soyez récompensé à chaque activation.</p>
                        <ul class="list-unstyled mt-3 mb-0">
                            <li><i class='bx bx-check text-success me-2'></i> Processus transparent</li>
                            <li><i class='bx bx-check text-success me-2'></i> Commissions et bonus</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <div class="advantages">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <h2 class="fw-bold mb-4">Pourquoi devenir partenaire Simplex ?</h2>
                        <div class="advantage-item">
                            <i class='bx bxs-badge-check'></i>
                            <div>
                                <h5 class="mb-1">Expertise tunisienne</h5>
                                <p class="text-white-50 mb-0">Solution adaptée au marché tunisien et à ses contraintes fiscales.</p>
                            </div>
                        </div>
                        <div class="advantage-item">
                            <i class='bx bxs-cloud-upload'></i>
                            <div>
                                <h5 class="mb-1">Solution cloud moderne</h5>
                                <p class="text-white-50 mb-0">Sécurité élevée et accès multi-supports (ordinateur et mobile).</p>
                            </div>
                        </div>
                        <div class="advantage-item mb-0">
                            <i class='bx bxs-heart'></i>
                            <div>
                                <h5 class="mb-1">Support local dédié</h5>
                                <p class="text-white-50 mb-0">Nous formons vos clients et assurons le service après-vente.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="income-box">
                            <h3>Revenu récurrent</h3>
                            <p class="text-white-50 mb-0">Sur chaque abonnement actif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="apply" class="pb-4">
        <div class="container">
            <div class="cta-block text-center text-white">
                <h2 class="fw-bold mb-3">Prêt à commencer le partenariat ?</h2>
                <p class="mb-4 text-white-50">Parlez avec notre équipe et découvrez le modèle partenaire le plus adapté à votre activité.</p>
                <a href="https://wa.me/21693796501" class="btn btn-light btn-lg px-5 fw-bold text-primary">Contactez-nous</a>
            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
