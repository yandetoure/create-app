<nav x-data="{ open: false }" class="bg-black/20 backdrop-blur-md border-b border-white/5 relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div
                            class="bg-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center text-lg font-black italic shadow-xl shadow-indigo-600/20 group-hover:scale-105 transition duration-300">
                            C</div>
                        <span class="text-xl font-extrabold tracking-tighter text-white">CreateApp</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 text-sm font-bold tracking-wide uppercase transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'text-indigo-400 border-b-2 border-indigo-400' : 'text-gray-400 hover:text-white border-b-2 border-transparent' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('configurator.index') }}"
                        class="inline-flex items-center px-1 pt-1 text-sm font-bold tracking-wide uppercase transition duration-150 ease-in-out {{ request()->routeIs('configurator.*') ? 'text-indigo-400 border-b-2 border-indigo-400' : 'text-gray-400 hover:text-white border-b-2 border-transparent' }}">
                        {{ __('Configurateur') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                            <button
                                class="flex items-center space-x-3 bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-sm font-bold text-gray-300 hover:bg-white/10 transition">
                                <div
                                    class="w-8 h-8 rounded-lg bg-indigo-600/20 flex items-center justify-center text-indigo-400">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 transform transition duration-200"
                                    :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-48 rounded-2xl shadow-2xl bg-slate-900 border border-white/10 py-2 z-50 overflow-hidden"
                            style="display: none;" @click="open = false">

                            <a href="{{ route('profile.edit') }}"
                                class="block w-full px-4 py-3 text-sm font-bold text-gray-400 hover:bg-white/5 hover:text-white transition">
                                {{ __('Profil') }}
                            </a>

                            <div class="h-px bg-white/5 mx-4 my-2"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-3 text-sm font-bold text-red-400/80 hover:bg-white/5 hover:text-red-400 transition">
                                    {{ __('Déconnexion') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-gray-400 hover:text-white transition">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 px-6 py-2 rounded-full font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition">S'inscrire</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden border-t border-white/5 bg-slate-900 px-4 py-6 space-y-4">
        <a href="{{ route('dashboard') }}"
            class="block px-4 py-3 rounded-xl font-bold text-gray-400 hover:bg-white/5 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-indigo-600/10 text-indigo-400' : '' }}">
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('configurator.index') }}"
            class="block px-4 py-3 rounded-xl font-bold text-gray-400 hover:bg-white/5 hover:text-white {{ request()->routeIs('configurator.*') ? 'bg-indigo-600/10 text-indigo-400' : '' }}">
            {{ __('Configurateur') }}
        </a>

        <!-- Responsive Settings Options -->
        <div class="pt-6 border-t border-white/5">
            @auth
            <div class="px-4 mb-4">
                <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-3 rounded-xl font-bold text-gray-400 hover:bg-white/5 hover:text-white">
                    {{ __('Profil') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-3 rounded-xl font-bold text-red-400/80 hover:bg-white/5 hover:text-red-400">
                        {{ __('Déconnexion') }}
                    </button>
                </form>
            </div>
            @else
            <div class="space-y-2 px-4">
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl font-bold text-gray-400 hover:bg-white/5 hover:text-white transition">
                    {{ __('Connexion') }}
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl font-bold text-indigo-400 bg-indigo-600/10 hover:bg-indigo-600/20 transition">
                    {{ __('S\'inscrire') }}
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>