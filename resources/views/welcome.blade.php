




<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,archive">
    <link rel="icon" type="image/png" href="img/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <title>Simplex Gestion: برنامج إدارة تجاري متكامل</title>
    <meta name="description" content="نظام إدارة تجاري شامل مع نقاط البيع (POS) لجميع أنواع التجارة">

    <style>
        :root {
            --primary-color: #2948ff;
            --secondary-color: #6c7ae0;
            --accent-color: #ff6b35;
            --success-color: #28a745;
            --dark-color: #1a202c;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #2948ff 0%, #6c7ae0 100%);
            --gradient-secondary: linear-gradient(135deg, #ff6b35 0%, #ff8a5b 100%);
            --shadow-soft: 0 10px 30px rgba(41, 72, 255, 0.1);
            --shadow-hover: 0 15px 40px rgba(41, 72, 255, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        /* Navbar */
        .navbar-area {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-soft);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.1);
        }

        .btn-login {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-soft);
            margin-left: 15px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            color: white;
        }

        .btn-register {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="500" cy="500" r="400" fill="rgba(255,255,255,0.1)"/><circle cx="300" cy="300" r="200" fill="rgba(255,255,255,0.05)"/><circle cx="700" cy="700" r="150" fill="rgba(255,255,255,0.03)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-btn {
            background: var(--gradient-secondary);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
            display: inline-block;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 107, 53, 0.4);
            color: white;
        }

        /* Features Section */
        .features-section {
            padding: 120px 0;
            background: var(--light-color);
        }

        .section-title {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-title .sub-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: block;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-color);
        }

        .feature-card p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        /* Statistics Section */
        .stats-section {
            padding: 100px 0;
            background: var(--gradient-primary);
            color: white;
        }

        .stat-item {
            text-align: center;
            padding: 30px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--accent-color);
        }

        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 120px 0;
            background: white;
        }

        .step-card {
            text-align: center;
            padding: 40px 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .step-card h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .step-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 120px 0;
            background: var(--light-color);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-soft);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .testimonial-text {
            font-style: italic;
            color: #666;
            margin-bottom: 20px;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--dark-color);
        }

        .testimonial-role {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        /* Pricing Section */
        .pricing-section {
            padding: 120px 0;
            background: white;
        }

        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            border: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pricing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-primary);
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .pricing-badge {
            background: var(--gradient-secondary);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 30px;
            display: inline-block;
        }

        .pricing-amount {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .pricing-period {
            color: #666;
            margin-bottom: 30px;
        }

        /* FAQ Section */
        .faq-section {
            padding: 120px 0;
            background: var(--light-color);
        }

        .faq-item {
            background: white;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .faq-question {
            background: var(--gradient-primary);
            color: white;
            padding: 25px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: right;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 30px;
            color: #666;
            line-height: 1.8;
            background: white;
        }

        /* Contact Section */
        .contact-section {
            padding: 120px 0;
            background: var(--gradient-primary);
            color: white;
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 40px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 20px;
            font-size: 1.2rem;
        }

        .contact-text a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-text a:hover {
            color: var(--accent-color);
        }

        /* Footer */
        .footer-section {
            background: var(--dark-color);
            color: white;
            padding: 80px 0 30px;
        }

        .footer-brand {
            margin-bottom: 30px;
        }

        .footer-brand img {
            margin-bottom: 20px;
        }

        .footer-text {
            color: #ccc;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 30px;
            margin-top: 50px;
            text-align: center;
            color: #ccc;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .pricing-amount {
                font-size: 2.5rem;
            }

            .navbar-area .container-fluid {
                padding: 10px 20px;
            }

            .hero-section {
                padding: 100px 0 50px;
            }

            .features-section,
            .how-it-works,
            .testimonials-section,
            .pricing-section,
            .faq-section,
            .contact-section {
                padding: 80px 0;
            }
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .feature-card,
            .testimonial-card,
            .pricing-card {
                padding: 30px 20px;
            }

            .btn-login,
            .btn-register {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s ease;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-area">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="/" class="navbar-brand">
                    <img src="img/logo.png" alt="Simplex Gestion Logo" width="40" height="40">
                </a>
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class='bx bx-log-in'></i>
                        تسجيل الدخول
                    </a>
                    <a href="{{ route('business.getRegister') }}" class="btn-register">
                        إنشاء حساب
                        <i class='bx bx-plus'></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-content" data-aos="fade-up">
                        <h1>نظم تجارتك بكل بساطة</h1>
                        <p>حلول إدارة تجارية متكاملة لجميع أنواع الأعمال. من إدارة المخزون إلى نقاط البيع، نوفر لك كل ما تحتاجه لتنمية أعمالك بكفاءة وسهولة.</p>
                        <a href="#" class="hero-btn">
                            ابدأ تجربتك المجانية
                            <i class='bx bx-arrow-back'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">عميل راضٍ</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">وقت التشغيل</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">دعم فني</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-number">14</div>
                        <div class="stat-label">يوم تجربة مجانية</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">مميزات Simplex Gestion</span>
                <h2>حلول شاملة لإدارة أعمالك</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">
                            <i class='bx bx-package'></i>
                        </div>
                        <h3>إدارة المنتجات والمخزون</h3>
                        <p>• إدارة العلامات التجارية والفئات بسهولة</p>
                        <p>• تنبيهات ذكية لانخفاض المخزون أو انتهاء الصلاحية</p>
                        <p>• إدارة مخزونات متعددة في مكان واحد</p>
                        <p>• تتبع حركة المنتجات في الوقت الفعلي</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class='bx bx-store'></i>
                        </div>
                        <h3>نقطة البيع (POS)</h3>
                        <p>• واجهة مبسطة وسريعة للبيع</p>
                        <p>• إنشاء وطباعة الفواتير فوراً</p>
                        <p>• إدارة العملاء والموردين</p>
                        <p>• دعم أنواع دفع متعددة</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class='bx bx-trending-up'></i>
                        </div>
                        <h3>إدارة المبيعات والمشتريات</h3>
                        <p>• تتبع وتحليل المبيعات بالتفصيل</p>
                        <p>• إنشاء عروض وتخفيضات مخصصة</p>
                        <p>• تحليل النفقات حسب الفئة</p>
                        <p>• تذكيرات بالمدفوعات المستحقة</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon">
                            <i class='bx bx-bar-chart-alt-2'></i>
                        </div>
                        <h3>التقارير والإحصائيات</h3>
                        <p>• تقارير مفصلة للمبيعات والمصروفات</p>
                        <p>• تقارير نقدية شاملة</p>
                        <p>• تقارير المخزون والمنتجات</p>
                        <p>• تحليل المنتجات الأكثر مبيعاً</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-icon">
                            <i class='bx bx-group'></i>
                        </div>
                        <h3>إدارة العملاء والموردين</h3>
                        <p>• قاعدة بيانات شاملة للعملاء والموردين</p>
                        <p>• تسجيل معلومات الاتصال والعناوين</p>
                        <p>• تتبع تاريخ المعاملات التجارية</p>
                        <p>• إدارة الحسابات الجارية</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                        <div class="feature-icon">
                            <i class='bx bx-qr-scan'></i>
                        </div>
                        <h3>الباركود واللاصقات</h3>
                        <p>• إنشاء وطباعة الباركود بسهولة</p>
                        <p>• قراءة الباركود السريعة</p>
                        <p>• طباعة اللاصقات المخصصة</p>
                        <p>• تسريع عملية البيع والجرد</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">كيف يعمل النظام</span>
                <h2>ثلاث خطوات بسيطة للبدء</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="step-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-number">1</div>
                        <h4>سجل حسابك</h4>
                        <p>أنشئ حساباً جديداً واحصل على تجربة مجانية لمدة 14 يوماً لتجربة جميع المميزات دون قيود.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-number">2</div>
                        <h4>أضف منتجاتك</h4>
                        <p>أدخل تفاصيل منتجاتك وخدماتك، وقم بتنظيمها في فئات لسهولة الإدارة والبحث.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="step-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="step-number">3</div>
                        <h4>ابدأ البيع</h4>
                        <p>استخدم نظام نقاط البيع المتطور لإتمام المبيعات وإنشاء الفواتير وتتبع الأرباح.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Types Section -->
    <section class="business-types-section" style="padding: 120px 0; background: white;">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">أنواع الأعمال المدعومة</span>
                <h2>الحل المثالي لجميع أنواع التجارة</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">
                            <i class='bx bx-store-alt'></i>
                        </div>
                        <h3>محلات التجزئة</h3>
                        <p>مثالي للمتاجر الصغيرة والمتوسطة، محلات الملابس، الأحذية، والإكسسوارات.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class='bx bx-devices'></i>
                        </div>
                        <h3>محلات الإلكترونيات</h3>
                        <p>إدارة متخصصة للأجهزة الإلكترونية مع تتبع الضمانات والمواصفات التقنية.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class='bx bx-first-aid'></i>
                        </div>
                        <h3>الصيدليات</h3>
                        <p>نظام متخصص لإدارة الأدوية مع تتبع تواريخ الانتهاء والتحكم في المخزون الطبي.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon">
                            <i class='bx bx-food-menu'></i>
                        </div>
                        <h3>المطاعم والمقاهي</h3>
                        <p>حلول مخصصة لإدارة المطاعم والمقاهي مع قوائم الطعام وإدارة الطلبات.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-icon">
                            <i class='bx bx-car'></i>
                        </div>
                        <h3>قطع غيار السيارات</h3>
                        <p>إدارة شاملة لقطع الغيار مع تصنيف حسب نوع السيارة والموديل.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                        <div class="feature-icon">
                            <i class='bx bx-package'></i>
                        </div>
                        <h3>تجارة الجملة</h3>
                        <p>حلول متقدمة لتجار الجملة مع إدارة كميات كبيرة وأسعار متدرجة.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">آراء العملاء</span>
                <h2>ماذا يقول عملاؤنا</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial-avatar">
                            <i class='bx bx-user'></i>
                        </div>
                        <div class="testimonial-text">
                            "نظام Simplex Gestion غير طريقة عملي تماماً. أصبح بإمكاني تتبع مبيعاتي ومخزوني بسهولة وسرعة."
                        </div>
                        <div class="testimonial-author">أحمد التونسي</div>
                        <div class="testimonial-role">صاحب محل إلكترونيات</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial-avatar">
                            <i class='bx bx-user'></i>
                        </div>
                        <div class="testimonial-text">
                            "النظام سهل الاستخدام والدعم الفني ممتاز. أنصح به كل تاجر يريد تطوير عمله."
                        </div>
                        <div class="testimonial-author">فاطمة الساحلي</div>
                        <div class="testimonial-role">صاحبة محل ملابس</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="testimonial-avatar">
                            <i class='bx bx-user'></i>
                        </div>
                        <div class="testimonial-text">
                            "التقارير والإحصائيات ساعدتني كثيراً في اتخاذ قرارات صحيحة لتطوير تجارتي."
                        </div>
                        <div class="testimonial-author">محمد الشرقي</div>
                        <div class="testimonial-role">صاحب صيدلية</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">الأسعار</span>
                <h2>خطة واحدة، مميزات لا محدودة</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-badge">
                            <i class='bx bx-crown'></i>
                            الاشتراك الشهري
                        </div>
                        <div class="pricing-amount">39 <span style="font-size: 1.5rem;">د.ت</span></div>
                        <div class="pricing-period">شهرياً</div>
                        <div class="pricing-features">
                            <div class="feature-item" style="padding: 10px 0; border-bottom: 1px solid #eee;">
                                <i class='bx bx-check' style="color: var(--success-color); margin-left: 10px;"></i>
                                تجربة مجانية 14 يوم
                            </div>
                            <div class="feature-item" style="padding: 10px 0; border-bottom: 1px solid #eee;">
                                <i class='bx bx-check' style="color: var(--success-color); margin-left: 10px;"></i>
                                جميع المميزات مفتوحة
                            </div>
                            <div class="feature-item" style="padding: 10px 0; border-bottom: 1px solid #eee;">
                                <i class='bx bx-check' style="color: var(--success-color); margin-left: 10px;"></i>
                                دعم فني 24/7
                            </div>
                            <div class="feature-item" style="padding: 10px 0; border-bottom: 1px solid #eee;">
                                <i class='bx bx-check' style="color: var(--success-color); margin-left: 10px;"></i>
                                تحديثات مجانية
                            </div>
                            <div class="feature-item" style="padding: 10px 0;">
                                <i class='bx bx-check' style="color: var(--success-color); margin-left: 10px;"></i>
                                نسخ احتياطية يومية
                            </div>
                        </div>
                        <div style="margin-top: 30px;">
                            <a href="#" class="hero-btn">
                                ابدأ تجربتك المجانية
                                <i class='bx bx-arrow-back'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="sub-title">الأسئلة الشائعة</span>
                <h2>إجابات على أسئلتك</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            <span>هل يمكنني استخدام النظام على أكثر من جهاز؟</span>
                            <i class='bx bx-chevron-down'></i>
                        </button>
                        <div class="faq-answer" style="display: none;">
                            نعم، يمكنك الوصول إلى حسابك من أي جهاز متصل بالإنترنت. النظام يعمل عبر المتصفح ولا يحتاج إلى تثبيت برامج إضافية.
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            <span>هل بياناتي آمنة؟</span>
                            <i class='bx bx-chevron-down'></i>
                        </button>
                        <div class="faq-answer" style="display: none;">
                            بياناتك محمية بأعلى معايير الأمان. نستخدم تشفير SSL ونقوم بعمل نسخ احتياطية يومية لضمان سلامة بياناتك.
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            <span>هل يمكنني إلغاء الاشتراك في أي وقت؟</span>
                            <i class='bx bx-chevron-down'></i>
                        </button>
                        <div class="faq-answer" style="display: none;">
                            نعم، يمكنك إلغاء الاشتراك في أي وقت دون رسوم إضافية. ستحتفظ بإمكانية الوصول إلى بياناتك حتى نهاية فترة الاشتراك المدفوعة.
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            <span>هل يوجد تدريب على استخدام النظام؟</span>
                            <i class='bx bx-chevron-down'></i>
                        </button>
                        <div class="faq-answer" style="display: none;">
                            نعم، نوفر دعماً فنياً شاملاً وتدريباً مجانياً لجميع المستخدمين. كما نوفر فيديوهات تعليمية ودليل المستخدم باللغة العربية.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="section-title" style="text-align: right; margin-bottom: 50px;">
                        <span class="sub-title" style="color: rgba(255,255,255,0.8);">تواصل معنا</span>
                        <h2 style="color: white;">هل لديك أسئلة؟</h2>
                        <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem;">
                            فريقنا مستعد لمساعدتك في أي وقت. تواصل معنا وسنكون سعداء لخدمتك.
                        </p>
                    </div>
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <div class="contact-text">
                                <h5>البريد الإلكتروني</h5>
                                <a href="mailto:contact@simplexschool.com">contact@simplexschool.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class='bx bx-phone'></i>
                            </div>
                            <div class="contact-text">
                                <h5>الهاتف</h5>
                                <a href="tel:+21624327623">+216 24 327 623</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class='bx bx-time'></i>
                            </div>
                            <div class="contact-text">
                                <h5>ساعات العمل</h5>
                                <p>من الاثنين إلى الجمعة: 9:00 - 18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-right">
                    <div style="text-align: center; padding: 40px;">
                        <a href="mailto:contact@simplexschool.com" class="hero-btn">
                            تواصل معنا الآن
                            <i class='bx bx-send'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-brand">
                        <img src="img/logo.png" alt="Simplex Gestion" width="60">
                        <div class="footer-text">
                            نظام إدارة تجاري شامل يساعدك على تنظيم وتطوير أعمالك بكل سهولة وفعالية. انضم إلى مئات التجار الذين اختاروا Simplex Gestion.
                        </div>
                        <div class="social-links">
                            <a href="#" class="social-link">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class='bx bxl-instagram'></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class='bx bxl-linkedin'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: white; margin-bottom: 20px;">روابط مفيدة</h5>
                            <ul style="list-style: none; padding: 0;">
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">الرئيسية</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">المميزات</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">الأسعار</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">تواصل معنا</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: white; margin-bottom: 20px;">الدعم</h5>
                            <ul style="list-style: none; padding: 0;">
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">مركز المساعدة</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">شروط الاستخدام</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">سياسة الخصوصية</a></li>
                                <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">الأسئلة الشائعة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>جميع الحقوق محفوظة © 2025 Simplex Gestion</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // FAQ Toggle Function
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('i');

            if (answer.style.display === 'none' || answer.style.display === '') {
                answer.style.display = 'block';
                icon.classList.remove('bx-chevron-down');
                icon.classList.add('bx-chevron-up');
            } else {
                answer.style.display = 'none';
                icon.classList.remove('bx-chevron-up');
                icon.classList.add('bx-chevron-down');
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-area');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
                const suffix = counter.textContent.replace(/[0-9]/g, '');
                let current = 0;
                const increment = target / 100;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current) + suffix;
                        setTimeout(updateCounter, 20);
                    } else {
                        counter.textContent = target + suffix;
                    }
                };

                updateCounter();
            });
        }

        // Trigger counter animation when section is visible
        const statsSection = document.querySelector('.stats-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        if (statsSection) {
            observer.observe(statsSection);
        }
    </script>
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-M57CQPB9JN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-M57CQPB9JN');
    </script>
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    @yield('javascript')
</body>
</html>