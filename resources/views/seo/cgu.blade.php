<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGU - Simplex Gestion</title>
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

        .legal-section p:last-child {
            margin-bottom: 0;
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
            <span class="legal-badge"><i class='bx bx-shield-quarter'></i> Cadre légal</span>
            <h1>Conditions Générales d’Utilisation (CGU)</h1>
            <p>Les présentes conditions définissent les règles d’accès et d’utilisation des services Simplex Gestion pour les utilisateurs de la plateforme web et mobile.</p>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <article class="legal-section">
                <h2>1. Introduction</h2>
                <p>Nous sommes Simplex Gestion (« la Société », « nous », « notre »), une société enregistrée en Tunisie, propriétaire de Simplex Gestion.</p>
                <p>Nous exploitons le site web www.simplexgestion.tn (le « Site ») et les services connexes qui font référence ou renvoient à ces conditions légales (les « Conditions Légales ») (collectivement, les « Services »).</p>
                <p>Vous pouvez nous contacter par email à contact@simplexgestion.tn ou par courrier à notre adresse officielle indiquée à l'article 27.</p>
                <p>Ces Conditions Légales constituent un accord juridiquement contraignant conclu entre vous, que ce soit personnellement ou au nom d'une entité (« vous » ou « l'Utilisateur »), et Simplex Gestion, concernant votre accès et votre utilisation des Services. Vous acceptez qu'en accédant aux Services, vous avez lu, compris et accepté d'être lié par la totalité de ces Conditions Légales. Si vous n'acceptez pas la totalité de ces Conditions Légales, il vous est expressément interdit d'utiliser les Services et vous devez en cesser l'utilisation immédiatement.</p>
                <p>Nous vous fournirons un préavis de tout changement programmé des Services que vous utilisez. Les Conditions Légales modifiées entreront en vigueur dès leur publication sur le Site ou leur notification par email. En continuant à utiliser les Services après la date d'entrée en vigueur de tout changement, vous acceptez d'être lié par les conditions modifiées.</p>
                <p>Âge minimum : Les Services sont destinés aux utilisateurs âgés d'au moins 18 ans et aux personnes morales légalement constituées. Les personnes de moins de 18 ans ne sont pas autorisées à utiliser ou s'inscrire aux Services.</p>
                <p>Simplex Gestion est une solution SaaS de gestion commerciale destinée aux fournisseurs, grossistes, distributeurs et commerçants.</p>
                <p>L’utilisation de la plateforme implique l’acceptation pleine et entière des présentes CGU.</p>
            </article>

            <article class="legal-section">
                <h2>2. Définitions</h2>
                <p><strong>Plateforme</strong> : solution SaaS Simplex Gestion.</p>
                <p><strong>Utilisateur</strong> : toute personne accédant au service.</p>
                <p><strong>Compte</strong> : espace personnel de l’utilisateur.</p>
                <p><strong>Service</strong> : fonctionnalités de gestion commerciale.</p>
                <p><strong>Période d’essai</strong> : période gratuite de 14 jours.</p>
                <p><strong>Abonnement</strong> : accès payant au service.</p>
                <p><strong>Administrateur</strong> : utilisateur avec droits avancés.</p>
            </article>

            <article class="legal-section">
                <h2>3. Accès à la plateforme</h2>
                <p>L’accès nécessite la création d’un compte. L’utilisateur fournit des informations exactes et à jour.</p>
                <p>Simplex Gestion peut suspendre ou supprimer un compte en cas de non-respect des CGU.</p>
            </article>

            <article class="legal-section">
                <h2>4. Utilisation du service</h2>
                <p>Le service doit être utilisé légalement et de manière responsable.</p>
                <p>Il est interdit de revendre, détourner ou nuire au système.</p>
                <p>Les données restent la propriété de l’utilisateur.</p>
            </article>

            <article class="legal-section">
                <h2>5. Propriété intellectuelle</h2>
                <p>La plateforme appartient à Simplex Gestion et est protégée par les lois sur la propriété intellectuelle.</p>
                <p>Toute reproduction ou exploitation sans autorisation est interdite.</p>
            </article>

            <article class="legal-section">
                <h2>6. Responsabilité</h2>
                <p>Le service est fourni avec un objectif de disponibilité élevé.</p>
                <p>Simplex Gestion n’est pas responsable des pertes de données ou interruptions indépendantes de sa volonté.</p>
            </article>

            <article class="legal-section">
                <h2>7. Abonnements et paiements</h2>
                <p>Abonnements mensuels, semestriel ou annuels.</p>
                <p>Période d’essai gratuite de 14 jours.</p>
                <p>Paiement par virement ou espèces.</p>
                <p>En cas de non-paiement, délai de 30 jours avant suspension.</p>
            </article>

            <article class="legal-section">
                <h2>8. Résiliation</h2>
                <p>L’utilisateur peut supprimer son compte à tout moment.</p>
                <p>Simplex Gestion peut suspendre un compte en cas d’abus.</p>
                <p>Les données sont archivées après résiliation puis supprimées ultérieurement.</p>
            </article>

            <article class="legal-section">
                <h2>9. Données personnelles</h2>
                <p>Les données sont utilisées uniquement pour le fonctionnement du service.</p>
                <p>Elles sont traitées conformément aux lois en vigueur en matière de protection des données.</p>
            </article>

            <article class="legal-section">
                <h2>10. Droit applicable</h2>
                <p>Les présentes CGU sont régies par le droit tunisien.</p>
                <p>Tout litige relève des juridictions compétentes en Tunisie.</p>
            </article>

            <article class="legal-section">
                <h2>11. Support et contact</h2>
                <p>Pour toute question : Simplex Gestion (+21693796501).</p>
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
