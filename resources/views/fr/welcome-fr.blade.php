<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="icon" type="image/png" href="/img/logo.png">

    <title>Logiciel Gestion Commerciale Tunisie - Solution commerciale</title>
    <meta name="description" content="Logiciel de gestion commerciale complet pour commerce et pme en Tunisie. Système POS, gestion stock, facturation, clients. On configure tout pour vous GRATUITEMENT. 90 DT par mois seulement.">
    <meta name="keywords" content="logiciel gestion commerciale tunisie, système pos tunisie, logiciel facturation tunisie, gestion stock tunisie, point de vente tunisie, caisse enregistreuse, logiciel comptabilité tunisie">

    <link rel="canonical" href="https://simplexgestion.tn/fr">
    <link rel="alternate" hreflang="fr" href="https://simplexgestion.tn/fr">
    <link rel="alternate" hreflang="ar" href="https://simplexgestion.tn/">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- Meta Pixel -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '768128085832071');
        fbq('track', 'PageView');
    </script>

    <style>
        :root {
            --primary: #2948ff;
            --accent: #ff6b35;
            --success: #28a745;
            --dark: #1a202c;
            --light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-logo img {
            height: 40px;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #6c7ae0);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            transition: transform 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary), #6c7ae0);
            color: white;
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.8rem;
            font-weight: 700;
            color: #FFD700;
            margin-bottom: 2rem;
        }

        .problem-box {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 700px;
            text-align: left;
        }

        .problem-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .problem-item i {
            color: #ff6b6b;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* CTA */
        .cta-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 3rem 2rem;
            margin: 3rem auto;
            max-width: 650px;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .cta-headline {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: #FFD700;
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent), #ff8a5b);
            color: white;
            padding: 20px 50px;
            border-radius: 50px;
            font-size: 1.4rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            animation: pulse 2s infinite;
            box-shadow: 0 10px 30px rgba(255,107,53,0.4);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .btn-cta:hover {
            animation: none;
            transform: scale(1.05);
            color: white;
        }

        .cta-subtext {
            margin-top: 1.5rem;
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .trust-badge {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
        }

        /* Social Proof */
        .social-proof {
            background: white;
            padding: 60px 0;
        }

        .proof-item {
            text-align: center;
            padding: 2rem;
        }

        .proof-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .proof-label {
            font-size: 1.1rem;
            color: #666;
        }

        /* Benefits */
        .benefits {
            background: var(--light);
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .section-title .subtitle {
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .benefit-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .benefit-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), #6c7ae0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .benefit-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .benefit-card ul {
            list-style: none;
            padding: 0;
        }

        .benefit-card li {
            padding: 0.5rem 0 0.5rem 1.5rem;
            position: relative;
        }

        .benefit-card li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: bold;
        }

        /* Steps */
        .how-it-works {
            background: white;
            padding: 80px 0;
        }

        .step {
            text-align: center;
            padding: 2rem 1rem;
        }

        .step-number {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), #6c7ae0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            font-weight: 800;
            color: white;
        }

        .step h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        /* Pricing */
        .pricing {
            background: var(--light);
            padding: 80px 0;
        }

        .pricing-card {
            background: white;
            border-radius: 25px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
            border-top: 5px solid var(--primary);
        }

        .price-tag {
            font-size: 4rem;
            font-weight: 800;
            color: var(--primary);
            margin: 1rem 0;
        }

        .price-period {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }

        /* Testimonial */
        .testimonial {
            background: white;
            padding: 80px 0;
        }

        .testimonial-card {
            background: var(--light);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .testimonial-text {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 2rem;
            color: #555;
            line-height: 1.8;
        }

        .testimonial-author {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .testimonial-role {
            color: var(--primary);
        }

        /* Final CTA */
        .final-cta {
            background: linear-gradient(135deg, var(--primary), #6c7ae0);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .final-cta h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .final-cta p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Contact */
        .contact {
            background: white;
            padding: 60px 0;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
            background: var(--light);
            padding: 1.5rem;
            border-radius: 15px;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .contact-text a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 40px 0 20px;
            text-align: center;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--accent);
            transform: translateY(-3px);
            color: white;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .hero-subtitle { font-size: 1.4rem; }
            .cta-headline { font-size: 1.5rem; }
            .btn-cta { font-size: 1.2rem; padding: 16px 40px; }
            .section-title h2 { font-size: 2rem; }
            .price-tag { font-size: 3rem; }
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/fr" class="nav-logo">
                <img src="/img/logo.png" alt="Simplex Gestion">
            </a>
            <div class="nav-buttons">
                <a href="/" style="color: var(--primary); text-decoration: none; font-weight: 600;">العربية</a>
                <a href="{{ route('login') }}" class="btn-primary">Connexion</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Fatigué des problèmes de gestion commerciale ? 😓</h1>
            <p class="hero-subtitle">⚡ On résout votre problème cette semaine</p>

            <div class="problem-box">
                <div class="problem-item">
                    <i class='bx bx-x-circle'></i>
                    <span>Stock qui disparaît sans savoir où il va ?</span>
                </div>
                <div class="problem-item">
                    <i class='bx bx-x-circle'></i>
                    <span>Difficile de suivre les crédits clients et fournisseurs ?</span>
                </div>
                <div class="problem-item">
                    <i class='bx bx-x-circle'></i>
                    <span>Factures impayées qui s'accumulent ?</span>
                </div>
                <div class="problem-item">
                    <i class='bx bx-x-circle'></i>
                    <span>Pas de visibilité sur vos profits en temps réel ?</span>
                </div>
                <div class="problem-item">
                    <i class='bx bx-x-circle'></i>
                    <span>Vous passez des heures à calculer les ventes ?</span>
                </div>
            </div>

            <!-- CTA -->
            <div class="cta-box">
                <h2 class="cta-headline">✅ La Solution Simple : On configure tout pour vous</h2>
                <a href="{{ route('business.getRegister') }}" class="btn-cta" onclick="fbq('track', 'Lead');">
                    📞 Réserver un RDV Gratuit (30 min)
                </a>
                <p class="cta-subtext">
                    ✨ On vient chez vous, on configure le système avec vos produits<br>
                    <strong>Vous n'avez rien à faire</strong>
                </p>
                <div class="trust-badges">
                    <span class="trust-badge">✅ 100% Gratuit</span>
                    <span class="trust-badge">✅ Sans Engagement</span>
                    <span class="trust-badge">✅ On se déplace</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Proof -->
<section class="social-proof">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="proof-item">
                    <div class="proof-number">150+</div>
                    <div class="proof-label">Commerçants utilisent Simplex</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="proof-item">
                    <div class="proof-number">3 DT</div>
                    <div class="proof-label">Seulement par jour</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="proof-item">
                    <div class="proof-number">30 min</div>
                    <div class="proof-label">Pour la configuration</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="benefits">
    <div class="container">
        <div class="section-title">
            <span class="subtitle">Avantages</span>
            <h2>Comment Simplex résout vos problèmes</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-package'></i></div>
                    <h3>Stock Toujours Précis</h3>
                    <ul>
                        <li>Connaître votre stock en temps réel</li>
                        <li>Alertes automatiques de rupture</li>
                        <li>Ne ratez plus aucune vente</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-money'></i></div>
                    <h3>Crédits Sous Contrôle</h3>
                    <ul>
                        <li>Voir qui vous doit de l'argent</li>
                        <li>Suivi automatique des paiements</li>
                        <li>Relances clients faciles</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-receipt'></i></div>
                    <h3>Factures en Secondes</h3>
                    <ul>
                        <li>Impression en moins de 10 secondes</li>
                        <li>Toutes les factures sauvegardées</li>
                        <li>Retrouvez n'importe quelle facture</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-bar-chart'></i></div>
                    <h3>Profit Quotidien Visible</h3>
                    <ul>
                        <li>Rapports profit/perte en temps réel</li>
                        <li>Ventes par employé</li>
                        <li>Produits les plus vendus</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-time'></i></div>
                    <h3>Gain de Temps</h3>
                    <ul>
                        <li>Plus besoin de passer des heures</li>
                        <li>Tout est automatisé</li>
                        <li>Concentrez-vous sur votre croissance</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card">
                    <div class="benefit-icon"><i class='bx bx-store'></i></div>
                    <h3>Multi-Magasins</h3>
                    <ul>
                        <li>Gérez tous vos magasins depuis un seul endroit</li>
                        <li>Transférez le stock entre magasins</li>
                        <li>Rapports par magasin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <div class="section-title">
            <span class="subtitle">Comment ça marche</span>
            <h2>3 Étapes Simples pour Démarrer</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Réservez un RDV Gratuit</h3>
                    <p>Remplissez le formulaire, on vous rappelle en moins d'une heure</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>On Configure Tout</h3>
                    <p>On vient chez vous ou à distance, on ajoute vos produits en 30 minutes</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Commencez à Vendre</h3>
                    <p>Le système est prêt, utilisez-le immédiatement sans complication</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="testimonial">
    <div class="container">
        <div class="section-title">
            <h2>Ce que disent nos clients</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        "Avant Simplex, je passais 3 heures chaque soir à faire les comptes. Maintenant en 10 minutes je sais ce que j'ai gagné, qui me doit de l'argent, et ce qui manque en stock. Ça a changé ma vie !"
                    </p>
                    <div class="testimonial-author">Mohamed Hedi</div>
                    <div class="testimonial-role">Propriétaire magasin pièces auto - Sfax</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="pricing">
    <div class="container">
        <div class="section-title">
            <span class="subtitle">Tarif</span>
            <h2>Un Seul Prix, Simple et Transparent</h2>
        </div>
        <div class="pricing-card">
            <h3 style="color: var(--primary); font-weight: 700; margin-bottom: 1rem;">
                <i class='bx bx-crown' style="font-size: 2rem;"></i><br>
                Abonnement Mensuel
            </h3>
            <div class="price-tag">90 <span style="font-size: 2rem;">DT</span></div>
            <div class="price-period">Par mois</div>
            <ul style="list-style: none; padding: 0; text-align: left; max-width: 350px; margin: 0 auto 2rem;">
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Gestion complète de stock
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Point de vente (POS)
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Facturation illimitée
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Gestion clients & fournisseurs
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Rapports et statistiques
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Support technique gratuit
                </li>
                <li style="padding: 0.5rem 0 0.5rem 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; color: var(--success); font-weight: bold;">✓</span>
                    Configuration GRATUITE
                </li>
            </ul>
            <a href="{{ route('business.getRegister') }}" class="btn-primary" style="display: inline-block; padding: 15px 40px; font-size: 1.1rem;">
                Commencer Maintenant
            </a>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="final-cta">
    <div class="container">
        <h2>Prêt à Simplifier Votre Gestion ?</h2>
        <p>On configure tout pour vous cette semaine - GRATUITEMENT</p>
        <a href="{{ route('business.getRegister') }}" class="btn-cta" onclick="fbq('track', 'Lead');">
            📞 Réserver un RDV Gratuit Maintenant
        </a>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="img/logo-white.png" alt="Simplex" height="40" class="mb-3 opacity-75">
                <p class="small">Logiciel de gestion commerciale conçu pour le marché tunisien. Simple, Sécurisé, Efficace.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="text-white mb-3">Liens Utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Tarifs</a></li>
                    <li><a href="#" class="footer-link">Support Technique</a></li>
                    <li><a href="#" class="footer-link">Mentions Légales</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="text-white mb-3">Contact</h5>
                <ul class="list-unstyled">
                    <li><i class='bx bx-phone'></i> +216 24 327 623</li>
                    <li><i class='bx bx-envelope'></i> contact@simplexgestion.tn</li>
                    <li class="mt-3">
                        <a href="#" class="text-white me-3 fs-4"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="text-white me-3 fs-4"><i class='bx bxl-instagram'></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-top border-secondary pt-4 text-center small">
            © 2026 Simplex Gestion. Tous droits réservés.
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

</body>
</html>
