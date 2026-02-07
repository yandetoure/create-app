<x-dashboard-layout>
    <div class="space-y-8 max-w-4xl">
        <!-- Back Button -->
        <a href="{{ route('admin.components.show', $comp) }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour</span>
        </a>

        <!-- Header -->
        <div>
            <h2 class="text-3xl font-black tracking-tight">Modifier le Composant</h2>
            <p class="text-gray-400 mt-2">{{ $comp->name }}</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.components.update', $comp) }}" enctype="multipart/form-data"
            class="bg-white/5 border border-white/10 rounded-2xl p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name & Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Nom du Composant *</label>
                    <input type="text" name="name" value="{{ old('name', $comp->name) }}" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type *</label>
                    <select name="type" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('type', $comp->type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="2"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('description', $comp->description) }}</textarea>
            </div>

            <!-- Current Preview -->
            @if($comp->preview_image)
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Image Preview actuelle</label>
                    <img src="{{ asset('storage/' . $comp->preview_image) }}" alt="Preview"
                        class="w-64 rounded-xl border border-white/10">
                </div>
            @endif

            <!-- New Preview Image -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nouvelle Image Preview</label>
                <input type="file" name="preview_image" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                <p class="text-xs text-gray-500 mt-2">Laisser vide pour conserver l'actuelle</p>
            </div>

            <!-- HTML Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code HTML</label>
                <textarea name="html_code" rows="8"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm">{{ old('html_code', $comp->html_code) }}</textarea>
            </div>

            <!-- CSS Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code CSS</label>
                <textarea name="css_code" rows="8"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm">{{ old('css_code', $comp->css_code) }}</textarea>
            </div>

            <!-- JS Code -->
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Code JavaScript (optionnel)</label>
                <textarea name="js_code" rows="4"
                    class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 font-mono text-sm">{{ old('js_code', $comp->js_code) }}</textarea>
            </div>

            <!-- Active -->
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $comp->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 rounded bg-white/5 border-white/10 text-indigo-600 focus:ring-indigo-600">
                    <span class="text-sm font-bold">Composant actif</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    Enregistrer
                </button>
                <a href="{{ route('admin.components.show', $comp) }}"
                    class="px-8 py-3 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-dashboard-layout>