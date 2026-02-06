<!DOCTYPE html>
<html lang="fr" class="{{ $isMobile ? 'overflow-hidden h-full' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview : {{ $project->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color:
                {{ $project->configuration?->primary_color ?? '#4f46e5' }}
            ;
            --secondary-color:
                {{ $project->configuration?->secondary_color ?? '#10b981' }}
            ;
            --accent-color:
                {{ $project->configuration?->accent_color ?? '#f59e0b' }}
            ;

            @php
                $style = $project->configuration?->design_style ?? 'modern';
                $radius = '1.5rem';
                $shadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1)';

                if ($style === 'minimalist') {
                    $radius = '0px';
                    $shadow = 'none';
                } elseif ($style === 'corporate') {
                    $radius = '0.5rem';
                    $shadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
                } elseif ($style === 'vibrant') {
                    $radius = '2rem';
                    $shadow = '0 10px 15px -3px rgba(0,0,0,0.1)';
                }
            @endphp

            --custom-radius: {{ $radius }};
            --custom-shadow: {{ $shadow }};
        }

        .rounded-custom { border-radius: var(--custom-radius) !important; }
        .shadow-custom { box-shadow: var(--custom-shadow) !important; }

        body {
            font-family: 'Outfit', sans-serif;
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .border-primary {
            border-color: var(--primary-color);
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }

        .mobile-frame {
            width: 375px;
            height: 667px;
            border: 12px solid #1f2937;
            border-radius: 40px;
            overflow-y: scroll;
            margin: 2rem auto;
            position: relative;
            background: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .mobile-frame::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    @if($isMobile)
        <!-- Mobile Emulator View -->
        <div class="min-h-screen bg-indigo-900 flex flex-col items-center justify-center p-4">
            <div class="text-white text-center mb-6">
                <h1 class="text-2xl font-bold">Aperçu Mobile</h1>
                <p class="text-indigo-300">Simulation iPhone 13 Layout</p>
            </div>

            <div class="mobile-frame">
                <!-- Mobile App Content -->
                @foreach($components as $component)
                    @include('components.preview.' . $component, ['project' => $project, 'isMobile' => true])
                @endforeach

                <!-- Mobile Navbar -->
                <div
                    class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 px-6 py-3 flex justify-between items-center z-50">
                    <div class="text-indigo-600">🏠</div>
                    <div class="text-gray-400">🔍</div>
                    <div class="text-gray-400">👤</div>
                </div>
            </div>
        </div>
    @else
        <!-- Full Website View -->
        <nav class="glass sticky top-0 z-50 px-8 py-4 flex justify-between items-center border-b border-gray-100">
            <div class="flex items-center space-x-4">
                @if($project->configuration?->logo_path)
                    <img src="{{ asset('storage/' . $project->configuration->logo_path) }}" class="h-8 w-auto" alt="Logo">
                @endif
                <div class="font-bold text-2xl tracking-tighter">{{ $project->name }}</div>
            </div>
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'home']) }}" 
                   class="{{ $page === 'home' ? 'text-primary' : 'hover:text-primary' }} transition">Accueil</a>

                @if($category === 'e-commerce')
                    <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'shop']) }}" 
                       class="{{ $page === 'shop' ? 'text-primary' : 'hover:text-primary' }} transition">Boutique</a>
                @elseif($category === 'showcase' || $category === 'portfolio')
                    <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'portfolio']) }}" 
                       class="{{ $page === 'portfolio' ? 'text-primary' : 'hover:text-primary' }} transition">Portfolio</a>
                @endif

                <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'contact']) }}" 
                   class="{{ $page === 'contact' ? 'text-primary' : 'hover:text-primary' }} transition">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                @if($category === 'e-commerce')
                    <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'cart']) }}" class="relative p-2 hover:bg-gray-100 rounded-full transition">
                        🛒
                        <span class="absolute top-0 right-0 bg-primary text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">2</span>
                    </a>
                @endif
                <button
                    class="bg-primary text-white px-6 py-2 rounded-custom font-bold text-sm tracking-tight active:scale-95 transition shadow-custom">
                    Démarrer
                </button>
            </div>
        </nav>

        <main>
            @if($page === 'home')
                @foreach($components as $component)
                    @include('components.preview.' . $component, ['project' => $project, 'isMobile' => false, 'mockData' => $mockData])
                @endforeach
            @elseif($page === 'shop' && $category === 'e-commerce')
                @include('components.preview.ecommerce_products', ['project' => $project, 'isMobile' => false, 'mockData' => $mockData])
            @elseif($page === 'cart' && $category === 'e-commerce')
                @include('components.preview.ecommerce_cart', ['project' => $project, 'isMobile' => false, 'mockData' => $mockData])
            @elseif($page === 'portfolio' && ($category === 'showcase' || $category === 'portfolio'))
                @include('components.preview.portfolio_grid', ['project' => $project, 'isMobile' => false, 'mockData' => $mockData])
            @elseif($page === 'contact')
                @include('components.preview.contact', ['project' => $project, 'isMobile' => false, 'mockData' => $mockData])
            @endif
        </main>

        <footer class="bg-gray-900 text-white py-20 px-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-4 mb-6">
                        @if($project->configuration?->logo_path)
                            <img src="{{ asset('storage/' . $project->configuration->logo_path) }}" class="h-8 w-auto brightness-0 invert" alt="Logo">
                        @endif
                        <div class="font-bold text-2xl">{{ $project->name }}</div>
                    </div>
                    @if($project->configuration?->copywriting_brief)
                        <p class="text-gray-400 text-sm mb-4">{{ Str::limit($project->configuration->copywriting_brief, 100) }}</p>
                    @endif
                    <p class="text-gray-500 text-[10px] uppercase font-black tracking-widest">Généré par Digital Configurator</p>
                </div>
                <div>
                    <h5 class="font-bold mb-6 text-primary">Plateforme</h5>
                    <ul class="text-gray-400 text-sm space-y-4">
                        <li>Type : {{ $project->projectType->name }}</li>
                        <li>Secteur : {{ $project->projectType->category->name }}</li>
                    </ul>
                </div>
                @if($project->configuration?->contact_email || $project->configuration?->contact_phone)
                    <div>
                        <h5 class="font-bold mb-6 text-primary">Contact</h5>
                        <ul class="text-gray-400 text-sm space-y-4">
                            @if($project->configuration?->contact_email) <li>{{ $project->configuration->contact_email }}</li> @endif
                            @if($project->configuration?->contact_phone) <li>{{ $project->configuration->contact_phone }}</li> @endif
                            @if($project->configuration?->contact_address) <li>{{ $project->configuration->contact_address }}</li> @endif
                        </ul>
                    </div>
                @endif
            </div>
        </footer>
    @endif

</body>

</html>