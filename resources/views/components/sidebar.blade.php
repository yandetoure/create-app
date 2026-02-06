<nav x-data="{ open: false }" id="sidebar"
    class="fixed left-0 top-0 h-full w-72 bg-slate-900 border-r border-white/5 z-50 flex flex-col pt-10 px-6 transition-all duration-300 lg:translate-x-0 -translate-x-full"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }" @toggle-sidebar.window="open = !open">
    <div class="flex items-center space-x-3 mb-12 px-2">
        <div
            class="bg-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center text-lg font-black italic shadow-xl shadow-indigo-600/20">
            C</div>
        <span class="text-xl font-extrabold tracking-tighter text-white">CreateApp</span>
    </div>

    <div class="flex-1 space-y-2">
        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4 px-2">Menu Principal</p>

        @php
            $role = Auth::user()->roles->first()->name ?? 'client';
            $links = [
                'admin' => [
                    ['name' => 'Tableau de bord', 'route' => 'admin.dashboard', 'icon' => 'squares-2x2'],
                    ['name' => 'Projets', 'route' => 'admin.projects.index', 'icon' => 'briefcase'],
                    ['name' => 'Types de Projet', 'route' => 'admin.project-types.index', 'icon' => 'swatch'],
                    ['name' => 'Equipe', 'route' => 'admin.team.index', 'icon' => 'users'],
                    ['name' => 'Catégories (types)', 'route' => 'admin.categories.index', 'icon' => 'tag'],
                    ['name' => 'Fonctionnalités', 'route' => 'admin.features.index', 'icon' => 'puzzle-piece'],
                    ['name' => 'Fonct. de Base', 'route' => 'admin.core-features.index', 'icon' => 'star'],
                    ['name' => 'Catégories (fonct)', 'route' => 'admin.feature-categories.index', 'icon' => 'list-bullet'],
                    ['name' => 'Livrables', 'route' => 'admin.deliverables.index', 'icon' => 'rocket-launch'],
                ],
                'developer' => [
                    ['name' => 'Dashboard', 'route' => 'developer.dashboard', 'icon' => 'squares-2x2'],
                    ['name' => 'Mes Projets', 'route' => 'developer.projects.index', 'icon' => 'briefcase'],
                    ['name' => 'Mes Tâches', 'route' => 'developer.tasks.index', 'icon' => 'list-bullet'],
                    ['name' => 'Livrables', 'route' => 'developer.deliverables.index', 'icon' => 'rocket-launch'],
                ],
                'client' => [
                    ['name' => 'Mes Projets', 'route' => 'client.dashboard', 'icon' => 'rocket-launch'],
                    ['name' => 'Nouveau Projet', 'route' => 'configurator.index', 'icon' => 'plus-circle'],
                ],
                // Add others as needed
            ];
            $activeLinks = $links[$role] ?? $links['client'];
        @endphp

        @foreach($activeLinks as $link)
            <a href="{{ route($link['route']) }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-2xl font-bold transition group {{ request()->routeIs($link['route']) ? 'bg-indigo-600/10 text-indigo-400' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <div class="w-5 h-5">
                    @if($link['icon'] === 'squares-2x2')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    @elseif($link['icon'] === 'briefcase')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    @endif
                </div>
                <span>{{ $link['name'] }}</span>
            </a>
        @endforeach
    </div>


</nav>