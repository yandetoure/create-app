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
        body {
            font-family: 'Outfit', sans-serif;
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
            <div class="font-bold text-2xl tracking-tighter">{{ $project->name }}</div>
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="#hero" class="hover:text-indigo-600 transition">Accueil</a>
                <a href="#features" class="hover:text-indigo-600 transition">Fonctionnalités</a>
                <a href="#contact" class="hover:text-indigo-600 transition">Contact</a>
            </div>
            <button
                class="bg-black text-white px-6 py-2 rounded-full font-bold text-sm tracking-tight active:scale-95 transition">
                Démarrer
            </button>
        </nav>

        <main>
            @foreach($components as $component)
                @include('components.preview.' . $component, ['project' => $project, 'isMobile' => false])
            @endforeach
        </main>

        <footer class="bg-gray-900 text-white py-20 px-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="font-bold text-2xl mb-6">{{ $project->name }}</div>
                    <p class="text-gray-400 text-sm">Généré automatiquement par Digital Configurator.</p>
                </div>
                <div>
                    <h5 class="font-bold mb-6">Plateforme</h5>
                    <ul class="text-gray-400 text-sm space-y-4">
                        <li>Type : {{ $project->projectType->name }}</li>
                        <li>Secteur : {{ $project->projectType->category->name }}</li>
                    </ul>
                </div>
            </div>
        </footer>
    @endif

</body>

</html>