<x-dashboard-layout>
    <x-slot name="title">Types de Projet & Tarification</x-slot>

    <div class="space-y-12">
        <div class="bg-white/5 border border-white/10 rounded-[3rem] overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Type de
                                Projet</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Catégorie
                            </th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Prix de Base
                            </th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Durée
                                (jours)</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($projectTypes as $type)
                            <tr class="hover:bg-white/[0.03] transition relative group">
                                <form action="{{ route('admin.project-types.update', $type) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td class="px-8 py-6">
                                        <input type="text" name="name" value="{{ $type->name }}"
                                            class="bg-transparent border-none p-0 font-bold text-white focus:ring-0 w-full">
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-xs font-black uppercase tracking-widest text-gray-500">{{ $type->category->name }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center space-x-2">
                                            <input type="number" name="base_price" value="{{ $type->base_price }}"
                                                class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-32 focus:border-indigo-500 outline-none">
                                            <span class="text-gray-500 font-bold text-xs uppercase">FCFA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <input type="number" name="base_duration_days"
                                            value="{{ $type->base_duration_days }}"
                                            class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-sm font-black w-20 focus:border-indigo-500 outline-none text-center">
                                    </td>
                                    <td class="px-8 py-6 flex items-center space-x-2">
                                        <a href="{{ route('admin.project-types.show', $type) }}"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-white/10 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.project-types.edit', $type) }}"
                                            class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <button type="submit"
                                            class="p-3 bg-indigo-600/10 text-indigo-400 rounded-xl hover:bg-indigo-600 hover:text-white transition group-hover:scale-110 shadow-lg shadow-indigo-600/0 hover:shadow-indigo-600/20">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                </form>
                                <form action="{{ route('admin.project-types.destroy', $type) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ce type ?')">
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
            <h4 class="text-xl font-black mb-8">Nouveau Type de Projet</h4>
            <form action="{{ route('admin.project-types.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Nom du type</label>
                    <input type="text" name="name" placeholder="Ex: Boutique Pro"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                        required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Catégorie</label>
                    <select name="category_id"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none"
                        required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Prix de base
                        (FCFA)</label>
                    <input type="number" name="base_price"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                        required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Durée (jours)</label>
                    <div class="flex space-x-2">
                        <input type="number" name="base_duration_days"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                            required>
                        <button type="submit"
                            class="bg-indigo-600 px-8 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>