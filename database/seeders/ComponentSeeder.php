<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $components = [
            // Headers
            [
                'name' => 'Modern Header',
                'slug' => 'modern-header',
                'type' => Component::TYPE_HEADER,
                'description' => 'Header moderne avec navigation et logo',
                'html_code' => '<header class="modern-header"><nav><div class="logo">Logo</div><ul class="nav-links"><li><a href="#">Accueil</a></li><li><a href="#">Services</a></li><li><a href="#">Contact</a></li></ul></nav></header>',
                'css_code' => '.modern-header { background: #fff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); } .modern-header nav { display: flex; justify-content: space-between; align-items: center; } .nav-links { display: flex; gap: 2rem; list-style: none; }',
                'is_active' => true,
            ],
            [
                'name' => 'Minimal Header',
                'slug' => 'minimal-header',
                'type' => Component::TYPE_HEADER,
                'description' => 'Header minimaliste et épuré',
                'html_code' => '<header class="minimal-header"><div class="container"><a href="#" class="brand">Brand</a><nav><a href="#">About</a><a href="#">Work</a><a href="#">Contact</a></nav></div></header>',
                'css_code' => '.minimal-header { padding: 2rem 0; } .minimal-header .container { display: flex; justify-content: space-between; } .minimal-header nav { display: flex; gap: 1.5rem; }',
                'is_active' => true,
            ],

            // Heroes
            [
                'name' => 'Full-Screen Hero',
                'slug' => 'fullscreen-hero',
                'type' => Component::TYPE_HERO,
                'description' => 'Hero section plein écran avec CTA',
                'html_code' => '<section class="hero-fullscreen"><div class="hero-content"><h1>Bienvenue</h1><p>Découvrez nos services exceptionnels</p><a href="#" class="cta-button">Commencer</a></div></section>',
                'css_code' => '.hero-fullscreen { height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; } .hero-content h1 { font-size: 4rem; margin-bottom: 1rem; } .cta-button { display: inline-block; padding: 1rem 2rem; background: white; color: #667eea; border-radius: 50px; font-weight: bold; margin-top: 2rem; }',
                'is_active' => true,
            ],
            [
                'name' => 'Split Hero',
                'slug' => 'split-hero',
                'type' => Component::TYPE_HERO,
                'description' => 'Hero section avec image et texte côte à côte',
                'html_code' => '<section class="hero-split"><div class="hero-text"><h1>Innovation</h1><p>Transformez votre business</p><button>En savoir plus</button></div><div class="hero-image"><img src="/placeholder.jpg" alt="Hero"></div></section>',
                'css_code' => '.hero-split { display: grid; grid-template-columns: 1fr 1fr; min-height: 80vh; } .hero-text { display: flex; flex-direction: column; justify-content: center; padding: 4rem; } .hero-image img { width: 100%; height: 100%; object-fit: cover; }',
                'is_active' => true,
            ],

            // Features
            [
                'name' => 'Feature Grid',
                'slug' => 'feature-grid',
                'type' => Component::TYPE_FEATURE,
                'description' => 'Grille de fonctionnalités avec icônes',
                'html_code' => '<section class="features-grid"><div class="feature"><div class="icon">🚀</div><h3>Rapide</h3><p>Performance optimale</p></div><div class="feature"><div class="icon">🔒</div><h3>Sécurisé</h3><p>Protection maximale</p></div><div class="feature"><div class="icon">💡</div><h3>Innovant</h3><p>Technologies modernes</p></div></section>',
                'css_code' => '.features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; padding: 4rem 2rem; } .feature { text-align: center; padding: 2rem; border-radius: 1rem; background: #f8f9fa; } .feature .icon { font-size: 3rem; margin-bottom: 1rem; }',
                'is_active' => true,
            ],

            // Footers
            [
                'name' => 'Modern Footer',
                'slug' => 'modern-footer',
                'type' => Component::TYPE_FOOTER,
                'description' => 'Footer moderne avec liens et réseaux sociaux',
                'html_code' => '<footer class="modern-footer"><div class="footer-content"><div class="footer-section"><h4>À propos</h4><p>Notre entreprise</p></div><div class="footer-section"><h4>Liens</h4><ul><li><a href="#">Accueil</a></li><li><a href="#">Services</a></li></ul></div><div class="footer-section"><h4>Contact</h4><p>contact@example.com</p></div></div><div class="footer-bottom"><p>&copy; 2026 Tous droits réservés</p></div></footer>',
                'css_code' => '.modern-footer { background: #1a202c; color: white; padding: 3rem 2rem 1rem; } .footer-content { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 2rem; } .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); }',
                'is_active' => true,
            ],

            // CTA
            [
                'name' => 'Simple CTA',
                'slug' => 'simple-cta',
                'type' => Component::TYPE_CTA,
                'description' => 'Call-to-action simple et efficace',
                'html_code' => '<section class="cta-simple"><h2>Prêt à commencer ?</h2><p>Rejoignez des milliers de clients satisfaits</p><button class="cta-btn">Démarrer gratuitement</button></section>',
                'css_code' => '.cta-simple { text-align: center; padding: 5rem 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; } .cta-simple h2 { font-size: 3rem; margin-bottom: 1rem; } .cta-btn { padding: 1rem 3rem; background: white; color: #667eea; border: none; border-radius: 50px; font-size: 1.2rem; font-weight: bold; cursor: pointer; margin-top: 2rem; }',
                'is_active' => true,
            ],

            // Gallery
            [
                'name' => 'Grid Gallery',
                'slug' => 'grid-gallery',
                'type' => Component::TYPE_GALLERY,
                'description' => 'Galerie d\'images en grille',
                'html_code' => '<section class="gallery-grid"><div class="gallery-item"><img src="/img1.jpg" alt="Image 1"></div><div class="gallery-item"><img src="/img2.jpg" alt="Image 2"></div><div class="gallery-item"><img src="/img3.jpg" alt="Image 3"></div><div class="gallery-item"><img src="/img4.jpg" alt="Image 4"></div></section>',
                'css_code' => '.gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; padding: 2rem; } .gallery-item { aspect-ratio: 1; overflow: hidden; border-radius: 1rem; } .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; } .gallery-item:hover img { transform: scale(1.1); }',
                'is_active' => true,
            ],
        ];

        foreach ($components as $component) {
            Component::create($component);
        }
    }
}
