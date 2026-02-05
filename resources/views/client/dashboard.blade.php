<x-dashboard-layout>
    <x-slot name="title">Mes Projets & Devis</x-slot>

    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold tracking-tight text-white/50 uppercase text-[10px] tracking-[0.2em]">Historique
                des commandes</h3>
            <a href="{{ route('configurator.index') }}"
                class="bg-indigo-600 px-6 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20 text-sm">
                + Nouveau Projet
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse($projects as $project)
                <div
                    class="bg-white/5 border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition shadow-2xl group">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div class="flex items-center space-x-6">
                            <div
                                class="w-16 h-16 rounded-2xl bg-indigo-600/20 border border-indigo-600/30 flex items-center justify-center text-2xl font-black text-indigo-400">
                                {{ substr($project->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-2xl font-black group-hover:text-indigo-400 transition">{{ $project->name }}
                                </h4>
                                <p class="text-gray-400 text-sm font-medium">{{ $project->projectType->name }} • Commandé le
                                    {{ $project->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="text-2xl font-black tracking-tighter">
                                {{ number_format($project->total_price, 0, ',', ' ') }} FCFA
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mt-2 {{ $project->status === 'completed' ? 'bg-green-500/10 text-green-400' : 'bg-indigo-500/10 text-indigo-400' }}">
                                {{ $project->status }}
                            </span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('projects.show', $project) }}"
                                class="p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition text-sm font-bold text-gray-400">
                                Détails
                            </a>
                            <a href="{{ route('client.projects.configure', $project) }}"
                                class="p-4 bg-indigo-600 border border-indigo-500 rounded-2xl hover:bg-indigo-700 transition text-sm font-bold text-white shadow-xl shadow-indigo-600/20">
                                Configurer
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-32 bg-white/5 rounded-[3rem] border border-white/10 border-dashed">
                    <div class="text-5xl mb-6">🚀</div>
                    <h3 class="text-2xl font-bold mb-2">Prêt à lancer votre prochain projet ?</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Utilisez notre configurateur intelligent pour obtenir un
                        devis instantané et commencer votre aventure digitale.</p>
                    <a href="{{ route('configurator.index') }}"
                        class="inline-block bg-indigo-600 px-8 py-4 rounded-2xl font-black hover:scale-105 transition shadow-2xl shadow-indigo-600/40">
                        Configurer mon Projet
                    </a>
                </div>
            @endforelse
        </div>

        @if($projects->hasPages())
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>