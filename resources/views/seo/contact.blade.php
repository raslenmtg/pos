<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Simplex Gestion</title>
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
            --success: #10b981;
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

        .contact-hero {
            padding-top: 130px;
            padding-bottom: 28px;
        }

        .contact-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .contact-hero p {
            max-width: 780px;
            color: var(--secondary);
        }

        .contact-badge {
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

        .contact-section {
            padding: 16px 0 56px;
        }

        .contact-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            padding: 34px 28px;
            height: 100%;
        }

        .contact-card h2 {
            font-size: 1.45rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .contact-card p {
            color: var(--secondary);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--secondary);
            margin-bottom: 14px;
            font-weight: 600;
        }

        .contact-item i {
            color: var(--primary);
            font-size: 1.3rem;
            width: 24px;
            text-align: center;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 18px;
        }

        .social-links a {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid #dbeafe;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--primary);
            font-size: 1.35rem;
            transition: all 0.2s ease;
            background: #eff6ff;
        }

        .social-links a:hover {
            background: var(--primary);
            color: #fff;
        }

        .whatsapp-cta {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 14px;
            padding: 16px;
            margin-top: 18px;
        }

        .whatsapp-cta .btn-success {
            background: var(--success);
            border: none;
            border-radius: 12px;
            font-weight: 700;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .contact-hero {
                padding-top: 108px;
                padding-bottom: 20px;
            }

            .contact-hero h1 {
                font-size: 1.75rem;
            }

            .contact-card {
                padding: 24px 18px;
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
    <section class="contact-hero">
        <div class="container">
            <span class="contact-badge"><i class='bx bx-support'></i> Contact</span>
            <h1>Contactez Simplex Gestion</h1>
            <p>Cette page regroupe tous les moyens pour joindre notre équipe rapidement: téléphone, email, WhatsApp et réseaux sociaux.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-7">
                    <article class="contact-card">
                        <h2>Nous contacter</h2>
                        <p>Notre équipe est disponible pour répondre à vos questions commerciales, techniques et d’accompagnement.</p>

                        <div class="contact-item">
                            <i class='bx bx-phone'></i>
                            <span>+216 93 796 501</span>
                        </div>
                        <div class="contact-item">
                            <i class='bx bx-envelope'></i>
                            <span>contact@simplexgestion.tn</span>
                        </div>

                        <div class="social-links">
                            <a href="https://www.facebook.com/simplexgestion" target="_blank" aria-label="Facebook">
                                <i class='bx bxl-facebook-circle'></i>
                            </a>
                            <a href="https://www.tiktok.com/@simplexgestion" target="_blank" aria-label="TikTok">
                                <i class='bx bxl-tiktok'></i>
                            </a>
                            <a href="https://www.instagram.com/simplexgestion" target="_blank" aria-label="Instagram">
                                <i class='bx bxl-instagram-alt'></i>
                            </a>
                        </div>
                    </article>
                </div>

                <div class="col-lg-5">
                    <article class="contact-card">
                        <h2>Support WhatsApp</h2>
                        <p>Vous pouvez nous écrire directement sur WhatsApp pour une réponse rapide.</p>

                        <div class="whatsapp-cta">
                            <p class="mb-3 fw-semibold text-dark">Disponible pour questions et démonstration.</p>
                            <a href="https://wa.me/21693796501?text=Bonjour%20Simplex,%20je%20souhaite%20plus%20d'informations%20sur%20votre%20solution." target="_blank" class="btn btn-success w-100">
                                <i class='bx bxl-whatsapp me-2'></i> Contacter sur WhatsApp
                            </a>
                        </div>
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
