<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webSite = Category::updateOrCreate(['slug' => 'site-web'], ['name' => 'Site Web Vitrine / Corporate', 'icon' => 'globe-alt']);
        $mobileApp = Category::updateOrCreate(['slug' => 'app-mobile'], ['name' => 'Application Mobile Native/Hybride', 'icon' => 'device-phone-mobile']);
        $webApp = Category::updateOrCreate(['slug' => 'web-app'], ['name' => 'Logiciel Métier / SaaS', 'icon' => 'computer-desktop']);

        $types = [
            'site-web' => [
                ['name' => 'Site de présentation standard', 'slug' => 'presentation', 'base_price' => 250000, 'base_duration_days' => 5],
                ['name' => 'Portfolio Créatif', 'slug' => 'portfolio', 'base_price' => 150000, 'base_duration_days' => 4],
                ['name' => 'Restaurant & Menu digital', 'slug' => 'restaurant', 'base_price' => 300000, 'base_duration_days' => 6],
                ['name' => 'Agence Immobilière', 'slug' => 'immobilier', 'base_price' => 500000, 'base_duration_days' => 10],
                ['name' => 'Hôtel & Réservations', 'slug' => 'hotel', 'base_price' => 600000, 'base_duration_days' => 12],
                ['name' => 'Clinique & Santé', 'slug' => 'sante', 'base_price' => 450000, 'base_duration_days' => 8],
                ['name' => 'Cabinet d\'avocats', 'slug' => 'avocat', 'base_price' => 400000, 'base_duration_days' => 7],
                ['name' => 'Site E-commerce simple', 'slug' => 'ecommerce-simple', 'base_price' => 750000, 'base_duration_days' => 15],
                ['name' => 'Landing Page Produit', 'slug' => 'landing-page', 'base_price' => 100000, 'base_duration_days' => 3],
                ['name' => 'Blog / Magazine d\'actualités', 'slug' => 'blog-mag', 'base_price' => 350000, 'base_duration_days' => 8],
                ['name' => 'Site Institutionnel / ONG', 'slug' => 'ong', 'base_price' => 550000, 'base_duration_days' => 10],
                ['name' => 'Portail d\'annonces', 'slug' => 'annonces', 'base_price' => 850000, 'base_duration_days' => 20],
                ['name' => 'Site de formation (LMS)', 'slug' => 'lms-web', 'base_price' => 950000, 'base_duration_days' => 25],
                ['name' => 'Marketplace de services', 'slug' => 'marketplace', 'base_price' => 1200000, 'base_duration_days' => 30],
                ['name' => 'Site d\'événementiel', 'slug' => 'evenement', 'base_price' => 400000, 'base_duration_days' => 7],
                ['name' => 'Auto-école digitalisée', 'slug' => 'auto-ecole', 'base_price' => 500000, 'base_duration_days' => 10],
                ['name' => 'Espace coworking', 'slug' => 'coworking', 'base_price' => 450000, 'base_duration_days' => 8],
                ['name' => 'Salle de sport / Fitness', 'slug' => 'fitness', 'base_price' => 350000, 'base_duration_days' => 7],
            ],
            'app-mobile' => [
                ['name' => 'App de Livraison (Uber Like)', 'slug' => 'livraison', 'base_price' => 1500000, 'base_duration_days' => 25],
                ['name' => 'App de Réservation VTC', 'slug' => 'vtc', 'base_price' => 1800000, 'base_duration_days' => 30],
                ['name' => 'Réseau Social complet', 'slug' => 'social', 'base_price' => 2500000, 'base_duration_days' => 45],
                ['name' => 'App E-learning Mobile', 'slug' => 'elearning-mobile', 'base_price' => 1200000, 'base_duration_days' => 20],
                ['name' => 'App de Santé / Téléconsultation', 'slug' => 'telemedecine', 'base_price' => 2200000, 'base_duration_days' => 40],
                ['name' => 'Fintech / Portefeuille mobile', 'slug' => 'fintech', 'base_price' => 3500000, 'base_duration_days' => 60],
                ['name' => 'App de Dating / Rencontres', 'slug' => 'dating', 'base_price' => 2000000, 'base_duration_days' => 35],
                ['name' => 'App de Fitness / Coaching', 'slug' => 'coaching', 'base_price' => 1400000, 'base_duration_days' => 25],
                ['name' => 'App de Streaming Audio/Vidéo', 'slug' => 'streaming', 'base_price' => 4000000, 'base_duration_days' => 70],
                ['name' => 'App de Gestion d\'inventaire scans', 'slug' => 'inventaire-mobile', 'base_price' => 1600000, 'base_duration_days' => 28],
                ['name' => 'App de Fidélité / Coupons', 'slug' => 'fidelite', 'base_price' => 900000, 'base_duration_days' => 15],
                ['name' => 'App de Conciergerie', 'slug' => 'conciergerie', 'base_price' => 1700000, 'base_duration_days' => 30],
                ['name' => 'App de Voyage & Guide local', 'slug' => 'voyage', 'base_price' => 1500000, 'base_duration_days' => 25],
                ['name' => 'App pour Communautés Religieuses', 'slug' => 'religion', 'base_price' => 800000, 'base_duration_days' => 15],
                ['name' => 'App de Pet Sitting / Animaux', 'slug' => 'pets', 'base_price' => 1100000, 'base_duration_days' => 20],
                ['name' => 'App pour Services de Nettoyage', 'slug' => 'cleaning', 'base_price' => 1300000, 'base_duration_days' => 22],
                ['name' => 'App de Recettes de cuisine', 'slug' => 'cuisine', 'base_price' => 950000, 'base_duration_days' => 18],
            ],
            'web-app' => [
                ['name' => 'SaaS Gestion Scolaire (ERP)', 'slug' => 'scolaire', 'base_price' => 2500000, 'base_duration_days' => 40],
                ['name' => 'Logiciel de Comptabilité Cloud', 'slug' => 'compta', 'base_price' => 3000000, 'base_duration_days' => 50],
                ['name' => 'CRM personnalisé', 'slug' => 'crm', 'base_price' => 2200000, 'base_duration_days' => 35],
                ['name' => 'ERP complet d\'entreprise', 'slug' => 'erp', 'base_price' => 5000000, 'base_duration_days' => 90],
                ['name' => 'Plateforme de Télétravail / Collab', 'slug' => 'teletravail', 'base_price' => 2800000, 'base_duration_days' => 45],
                ['name' => 'Logiciel de Gestion RH (HRM)', 'slug' => 'rh', 'base_price' => 2400000, 'base_duration_days' => 38],
                ['name' => 'Plateforme de Crowdfunding', 'slug' => 'crowdfunding', 'base_price' => 3500000, 'base_duration_days' => 55],
                ['name' => 'Système de ticketing / Support', 'slug' => 'ticketing', 'base_price' => 1800000, 'base_duration_days' => 30],
                ['name' => 'Plateforme d\'Automatisation Marketing', 'slug' => 'marketing-automation', 'base_price' => 4000000, 'base_duration_days' => 65],
                ['name' => 'Tableau de bord BI / Analytics', 'slug' => 'bi', 'base_price' => 3200000, 'base_duration_days' => 50],
                ['name' => 'SaaS de Gestion de Microfinance', 'slug' => 'microfinance', 'base_price' => 4500000, 'base_duration_days' => 80],
                ['name' => 'Logiciel de Gestion Hospitalière', 'slug' => 'hospital-mgmt', 'base_price' => 5500000, 'base_duration_days' => 100],
                ['name' => 'Plateforme d\'Appels d\'offres', 'slug' => 'tender', 'base_price' => 2600000, 'base_duration_days' => 42],
                ['name' => 'Logiciel de Logistique / Flotte', 'slug' => 'logistique', 'base_price' => 3800000, 'base_duration_days' => 60],
                ['name' => 'SaaS de Gestion de Microfinance', 'slug' => 'agriculture', 'base_price' => 2200000, 'base_duration_days' => 35],
                ['name' => 'Logiciel de Paie (Payroll)', 'slug' => 'payroll', 'base_price' => 2000000, 'base_duration_days' => 32],
                ['name' => 'Plateforme de Concours en ligne', 'slug' => 'concours', 'base_price' => 1500000, 'base_duration_days' => 25],
            ]
        ];

        foreach ($types['site-web'] as $type) {
            $webSite->projectTypes()->updateOrCreate(['slug' => $type['slug']], $type);
        }
        foreach ($types['app-mobile'] as $type) {
            $mobileApp->projectTypes()->updateOrCreate(['slug' => $type['slug']], $type);
        }
        foreach ($types['web-app'] as $type) {
            $webApp->projectTypes()->updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
