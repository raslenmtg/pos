<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Simplex Gestion</title>
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

        .faq-hero {
            padding-top: 130px;
            padding-bottom: 34px;
        }

        .faq-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .faq-hero p {
            max-width: 780px;
            color: var(--secondary);
        }

        .faq-badge {
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
            padding: 40px 0 56px;
        }

        .section.bg-light {
            background-color: var(--light) !important;
        }

        .accordion-item {
            border: none;
            margin-bottom: 15px;
            background: transparent;
        }

        .accordion-button {
            background: #fff !important;
            padding: 25px;
            border-radius: 16px !important;
            font-weight: 700;
            color: var(--dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(41, 72, 255, 0.15);
            border-color: rgba(41, 72, 255, 0.35);
        }

        .accordion-body {
            background: #fff;
            border-radius: 0 0 16px 16px;
            padding: 25px;
            color: var(--secondary);
            margin-top: -10px;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .faq-hero {
                padding-top: 108px;
                padding-bottom: 24px;
            }

            .faq-hero h1 {
                font-size: 1.75rem;
            }

            .accordion-button,
            .accordion-body {
                padding: 18px;
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
    <section class="faq-hero">
        <div class="container">
            <span class="faq-badge"><i class='bx bx-help-circle'></i> Centre d’aide</span>
            <h1>Questions Fréquentes</h1>
            <p>Tout ce que vous devez savoir avant de commencer avec Simplex Gestion.</p>
        </div>
    </section>

    <section class="section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Puis-je tester avant de payer ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Oui, absolument.</strong> Nous configurons votre période d'essai avec vos propres produits et clients. Vous testez la plateforme dans vos conditions réelles, avec notre accompagnement complet. Aucun engagement jusqu'à ce que vous soyez convaincu.
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
                                    Oui. Nous utilisons des serveurs hautement sécurisés avec chiffrement des données et effectuons des sauvegardes quotidiennes automatiques.
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Puis-je annuler mon abonnement à tout moment ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Oui, en toute liberté.</strong> Nos offres sont sans engagement de durée. Vous pouvez arrêter votre abonnement quand vous le souhaitez, sans frais cachés ni pénalités.
                                </div>
                            </div>
                        </div>
                    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
