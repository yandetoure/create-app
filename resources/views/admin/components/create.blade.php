<x-admin-layout>
    <x-slot name="title">Créer un Composant</x-slot>

    <div class="space-y-8 max-w-4xl">
        <!-- Back Button -->
        <a href="{{ route('admin.components.index') }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour aux composants</span>
        </a>

        <!-- Header -->
        <div>
            <h2 class="text-3xl font-black tracking-tight">Créer un Composant</h2>
            <p class="text-gray-400 mt-2">Ajoutez un nouveau composant réutilisable</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.components.store') }}" enctype="multipart/form-data"
            class="bg-white/5 border border-white/10 rounded-2xl p-8 space-y-6">
            @csrf

            <!-- Name & Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Nom du Composant *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="Ex: Modern Header">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type *</label>
                    <select name="type" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="">Sélectionner...</option>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="2"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                    placeholder="Description du composant...">{{ old('description') }}</textarea>
            </div>

            <!-- Preview Image -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Image Preview</label>
                <input type="file" name="preview_image" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                <p class="text-xs text-gray-500 mt-2">Recommandé: 400x300px, max 2MB</p>
            </div>

            <!-- HTML Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code HTML</label>
                <textarea name="html_code" rows="8"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm"
                    placeholder="<header>...</header>">{{ old('html_code') }}</textarea>
                <p class="text-xs text-gray-500 mt-2">Code HTML du composant</p>
            </div>

            <!-- CSS Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code CSS</label>
                <textarea name="css_code" rows="8"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm"
                    placeholder=".header { ... }">{{ old('css_code') }}</textarea>
                <p class="text-xs text-gray-500 mt-2">Styles CSS du composant</p>
            </div>

            <!-- JS Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code JavaScript (optionnel)</label>
                <textarea name="js_code" rows="4"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm"
                    placeholder="// JavaScript...">{{ old('js_code') }}</textarea>
            </div>

            <!-- Active -->
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded bg-white/5 border-white/10 text-indigo-600 focus:ring-indigo-600">
                    <span class="text-sm font-bold">Composant actif</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    Créer le Composant
                </button>
                <a href="{{ route('admin.components.index') }}"
                    class="px-8 py-3 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>