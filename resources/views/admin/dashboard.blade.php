<x-dashboard-layout>
    <x-slot name="title">Administration Globale</x-slot>

    <div class="space-y-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($stats as $label => $value)
                <div class="bg-white/5 border border-white/10 p-8 rounded-3xl shadow-xl">
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">
                        {{ str_replace('_', ' ', $label) }}
                    </p>
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
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500 text-right">
                                Actions</th>
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
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $project->status === 'completed' ? 'bg-green-500/10 text-green-400' : ($project->status === 'new' ? 'bg-blue-500/10 text-blue-400' : 'bg-yellow-500/10 text-yellow-400') }}">
                                        {{ $project->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 font-bold">{{ number_format($project->total_price, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="px-8 py-6 text-right space-x-2">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if($project->status === 'new' || $project->status === 'pending')
                                            <form action="{{ route('admin.projects.approve', $project) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="p-2 bg-green-500/10 text-green-500 rounded-lg hover:bg-green-500 hover:text-white transition"
                                                    title="Approuver">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.projects.reject', $project) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="p-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition"
                                                    title="Refuser">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.projects.manage', $project) }}"
                                            class="p-2 bg-indigo-500/10 text-indigo-400 rounded-lg hover:bg-indigo-500 hover:text-white transition"
                                            title="Gérer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>