<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#020617] text-white antialiased overflow-x-hidden min-h-screen">

    <x-sidebar />

    <div class="lg:pl-72 min-h-screen flex flex-col">
        <header
            class="h-24 px-8 flex items-center justify-between border-b border-white/5 backdrop-blur-md bg-[#020617]/50 sticky top-0 z-40">
            <div class="flex items-center">
                <button @click="$dispatch('toggle-sidebar')"
                    class="lg:hidden p-2 -ml-2 mr-4 text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-2xl font-bold tracking-tight">{{ $title ?? 'Dashboard' }}</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Notifications Dropdown -->
                <div x-data="{ 
                    open: false, 
                    notifications: [],
                    unreadCount: {{ auth()->user()->notifications()->unread()->count() }}
                }" class="relative">
                    <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center"></span>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-2 w-96 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50">

                        <!-- Header -->
                        <div class="p-4 border-b border-white/10 flex items-center justify-between">
                            <h3 class="font-bold text-white">Notifications</h3>
                            @if(auth()->user()->notifications()->unread()->count() > 0)
                                <form method="POST" action="{{ route('notifications.read-all') }}">
                                    @csrf
                                    <button type="submit" class="text-xs text-indigo-400 hover:text-indigo-300">
                                        Tout marquer comme lu
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Notifications List -->
                        <div class="max-h-96 overflow-y-auto">
                            @forelse(auth()->user()->notifications()->limit(5)->get() as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}"
                                    class="block p-4 hover:bg-white/5 transition border-b border-white/5 {{ $notification->isUnread() ? 'bg-indigo-600/5' : '' }}">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-2xl">{{ $notification->icon }}</span>
                                        <div class="flex-1 min-w-0">
                                            <p
                                                class="text-sm {{ $notification->isUnread() ? 'font-bold text-white' : 'text-gray-400' }}">
                                                {{ $notification->message }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @if($notification->isUnread())
                                            <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                                        @endif
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-sm">Aucune notification</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Footer -->
                        @if(auth()->user()->notifications()->count() > 0)
                            <div class="p-3 border-t border-white/10 text-center">
                                <a href="{{ route('notifications.index') }}"
                                    class="text-sm text-indigo-400 hover:text-indigo-300 font-bold">
                                    Voir toutes les notifications
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Profile Section -->
                <div class="flex items-center space-x-3 pl-4 border-l border-white/10">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-sm font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                {{ Auth::user()->roles->first()->name ?? 'client' }}
                            </p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Déconnexion"
                            class="p-2 text-gray-400 hover:text-red-400 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8">
            {{ $slot }}
        </main>
    </div>

    <!-- Background Orbs -->
    <div
        class="fixed top-0 right-0 w-[800px] h-[800px] bg-indigo-600/5 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 pointer-events-none -z-10">
    </div>
    <div
        class="fixed bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/4 pointer-events-none -z-10">
    </div>
</body>

</html>