<x-dashboard-layout>
    <x-slot name="title">Modifier la Fonctionnalité</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <form action="{{ route('admin.features.update', $feature) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div
                class="bg-white/5 border border-white/10 rounded-[2.5rem] p-10 shadow-2xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute -left-20 -top-20 w-64 h-64 bg-indigo-600/5 blur-[80px] rounded-full"></div>

                <h3 class="text-2xl font-black mb-10 relative">Edition : {{ $feature->name }}</h3>

                <div class="grid grid-cols-1 gap-8 relative">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Nom de la
                            fonctionnalité</label>
                        <input type="text" name="name" value="{{ $feature->name }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none"
                            readonly>
                        <p class="text-[10px] text-gray-500 italic mt-1">* Le nom et le slug ne sont pas modifiables
                            pour préserver l'intégrité technique.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Prix de base
                                (FCFA)</label>
                            <input type="number" name="base_price" value="{{ (int) $feature->price }}" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Impact durée
                                (jours)</label>
                            <input type="number" name="base_duration" value="{{ $feature->impact_days }}" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none">
                        </div>
                    </div>

                    <div
                        class="flex items-center space-x-4 bg-indigo-600/10 border border-indigo-600/20 p-6 rounded-3xl group transition hover:bg-indigo-600/20">
                        <input type="checkbox" name="is_base" value="1" id="is_base_edit" {{ $feature->is_base ? 'checked' : '' }}
                            class="w-6 h-6 rounded-lg border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500 transition">
                        <label for="is_base_edit" class="flex flex-col cursor-pointer">
                            <span
                                class="text-sm font-black text-white group-hover:text-indigo-300 transition uppercase tracking-widest">Fonctionnalité
                                de Base</span>
                            <span class="text-[10px] text-gray-500 italic mt-0.5">Si coché, cette option sera offerte
                                gratuitement au client tout en restant sélectionnable.</span>
                        </label>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Catégorie de
                            fonctionnalité</label>
                        <select name="feature_category_id"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none appearance-none"
                            disabled>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $feature->feature_category_id == $cat->id ? 'selected' : '' }} class="bg-gray-900">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label
                            class="text-[10px] font-black uppercase tracking-widest text-gray-500">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none"
                            readonly>{{ $feature->description }}</textarea>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 bg-indigo-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20 active:scale-95">
                        Mettre à jour les tarifs
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>