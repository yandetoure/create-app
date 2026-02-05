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
        $webSite = Category::create(['name' => 'Site Web', 'slug' => 'site-web', 'icon' => 'globe-alt']);
        $mobileApp = Category::create(['name' => 'Application Mobile', 'slug' => 'app-mobile', 'icon' => 'device-phone-mobile']);
        $webApp = Category::create(['name' => 'Application Web (SaaS)', 'slug' => 'web-app', 'icon' => 'computer-desktop']);

        $webSite->projectTypes()->createMany([
            ['name' => 'Site de présentation', 'slug' => 'presentation', 'base_price' => 500, 'base_duration_days' => 5],
            ['name' => 'Portfolio', 'slug' => 'portfolio', 'base_price' => 400, 'base_duration_days' => 4],
            ['name' => 'Restaurant', 'slug' => 'restaurant', 'base_price' => 600, 'base_duration_days' => 6],
            ['name' => 'Immobilier', 'slug' => 'immobilier', 'base_price' => 800, 'base_duration_days' => 10],
        ]);

        $mobileApp->projectTypes()->createMany([
            ['name' => 'Livraison', 'slug' => 'livraison', 'base_price' => 1500, 'base_duration_days' => 15],
            ['name' => 'Réservation', 'slug' => 'reservation', 'base_price' => 1200, 'base_duration_days' => 12],
            ['name' => 'Réseau social', 'slug' => 'social', 'base_price' => 2000, 'base_duration_days' => 20],
            ['name' => 'E-learning', 'slug' => 'elearning', 'base_price' => 1800, 'base_duration_days' => 18],
        ]);

        $webApp->projectTypes()->createMany([
            ['name' => 'Gestion scolaire', 'slug' => 'scolaire', 'base_price' => 2500, 'base_duration_days' => 25],
            ['name' => 'Comptabilité', 'slug' => 'compta', 'base_price' => 3000, 'base_duration_days' => 30],
            ['name' => 'CRM', 'slug' => 'crm', 'base_price' => 2200, 'base_duration_days' => 22],
            ['name' => 'ERP', 'slug' => 'erp', 'base_price' => 4000, 'base_duration_days' => 40],
        ]);
    }
}
