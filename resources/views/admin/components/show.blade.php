<x-dashboard-layout>
    <div class="space-y-8">
        <!-- Back & Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.components.index') }}"
                class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-bold">Retour</span>
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('admin.components.edit', $comp) }}"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>

        <!-- Component Info -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-black mb-2">{{ $comp->name }}</h2>
                    <div class="flex items-center space-x-4 text-sm">
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg font-bold">
                            {{ \App\Models\Component::getTypes()[$comp->type] ?? $comp->type }}
                        </span>
                        <span class="{{ $comp->is_active ? 'text-green-400' : 'text-gray-500' }}">
                            {{ $comp->is_active ? '✓ Actif' : '⏸ Inactif' }}
                        </span>
                    </div>
                </div>
            </div>

            @if($comp->description)
                <p class="text-gray-300 mb-6">{{ $comp->description }}</p>
            @endif

            @if($comp->preview_image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $comp->preview_image) }}" alt="{{ $comp->name }}"
                        class="w-full max-w-2xl rounded-xl border border-white/10">
                </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Type</p>
                    <p class="text-lg font-bold">{{ ucfirst($comp->type) }}</p>
                </div>
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Utilisé dans</p>
                    <p class="text-2xl font-bold">{{ $comp->templates->count() }} templates</p>
                </div>
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Créé le</p>
                    <p class="text-sm font-bold">{{ $comp->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Code Sections -->
        @if($comp->html_code)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <span class="text-orange-400 mr-2">HTML</span>
                </h3>
                <pre
                    class="bg-black/40 p-6 rounded-xl overflow-x-auto border border-white/10"><code class="text-sm text-gray-300 font-mono">{{ $comp->html_code }}</code></pre>
            </div>
        @endif

        @if($comp->css_code)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <span class="text-blue-400 mr-2">CSS</span>
                </h3>
                <pre
                    class="bg-black/40 p-6 rounded-xl overflow-x-auto border border-white/10"><code class="text-sm text-gray-300 font-mono">{{ $comp->css_code }}</code></pre>
            </div>
        @endif

        @if($comp->js_code)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <span class="text-yellow-400 mr-2">JavaScript</span>
                </h3>
                <pre
                    class="bg-black/40 p-6 rounded-xl overflow-x-auto border border-white/10"><code class="text-sm text-gray-300 font-mono">{{ $comp->js_code }}</code></pre>
            </div>
        @endif

        <!-- Used in Templates -->
        @if($comp->templates->isNotEmpty())
            <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                <h3 class="text-2xl font-black mb-6">Utilisé dans ces templates ({{ $comp->templates->count() }})</h3>
                <div class="space-y-3">
                    @foreach($comp->templates as $template)
                        <div class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/10">
                            <div class="flex items-center space-x-4">
                                <span class="text-2xl">🎨</span>
                                <div>
                                    <h4 class="font-bold">{{ $template->name }}</h4>
                                    <div class="flex items-center space-x-3 text-xs text-gray-500 mt-1">
                                        <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded">
                                            {{ $template->pivot->section_name }}
                                        </span>
                                        <span>Ordre: {{ $template->pivot->sort_order }}</span>
                                        <span>{{ ucfirst($template->category) }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.templates.show', $template) }}"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-bold text-sm transition">
                                Voir le template
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-2xl p-8 text-center">
                <span class="text-4xl mb-3 block">📦</span>
                <p class="text-gray-500">Ce composant n'est utilisé dans aucun template</p>
            </div>
        @endif
    </div>
</x-dashboard-layout>