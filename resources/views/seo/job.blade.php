<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrières - Simplex Gestion</title>
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

        .jobs-hero {
            padding-top: 130px;
            padding-bottom: 28px;
        }

        .jobs-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .jobs-hero p {
            max-width: 760px;
            color: var(--secondary);
        }

        .jobs-badge {
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

        .jobs-section {
            padding: 16px 0 56px;
        }

        .jobs-empty-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            padding: 48px 28px;
            text-align: center;
        }

        .jobs-empty-icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: var(--primary);
            font-size: 2rem;
        }

        .jobs-empty-title {
            font-size: 1.65rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .jobs-empty-text {
            color: var(--secondary);
            max-width: 620px;
            margin: 0 auto;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .jobs-hero {
                padding-top: 108px;
                padding-bottom: 20px;
            }

            .jobs-hero h1 {
                font-size: 1.75rem;
            }

            .jobs-empty-card {
                padding: 34px 18px;
                border-radius: 14px;
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
    <section class="jobs-hero">
        <div class="container">
            <span class="jobs-badge"><i class='bx bx-briefcase-alt-2'></i> Carrières</span>
            <h1>Rejoignez l’équipe Simplex Gestion</h1>
            <p>Consultez nos opportunités professionnelles et contribuez à construire la meilleure solution de gestion commerciale en Tunisie.</p>
        </div>
    </section>

    <section class="jobs-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article class="jobs-empty-card">
                        <div class="jobs-empty-icon">
                            <i class='bx bx-briefcase'></i>
                        </div>
                        <h2 class="jobs-empty-title">No jobs available</h2>
                        <p class="jobs-empty-text">Nous n’avons actuellement aucun poste ouvert. Merci de revenir plus tard pour consulter les futures opportunités chez Simplex Gestion.</p>
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
