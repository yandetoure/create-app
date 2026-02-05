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
        $uiCategory = FeatureCategory::create(['name' => 'Interface & Design', 'icon' => 'paint-brush']);
        $paymentCategory = FeatureCategory::create(['name' => 'Paiements', 'icon' => 'credit-card']);
        $commCategory = FeatureCategory::create(['name' => 'Communication', 'icon' => 'chat-bubble-left-right']);
        $techCategory = FeatureCategory::create(['name' => 'Technique & Data', 'icon' => 'cpu-chip']);

        Feature::create([
            'feature_category_id' => $paymentCategory->id,
            'name' => 'Paiement en ligne',
            'slug' => 'online-payment',
            'description' => 'Stripe, PayPal',
            'price' => 150,
            'impact_days' => 2,
            'component_name' => 'pricing',
        ]);

        Feature::create([
            'feature_category_id' => $commCategory->id,
            'name' => 'Intégration WhatsApp',
            'slug' => 'whatsapp',
            'description' => 'Chat direct',
            'price' => 50,
            'impact_days' => 1,
            'component_name' => 'chat',
        ]);

        Feature::create([
            'feature_category_id' => $techCategory->id,
            'name' => 'GPS / Géolocalisation',
            'slug' => 'gps',
            'description' => 'Carte + tracking',
            'price' => 200,
            'impact_days' => 3,
            'component_name' => 'map',
        ]);

        Feature::create([
            'feature_category_id' => $commCategory->id,
            'name' => 'Notifications Push',
            'slug' => 'push-notifications',
            'description' => 'Mobile & Web',
            'price' => 120,
            'impact_days' => 2,
        ]);

        Feature::create([
            'feature_category_id' => $uiCategory->id,
            'name' => 'Tableau de bord avancé',
            'slug' => 'advanced-dashboard',
            'description' => 'Statistiques détaillées',
            'price' => 180,
            'impact_days' => 2,
            'component_name' => 'dashboard',
        ]);

        Feature::create([
            'feature_category_id' => $uiCategory->id,
            'name' => 'Multi-langue',
            'slug' => 'multi-language',
            'description' => 'FR/EN etc',
            'price' => 100,
            'impact_days' => 1,
        ]);

        Feature::create([
            'feature_category_id' => $techCategory->id,
            'name' => 'Blog / Actualités',
            'slug' => 'blog',
            'description' => 'Gestion de contenu',
            'price' => 250,
            'impact_days' => 3,
            'component_name' => 'blog',
        ]);
    }
}
