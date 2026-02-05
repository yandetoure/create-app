<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\FeatureCategory;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uiCategory = FeatureCategory::create(['name' => 'Interface & Design UI/UX', 'icon' => 'paint-brush']);
        $authCategory = FeatureCategory::create(['name' => 'Sécurité & Authentification', 'icon' => 'lock-closed']);
        $paymentCategory = FeatureCategory::create(['name' => 'Paiements & Facturation', 'icon' => 'credit-card']);
        $commCategory = FeatureCategory::create(['name' => 'Communication & Social', 'icon' => 'chat-bubble-left-right']);
        $techCategory = FeatureCategory::create(['name' => 'Technique & Infrastructure', 'icon' => 'cpu-chip']);
        $aiCategory = FeatureCategory::create(['name' => 'Intelligence Artificielle & Data', 'icon' => 'beaker']);
        $marketingCategory = FeatureCategory::create(['name' => 'Marketing & Croissance', 'icon' => 'megaphone']);

        // --- Interface & Design --- (15 features)
        $features = [
            ['feature_category_id' => $uiCategory->id, 'name' => 'Mode Sombre / Dark Mode', 'slug' => 'dark-mode', 'description' => 'Interface adaptative nuit/jour', 'price' => 50000, 'impact_days' => 1],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Animations Premium (Lottie)', 'slug' => 'animations', 'description' => 'Micro-interactions fluides', 'price' => 80000, 'impact_days' => 2],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Design System sur mesure', 'slug' => 'design-system', 'description' => 'Charte graphique unique', 'price' => 300000, 'impact_days' => 5],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Tableau de bord Admin', 'slug' => 'admin-dashboard', 'description' => 'Gestion complète du contenu', 'price' => 250000, 'impact_days' => 4],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Illustrations Personnalisées', 'slug' => 'illustrations', 'description' => 'Pack de 10 icônes/images', 'price' => 120000, 'impact_days' => 3],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Multi-langue (FR/EN/ES)', 'slug' => 'multilingual', 'description' => 'Support international', 'price' => 100000, 'impact_days' => 2],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Drag & Drop Interface', 'slug' => 'drag-drop', 'description' => 'Glisser-déposer intuitif', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Police de caractères Custom', 'slug' => 'custom-fonts', 'description' => 'Typographie premium', 'price' => 30000, 'impact_days' => 1],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Responsive Ultra-fluide', 'slug' => 'ultra-responsive', 'description' => 'Optimisation tous écrans', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Squelette de chargement', 'slug' => 'skeleton', 'description' => 'Optimisation UX visuelle', 'price' => 40000, 'impact_days' => 1],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Navigation Mega Menu', 'slug' => 'mega-menu', 'description' => 'Menu complexe structuré', 'price' => 70000, 'impact_days' => 2],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Recherche en temps réel', 'slug' => 'instant-search', 'description' => 'Filtrage dynamique', 'price' => 90000, 'impact_days' => 2],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Galerie Image Premium', 'slug' => 'gallery', 'description' => 'Lightbox & Zoom', 'price' => 60000, 'impact_days' => 1],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Composants Interactifs', 'slug' => 'interactive-components', 'description' => 'Graphiques & Modales', 'price' => 130000, 'impact_days' => 3],
            ['feature_category_id' => $uiCategory->id, 'name' => 'Export PDF (Rapports)', 'slug' => 'pdf-export', 'description' => 'Génération automatique', 'price' => 180000, 'impact_days' => 4],
        ];

        // --- Sécurité & Auth --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $authCategory->id, 'name' => 'Login Social (Google/FB)', 'slug' => 'social-login', 'description' => 'Connexion simplifiée', 'price' => 120000, 'impact_days' => 2],
            ['feature_category_id' => $authCategory->id, 'name' => 'Double Auth (2FA)', 'slug' => '2fa', 'description' => 'Sécurité renforcée (SMS/App)', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $authCategory->id, 'name' => 'Gestion des Rôles (RBAC)', 'slug' => 'roles', 'description' => 'Permissions granulaires', 'price' => 200000, 'impact_days' => 4],
            ['feature_category_id' => $authCategory->id, 'name' => 'Audit Log', 'slug' => 'audit-log', 'description' => 'Historique des actions', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $authCategory->id, 'name' => 'Chiffrement des données', 'slug' => 'encryption', 'description' => 'Conformité RGPD / Sécurité', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $authCategory->id, 'name' => 'Vérification d\'identité (KYC)', 'slug' => 'kyc', 'description' => 'Scan de documents', 'price' => 500000, 'impact_days' => 7],
            ['feature_category_id' => $authCategory->id, 'name' => 'Session Management', 'slug' => 'sessions', 'description' => 'Gestion active des devices', 'price' => 100000, 'impact_days' => 2],
            ['feature_category_id' => $authCategory->id, 'name' => 'Protection Brute Force', 'slug' => 'bruteforce-prot', 'description' => 'Blocage IP & Rate limit', 'price' => 80000, 'impact_days' => 2],
            ['feature_category_id' => $authCategory->id, 'name' => 'Passwordless Auth', 'slug' => 'passwordless', 'description' => 'Lien magique par e-mail', 'price' => 130000, 'impact_days' => 3],
            ['feature_category_id' => $authCategory->id, 'name' => 'Single Sign-On (SSO)', 'slug' => 'sso', 'description' => 'SAML / OAuth Entreprise', 'price' => 400000, 'impact_days' => 6],
            ['feature_category_id' => $authCategory->id, 'name' => 'Auto-déconnexion', 'slug' => 'idle-timeout', 'description' => 'Inactivité sécurité', 'price' => 40000, 'impact_days' => 1],
            ['feature_category_id' => $authCategory->id, 'name' => 'Blacklist IP Dynamique', 'slug' => 'ip-blacklist', 'description' => 'Sécurité proactive', 'price' => 110000, 'impact_days' => 2],
            ['feature_category_id' => $authCategory->id, 'name' => 'Backup Automatique', 'slug' => 'auto-backup', 'description' => 'Sauvegarde journalière', 'price' => 200000, 'impact_days' => 2],
            ['feature_category_id' => $authCategory->id, 'name' => 'HTTPS & SSL Premium', 'slug' => 'https-ssl', 'description' => 'Certificat et configuration', 'price' => 50000, 'impact_days' => 1],
            ['feature_category_id' => $authCategory->id, 'name' => 'Firewall d\'application (WAF)', 'slug' => 'waf', 'description' => 'Protection Cloudflare/AWS', 'price' => 150000, 'impact_days' => 2],
        ]);

        // --- Paiements & Facturation --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Intégration Stripe', 'slug' => 'stripe', 'description' => 'Cartes de crédit mondiales', 'price' => 200000, 'impact_days' => 3],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Paiement Mobile Money', 'slug' => 'mobile-money', 'description' => 'Orange/MTN/Wave/Moov', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Système d\'Abonnement', 'slug' => 'subscriptions', 'description' => 'Paiements récurrents', 'price' => 300000, 'impact_days' => 5],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Factures PDF Auto', 'slug' => 'pdf-invoice', 'description' => 'Génération après achat', 'price' => 120000, 'impact_days' => 2],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Gestion de la TVA', 'slug' => 'tax-mgmt', 'description' => 'Calcul automatique taxes', 'price' => 80000, 'impact_days' => 2],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Coupons & Promos', 'slug' => 'coupons', 'description' => 'Codes de réduction', 'price' => 100000, 'impact_days' => 2],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Multi-Devises', 'slug' => 'multi-currency', 'description' => 'Conversion temps réel', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Portefeuille Client (Wallet)', 'slug' => 'client-wallet', 'description' => 'Crédit interne prépayé', 'price' => 450000, 'impact_days' => 6],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Remboursements Auto', 'slug' => 'refunds', 'description' => 'Gestion des litiges', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Checkout 1-Click', 'slug' => 'one-click-checkout', 'description' => 'Optimisation conversion', 'price' => 250000, 'impact_days' => 4],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Paiement en N fois', 'slug' => 'installments', 'description' => 'Échelonnement automatique', 'price' => 400000, 'impact_days' => 6],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Lien de paiement direct', 'slug' => 'payment-link', 'description' => 'Envoi par SMS/WhatsApp', 'price' => 70000, 'impact_days' => 1],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Terminal de paiement (POS)', 'slug' => 'pos-sync', 'description' => 'Synchro magasin physique', 'price' => 600000, 'impact_days' => 10],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Gestion de l\'Affiliation', 'slug' => 'affiliates', 'description' => 'Commissions partenaires', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $paymentCategory->id, 'name' => 'Statistiques de revenus', 'slug' => 'revenue-analytics', 'description' => 'Graphes et prévisions', 'price' => 150000, 'impact_days' => 3],
        ]);

        // --- Communication & Social --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $commCategory->id, 'name' => 'Chat en direct (LiveChat)', 'slug' => 'livechat', 'description' => 'Support temps réel', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $commCategory->id, 'name' => 'Intégration WhatsApp App', 'slug' => 'whatsapp-api', 'description' => 'Envoi automatisé', 'price' => 250000, 'impact_days' => 4],
            ['feature_category_id' => $commCategory->id, 'name' => 'Notifications Push Mobile', 'slug' => 'push-mobile', 'description' => 'Fidélisation utilisateur', 'price' => 200000, 'impact_days' => 3],
            ['feature_category_id' => $commCategory->id, 'name' => 'Emails Transactionnels', 'slug' => 'transactional-emails', 'description' => 'Mailgun / SendGrid config', 'price' => 90000, 'impact_days' => 2],
            ['feature_category_id' => $commCategory->id, 'name' => 'Forum Communautaire', 'slug' => 'forum', 'description' => 'Espace d\'échange', 'price' => 400000, 'impact_days' => 7],
            ['feature_category_id' => $commCategory->id, 'name' => 'Système de Parrainage', 'slug' => 'referral', 'description' => ' viralité intégrée', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $commCategory->id, 'name' => 'Avis & Commentaires', 'slug' => 'reviews', 'description' => 'Système d\'étoiles', 'price' => 100000, 'impact_days' => 2],
            ['feature_category_id' => $commCategory->id, 'name' => 'Messagerie Interne', 'slug' => 'internal-messaging', 'description' => 'DM entre utilisateurs', 'price' => 300000, 'impact_days' => 5],
            ['feature_category_id' => $commCategory->id, 'name' => 'Intégration Zoom/Meet', 'slug' => 'video-conf', 'description' => 'Visioconférence', 'price' => 450000, 'impact_days' => 6],
            ['feature_category_id' => $commCategory->id, 'name' => 'Flux Sociaux (Feed)', 'slug' => 'social-feed', 'description' => 'Mur de publications', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $commCategory->id, 'name' => 'Profils Publics', 'slug' => 'user-profiles', 'description' => 'Pages personnalisées', 'price' => 120000, 'impact_days' => 2],
            ['feature_category_id' => $commCategory->id, 'name' => 'Partage Social', 'slug' => 'social-share', 'description' => 'Boutons de partage', 'price' => 40000, 'impact_days' => 1],
            ['feature_category_id' => $commCategory->id, 'name' => 'Chatbot de base', 'slug' => 'basic-chatbot', 'description' => 'Scénario automatisé', 'price' => 220000, 'impact_days' => 4],
            ['feature_category_id' => $commCategory->id, 'name' => 'Système de Newsletters', 'slug' => 'newsletter', 'description' => 'Gestion de listes mail', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $commCategory->id, 'name' => 'Support par Ticket', 'slug' => 'ticket-system', 'description' => 'Helpdesk complet', 'price' => 280000, 'impact_days' => 5],
        ]);

        // --- Technique & Infrastructure --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $techCategory->id, 'name' => 'API REST Publique', 'slug' => 'rest-api', 'description' => 'Connexion tiers', 'price' => 450000, 'impact_days' => 8],
            ['feature_category_id' => $techCategory->id, 'name' => 'Synchro Cloud (S3/GCS)', 'slug' => 'cloud-sync', 'description' => 'Stockage illimité fichiers', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $techCategory->id, 'name' => 'PWA (Offline App)', 'slug' => 'pwa', 'description' => 'Installation web mobile', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $techCategory->id, 'name' => 'Search avec Elasticsearch', 'slug' => 'elasticsearch', 'description' => 'Recherche ultra-rapide', 'price' => 400000, 'impact_days' => 7],
            ['feature_category_id' => $techCategory->id, 'name' => 'Caching avec Redis', 'slug' => 'redis-cache', 'description' => 'Performance accrue', 'price' => 120000, 'impact_days' => 2],
            ['feature_category_id' => $techCategory->id, 'name' => 'Gestion de Logs avancée', 'slug' => 'logging', 'description' => 'Sentry / Monitoring', 'price' => 100000, 'impact_days' => 2],
            ['feature_category_id' => $techCategory->id, 'name' => 'SEO Opti & Sitemap', 'slug' => 'seo-pro', 'description' => 'Référencement maximum', 'price' => 80000, 'impact_days' => 2],
            ['feature_category_id' => $techCategory->id, 'name' => 'WebSocket / Realtime', 'slug' => 'websockets', 'description' => 'Notifications instantanées', 'price' => 250000, 'impact_days' => 5],
            ['feature_category_id' => $techCategory->id, 'name' => 'Export de données (Excel / CSV)', 'slug' => 'data-export', 'description' => 'Utile pour gestion', 'price' => 110000, 'impact_days' => 2],
            ['feature_category_id' => $techCategory->id, 'name' => 'Import Massive Data', 'slug' => 'data-import', 'description' => 'Outil de migration', 'price' => 220000, 'impact_days' => 4],
            ['feature_category_id' => $techCategory->id, 'name' => 'CDN Implementation', 'slug' => 'cdn', 'description' => 'Vitesse mondiale', 'price' => 70000, 'impact_days' => 1],
            ['feature_category_id' => $techCategory->id, 'name' => 'CI/CD Configuration', 'slug' => 'cicd', 'description' => 'Déploiement auto securisé', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $techCategory->id, 'name' => 'Multi-Tenant (SaaS)', 'slug' => 'multi-tenant', 'description' => 'Bases de données isolées', 'price' => 800000, 'impact_days' => 15],
            ['feature_category_id' => $techCategory->id, 'name' => 'Optimisation Images Auto', 'slug' => 'img-opti', 'description' => 'Gain de bande passante', 'price' => 60000, 'impact_days' => 1],
            ['feature_category_id' => $techCategory->id, 'name' => 'Versionning Api', 'slug' => 'api-versioning', 'description' => 'Evolutivité assurée', 'price' => 140000, 'impact_days' => 3],
        ]);

        // --- AI & Data --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $aiCategory->id, 'name' => 'IA Chatbot (OpenAI/GPT)', 'slug' => 'ai-chat', 'description' => 'Assistant intelligent', 'price' => 600000, 'impact_days' => 8],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Recommandations IA', 'slug' => 'recommendations', 'description' => 'Machine Learning basique', 'price' => 700000, 'impact_days' => 12],
            ['feature_category_id' => $aiCategory->id, 'name' => 'OCR (Lecture documents)', 'slug' => 'ocr', 'description' => 'Scan de factures auto', 'price' => 500000, 'impact_days' => 10],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Analyse de sentiment', 'slug' => 'sentiment-analysis', 'description' => 'Sur avis clients', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Génération d\'images IA', 'slug' => 'ai-images', 'description' => 'DALL-E mini intégré', 'price' => 550000, 'impact_days' => 8],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Transcription Audio/Video', 'slug' => 'transcription', 'description' => 'Whisper integration', 'price' => 450000, 'impact_days' => 7],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Prédiction de ventes', 'slug' => 'sales-forecast', 'description' => 'Analyse prédictive stats', 'price' => 850000, 'impact_days' => 15],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Résumé auto de texte', 'slug' => 'auto-summary', 'description' => 'NLP pour articles', 'price' => 300000, 'impact_days' => 5],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Traduction Auto IA', 'slug' => 'ai-translation', 'description' => 'Traductions parfaites', 'price' => 400000, 'impact_days' => 6],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Reconnaissance Faciale', 'slug' => 'face-recognition', 'description' => 'Sécurité biométrique', 'price' => 1200000, 'impact_days' => 20],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Synthèse Vocale (TTS)', 'slug' => 'tts', 'description' => 'Voix réalistes', 'price' => 380000, 'impact_days' => 6],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Détection d\'anomalies', 'slug' => 'anomaly-detection', 'description' => 'Anti-fraude Data', 'price' => 650000, 'impact_days' => 10],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Clustering Clients', 'slug' => 'segmentation', 'description' => 'Marketing ciblé ML', 'price' => 580000, 'impact_days' => 9],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Génération PDF par IA', 'slug' => 'ai-pdf', 'description' => 'Mise en page auto', 'price' => 480000, 'impact_days' => 7],
            ['feature_category_id' => $aiCategory->id, 'name' => 'Extraction de données Web', 'slug' => 'scrapping', 'description' => 'Scrapping éthique', 'price' => 320000, 'impact_days' => 6],
        ]);

        // --- Marketing & Croissance --- (15 features)
        $features = array_merge($features, [
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Google Analytics 4 config', 'slug' => 'ga4', 'description' => 'Tracking complet', 'price' => 70000, 'impact_days' => 1],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Facebook Pixel / API', 'slug' => 'fb-pixel', 'description' => 'Conversion Ads', 'price' => 80000, 'impact_days' => 1],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'A/B Testing Tool', 'slug' => 'ab-test', 'description' => 'Optimisation landing', 'price' => 250000, 'impact_days' => 4],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Popups Smart Exit', 'slug' => 'popups', 'description' => 'Retrait de lead', 'price' => 60000, 'impact_days' => 1],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Gestion des Funnels', 'slug' => 'funnels', 'description' => 'Entonnoise de vente', 'price' => 300000, 'impact_days' => 5],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Blog Auto-Post Social', 'slug' => 'social-autopost', 'description' => 'Synchro réseaux', 'price' => 180000, 'impact_days' => 3],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'CRM Marketing (Mailchimp)', 'slug' => 'mailchimp', 'description' => 'Automation mails', 'price' => 120000, 'impact_days' => 2],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Hotjar / Heatmaps', 'slug' => 'heatmaps', 'description' => 'Analyse du clic user', 'price' => 90000, 'impact_days' => 2],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Outil de SEO On-page', 'slug' => 'seo-tool', 'description' => 'Conseils en temps réel', 'price' => 150000, 'impact_days' => 3],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Lien court & Tracking', 'slug' => 'short-links', 'description' => 'Type Bitly personnalisé', 'price' => 110000, 'impact_days' => 2],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Webinaires Intégrés', 'slug' => 'webinars', 'description' => 'Tunnel de vente video', 'price' => 500000, 'impact_days' => 8],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Gamification (Badges)', 'slug' => 'gamification', 'description' => 'Engagement utilisateur', 'price' => 350000, 'impact_days' => 5],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Google Search Console', 'slug' => 'gsc-config', 'description' => 'Indexation parfaite', 'price' => 50000, 'impact_days' => 1],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Rapports Marketing Hebdo', 'slug' => 'reports-marketing', 'description' => 'Envoi auto PDF', 'price' => 140000, 'impact_days' => 3],
            ['feature_category_id' => $marketingCategory->id, 'name' => 'Gestion Multi-canaux SMS', 'slug' => 'multi-sms', 'description' => 'Twilio / Vonage setup', 'price' => 200000, 'impact_days' => 3],
        ]);

        foreach ($features as $featureData) {
            Feature::create($featureData);
        }
    }
}
