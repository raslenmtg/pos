<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique d’utilisation acceptable - Simplex Gestion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2948ff;
            --primary-dark: #1a35cc;
            --secondary: #333d50;
            --dark: #0f172a;
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
            max-width: 860px;
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

        .legal-section p:last-child {
            margin-bottom: 0;
        }

        .legal-list {
            margin: 0;
            padding-left: 1.25rem;
            color: var(--secondary);
        }

        .legal-list li + li {
            margin-top: 0.6rem;
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
    <section class="legal-hero">
        <div class="container">
            <span class="legal-badge"><i class='bx bx-check-shield'></i>Conditions d'utilisation</span>
            <h1>Politique d’utilisation </h1>
            <p>La présente Politique d’utilisation fait partie des Conditions d’utilisation ou d’un autre accord régissant l’utilisation des Services de <strong>simplexgestion.tn</strong> (« Accord ») et reflète les activités interdites dans le cadre de l’utilisation des Services et/ou de l’un des sites de <strong>simplexgestion.tn</strong> (collectivement, les « Services »), en plus des restrictions prévues dans l’Accord.</p>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <article class="legal-section">
                <h2>1. Activités interdites</h2>
                <p>Vous déclarez et garantissez que vous ne devez pas faire, et ne forcerez pas ou n’autoriserez pas un tiers à effectuer l’une des activités suivantes :</p>
                <ol class="legal-list">
                    <li>Accéder (ou tenter d’accéder), altérer, faire de la rétro-ingénierie, exporter, télécharger ou rechercher toute partie des Services et/ou de ses infrastructures, systèmes, réseaux et technologies sous-jacents ou connexes (« Systèmes »), par tout moyen autre que l’interface fournie en relation avec les Services ou les Systèmes (par exemple, scraping, spidering ou crawling).</li>
                    <li>Sonder, scanner ou tester la vulnérabilité de tout système ou réseau, ou violer ou contourner toute mesure de sécurité ou d’authentification.</li>
                    <li>Essayer de perturber ou de submerger l’infrastructure en imposant des demandes déraisonnables ou des charges sur les ressources (par exemple, via des bots).</li>
                    <li>Copier, modifier, altérer, changer ou créer des œuvres dérivées des Services ou des Systèmes, ou supprimer les marques de propriété.</li>
                    <li>Utiliser les Services et/ou les Systèmes pour transmettre des logiciels malveillants ou à des fins d’hameçonnage.</li>
                    <li>Effectuer des activités ou transmettre du contenu susceptible de nuire ou de perturber le fonctionnement des Services, des Systèmes ou de toute autre infrastructure de simplexgestion.tn ou d’une tierce partie.</li>
                    <li>Utiliser les Services pour mener des activités illégales, illicites, frauduleuses ou trompeuses, ou à des fins concurrentielles.</li>
                    <li>Essayer d’obtenir un accès non autorisé aux Services ou aux Systèmes pour contourner les mécanismes de protection ou de surveillance.</li>
                    <li>Usurper l’identité d’une personne, d’une organisation ou d’une entité, ou présenter faussement une affiliation.</li>
                    <li>Utiliser les Services pour porter atteinte à la vie privée d’autrui, notamment en publiant des informations privées et confidentielles sans autorisation.</li>
                    <li>Utiliser les Services pour effectuer ou encourager des activités diffamatoires, calomnieuses, menaçantes, haineuses, de harcèlement ou de persécution.</li>
                    <li>Télécharger, soumettre ou transmettre du contenu contenant (ou redirigeant vers) des virus, chevaux de Troie, vers, exploits, bots, ou tout autre composant nuisible.</li>
                    <li>Utiliser à mauvais escient ou de manière excessive les Services ou les Systèmes par rapport à l’usage prévu, y compris une consommation massive de stockage ou une sollicitation nuisible.</li>
                    <li>Envoyer des messages ou communications illégaux, non sollicités (spam), envoyés à des listes achetées/récupérées/louées, ou à des destinataires ayant demandé l’arrêt des envois.</li>
                    <li>Générer du contenu (y compris via des fonctionnalités d’IA) illégal, nuisible, haineux, discriminatoire, menaçant, violent, harcelant, préjudiciable ou qui encourage un tel contenu.</li>
                    <li>Générer ou utiliser du contenu (y compris via des fonctionnalités d’IA) enfreignant les droits d’un tiers.</li>
                </ol>
            </article>

            <article class="legal-section">
                <h2>2. Contenu interdit</h2>
                <p>Vous déclarez et garantissez que vous n’autoriserez pas, ne provoquerez pas et n’encouragerez pas d’autres personnes à télécharger, soumettre, inviter, saisir, transmettre, diffuser, envoyer, publier, produire, collecter ou mettre à disposition via les Services ou les Systèmes tout contenu qui :</p>
                <ol class="legal-list">
                    <li>Exploite ou abuse des enfants, y compris les images ou représentations d’abus sexuels d’enfants, ou présentant des enfants de manière sexuelle.</li>
                    <li>Porte atteinte aux droits de propriété intellectuelle de simplexgestion.tn ou aux droits d’un tiers (droit d’auteur, marque, brevet, secret commercial, droit moral, vie privée, publicité, droits contractuels, etc.).</li>
                    <li>Porte atteinte aux droits à la vie privée ou aux droits de publicité.</li>
                    <li>Est trompeur, frauduleux, illégal, obscène, diffamatoire, menaçant, nuisible, pornographique, indécent, harcelant, haineux, incitant à la violence/au terrorisme, ou encourageant un comportement illégal ou inapproprié.</li>
                    <li>Attaque ou établit illégalement des relations avec les autres selon leur origine ethnique, nationale, religion, sexe, orientation sexuelle, handicap ou maladie.</li>
                </ol>
            </article>

            <article class="legal-section">
                <h2>3. Surveillance et contrôle</h2>
                <p>Nous ne sommes pas tenus de surveiller vos activités en rapport avec les Services ou les Systèmes. Toutefois, nous pouvons procéder à un examen et/ou à un contrôle systématique de tout contenu téléchargé, soumis et/ou transmis via nos Services ou Systèmes, à tout moment et pour quelque raison que ce soit, afin de vérifier la conformité à la présente PUA et à l’Accord, avec ou sans préavis.</p>
            </article>

            <article class="legal-section">
                <h2>4. Droits d’auteur</h2>
                <p>Vous reconnaissez que notre politique vise à respecter les droits légitimes des détenteurs de droits d’auteur et d’autres droits de propriété intellectuelle, et que nous répondrons aux avis de violation présumée des droits d’auteur conformément à notre politique en matière de droits d’auteur et de contenu.</p>
            </article>

            <article class="legal-section">
                <h2>5. Mesures en cas de violation</h2>
                <p>Outre les autres recours dont nous pouvons disposer, si nous soupçonnons que votre contenu, l’une de vos activités ou l’utilisation des Services constitue une violation de la présente PUA, de l’Accord ou de la législation applicable, nous pouvons, avec ou sans préavis et sans responsabilité envers vous : (i) supprimer et/ou bloquer le contenu litigieux ; (ii) résilier ou suspendre votre compte, l’accès aux Services ou à certaines fonctionnalités ; et/ou (iii) supprimer ou limiter l’accès au contenu ou aux données soumises via les Services.</p>
            </article>

            <article class="legal-section">
                <h2>6. Modifications de la politique</h2>
                <p>Nous pouvons mettre à jour et/ou modifier la présente politique de temps à autre. Si <strong>simplexgestion.tn</strong> apporte des modifications importantes, nous vous en informerons de manière appropriée selon les circonstances, par exemple via un avis visible dans les Services ou par e-mail. En continuant à utiliser les Services après la mise en œuvre de ces modifications, vous acceptez ces changements.</p>
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
