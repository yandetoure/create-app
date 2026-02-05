<x-dashboard-layout>
    <x-slot name="title">Gestion des Développeurs</x-slot>

    <div class="space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($developers as $dev)
                <div
                    class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 hover:border-indigo-500/30 transition shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-indigo-600/10 blur-3xl rounded-full"></div>

                    <div class="flex items-center space-x-6 mb-8 relative">
                        <div
                            class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-2xl font-black shadow-xl shadow-indigo-600/20">
                            {{ substr($dev->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-black">{{ $dev->name }}</h3>
                            <p class="text-xs font-bold text-gray-500 tracking-widest uppercase">Expert Développeur
                                Fullstack</p>
                        </div>
                    </div>

                    <div class="space-y-6 relative">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/[0.03] p-4 rounded-2xl border border-white/5 text-center">
                                <div class="text-2xl font-black text-indigo-400">
                                    {{ $dev->projects->where('status', 'in_progress')->count() }}</div>
                                <div class="text-[10px] font-black uppercase tracking-widest text-gray-500">En cours</div>
                            </div>
                            <div class="bg-white/[0.03] p-4 rounded-2xl border border-white/5 text-center">
                                <div class="text-2xl font-black text-green-400">
                                    {{ $dev->projects->where('status', 'completed')->count() }}</div>
                                <div class="text-[10px] font-black uppercase tracking-widest text-gray-500">Terminés</div>
                            </div>
                        </div>

                        <div class="p-4 bg-indigo-600/5 rounded-2xl border border-indigo-600/10 space-y-4">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Projets Actuels
                            </h4>
                            <div class="space-y-2">
                                @forelse($dev->projects->where('status', 'in_progress')->take(3) as $proj)
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="font-bold truncate max-w-[120px]">{{ $proj->name }}</span>
                                        <span class="text-gray-500">{{ $proj->total_duration }}j</span>
                                    </div>
                                @empty
                                    <p class="text-xs italic text-gray-500">Aucun projet actif</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="mt-8 block text-center py-4 bg-white/5 border border-white/10 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-white/10 transition">
                        Voir Profil Complet
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>