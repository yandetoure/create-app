<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tighter text-white mb-2">
                    {{ Auth::user()->hasRole('developer') ? 'Console Développeur' : 'Mon Espace Projets' }}
                </h2>
                <p class="text-gray-400">Bienvenue, <span
                        class="text-indigo-400 font-bold">{{ Auth::user()->name }}</span> 👋</p>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('configurator.index') }}"
                    class="bg-indigo-600 px-6 py-3 rounded-2xl font-bold flex items-center hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20">
                    <span class="mr-2">🚀</span> Nouveau Projet
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-12">

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($stats as $label => $value)
                    <div
                        class="bg-white/5 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] group hover:border-indigo-500/50 transition duration-500">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-3">
                            {{ str_replace('_', ' ', $label) }}</p>
                        <div class="flex items-end space-x-2">
                            <span
                                class="text-4xl font-extrabold tracking-tighter">{{ is_numeric($value) && $value > 1000 ? round($value / 1000, 1) . 'k' : $value }}</span>
                            @if(str_contains($label, 'value'))
                                <span class="text-xl font-bold text-gray-500 mb-1">€</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Projects Section -->
            <div class="space-y-6">
                <div class="flex items-center justify-between pl-2">
                    <h3 class="text-2xl font-bold tracking-tight">Projets Récents</h3>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span>Mise à jour en temps réel</span>
                    </div>
                </div>

                <div
                    class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-white/5 bg-white/[0.02]">
                                    <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-gray-500">
                                        Projet</th>
                                    <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-gray-500">Type
                                        / Plateforme</th>
                                    @if(Auth::user()->hasRole('developer'))
                                        <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-gray-500">
                                            Client</th>
                                    @endif
                                    <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-gray-500">
                                        Montant</th>
                                    <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest text-gray-500">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($projects as $project)
                                    <tr class="hover:bg-white/[0.03] transition group">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-indigo-600/10 flex items-center justify-center text-indigo-400 mr-4 font-bold border border-indigo-600/20">
                                                    {{ substr($project->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-lg group-hover:text-indigo-400 transition">
                                                        {{ $project->name }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $project->created_at->format('d M Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-[11px] font-bold text-gray-400 uppercase tracking-tighter">
                                                {{ $project->projectType->name }}
                                            </span>
                                            <div class="mt-2 flex gap-1">
                                                @foreach($project->platforms as $plat)
                                                    <span
                                                        class="text-[10px] text-indigo-400/80 uppercase font-black tracking-widest">{{ $plat->platform_type }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        @if(Auth::user()->hasRole('developer'))
                                            <td class="px-8 py-6 font-medium text-gray-300">
                                                {{ $project->user->name }}
                                            </td>
                                        @endif
                                        <td class="px-8 py-6">
                                            <div class="font-black text-xl tracking-tight text-white">
                                                {{ number_format($project->total_price, 0, ',', ' ') }}€
                                            </div>
                                            <div class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">
                                                ±{{ $project->total_duration }} jours</div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('projects.show', $project) }}"
                                                    class="p-2 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition group/btn"
                                                    title="Voir les détails">
                                                    <svg class="w-5 h-5 text-gray-400 group-hover/btn:text-white"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('projects.pdf', $project) }}"
                                                    class="p-2 bg-indigo-600/10 border border-indigo-600/20 rounded-xl hover:bg-indigo-600 hover:border-indigo-500 transition group/btn"
                                                    title="Télécharger PDF">
                                                    <svg class="w-5 h-5 text-indigo-400 group-hover/btn:text-white"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center">
                                            <div class="mb-4 text-4xl opacity-50">📂</div>
                                            <div class="text-gray-500 font-bold italic">Aucun projet configuré pour le
                                                moment.</div>
                                            <a href="{{ route('configurator.index') }}"
                                                class="mt-6 inline-block text-indigo-400 font-bold hover:underline">Démarrer
                                                une configuration →</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($projects->hasPages())
                        <div class="px-8 py-6 border-t border-white/5 bg-white/[0.01]">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Promotion / Tips Card -->
            <div
                class="relative bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-[2rem] p-10 overflow-hidden group shadow-2xl">
                <div
                    class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition duration-1000">
                </div>
                <div class="relative z-10 max-w-2xl">
                    <h4 class="text-3xl font-black tracking-tight text-white mb-4">Besoin d'un accompagnement sur mesure
                        ?</h4>
                    <p class="text-indigo-100 text-lg mb-8 leading-relaxed">Nos experts développeurs sont disponibles
                        pour transformer votre configuration en une plateforme industrielle évolutive.</p>
                    <button
                        class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-black hover:-translate-y-1 transition duration-300">
                        Discuter avec un Expert
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>