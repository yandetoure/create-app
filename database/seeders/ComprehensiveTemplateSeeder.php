<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\ProjectType;
use App\Models\Component;
use Illuminate\Database\Seeder;

class ComprehensiveTemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Get all components
        $components = Component::all()->keyBy('slug');

        if ($components->isEmpty()) {
            $this->command->warn('No components found. Please seed components first.');
            return;
        }

        // Define templates for each project type
        $templates = [
            // SITES WEB (IDs 1-23)
            1 => [ // Site de présentation standard
                ['name' => 'Corporate Modern', 'category' => 'vitrine', 'description' => 'Template moderne pour site vitrine professionnel'],
                ['name' => 'Business Classic', 'category' => 'vitrine', 'description' => 'Template classique et élégant pour entreprise'],
            ],
            2 => [ // Portfolio Créatif
                ['name' => 'Creative Portfolio', 'category' => 'portfolio', 'description' => 'Portfolio créatif avec galerie dynamique'],
                ['name' => 'Minimal Portfolio', 'category' => 'portfolio', 'description' => 'Portfolio minimaliste et épuré'],
            ],
            3 => [ // Restaurant & Menu digital
                ['name' => 'Restaurant Deluxe', 'category' => 'restaurant', 'description' => 'Template élégant pour restaurant avec menu digital'],
                ['name' => 'Fast Food Modern', 'category' => 'restaurant', 'description' => 'Template dynamique pour restauration rapide'],
            ],
            4 => [ // Agence Immobilière
                ['name' => 'Real Estate Pro', 'category' => 'immobilier', 'description' => 'Template professionnel pour agence immobilière'],
            ],
            5 => [ // Hôtel & Réservations
                ['name' => 'Hotel Paradise', 'category' => 'hotel', 'description' => 'Template luxueux pour hôtel avec système de réservation'],
                ['name' => 'Boutique Hotel', 'category' => 'hotel', 'description' => 'Template intimiste pour hôtel boutique'],
            ],
            6 => [ // Clinique & Santé
                ['name' => 'Medical Care', 'category' => 'sante', 'description' => 'Template professionnel pour clinique et centre de santé'],
            ],
            7 => [ // Cabinet d\'avocats
                ['name' => 'Law Firm Pro', 'category' => 'juridique', 'description' => 'Template professionnel pour cabinet d\'avocats'],
            ],
            8 => [ // Site E-commerce simple
                ['name' => 'Modern Shop', 'category' => 'e-commerce', 'description' => 'Boutique en ligne moderne et intuitive'],
                ['name' => 'Minimal Store', 'category' => 'e-commerce', 'description' => 'E-commerce minimaliste haut de gamme'],
            ],
            9 => [ // Landing Page Produit
                ['name' => 'Product Launch', 'category' => 'landing', 'description' => 'Landing page percutante pour lancement produit'],
            ],
            10 => [ // Blog / Magazine
                ['name' => 'News Magazine', 'category' => 'blog', 'description' => 'Template magazine pour blog d\'actualités'],
            ],
            11 => [ // Site Institutionnel / ONG
                ['name' => 'NGO Impact', 'category' => 'institutionnel', 'description' => 'Template pour ONG et organisations'],
            ],
            12 => [ // Portail d\'annonces
                ['name' => 'Classifieds Portal', 'category' => 'annonces', 'description' => 'Portail d\'annonces classées'],
            ],
            13 => [ // Site de formation (LMS)
                ['name' => 'Learning Hub', 'category' => 'education', 'description' => 'Plateforme e-learning complète'],
            ],
            14 => [ // Marketplace de services
                ['name' => 'Service Marketplace', 'category' => 'marketplace', 'description' => 'Marketplace pour services professionnels'],
            ],
            15 => [ // Site d\'événementiel
                ['name' => 'Event Pro', 'category' => 'evenement', 'description' => 'Template pour gestion d\'événements'],
            ],

            // APPS MOBILES (IDs 24-40)
            24 => [ // App de Livraison
                ['name' => 'Delivery App Modern', 'category' => 'mobile', 'description' => 'App de livraison type Uber Eats'],
            ],
            25 => [ // App de Réservation VTC
                ['name' => 'Ride Booking App', 'category' => 'mobile', 'description' => 'App de réservation de transport'],
            ],
            26 => [ // Réseau Social
                ['name' => 'Social Network', 'category' => 'mobile', 'description' => 'Réseau social complet'],
            ],
            27 => [ // App E-learning Mobile
                ['name' => 'Mobile Learning', 'category' => 'mobile', 'description' => 'Application mobile d\'apprentissage'],
            ],
            28 => [ // App de Santé
                ['name' => 'Telehealth App', 'category' => 'mobile', 'description' => 'App de téléconsultation médicale'],
            ],
            29 => [ // Fintech
                ['name' => 'Mobile Wallet', 'category' => 'mobile', 'description' => 'Portefeuille mobile et paiements'],
            ],
            30 => [ // App de Dating
                ['name' => 'Dating App', 'category' => 'mobile', 'description' => 'Application de rencontres'],
            ],

            // SAAS / WEB APPS (IDs 41-61)
            43 => [ // SaaS Gestion Scolaire
                ['name' => 'School ERP', 'category' => 'saas', 'description' => 'ERP complet pour gestion scolaire'],
            ],
            44 => [ // Logiciel de Comptabilité
                ['name' => 'Cloud Accounting', 'category' => 'saas', 'description' => 'Logiciel de comptabilité en ligne'],
            ],
            45 => [ // CRM personnalisé
                ['name' => 'Custom CRM', 'category' => 'saas', 'description' => 'CRM personnalisable pour entreprises'],
            ],
            46 => [ // ERP complet
                ['name' => 'Enterprise ERP', 'category' => 'saas', 'description' => 'ERP complet pour grandes entreprises'],
            ],
            47 => [ // Plateforme de Télétravail
                ['name' => 'Remote Work Hub', 'category' => 'saas', 'description' => 'Plateforme collaborative pour télétravail'],
            ],
            48 => [ // Logiciel de Gestion RH
                ['name' => 'HR Management', 'category' => 'saas', 'description' => 'Système de gestion des ressources humaines'],
            ],
            49 => [ // Plateforme de Crowdfunding
                ['name' => 'Crowdfunding Platform', 'category' => 'saas', 'description' => 'Plateforme de financement participatif'],
            ],
            50 => [ // Système de ticketing
                ['name' => 'Support Ticketing', 'category' => 'saas', 'description' => 'Système de support client et tickets'],
            ],
            61 => [ // E-commerce (le type actuel du projet)
                ['name' => 'E-commerce Pro', 'category' => 'e-commerce', 'description' => 'Boutique en ligne professionnelle complète'],
                ['name' => 'Quick Shop', 'category' => 'e-commerce', 'description' => 'E-commerce rapide et efficace'],
            ],
        ];

        $createdCount = 0;

        foreach ($templates as $projectTypeId => $projectTemplates) {
            foreach ($projectTemplates as $index => $templateData) {
                $template = Template::create([
                    'name' => $templateData['name'],
                    'slug' => \Illuminate\Support\Str::slug($templateData['name']),
                    'description' => $templateData['description'],
                    'project_type_id' => $projectTypeId,
                    'category' => $templateData['category'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]);

                // Attach some components to each template
                $componentsList = $components->values()->take(5);
                foreach ($componentsList as $order => $component) {
                    $template->components()->attach($component->id, [
                        'section_name' => ['header', 'hero', 'features', 'cta', 'footer'][$order] ?? 'content',
                        'sort_order' => $order + 1,
                    ]);
                }

                $createdCount++;
            }
        }

        $this->command->info("Created {$createdCount} templates for " . count($templates) . " project types!");
    }
}
