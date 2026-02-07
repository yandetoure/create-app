<x-admin-layout>
    <x-slot name="title">Modifier {{ $template->name }}</x-slot>

    <div class="space-y-8 max-w-4xl">
        <!-- Back Button -->
        <a href="{{ route('admin.templates.show', $template) }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour</span>
        </a>

        <!-- Header -->
        <div>
            <h2 class="text-3xl font-black tracking-tight">Modifier le Template</h2>
            <p class="text-gray-400 mt-2">{{ $template->name }}</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.templates.update', $template) }}" enctype="multipart/form-data"
            class="bg-white/5 border border-white/10 rounded-2xl p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nom du Template *</label>
                <input type="text" name="name" value="{{ old('name', $template->name) }}" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('description', $template->description) }}</textarea>
            </div>

            <!-- Project Type & Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type de Projet *</label>
                    <select name="project_type_id" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}" {{ old('project_type_id', $template->project_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Catégorie *</label>
                    <select name="category" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category', $template->category) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Current Images -->
            @if($template->preview_image || $template->thumbnail_image)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($template->preview_image)
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Image Preview actuelle</label>
                            <img src="{{ asset('storage/' . $template->preview_image) }}" alt="Preview"
                                class="w-full rounded-xl border border-white/10">
                        </div>
                    @endif
                    @if($template->thumbnail_image)
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Thumbnail actuelle</label>
                            <img src="{{ asset('storage/' . $template->thumbnail_image) }}" alt="Thumbnail"
                                class="w-full rounded-xl border border-white/10">
                        </div>
                    @endif
                </div>
            @endif

            <!-- New Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Nouvelle Image Preview</label>
                    <input type="file" name="preview_image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <p class="text-xs text-gray-500 mt-2">Laisser vide pour conserver l'actuelle</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Nouveau Thumbnail</label>
                    <input type="file" name="thumbnail_image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <p class="text-xs text-gray-500 mt-2">Laisser vide pour conserver l'actuelle</p>
                </div>
            </div>

            <!-- Sort Order & Active -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $template->sort_order) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Statut</label>
                    <div class="flex items-center space-x-4 mt-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $template->is_active) ? 'checked' : '' }}
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
                    Enregistrer
                </button>
                <a href="{{ route('admin.templates.show', $template) }}"
                    class="px-8 py-3 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>