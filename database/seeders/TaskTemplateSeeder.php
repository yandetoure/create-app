<?php

namespace Database\Seeders;

use App\Models\TaskTemplate;
use Illuminate\Database\Seeder;

class TaskTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            // Setup Tasks
            ['name' => 'Achat du nom de domaine', 'description' => 'Acheter et configurer le nom de domaine pour le projet', 'category' => 'setup', 'order' => 1],
            ['name' => 'Configuration de l\'hébergement', 'description' => 'Mettre en place l\'hébergement web et configurer le serveur', 'category' => 'setup', 'order' => 2],
            ['name' => 'Création du repository GitHub', 'description' => 'Créer le repository GitHub et configurer les accès', 'category' => 'setup', 'order' => 3],
            ['name' => 'Configuration de la base de données', 'description' => 'Créer et configurer la base de données du projet', 'category' => 'setup', 'order' => 4],

            // Development Tasks
            ['name' => 'Initialisation du projet', 'description' => 'Initialiser la structure du projet et les fichiers de base', 'category' => 'development', 'order' => 5],
            ['name' => 'Configuration de l\'environnement', 'description' => 'Configurer les variables d\'environnement et les paramètres', 'category' => 'development', 'order' => 6],
            ['name' => 'Installation des dépendances', 'description' => 'Installer toutes les dépendances nécessaires au projet', 'category' => 'development', 'order' => 7],

            // Design Tasks
            ['name' => 'Création du header', 'description' => 'Développer le header du site avec navigation', 'category' => 'design', 'order' => 8],
            ['name' => 'Création du footer', 'description' => 'Développer le footer du site avec liens et informations', 'category' => 'design', 'order' => 9],
            ['name' => 'Design responsive', 'description' => 'Adapter le design pour tous les appareils (mobile, tablette, desktop)', 'category' => 'design', 'order' => 10],

            // Page Creation Tasks
            ['name' => 'Création de la page d\'accueil', 'description' => 'Développer la page d\'accueil du site', 'category' => 'pages', 'order' => 11],
            ['name' => 'Création de la page À propos', 'description' => 'Développer la page À propos', 'category' => 'pages', 'order' => 12],
            ['name' => 'Création de la page Contact', 'description' => 'Développer la page Contact avec formulaire', 'category' => 'pages', 'order' => 13],
            ['name' => 'Création des pages de services', 'description' => 'Développer les pages présentant les services', 'category' => 'pages', 'order' => 14],

            // Testing & Deployment
            ['name' => 'Tests et validation', 'description' => 'Tester toutes les fonctionnalités et valider le projet', 'category' => 'deployment', 'order' => 15],
            ['name' => 'Déploiement en production', 'description' => 'Déployer le projet sur le serveur de production', 'category' => 'deployment', 'order' => 16],
        ];

        foreach ($templates as $template) {
            TaskTemplate::create($template);
        }
    }
}
