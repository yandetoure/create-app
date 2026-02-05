<x-dashboard-layout>
    <x-slot name="title">Gestion de l'Équipe</x-slot>

    <div class="space-y-12">
        <!-- Developers Section -->
        <div class="space-y-4">
            <h4 class="text-sm font-black uppercase tracking-widest text-indigo-400 px-2 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <span>Développeurs</span>
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($developers as $dev)
                    <a href="{{ route('admin.team.show', $dev) }}"
                        class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 hover:bg-white/10 transition shadow-2xl backdrop-blur-md group">
                        <div class="flex items-center space-x-6 mb-6">
                            <div
                                class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-2xl font-black italic group-hover:scale-110 transition">
                                {{ substr($dev->name, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="text-xl font-black italic text-white">{{ $dev->name }}</h5>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                                    {{ $dev->projects->count() }} Projets Actifs
                                </p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Projets en cours :
                            </p>
                            @foreach($dev->projects->where('status', 'in_progress')->take(3) as $p)
                                <div class="flex items-center justify-between text-xs font-bold text-gray-400">
                                    <span>{{ $p->name }}</span>
                                    <span class="text-indigo-400/50">Voir →</span>
                                </div>
                            @endforeach
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Project & Community Managers -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="space-y-4">
                <h4 class="text-sm font-black uppercase tracking-widest text-white px-2">Project Managers</h4>
                <div class="space-y-4">
                    @foreach($projectManagers as $pm)
                        <a href="{{ route('admin.team.show', $pm) }}"
                            class="bg-white/5 border border-white/10 rounded-3xl p-6 flex items-center justify-between hover:bg-white/10 transition group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-green-500/20 text-green-400 flex items-center justify-center text-sm font-bold group-hover:bg-green-500 transition">
                                    PM</div>
                                <span class="font-bold text-white">{{ $pm->name }}</span>
                            </div>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ $pm->managedProjects->count() }}
                                Projets</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="text-sm font-black uppercase tracking-widest text-white px-2">Community Managers</h4>
                <div class="space-y-4">
                    @foreach($communityManagers as $cm)
                        <a href="{{ route('admin.team.show', $cm) }}"
                            class="bg-white/5 border border-white/10 rounded-3xl p-6 flex items-center justify-between hover:bg-white/10 transition group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-pink-500/20 text-pink-400 flex items-center justify-center text-sm font-bold group-hover:bg-pink-500 transition">
                                    CM</div>
                                <span class="font-bold text-white">{{ $cm->name }}</span>
                            </div>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ $cm->communityProjects->count() }}
                                Projets</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>