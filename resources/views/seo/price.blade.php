<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifs - Simplex Gestion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        .price-hero {
            padding-top: 130px;
            padding-bottom: 28px;
        }

        .price-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .price-hero p {
            max-width: 780px;
            color: var(--secondary);
        }

        .price-badge {
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

        .price-section {
            padding: 16px 0 48px;
        }

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

        .feature-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .feature-card h3 {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .feature-card p {
            margin-bottom: 0;
            color: var(--secondary);
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 991px) {
            .pricing-table {
                padding: 36px 20px;
                border-radius: 20px;
            }
        }

        @media (max-width: 768px) {
            .price-hero {
                padding-top: 108px;
                padding-bottom: 20px;
            }

            .price-hero h1 {
                font-size: 1.75rem;
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
    <section class="price-hero">
        <div class="container">
            <span class="price-badge"><i class='bx bx-purchase-tag-alt'></i> Tarification</span>
            <h1>Une offre simple, claire et complète</h1>
            <p>Simplex Gestion propose une tarification unique, sans frais cachés, avec accompagnement complet pour vous aider à démarrer et réussir rapidement.</p>
        </div>
    </section>

    <section class="price-section">
        <div class="container">
            <div class="pricing-table text-center">
                <h2 class="display-5 fw-bold mb-4">L'offre Tout-en-Un</h2>
                <p class="lead text-white-50 mb-5">Tout ce dont vous avez besoin pour gérer votre commerce, sans frais cachés.</p>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="bg-white text-dark rounded-4 p-5 shadow-lg">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">Sans engagement</span>
                            <div class="display-2 fw-bold mb-2">3 <span class="fs-4 text-muted">DT/jour</span></div>
                            <p class="text-muted mb-4">Soit 90 DT / mois.</p>
                            <ul class="list-unstyled text-start mb-5 d-inline-block mx-auto">
                                <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Configuration complète par notre équipe</strong></li>
                                <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Accompagnement continu pour réussir</strong></li>
                                <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Formation personnalisée</strong></li>
                                <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Support réactif par téléphone et WhatsApp</strong></li>
                                <li class="mb-3"><i class='bx bxs-check-circle text-primary me-2'></i> <strong>Mises à jour et nouvelles fonctionnalités incluses</strong></li>
                            </ul>
                            <div class="d-grid gap-3">
                                <a href="https://wa.me/21693796501?text=Bonjour%20Simplex,%20je%20souhaite%20une%20démonstration%20pour%20mon%20commerce." target="_blank" class="btn btn-primary btn-lg fw-bold">
                                    <i class='bx bxl-whatsapp me-2'></i> Réservez Votre Démonstration
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <article class="feature-card">
                        <h3>Ce que vous payez</h3>
                        <p>Un tarif unique de 3 DT/jour couvrant la plateforme, le support et les mises à jour.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="feature-card">
                        <h3>Ce que vous obtenez</h3>
                        <p>Un accompagnement opérationnel complet: configuration, formation et support continu.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="feature-card">
                        <h3>Ce qui est inclus</h3>
                        <p>Fonctionnalités métier, évolutions produit et assistance, sans coût caché supplémentaire.</p>
                    </article>
                </div>
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
</body>
</html>
