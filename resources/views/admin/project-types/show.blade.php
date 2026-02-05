<x-dashboard-layout>
    <x-slot name="title">Détails du Type de Projet</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <div
            class="bg-white/5 border border-white/10 rounded-[3rem] p-12 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-indigo-600/5 blur-[120px] rounded-full"></div>

            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center space-x-6">
                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-3xl font-black">
                        {{ substr($projectType->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-3xl font-black tracking-tighter">{{ $projectType->name }}</h3>
                        <p class="text-gray-500 font-bold uppercase text-[10px] tracking-[0.4em]">
                            {{ $projectType->category->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.project-types.edit', $projectType) }}"
                        class="px-6 py-3 bg-indigo-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-700 transition">Modifier</a>
                    <a href="{{ route('admin.project-types.index') }}"
                        class="px-6 py-3 bg-white/5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-white/10 transition border border-white/5">Retour</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative">
                <div class="space-y-8">
                    <div class="p-8 bg-indigo-600/10 border border-indigo-600/20 rounded-3xl">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-4">Paramètres
                            Financiers</p>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-400">Tarif de base</span>
                                <span
                                    class="text-3xl font-black">{{ number_format($projectType->base_price, 0, ',', ' ') }}
                                    <span class="text-sm text-gray-500 uppercase">FCFA</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-white/[0.02] border border-white/5 rounded-3xl">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">Temps de
                            Réalisation</p>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-400">Délai estimé</span>
                                <span class="text-3xl font-black">{{ $projectType->base_duration_days }} <span
                                        class="text-sm text-gray-500">jours</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="p-8 bg-white/[0.02] border border-white/5 rounded-3xl h-full">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">Moteur de
                            Configuration</p>
                        <ul class="space-y-4">
                            <li class="flex items-center space-x-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                <span class="text-xs font-bold text-gray-400">Slug Technique:</span>
                                <span
                                    class="text-xs font-mono text-indigo-400 underline">{{ $projectType->slug }}</span>
                            </li>
                            <li class="flex items-center space-x-3 text-xs text-gray-500 italic">
                                * Ce type de projet sert de base au calcul dynamique du configurateur.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>