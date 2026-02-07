<x-admin-layout>
    <x-slot name="title">Créer un Template</x-slot>

    <div class="space-y-8 max-w-4xl">
        <!-- Back Button -->
        <a href="{{ route('admin.templates.index') }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour aux templates</span>
        </a>

        <!-- Header -->
        <div>
            <h2 class="text-3xl font-black tracking-tight">Créer un Template</h2>
            <p class="text-gray-400 mt-2">Ajoutez un nouveau template pour vos projets</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.templates.store') }}" enctype="multipart/form-data"
            class="bg-white/5 border border-white/10 rounded-2xl p-8 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nom du Template *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                    placeholder="Ex: Modern E-commerce">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                    placeholder="Description du template...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Type & Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type de Projet *</label>
                    <select name="project_type_id" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="">Sélectionner...</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}" {{ old('project_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_type_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Catégorie *</label>
                    <select name="category" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="">Sélectionner...</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Image Preview (Grande)</label>
                    <input type="file" name="preview_image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <p class="text-xs text-gray-500 mt-2">Recommandé: 1200x800px, max 5MB</p>
                    @error('preview_image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Thumbnail (Miniature)</label>
                    <input type="file" name="thumbnail_image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <p class="text-xs text-gray-500 mt-2">Recommandé: 400x300px, max 2MB</p>
                    @error('thumbnail_image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sort Order & Active -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="0">
                    <p class="text-xs text-gray-500 mt-2">Plus petit = affiché en premier</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Statut</label>
                    <div class="flex items-center space-x-4 mt-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-5 h-5 rounded bg-white/5 border-white/10 text-indigo-600 focus:ring-indigo-600">
                            <span class="text-sm font-bold">Template actif</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    Créer le Template
                </button>
                <a href="{{ route('admin.templates.index') }}"
                    class="px-8 py-3 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>