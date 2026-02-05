<x-dashboard-layout>
    <x-slot name="title">Modifier le Type de Projet</x-slot>

    <div class="max-w-4xl mx-auto py-12">
        <form action="{{ route('admin.project-types.update', $projectType) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div
                class="bg-white/5 border border-white/10 rounded-[2.5rem] p-10 shadow-2xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-600/5 blur-[80px] rounded-full"></div>

                <h3 class="text-2xl font-black mb-10 relative">Edition : {{ $projectType->name }}</h3>

                <div class="grid grid-cols-1 gap-8 relative">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Nom du type de
                            projet</label>
                        <input type="text" name="name" value="{{ $projectType->name }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Prix de base
                                (FCFA)</label>
                            <input type="number" name="base_price" value="{{ (int) $projectType->base_price }}" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Durée de base
                                (jours)</label>
                            <input type="number" name="base_duration_days"
                                value="{{ $projectType->base_duration_days }}" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 transition outline-none">
                        </div>
                    </div>

                        </select>
                    </div>

                    <div class="space-y-4 pt-6 border-t border-white/5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Fonctionnalités Incluses (Base)</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($features->where('is_base', true) as $f)
                                <div class="flex items-center space-x-3 bg-white/5 p-4 rounded-2xl hover:bg-white/10 transition group cursor-pointer">
                                    <input type="checkbox" name="features[]" value="{{ $f->id }}" id="feat_{{ $f->id }}"
                                        {{ $projectType->features->contains($f->id) ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-white/10 bg-transparent text-indigo-600 focus:ring-indigo-500 transition">
                                    <label for="feat_{{ $f->id }}" class="flex flex-col cursor-pointer">
                                        <span class="text-xs font-bold text-white group-hover:text-indigo-300 transition">{{ $f->name }}</span>
                                        <span class="text-[9px] text-gray-500 italic">{{ Str::limit($f->description, 40) }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 bg-indigo-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20 active:scale-95">
                        Mettre à jour le type
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>