<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité - Simplex Gestion</title>
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

        .legal-hero {
            padding-top: 130px;
            padding-bottom: 34px;
        }

        .legal-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .legal-hero p {
            max-width: 780px;
            color: var(--secondary);
        }

        .legal-badge {
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

        .legal-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            padding: 24px;
            margin-bottom: 18px;
        }

        .legal-section h2 {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 14px;
            color: var(--dark);
        }

        .legal-section p {
            margin-bottom: 0.75rem;
            color: var(--secondary);
        }

        .legal-section ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
            color: var(--secondary);
        }

        .legal-section li + li {
            margin-top: 0.4rem;
        }

        footer {
            margin-top: 48px;
        }

        @media (max-width: 768px) {
            .legal-hero {
                padding-top: 108px;
                padding-bottom: 24px;
            }

            .legal-hero h1 {
                font-size: 1.75rem;
            }

            .legal-section {
                padding: 18px;
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
        <a class="d-flex justify-content-between align-items-center w-100 py-2 py-md-3">
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
    <section class="legal-hero">
        <div class="container">
            <span class="legal-badge"><i class='bx bx-lock-alt'></i> Protection des données</span>
            <h1>Politique de confidentialité</h1>
            <p>Cette politique détaille la collecte, l’utilisation, la conservation et la protection des données personnelles dans le cadre de l’utilisation de Simplex Gestion.</p>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <article class="legal-section">
                <h2>1. Introduction</h2>
                <p>La présente politique de confidentialité décrit la manière dont la société <strong>Simplex Gestion</strong> collecte, utilise et protège les données personnelles des utilisateurs de la plateforme Simplex Gestion.</p>
                <p>En utilisant la plateforme, l’utilisateur accepte la collecte et l’utilisation de ses données conformément à cette politique.</p>
            </article>

            <article class="legal-section">
                <h2>2. Données collectées</h2>
                <p>Dans le cadre de l’utilisation du service, nous pouvons collecter les données suivantes :</p>
                <ul>
                    <li>Informations d’identification (nom, prénom, entreprise)</li>
                    <li>Coordonnées (email, numéro de téléphone)</li>
                    <li>Données professionnelles (clients, ventes, stocks, fournisseurs)</li>
                    <li>Données de connexion (logs)</li>
                </ul>
            </article>

            <article class="legal-section">
                <h2>3. Finalité de la collecte</h2>
                <p>Les données sont collectées pour :</p>
                <ul>
                    <li>Fournir et améliorer le service</li>
                    <li>Gérer les comptes utilisateurs</li>
                    <li>Assurer la sécurité de la plateforme</li>
                    <li>Gérer la facturation et les abonnements</li>
                    <li>Effectuer des sauvegardes et statistiques techniques</li>
                </ul>
            </article>

            <article class="legal-section">
                <h2>4. Base légale du traitement</h2>
                <p>Les données sont traitées sur la base :</p>
                <ul>
                    <li>de l’exécution du contrat d’utilisation du service</li>
                    <li>du consentement de l’utilisateur</li>
                    <li>des obligations légales applicables en Tunisie</li>
                </ul>
                <p>La plateforme respecte les principes de protection des données inspirés du RGPD (Union européenne) et de la loi tunisienne relative à la protection des données personnelles.</p>
            </article>

            <article class="legal-section">
                <h2>5. Partage des données</h2>
                <p>Nous ne vendons ni ne partageons vos données. Vos informations ne sont jamais commercialisées ni communiquées à des tiers, sauf obligation légale ou avec votre autorisation.</p>
                <p>Vos données restent votre propriété. Vous conservez l'entière propriété de toutes les informations enregistrées dans votre compte..</p>
                <p>Accès limité à vos données. Notre équipe n'accède à vos données qu'en cas d'assistance technique ou de résolution d'un incident, et, dans la mesure du possible, avec votre accord préalable.</p>
            </article>

            <article class="legal-section">
                <h2>6. Conservation des données</h2>
                <p>Les données sont conservées pendant toute la durée d’utilisation du service, puis archivées pour une durée raisonnable après résiliation du compte, sauf obligation légale contraire.</p>
            </article>

            <article class="legal-section">
                <h2>7. Sécurité</h2>
                <p>Simplex Gestion met en place des mesures techniques et organisationnelles pour protéger les données contre la perte, l’accès non autorisé, la modification ou la divulgation.</p>
            </article>

            <article class="legal-section">
                <h2>8. Droits de l’utilisateur</h2>
                <p>L’utilisateur dispose des droits suivants :</p>
                <ul>
                    <li>Droit d’accès à ses données</li>
                    <li>Droit de rectification</li>
                    <li>Droit de suppression</li>
                    <li>Droit d’opposition au traitement</li>
                </ul>
                <p>Ces droits peuvent être exercés en contactant Simplex Gestion.</p>
            </article>

            <article class="legal-section">
                <h2>9. Cookies</h2>
                <p>La plateforme utilise des cookies pour assurer le fonctionnement du service, améliorer l’expérience utilisateur et analyser l’utilisation de la plateforme.</p>
            </article>

            <article class="legal-section">
                <h2>10. Transfert international</h2>
                <p>Les données peuvent être stockées ou traitées sur des serveurs situés hors de Tunisie, dans le respect des standards de sécurité applicables.</p>
            </article>

            <article class="legal-section">
                <h2>11. Contact</h2>
                <p>Pour toute question relative à la protection des données :<br><strong>Simplex Gestion</strong> (coordonnées à compléter)</p>
            </article>
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
