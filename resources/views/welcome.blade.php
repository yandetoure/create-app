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

    <!-- Header -->
    <nav
        class="fixed w-full z-50 px-8 py-6 flex justify-between items-center backdrop-blur-md bg-black/20 border-b border-white/5">
        <div class="text-2xl font-extrabold tracking-tighter flex items-center space-x-2">
            <span class="bg-indigo-600 w-8 h-8 rounded-lg flex items-center justify-center text-sm italic">C</span>
            <span>CreateApp</span>
        </div>
        <div class="hidden md:flex space-x-12 text-sm font-medium text-gray-400 uppercase tracking-widest">
            <a href="#" class="hover:text-white transition">Configurateur</a>
            <a href="#" class="hover:text-white transition">Templates</a>
            <a href="#" class="hover:text-white transition">Tarifs</a>
        </div>
        <div class="flex items-center space-x-6">
            @auth
                <a href="{{ route('configurator.index') }}"
                    class="bg-white text-black px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-200 transition">Lancer
                    le Configurateur</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold">Connexion</a>
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 px-6 py-2 rounded-full font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition">S'inscrire</a>
            @endauth
        </div>
    </nav>

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
                <a href="#"
                    class="w-full md:w-auto bg-white/5 border border-white/10 px-10 py-5 rounded-2xl font-bold text-lg backdrop-blur-sm hover:bg-white/10 transition">
                    Voir les démos
                </a>
            </div>

            <!-- Mockup -->
            <div class="mt-24 relative max-w-5xl mx-auto">
                <div class="bg-gradient-to-b from-white/10 to-transparent p-1 rounded-3xl shadow-2xl">
                    <div
                        class="bg-slate-900 rounded-3xl aspect-[16/9] overflow-hidden border border-white/5 flex items-center justify-center p-8">
                        <!-- Simulation components -->
                        <div class="grid grid-cols-3 gap-6 w-full">
                            <div class="col-span-1 bg-white/5 h-64 rounded-2xl border border-white/5 animate-pulse">
                            </div>
                            <div class="col-span-2 bg-white/5 h-64 rounded-2xl border border-white/5 animate-pulse"
                                style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
                <!-- Decorative reflection -->
                <div
                    class="absolute -bottom-10 inset-x-0 h-40 bg-gradient-to-t from-[#020617] via-[#020617]/50 to-transparent">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-24 border-y border-white/5 bg-white/5 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">10k+</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Projets Configurés</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">2 min</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Temps de Devis</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">-40%</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Réduction Coûts</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">98%</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Satisfaction</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 px-8 border-t border-white/5 text-center">
        <p class="text-gray-500 text-sm">© 2024 CreateApp Configurator. Tous droits réservés.</p>
    </footer>

</body>

</html>