<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simplex Gestion vs Méthodes Traditionnelles | Pourquoi Switcher ?</title>
    <meta name="description" content="Comparez Simplex Gestion avec Excel et les logiciels classiques. Découvrez pourquoi les entreprises tunisiennes choisissent la digitalisation.">

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
            --success: #198754;
            --danger: #dc3545;
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

        .comparison-hero {
            padding-top: 130px;
            padding-bottom: 34px;
        }

        .comparison-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .comparison-hero p {
            max-width: 820px;
            color: var(--secondary);
        }

        .comparison-badge {
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
            padding: 16px 0 48px;
        }

        .comparison-wrap {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        }

        .comparison-table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 800;
        }

        .comparison-table td,
        .comparison-table th {
            vertical-align: middle;
            border-color: #edf2f7;
        }

        .comparison-table .simplex-col {
            background: #f8fbff;
        }

        .check-icon {
            color: var(--success);
            font-size: 1.3rem;
            vertical-align: middle;
        }

        .x-icon {
            color: var(--danger);
            font-size: 1.3rem;
            vertical-align: middle;
        }

        .edge-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-left: 4px solid var(--primary);
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .edge-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        .edge-card h3 {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .case-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 26px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .case-card p {
            color: var(--secondary);
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
            .comparison-hero {
                padding-top: 108px;
                padding-bottom: 22px;
            }

            .comparison-hero h1 {
                font-size: 1.75rem;
            }

            .edge-card,
            .case-card {
                padding: 20px 16px;
                border-radius: 14px;
            }

            .comparison-wrap {
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
    <section class="comparison-hero">
        <div class="container text-center">
            <span class="comparison-badge"><i class='bx bx-git-compare'></i> Comparatif</span>
            <h1>Pourquoi passer à Simplex Gestion ?</h1>
            <p class="mx-auto">Comparez votre solution actuelle avec une gestion moderne, intelligente et adaptée au marché tunisien.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="comparison-wrap table-responsive">
                <table class="table table-hover align-middle mb-0 comparison-table">
                    <thead>
                    <tr>
                        <th style="width: 40%;" class="ps-4 py-4">Fonctionnalité</th>
                        <th class="text-center py-4 text-danger">Excel/papier</th>
                        <th class="text-center py-4 text-danger">logiciel offline (local)</th>
                        <th class="text-center py-4 text-primary simplex-col">Simplex Gestion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="ps-4 fw-bold">Accessibilité</td>
                        <td class="text-center ">Limitée </td>
                        <td class="text-center ">Bloqué au bureau (PC unique)</td>
                        <td class="text-center simplex-col">✅ Partout (Mobile, PC) <span class="badge bg-primary">Cloud</span></td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Coût</td>
                        <td class="text-center ">Gratuit </td>
                        <td class="text-center ">Élevé (licences + maintenance)</td>
                        <td class="text-center bg-light border-start border-end">✅ Frais d'abonnement </td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Sécurité des données</td>
                        <td class="text-center">Zéro</td>
                        <td class="text-center">Risque Virus/Vol</td>
                        <td class="text-center simplex-col">✅ Élevée (sauvegardes automatiques, chiffrement, accès contrôlés)</td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Dépendance Matérielle</td>
                        <td class="text-center">PC</td>
                        <td class="text-center">pc puissant /Serveur local</td>
                        <td class="text-center bg-light border-start border-end">✅ Zéro dépense</td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Conformité Fiscale (TN)</td>
                        <td class="text-center"> Manuel (Risque d'erreur)</td>
                        <td class="text-center"> Payantes / Intervention technique</td>
                        <td class="text-center simplex-col">✅ Automatique (ex:TEJ)</td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Collaboration en temps réel</td>
                        <td class="text-center ">Limitée (fichier en lecture seule) </td>
                        <td class="text-center ">Non</td>
                        <td class="text-center bg-light border-start border-end">✅ Oui, multi utilisateurs simultanés</td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Inventaire & Achat</td>
                        <td class="text-center">Manuel</td>
                        <td class="text-center">Manuel</td>
                        <td class="text-center simplex-col">✅ Automatisé  par IA</td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Interface utilisateur </td>
                        <td class="text-center">Colonnes</td>
                        <td class="text-center">Ancienne & complexe</td>
                        <td class="text-center bg-light border-start border-end">✅ Design moderne & simple</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="pb-4">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Les avantages qui font la différence</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <article class="edge-card">
                        <h3><i class='bx bxs-file-pdf me-2'></i>L'avantage fiscal tunisien</h3>
                        <p>Contrairement aux solutions internationales qui exigent des réglages complexes, <strong>Simplex est pré-configuré</strong> pour le système tunisien :</p>
                        <ul class="small mb-0">
                            <li>Mises à jour fiscales automatiques.</li>
                            <li>déclaration TEJ, TVA, Timbre Fiscal.</li>
                            <li>Factures et rapports prêts pour votre comptable.</li>
                        </ul>
                    </article>
                </div>
                <div class="col-md-6">
                    <article class="edge-card">
                        <h3><i class='bx bxs-phone-call me-2'></i>Mobilité de terrain</h3>
                        <p>Vous êtes en déplacement ou chez un fournisseur ?</p>
                        <ul class="small mb-0">
                            <li>Vendez n'importe où depuis smartphone.</li>
                            <li>Vérifiez vos stocks en temps réel.</li>
                            <li>Validez les commandes clients à distance.</li>
                        </ul>
                    </article>
                </div>
                <div class="col-md-6">
                    <article class="edge-card">
                        <h3><i class='bx bxs-error-alt me-2'></i>Zéro perte de données</h3>
                        <p>En cas de panne locale, votre activité continue :</p>
                        <ul class="small mb-0">
                            <li>Connexion immédiate depuis un autre appareil.</li>
                            <li>Factures, clients et dettes toujours disponibles.</li>
                            <li><strong>Le business ne s'arrête jamais.</strong></li>
                        </ul>
                    </article>
                </div>
                <div class="col-md-6">
                    <article class="edge-card">
                        <h3><i class='bx bxs-up-arrow-circle me-2'></i>Mise en place rapide</h3>
                        <p>Passez à Simplex gestion rapidement :</p>
                        <ul class="small mb-0">
                            <li>Module d'importation Excel intelligent.</li>
                            <li>Mapping automatique de vos produits et clients.</li>
                            <li><strong>Migration en moins de 24h.</strong></li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="container text-center">
            <h3 class="fw-bold mb-4" style="font-size: 2rem">Simplex gestion est la meilleure solution pour vous !</h3>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article class="case-card">
                        <p class="lead mb-3">Excel n’est pas un système de gestion.
                            Chaque erreur de stock, chaque oubli de facture, chaque mauvaise décision vous coûte de l’argent.
<br>
<br>
                            Les logiciels locaux et solutions comme Sage et zoho sont puissants… mais souvent complexes, coûteux et mal adaptés aux réalités des grossistes et distributeurs en Tunisie.
                            <br>
                            <br>
                            Simplex Gestion a été conçu pour une seule chose : simplifier votre business et vous faire gagner du temps et de l’argent.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="container">
            <div class="cta-block text-center text-white">
                <h2 class="fw-bold mb-3">Prêt à moderniser votre commerce ?</h2>
                <p class="mb-4 text-white-50">Ne laissez plus une mauvaise gestion freiner votre croissance.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('business.getRegister') }}" class="btn btn-light btn-lg fw-bold text-primary">Démarrer l'essai gratuit</a>
                    <a href="/contact" class="btn btn-outline-light btn-lg">Demander une démo</a>
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
