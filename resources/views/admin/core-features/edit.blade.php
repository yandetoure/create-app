<x-dashboard-layout>
    <x-slot name="title">Modifier Fonctionnalité de Base</x-slot>

    <div class="max-w-3xl">
        <!-- Back Button -->
        <a href="{{ route('admin.core-features.index') }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour à la liste</span>
        </a>

        <!-- Form Card -->
        <div class="bg-white/5 border border-white/10 rounded-[3rem] p-10 shadow-2xl backdrop-blur-md">
            <h3 class="text-2xl font-black mb-8">Modifier la Fonctionnalité</h3>

            <form action="{{ route('admin.core-features.update', $coreFeature) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">
                        Nom de la fonctionnalité *
                    </label>
                    <input type="text" name="name" value="{{ old('name', $coreFeature->name) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition @error('name') border-red-500 @enderror"
                        placeholder="Ex: Lien GitHub, Nom de domaine, Hébergement..."
                        required>
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">
                        Description
                    </label>
                    <textarea name="description" rows="4"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition @error('description') border-red-500 @enderror"
                        placeholder="Description détaillée de cette fonctionnalité...">{{ old('description', $coreFeature->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="is_active" value="1" id="is_active" 
                        {{ old('is_active', $coreFeature->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500 transition">
                    <label for="is_active" class="text-sm font-bold text-gray-300">
                        Activer cette fonctionnalité (elle sera automatiquement incluse dans les nouveaux projets)
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.core-features.index') }}"
                        class="px-8 py-4 rounded-2xl font-bold text-gray-400 hover:text-white transition">
                        Annuler
                    </a>
                    <button type="submit"
                        class="bg-indigo-600 px-8 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20">
                        Mettre à Jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
