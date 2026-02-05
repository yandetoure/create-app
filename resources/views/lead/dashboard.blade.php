<x-dashboard-layout>
    <x-slot name="title">Gestion des Opérations</x-slot>

    <div class="space-y-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stats as $label => $value)
                <div class="bg-white/5 border border-white/10 p-8 rounded-[2.5rem] shadow-xl">
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">
                        {{ str_replace('_', ' ', $label) }}</p>
                    <div class="text-4xl font-black tracking-tighter">{{ $value }}</div>
                </div>
            @endforeach
        </div>

        <div class="bg-white/5 border border-white/10 rounded-[3rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-white/5 bg-white/[0.02]">
                <h3 class="text-xl font-bold">Flux de Projets</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.01]">
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Détails</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Client</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-gray-500">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($projects as $project)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="px-8 py-6 font-bold">{{ $project->name }}</td>
                                <td class="px-8 py-6 text-sm">{{ $project->user->name }}</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-indigo-500/10 text-indigo-400">
                                        {{ $project->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>