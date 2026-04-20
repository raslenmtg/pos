<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Simplex Gestion</title>
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

        .about-hero {
            padding-top: 130px;
            padding-bottom: 28px;
        }

        .about-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .about-hero p {
            max-width: 800px;
            color: var(--secondary);
        }

        .about-badge {
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

        .about-section {
            padding: 14px 0 24px;
        }

        .feature-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .feature-card h3 {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .feature-card p {
            margin-bottom: 0;
            color: var(--secondary);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: var(--primary);
            font-size: 1.6rem;
            margin-bottom: 12px;
        }

        .compliance-strip {
            background: var(--dark);
            color: #fff;
            border-radius: 20px;
            padding: 32px 24px;
            margin: 28px 0;
        }

        .badge-list {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 1.2rem;
        }

        .badge-list span {
            background: #fff;
            border: 2px solid var(--primary);
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 700;
            color: var(--primary);
            font-size: 0.9rem;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .about-hero {
                padding-top: 108px;
                padding-bottom: 20px;
            }

            .about-hero h1 {
                font-size: 1.75rem;
            }

            .feature-card {
                padding: 22px 18px;
                border-radius: 14px;
            }

            .compliance-strip {
                border-radius: 14px;
                padding: 24px 16px;
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
    <section class="about-hero">
        <div class="container">
            <span class="about-badge"><i class='bx bx-buildings'></i> À propos</span>
            <h1>Simplex Gestion, votre partenaire de gestion commerciale</h1>
            <p>Simplex Gestion est une plateforme dédiée pour les fournisseurs, grossistes et distributeurs. Notre objectif est d’aider les commerces tunisiennes à gérer leurs ventes, stocks et facturation, tout en gagnant du temps au quotidien.</p>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <article class="feature-card">
                        <div class="feature-icon"><i class='bx bx-line-chart'></i></div>
                        <h3>Notre mission</h3>
                        <p>Offrir un outil clair, rapide et fiable pour piloter l’activité commerciale, améliorer la performance et simplifier le travail.</p>
                    </article>
                </div>
                <div class="col-lg-4">
                    <article class="feature-card">
                        <div class="feature-icon"><i class='bx bx-cloud'></i></div>
                        <h3>Notre approche</h3>
                        <p>Une plateforme cloud avec zéro installation, accessible partout, avec un accompagnement humain et des mises à jour continues.</p>
                    </article>
                </div>
                <div class="col-lg-4">
                    <article class="feature-card">
                        <div class="feature-icon"><i class='bx bx-shield-quarter'></i></div>
                        <h3>Notre engagement</h3>
                        <p>Vous offrir sécurité, conformité fiscale tunisienne et visibilité opérationnelle en temps réel pour des décisions plus sûres.</p>
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
