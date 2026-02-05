<x-dashboard-layout>
    <x-slot name="title">Détails de la Fonctionnalité</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <div
            class="bg-white/5 border border-white/10 rounded-[3rem] p-12 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600/10 blur-[100px] rounded-full"></div>

            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center space-x-6">
                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-2xl font-black">
                        {{ substr($feature->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-3xl font-black italic">{{ $feature->name }}</h3>
                        <p class="text-indigo-400 font-bold uppercase text-[10px] tracking-[0.3em]">
                            {{ $feature->category->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.features.edit', $feature) }}"
                        class="px-6 py-3 bg-indigo-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-700 transition">Modifier</a>
                    <a href="{{ route('admin.features.index') }}"
                        class="px-6 py-3 bg-white/5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-white/10 transition border border-white/5">Fermer</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative">
                <div class="space-y-8">
                    <div class="p-8 bg-white/[0.02] border border-white/5 rounded-3xl">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">Tarification &
                            Temps</p>
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <span class="text-sm text-gray-400 font-bold">Prix de base</span>
                                <span class="text-2xl font-black">{{ number_format($feature->price, 0, ',', ' ') }}
                                    FCFA</span>
                            </div>
                            <div class="flex justify-between items-end">
                                <span class="text-sm text-gray-400 font-bold">Impact durée</span>
                                <span class="text-2xl font-black text-indigo-400">+{{ $feature->impact_days }}
                                    jours</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-white/[0.02] border border-white/5 rounded-3xl">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">Informations
                            Techniques</p>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-400 font-bold">Slug</span>
                                <code
                                    class="text-xs text-indigo-400 bg-indigo-400/10 px-2 py-1 rounded">{{ $feature->slug }}</code>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-400 font-bold">Composant</span>
                                <span class="text-xs text-white">{{ $feature->component_name ?: 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="p-8 bg-white/[0.02] border border-white/5 rounded-3xl h-full flex flex-col">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">Description</p>
                        <p class="text-gray-300 leading-relaxed text-sm italic">
                            {{ $feature->description ?: 'Aucune description disponible.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>