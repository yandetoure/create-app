<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\ProjectType;
use App\Models\Component;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Get project types (assuming they exist)
        $projectTypes = ProjectType::all();

        if ($projectTypes->isEmpty()) {
            $this->command->warn('No project types found. Please seed project types first.');
            return;
        }

        // Get components
        $modernHeader = Component::where('slug', 'modern-header')->first();
        $minimalHeader = Component::where('slug', 'minimal-header')->first();
        $fullscreenHero = Component::where('slug', 'fullscreen-hero')->first();
        $splitHero = Component::where('slug', 'split-hero')->first();
        $featureGrid = Component::where('slug', 'feature-grid')->first();
        $modernFooter = Component::where('slug', 'modern-footer')->first();
        $simpleCta = Component::where('slug', 'simple-cta')->first();
        $gridGallery = Component::where('slug', 'grid-gallery')->first();

        // Create templates
        $templates = [
            [
                'name' => 'Modern E-commerce',
                'slug' => 'modern-ecommerce',
                'description' => 'Template moderne pour boutique en ligne avec design épuré',
                'project_type_id' => $projectTypes->first()->id,
                'category' => 'e-commerce',
                'is_active' => true,
                'sort_order' => 1,
                'components' => [
                    ['component' => $modernHeader, 'section' => 'header', 'order' => 1],
                    ['component' => $fullscreenHero, 'section' => 'hero', 'order' => 2],
                    ['component' => $featureGrid, 'section' => 'features', 'order' => 3],
                    ['component' => $gridGallery, 'section' => 'gallery', 'order' => 4],
                    ['component' => $simpleCta, 'section' => 'cta', 'order' => 5],
                    ['component' => $modernFooter, 'section' => 'footer', 'order' => 6],
                ],
            ],
            [
                'name' => 'Minimal Shop',
                'slug' => 'minimal-shop',
                'description' => 'Template minimaliste pour e-commerce haut de gamme',
                'project_type_id' => $projectTypes->first()->id,
                'category' => 'e-commerce',
                'is_active' => true,
                'sort_order' => 2,
                'components' => [
                    ['component' => $minimalHeader, 'section' => 'header', 'order' => 1],
                    ['component' => $splitHero, 'section' => 'hero', 'order' => 2],
                    ['component' => $featureGrid, 'section' => 'features', 'order' => 3],
                    ['component' => $modernFooter, 'section' => 'footer', 'order' => 4],
                ],
            ],
            [
                'name' => 'Hotel Paradise',
                'slug' => 'hotel-paradise',
                'description' => 'Template élégant pour hôtels et resorts',
                'project_type_id' => $projectTypes->first()->id,
                'category' => 'hotel',
                'is_active' => true,
                'sort_order' => 1,
                'components' => [
                    ['component' => $modernHeader, 'section' => 'header', 'order' => 1],
                    ['component' => $fullscreenHero, 'section' => 'hero', 'order' => 2],
                    ['component' => $gridGallery, 'section' => 'gallery', 'order' => 3],
                    ['component' => $featureGrid, 'section' => 'amenities', 'order' => 4],
                    ['component' => $simpleCta, 'section' => 'booking', 'order' => 5],
                    ['component' => $modernFooter, 'section' => 'footer', 'order' => 6],
                ],
            ],
            [
                'name' => 'Recipe Blog',
                'slug' => 'recipe-blog',
                'description' => 'Template pour blog de recettes et cuisine',
                'project_type_id' => $projectTypes->first()->id,
                'category' => 'recipe',
                'is_active' => true,
                'sort_order' => 1,
                'components' => [
                    ['component' => $minimalHeader, 'section' => 'header', 'order' => 1],
                    ['component' => $splitHero, 'section' => 'hero', 'order' => 2],
                    ['component' => $gridGallery, 'section' => 'recipes', 'order' => 3],
                    ['component' => $modernFooter, 'section' => 'footer', 'order' => 4],
                ],
            ],
            [
                'name' => 'Corporate Pro',
                'slug' => 'corporate-pro',
                'description' => 'Template professionnel pour entreprises',
                'project_type_id' => $projectTypes->first()->id,
                'category' => 'vitrine',
                'is_active' => true,
                'sort_order' => 1,
                'components' => [
                    ['component' => $modernHeader, 'section' => 'header', 'order' => 1],
                    ['component' => $fullscreenHero, 'section' => 'hero', 'order' => 2],
                    ['component' => $featureGrid, 'section' => 'services', 'order' => 3],
                    ['component' => $simpleCta, 'section' => 'contact', 'order' => 4],
                    ['component' => $modernFooter, 'section' => 'footer', 'order' => 5],
                ],
            ],
        ];

        foreach ($templates as $templateData) {
            $components = $templateData['components'];
            unset($templateData['components']);

            $template = Template::create($templateData);

            // Attach components
            foreach ($components as $componentData) {
                if ($componentData['component']) {
                    $template->components()->attach($componentData['component']->id, [
                        'section_name' => $componentData['section'],
                        'sort_order' => $componentData['order'],
                    ]);
                }
            }
        }

        $this->command->info('Templates seeded successfully!');
    }
}
