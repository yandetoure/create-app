<x-dashboard-layout>
    <x-slot name="title">Gestion de tous les projets</x-slot>

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-gray-500">Liste exhaustive</h3>
            <div class="flex space-x-2">
                <input type="text" placeholder="Rechercher un projet..."
                    class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-sm focus:border-indigo-500 outline-none transition w-64">
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Nom du
                                Projet</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Client</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Développeur
                            </th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Statut</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Budget</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($projects as $project)
                                            <tr class="hover:bg-white/[0.03] transition group">
                                                <td class="px-8 py-6">
                                                    <div class="font-bold text-white group-hover:text-indigo-400 transition">
                                                        {{ $project->name }}</div>
                                                    <div class="text-[10px] text-gray-500 uppercase font-black">
                                                        {{ $project->projectType->name }}</div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-sm font-medium">{{ $project->user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $project->user->email }}</div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    @if($project->developer)
                                                        <div class="flex items-center space-x-2">
                                                            <div
                                                                class="w-6 h-6 rounded-full bg-indigo-600 flex items-center justify-center text-[10px] font-bold">
                                                                {{ substr($project->developer->name, 0, 1) }}
                                                            </div>
                                                            <span
                                                                class="text-sm font-bold text-indigo-400">{{ $project->developer->name }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-red-400/50 italic text-xs">Non assigné</span>
                                                    @endif
                                                </td>
                                                <td class="px-8 py-6">
                                                    <span
                                                        class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest
                                                        {{ $project->status === 'completed' ? 'bg-green-500/10 text-green-400 border border-green-500/20' :
                            ($project->status === 'new' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20') }}">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="font-black text-white">
                                                        {{ number_format($project->total_price, 0, ',', ' ') }} FCFA</div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <a href="{{ route('admin.projects.show', $project) }}"
                                                        class="inline-flex items-center space-x-2 text-indigo-400 font-bold text-xs hover:text-white transition">
                                                        <span>Gérer</span>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                        @endforeach
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
</x-dashboard-layout>