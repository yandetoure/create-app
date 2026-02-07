<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateApp - Créez votre projet digital en quelques clics</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 900;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            color: #9ca3af;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: #ffffff;
        }

        .nav-links a.active {
            color: #6366f1;
        }

        .nav-cta {
            display: flex;
            gap: 1rem;
        }

        .btn-login {
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }

        .btn-start {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        /* Hero Section */
        .hero {
            padding: 10rem 2rem 6rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15), transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 2rem;
            color: #a855f7;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 0.875rem;
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.5rem;
            color: #9ca3af;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .hero-cta {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
        }

        .btn-primary {
            padding: 1.25rem 3rem;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
            border: none;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        }

        .btn-secondary {
            padding: 1.25rem 3rem;
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }

        /* Stats Section */
        .stats {
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.02);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 1.125rem;
        }

        /* Features Section */
        .features {
            padding: 6rem 2rem;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 4rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.25rem;
            color: #9ca3af;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2.5rem;
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.5);
            background: rgba(255, 255, 255, 0.05);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #9ca3af;
            line-height: 1.6;
        }

        /* How It Works */
        .how-it-works {
            padding: 6rem 2rem;
            background: rgba(255, 255, 255, 0.02);
        }

        .steps-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            gap: 3rem;
        }

        .step {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 2rem;
            align-items: start;
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
        }

        .step-content h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .step-content p {
            color: #9ca3af;
            font-size: 1.125rem;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 2rem;
            text-align: center;
        }

        .cta-box {
            max-width: 800px;
            margin: 0 auto;
            padding: 4rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 2rem;
        }

        .cta-box h2 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .cta-box p {
            font-size: 1.25rem;
            color: #9ca3af;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            padding: 4rem 2rem 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-col h4 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-col p {
            color: #9ca3af;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .footer-col a {
            display: block;
            color: #9ca3af;
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: color 0.3s;
        }

        .footer-col a:hover {
            color: #6366f1;
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.125rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">🚀 CreateApp</a>
            <div class="nav-links">
                <a href="#accueil" class="active">Accueil</a>
                <a href="#templates">Templates</a>
                <a href="#fonctionnalites">Fonctionnalités</a>
                <a href="#comment-ca-marche">Comment ça marche</a>
                <a href="#tarifs">Tarifs</a>
            </div>
            <div class="nav-cta">
                <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                <a href="{{ route('register') }}" class="btn-start">Commencer</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <div class="hero-content">
            <span class="hero-badge">✨ Plateforme de création de projets digitaux</span>
            <h1>Créez votre projet digital en quelques clics</h1>
            <p>Configurez, personnalisez et lancez votre site web, application mobile ou SaaS avec notre plateforme
                intelligente. Devis instantané, templates professionnels.</p>
            <div class="hero-cta">
                <a href="{{ route('register') }}" class="btn-primary">🚀 Démarrer gratuitement</a>
                <a href="#comment-ca-marche" class="btn-secondary">📖 Voir comment ça marche</a>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">{{ number_format($counts['projects'] ?? 10000) }}+</div>
                <div class="stat-label">Projets créés</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $counts['categories'] ?? 20 }}+</div>
                <div class="stat-label">Types de projets</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $counts['features'] ?? 100 }}+</div>
                <div class="stat-label">Fonctionnalités disponibles</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24h</div>
                <div class="stat-label">Devis instantané</div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features" id="fonctionnalites">
        <div class="section-header">
            <h2 class="section-title">Pourquoi choisir CreateApp ?</h2>
            <p class="section-subtitle">Une plateforme complète pour transformer vos idées en réalité digitale</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Configuration Rapide</h3>
                <p>Configurez votre projet en quelques minutes grâce à notre interface intuitive et nos templates prêts
                    à l'emploi.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎨</div>
                <h3>Templates Professionnels</h3>
                <p>Choisissez parmi des dizaines de templates modernes et personnalisables pour tous types de projets.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Devis Instantané</h3>
                <p>Obtenez un devis détaillé en temps réel avec estimation du coût et du délai de réalisation.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔧</div>
                <h3>Fonctionnalités Modulaires</h3>
                <p>Ajoutez uniquement les fonctionnalités dont vous avez besoin : paiement, chat, notifications, etc.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Suivi en Temps Réel</h3>
                <p>Suivez l'avancement de votre projet avec un tableau de bord complet et des mises à jour régulières.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3>Déploiement Facile</h3>
                <p>Déployez votre projet en un clic sur nos serveurs ou téléchargez les fichiers sources.</p>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="comment-ca-marche">
        <div class="section-header">
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-subtitle">4 étapes simples pour lancer votre projet</p>
        </div>
        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Choisissez votre type de projet</h3>
                    <p>Sélectionnez parmi nos catégories : site web, application mobile, SaaS, e-commerce, etc. Plus de
                        60 types de projets disponibles.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Configurez vos fonctionnalités</h3>
                    <p>Ajoutez les fonctionnalités dont vous avez besoin : authentification, paiement, chat,
                        notifications push, etc. Le prix s'ajuste automatiquement.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Choisissez un template</h3>
                    <p>Sélectionnez un template professionnel adapté à votre projet. Prévisualisez en temps réel avant
                        de valider.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Lancez votre projet</h3>
                    <p>Validez votre configuration, recevez votre devis et notre équipe commence le développement.
                        Suivez l'avancement en temps réel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-box">
            <h2>Prêt à lancer votre projet ?</h2>
            <p>Rejoignez des milliers d'entrepreneurs qui ont concrétisé leurs idées avec CreateApp</p>
            <a href="{{ route('register') }}" class="btn-primary">🚀 Commencer maintenant</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>🚀 CreateApp</h4>
                    <p>La plateforme intelligente pour créer vos projets digitaux. Rapide, simple, professionnel.</p>
                </div>
                <div class="footer-col">
                    <h4>Produit</h4>
                    <a href="#fonctionnalites">Fonctionnalités</a>
                    <a href="#templates">Templates</a>
                    <a href="#tarifs">Tarifs</a>
                    <a href="#comment-ca-marche">Comment ça marche</a>
                </div>
                <div class="footer-col">
                    <h4>Entreprise</h4>
                    <a href="#">À propos</a>
                    <a href="#">Blog</a>
                    <a href="#">Carrières</a>
                    <a href="#">Contact</a>
                </div>
                <div class="footer-col">
                    <h4>Légal</h4>
                    <a href="#">Conditions d'utilisation</a>
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Mentions légales</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 CreateApp. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
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

        // Active nav link on scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-links a');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>