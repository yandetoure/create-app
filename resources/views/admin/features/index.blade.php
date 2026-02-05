<x-dashboard-layout>
    <x-slot name="title">Gestion des Fonctionnalités Modulaires</x-slot>

    <div class="space-y-12">
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                Fonctionnalité</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Catégorie
                            </th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400"
                                title="Prix multiplié par le facteur de plateforme">Prix de Base</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Durée
                                (jours)</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($features as $feature)
                            <tr class="hover:bg-white/[0.03] transition relative group">
                                <form action="{{ route('admin.features.update', $feature) }}" method="POST">
                                    @csrf
                                    @method('PUT')
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
                                            <input type="number" name="base_price" value="{{ $feature->base_price }}"
                                                class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-32 focus:border-indigo-500 outline-none">
                                            <span class="text-gray-500 font-bold text-xs uppercase">FCFA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <input type="number" name="base_duration" value="{{ $feature->base_duration }}"
                                            class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-20 focus:border-indigo-500 outline-none text-center">
                                    </td>
                                    <td class="px-8 py-6 text-right flex items-center justify-end space-x-2">
                                        <button type="submit"
                                            class="p-3 bg-indigo-600/10 text-indigo-400 rounded-xl hover:bg-indigo-600 hover:text-white transition group-hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                </form>
                                <form action="{{ route('admin.features.destroy', $feature) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cette fonction ?')">
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

        <div class="bg-white/5 border border-white/10 rounded-[3rem] p-10 shadow-2xl backdrop-blur-md">
            <h4 class="text-xl font-black mb-8">Nouvelle Fonctionnalité</h4>
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
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none"
                            required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Description</label>
                    <textarea name="description"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition h-24"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
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
                    <button type="submit"
                        class="bg-indigo-600 py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20">
                        Ajouter la fonctionnalité
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>