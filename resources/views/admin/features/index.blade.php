<x-dashboard-layout>
    <x-slot name="title">Gestion des Fonctionnalités Modulaires</x-slot>

    <div class="space-y-12">
        <!-- Feature Categories Link -->
        <div class="flex justify-between items-end px-2">
            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500">Catalogue des modules</h3>
            <a href="{{ route('admin.feature-categories.index') }}"
                class="text-xs font-bold text-indigo-400 hover:text-white transition flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span>Gérer les catégories</span>
            </a>
        </div>

        <!-- Paid Features Table -->
        <div class="space-y-4">
            <h4 class="text-sm font-black uppercase tracking-widest text-white px-2">Modules Payants</h4>
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/[0.02] border-b border-white/5">
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                    Fonctionnalité</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                    Catégorie</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Prix de
                                    Base</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Durée
                                    (j)</th>
                                <th
                                    class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($paidFeatures as $feature)
                                <tr class="hover:bg-white/[0.03] transition relative group">
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-white">{{ $feature->name }}</div>
                                        <div class="text-[10px] text-gray-500 italic truncate max-w-[200px]">
                                            {{ $feature->description }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400">{{ $feature->category->name }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center space-x-2">
                                            <form id="update-feature-{{ $feature->id }}"
                                                action="{{ route('admin.features.update', $feature) }}" method="POST"
                                                class="hidden">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <input type="number" name="base_price" form="update-feature-{{ $feature->id }}"
                                                value="{{ (int) $feature->price }}"
                                                class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-32 focus:border-indigo-500 outline-none">
                                            <span class="text-gray-500 font-bold text-xs uppercase">FCFA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <input type="number" name="base_duration" form="update-feature-{{ $feature->id }}"
                                            value="{{ $feature->impact_days }}"
                                            class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-20 focus:border-indigo-500 outline-none text-center">
                                    </td>
                                    <td class="px-8 py-6 text-right flex items-center justify-end space-x-2">
                                        <button type="submit" form="update-feature-{{ $feature->id }}" title="Sauvegarder"
                                            class="p-3 bg-green-500/10 text-green-400 rounded-xl hover:bg-green-500 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>

                                        <form action="{{ route('admin.features.toggle-base', $feature) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit" title="Basculer vers les modules inclus"
                                                class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-6.857 2.286L12 21l-2.286-6.857L3 12l6.857-2.286L12 3z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.features.show', $feature) }}" title="Voir les détails"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-white/10 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.features.edit', $feature) }}" title="Modifier"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Supprimer ce module ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-red-500/10 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Base Features Table -->
        <div class="space-y-4">
            <h4 class="text-sm font-black uppercase tracking-widest text-indigo-400 px-2 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z"
                        clip-rule="evenodd" />
                </svg>
                <span>Modules Inclus par défaut (Génériques)</span>
            </h4>
            <div
                class="bg-indigo-600/5 border border-indigo-600/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-indigo-600/[0.02] border-b border-indigo-600/5">
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-indigo-400/60">
                                    Module Inclus</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-indigo-400/60">
                                    Catégorie</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-indigo-400/60">
                                    Statut</th>
                                <th
                                    class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-indigo-400/60 text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($baseFeatures as $feature)
                                <tr class="hover:bg-indigo-600/[0.03] transition relative group">
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-indigo-300">{{ $feature->name }}</div>
                                        <div class="text-[10px] text-gray-500 italic truncate max-w-[300px]">
                                            {{ $feature->description }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400/60">{{ $feature->category->name }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="px-3 py-1 bg-green-500/10 text-[10px] font-black uppercase tracking-widest text-green-400 rounded-full border border-green-500/10">Gratuit</span>
                                    </td>
                                    <td class="px-8 py-6 text-right flex items-center justify-end space-x-2">
                                        <form action="{{ route('admin.features.toggle-base', $feature) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit" title="Rendre payant"
                                                class="p-3 bg-indigo-600 text-white rounded-xl hover:scale-110 transition shadow-lg shadow-indigo-600/20">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.features.show', $feature) }}" title="Voir les détails"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-white/10 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.features.edit', $feature) }}" title="Modifier"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Supprimer ce module ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-red-500/10 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($baseFeatures->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-8 py-10 text-center text-gray-500 italic text-sm">
                                        Aucun module n'est défini comme "inclus par défaut" pour le moment.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Creation Form -->
        <div class="bg-white/5 border border-white/10 rounded-[3rem] p-10 shadow-2xl backdrop-blur-md">
            <h4 class="text-xl font-black mb-8 italic">Nouvelle Fonctionnalité</h4>
            <form action="{{ route('admin.features.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Nom de la
                            fonctionnalité</label>
                        <input type="text" name="name"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                            required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Catégorie</label>
                        <select name="feature_category_id"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none text-white"
                            required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" class="bg-gray-900">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Description</label>
                    <textarea name="description"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition h-24"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Prix de base
                            (FCFA)</label>
                        <input type="number" name="base_price"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                            required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Durée
                            (jours)</label>
                        <input type="number" name="base_duration"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                            required>
                    </div>
                    <div class="flex items-center space-x-3 pb-4">
                        <input type="checkbox" name="is_base" value="1" id="is_base_check"
                            class="w-5 h-5 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500 transition">
                        <label for="is_base_check" class="text-xs font-bold text-gray-400">Gratuit par défaut</label>
                    </div>
                    <button type="submit"
                        class="bg-indigo-600 py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20">
                        Ajouter au catalogue
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>