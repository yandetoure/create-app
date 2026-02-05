<x-dashboard-layout>
    <x-slot name="title">Catégories de Fonctionnalités</x-slot>

    <div class="space-y-12">
        <!-- Categories List -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Icône</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Nom</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">
                                Fonctions</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($categories as $category)
                            <tr class="hover:bg-white/[0.03] transition group">
                                <td class="px-8 py-6">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-indigo-600/10 flex items-center justify-center text-indigo-400 border border-indigo-600/20">
                                        <span class="text-xl font-bold">{{ $category->icon ?: 'F' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 font-bold text-white">{{ $category->name }}</td>
                                <td class="px-8 py-6 text-center">
                                    <span
                                        class="px-3 py-1 bg-white/5 rounded-full text-xs font-black text-indigo-400 border border-white/5">
                                        {{ $category->features_count }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right space-x-2">
                                    <a href="{{ route('admin.feature-categories.edit', $category) }}"
                                        class="inline-flex p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.feature-categories.destroy', $category) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
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

        <!-- Create Form -->
        <div
            class="bg-white/5 border border-white/10 rounded-[3rem] p-10 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-600/5 blur-[100px] rounded-full"></div>

            <h3 class="text-2xl font-black mb-10 flex items-center space-x-4">
                <span class="w-12 h-1 bg-indigo-600 rounded-full"></span>
                <span>Nouvelle Catégorie de Fonctionnalités</span>
            </h3>

            <form action="{{ route('admin.feature-categories.store') }}" method="POST" class="space-y-8 relative">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500 ml-2">Nom de la
                            catégorie</label>
                        <input type="text" name="name" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition outline-none"
                            placeholder="ex: Interface Utilisateur">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500 ml-2">Icône
                            (optionnel)</label>
                        <input type="text" name="icon"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition outline-none"
                            placeholder="Un caractère ou emoji">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="group relative px-10 py-5 bg-indigo-600 rounded-2xl overflow-hidden transition-all hover:scale-[1.02] active:scale-95 shadow-2xl shadow-indigo-600/20">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                        <span class="relative text-xs font-black uppercase tracking-widest">Créer la Catégorie</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>