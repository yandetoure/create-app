<x-dashboard-layout>
    <div class="space-y-8">
        <!-- Back & Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.templates.index') }}"
                class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-bold">Retour</span>
            </a>

            <div class="flex space-x-3">
                <form action="{{ route('admin.templates.toggle-active', $template) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 {{ $template->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} rounded-xl font-bold transition">
                        {{ $template->is_active ? '⏸ Désactiver' : '✓ Activer' }}
                    </button>
                </form>
                <a href="{{ route('admin.templates.edit', $template) }}"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    ✏️ Modifier
                </a>
            </div>
        </div>

        <!-- Template Info -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-black mb-2">{{ $template->name }}</h2>
                    <div class="flex items-center space-x-4 text-sm">
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg font-bold">
                            {{ ucfirst($template->category) }}
                        </span>
                        <span class="text-gray-400">{{ $template->projectType->name }}</span>
                        <span class="{{ $template->is_active ? 'text-green-400' : 'text-gray-500' }}">
                            {{ $template->is_active ? '✓ Actif' : '⏸ Inactif' }}
                        </span>
                    </div>
                </div>
            </div>

            @if($template->description)
                <p class="text-gray-300 mb-6">{{ $template->description }}</p>
            @endif

            @if($template->preview_image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $template->preview_image) }}" alt="{{ $template->name }}"
                        class="w-full max-w-3xl rounded-xl border border-white/10">
                </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Composants</p>
                    <p class="text-2xl font-bold">{{ $template->components->count() }}</p>
                </div>
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Projets</p>
                    <p class="text-2xl font-bold">{{ $template->projects->count() }}</p>
                </div>
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Ordre</p>
                    <p class="text-2xl font-bold">{{ $template->sort_order }}</p>
                </div>
                <div class="bg-white/5 p-4 rounded-xl">
                    <p class="text-gray-500 mb-1">Créé le</p>
                    <p class="text-sm font-bold">{{ $template->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Components -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-black">Composants ({{ $template->components->count() }})</h3>
                <button onclick="document.getElementById('addComponentModal').classList.remove('hidden')"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition text-sm">
                    + Ajouter un composant
                </button>
            </div>

            @if($template->components->isEmpty())
                <div class="text-center py-12 bg-white/5 rounded-xl border border-white/5 border-dashed">
                    <span class="text-4xl mb-3 block">🧩</span>
                    <p class="text-gray-500">Aucun composant assigné</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($template->components->sortBy('pivot.sort_order') as $component)
                        <div class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/10">
                            <div class="flex items-center space-x-4">
                                <span class="text-2xl">🧩</span>
                                <div>
                                    <h4 class="font-bold">{{ $component->name }}</h4>
                                    <div class="flex items-center space-x-3 text-xs text-gray-500 mt-1">
                                        <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded">
                                            {{ $component->pivot->section_name }}
                                        </span>
                                        <span>Ordre: {{ $component->pivot->sort_order }}</span>
                                        <span>Type: {{ $component->type }}</span>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.templates.remove-component', [$template, $component]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Retirer ce composant ?')"
                                    class="px-3 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg font-bold text-sm transition">
                                    Retirer
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Available Components by Type -->
        <div id="addComponentModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
            <div
                class="bg-slate-900 border border-white/10 rounded-2xl p-8 max-w-4xl w-full max-h-[80vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-black">Ajouter un Composant</h3>
                    <button onclick="document.getElementById('addComponentModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-white text-2xl">×</button>
                </div>

                @foreach($availableComponents as $type => $components)
                    <div class="mb-6">
                        <h4 class="text-lg font-bold mb-3 text-indigo-400">{{ ucfirst($type) }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($components as $component)
                                <form action="{{ route('admin.templates.assign-component', $template) }}" method="POST"
                                    class="bg-white/5 p-4 rounded-xl border border-white/10 hover:border-indigo-500/30 transition">
                                    @csrf
                                    <input type="hidden" name="component_id" value="{{ $component->id }}">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h5 class="font-bold mb-1">{{ $component->name }}</h5>
                                            @if($component->description)
                                                <p class="text-xs text-gray-500">{{ $component->description }}</p>
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 mb-3">
                                        <input type="text" name="section_name" placeholder="Section (ex: header)" required
                                            class="px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-sm">
                                        <input type="number" name="sort_order" placeholder="Ordre" value="0"
                                            class="px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-sm">
                                    </div>
                                    <button type="submit"
                                        class="w-full px-3 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-bold text-sm transition">
                                        Ajouter
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-dashboard-layout>