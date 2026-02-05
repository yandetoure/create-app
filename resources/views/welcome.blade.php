<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Configurator | Créez votre futur projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-[#020617] text-white overflow-x-hidden">
    <!-- Header/Navigation -->
    @include('layouts.navigation')

    <!-- Hero -->
    <section class="relative pt-44 pb-32 px-8 overflow-hidden">
        <!-- Background Orbs -->
        <div
            class="absolute top-0 right-0 w-[800px] h-[800px] bg-indigo-600/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/4">
        </div>

        <div class="max-w-7xl mx-auto items-center text-center">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-indigo-600/10 border border-indigo-500/30 text-indigo-400 text-[10px] font-bold uppercase tracking-widest mb-8">
                Propulsé par IA & Modulaire
            </span>
            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter leading-[1.05] mb-8">
                Configurez votre projet <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-indigo-600">digital en 2
                    minutes.</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                Site Web, App Mobile ou SaaS. Choisissez vos options, visualisez le rendu en temps réel et obtenez un
                devis immédiat.
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-6">
                <a href="{{ route('configurator.index') }}"
                    class="w-full md:w-auto bg-indigo-600 px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-600/30 hover:bg-indigo-700 hover:-translate-y-1 transition duration-300">
                    Démarrer la configuration
                </a>
                <a href="#categories"
                    class="w-full md:w-auto bg-white/5 border border-white/10 px-10 py-5 rounded-2xl font-bold text-lg backdrop-blur-sm hover:bg-white/10 transition">
                    Explorer les types de projets
                </a>
            </div>

            <!-- Categories Grid -->
            <div id="categories" class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div
                        class="group bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition duration-500 text-left">
                        <div
                            class="w-14 h-14 bg-indigo-600/20 rounded-2xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition duration-300">
                            @if($category->slug === 'site-web')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9-9c1.657 0 3 4.03 3 9s-1.343 9-3 9m0-18c-1.657 0-3 4.03-3 9s1.343 9 3 9m-9-9a9 9 0 019-9" />
                                </svg>
                            @elseif($category->slug === 'app-mobile')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            @elseif($category->slug === 'web-app')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @else
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold mb-4">{{ $category->name }}</h3>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                            {{ $category->description ?? 'Solutions sur mesure pour vos besoins en ' . strtolower($category->name) . '.' }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            @foreach($category->projectTypes->take(3) as $type)
                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 bg-white/5 rounded-full text-indigo-300">
                                    {{ $type->name }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('configurator.index', ['category' => $category->slug]) }}"
                            class="text-indigo-400 font-bold flex items-center group/link">
                            Configurer <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Features -->
    <section class="py-32 px-8 bg-indigo-900/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-16 tracking-tight">Fonctionnalités modulaires <span
                    class="text-indigo-500">Premium</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($features as $feature)
                    <div
                        class="bg-slate-900/50 border border-white/5 p-6 rounded-2xl text-left hover:border-indigo-500/30 transition">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-2 bg-indigo-500/10 rounded-lg text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg">{{ $feature->name }}</h4>
                        </div>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $feature->description }}</p>
                        <div class="text-indigo-400 font-bold text-xs">+ {{ number_format($feature->price, 0, ',', ' ') }}
                            FCFA</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-24 border-y border-white/5 bg-white/5 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">{{ number_format($counts['projects'] / 1000, 0) }}k+</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Projets Configurés</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ $counts['categories'] }}</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Secteurs d'activité</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ $counts['features'] }}</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Modules disponibles</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">98%</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Satisfaction</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 px-8 border-t border-white/5 text-center">
        <p class="text-gray-500 text-sm">© {{ date('Y') }} CreateApp Configurator. Tous droits réservés.</p>
    </footer>

</body>

</body>

</html>