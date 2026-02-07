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
                    ['name' => 'Notifications', 'route' => 'notifications.index', 'icon' => 'bell'],
                ],
                'developer' => [
                    ['name' => 'Dashboard', 'route' => 'developer.dashboard', 'icon' => 'squares-2x2'],
                    ['name' => 'Mes Projets', 'route' => 'developer.projects.index', 'icon' => 'briefcase'],
                    ['name' => 'Mes Tâches', 'route' => 'developer.tasks.index', 'icon' => 'list-bullet'],
                    ['name' => 'Time Tracking', 'route' => 'time-tracking.index', 'icon' => 'clock'],
                    ['name' => 'Livrables', 'route' => 'developer.deliverables.index', 'icon' => 'rocket-launch'],
                    ['name' => 'Notifications', 'route' => 'notifications.index', 'icon' => 'bell'],
                ],
                'client' => [
                    ['name' => 'Mes Projets', 'route' => 'client.dashboard', 'icon' => 'rocket-launch'],
                    ['name' => 'Nouveau Projet', 'route' => 'configurator.index', 'icon' => 'plus-circle'],
                    ['name' => 'Notifications', 'route' => 'notifications.index', 'icon' => 'bell'],
                ],
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
                    @elseif($link['icon'] === 'list-bullet')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    @elseif($link['icon'] === 'clock')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($link['icon'] === 'rocket-launch')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                    @elseif($link['icon'] === 'bell')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    @elseif($link['icon'] === 'users')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @elseif($link['icon'] === 'tag')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    @elseif($link['icon'] === 'swatch')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    @elseif($link['icon'] === 'puzzle-piece')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                        </svg>
                    @elseif($link['icon'] === 'star')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    @elseif($link['icon'] === 'plus-circle')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
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