<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-[#020617] text-white antialiased overflow-x-hidden">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative">
        <!-- Background Orbs -->
        <div
            class="fixed top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>
        <div
            class="fixed bottom-0 left-0 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/4 pointer-events-none">
        </div>

        <div class="relative z-10 w-full flex flex-col items-center">
            <a href="/" class="mb-12 flex items-center space-x-3 group">
                <div
                    class="bg-indigo-600 w-12 h-12 rounded-2xl flex items-center justify-center text-xl font-black italic shadow-2xl shadow-indigo-600/30 group-hover:scale-110 transition duration-300">
                    C</div>
                <span class="text-2xl font-extrabold tracking-tighter">CreateApp</span>
            </a>

            {{ $slot }}
        </div>
    </div>
</body>

</html>