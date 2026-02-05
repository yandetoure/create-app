<x-dashboard-layout>
    <x-slot name="title">Modifier la Catégorie</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <div
            class="bg-white/5 border border-white/10 rounded-[3rem] p-12 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-indigo-600/5 blur-[120px] rounded-full"></div>

            <div class="flex items-center justify-between mb-12 relative">
                <h3 class="text-3xl font-black tracking-tighter">Edition : {{ $category->name }}</h3>
                <a href="{{ route('admin.categories.index') }}"
                    class="text-xs font-bold text-gray-500 hover:text-white transition uppercase tracking-widest">←
                    Retour</a>
            </div>

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-10 relative">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Nom de la
                            catégorie</label>
                        <input type="text" name="name" value="{{ $category->name }}" required
                            class="w-full bg-white/5 border border-indigo-600/20 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition outline-none">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Identifiant
                            de l'icône (svg name)</label>
                        <input type="text" name="icon" value="{{ $category->icon }}" required
                            class="w-full bg-white/5 border border-indigo-600/20 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition outline-none">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Description
                        complète</label>
                    <textarea name="description" rows="5"
                        class="w-full bg-white/5 border border-indigo-600/20 rounded-3xl px-8 py-6 text-white leading-relaxed focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition outline-none resize-none">{{ $category->description }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-white/5">
                    <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em]">Slug auto-généré :
                        {{ $category->slug }}</p>
                    <button type="submit"
                        class="px-12 py-5 bg-indigo-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition active:scale-95 shadow-xl shadow-indigo-600/30">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>