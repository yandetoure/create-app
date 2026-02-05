<x-dashboard-layout>
    <x-slot name="title">Administration Globale</x-slot>

    <div class="space-y-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($stats as $label => $value)
                <div class="bg-white/5 border border-white/10 p-8 rounded-3xl shadow-xl">
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">
                        {{ str_replace('_', ' ', $label) }}</p>
                    <div class="flex items-end space-x-2">
                        <span class="text-4xl font-black tracking-tighter">
                            {{ is_numeric($value) && $value >= 1000 ? number_format($value / 1000, 1) . 'k' : number_format($value, 0, ',', ' ') }}
                        </span>
                        @if(str_contains($label, 'value'))
                            <span class="text-xl font-bold text-gray-500 mb-1">FCFA</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Projects -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between bg-white/[0.02]">
                <h3 class="text-xl font-bold">Projets Récents</h3>
                <a href="#" class="text-indigo-400 font-bold text-sm hover:underline">Voir tout →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.01]">
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Projet</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Client</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Développeur
                            </th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Statut</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Prix</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($recentProjects as $project)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="px-8 py-6">
                                    <div class="font-bold">{{ $project->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $project->projectType->name }}</div>
                                </td>
                                <td class="px-8 py-6 text-sm">{{ $project->user->name }}</td>
                                <td class="px-8 py-6">
                                    @if($project->developer)
                                        <span class="text-indigo-400 font-bold text-sm">{{ $project->developer->name }}</span>
                                    @else
                                        <span class="text-red-400/60 italic text-xs">Non assigné</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $project->status === 'completed' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                        {{ $project->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 font-bold">{{ number_format($project->total_price, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>