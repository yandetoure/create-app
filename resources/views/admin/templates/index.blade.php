<x-dashboard-layout>
    <x-slot name="title">Templates</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">🎨 Templates</h2>
                <p class="text-gray-400 mt-2">Gérez les templates pour vos projets</p>
            </div>
            <a href="{{ route('admin.templates.create') }}"
                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-2xl font-bold transition">
                + Nouveau Template
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type de Projet</label>
                    <select name="project_type_id"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white">
                        <option value="">Tous</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}" {{ request('project_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Catégorie</label>
                    <select name="category"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white">
                        <option value="">Toutes</option>
                        <option value="e-commerce" {{ request('category') == 'e-commerce' ? 'selected' : '' }}>E-commerce
                        </option>
                        <option value="hotel" {{ request('category') == 'hotel' ? 'selected' : '' }}>Hôtellerie</option>
                        <option value="recipe" {{ request('category') == 'recipe' ? 'selected' : '' }}>Recettes</option>
                        <option value="vitrine" {{ request('category') == 'vitrine' ? 'selected' : '' }}>Site Vitrine
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Statut</label>
                    <select name="is_active"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white">
                        <option value="">Tous</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                        Filtrer
                    </button>
                </div>
            </div>
        </form>

        <!-- Templates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($templates as $template)
                <div
                    class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-indigo-500/30 transition group">
                    <!-- Preview Image -->
                    @if($template->thumbnail_image)
                        <div class="h-48 bg-gray-800 overflow-hidden">
                            <img src="{{ asset('storage/' . $template->thumbnail_image) }}" alt="{{ $template->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">
                        </div>
                    @else
                        <div
                            class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                            <span class="text-6xl">🎨</span>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold mb-1">{{ $template->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $template->projectType->name }}</p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-lg text-xs font-bold
                                    {{ $template->is_active ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ $template->is_active ? '✓ Actif' : '⏸ Inactif' }}
                            </span>
                        </div>

                        @if($template->description)
                            <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ $template->description }}</p>
                        @endif

                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <span>{{ ucfirst($template->category) }}</span>
                            <span>{{ $template->components->count() }} composants</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.templates.show', $template) }}"
                                class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold text-center transition text-sm">
                                Voir
                            </a>
                            <a href="{{ route('admin.templates.edit', $template) }}"
                                class="px-4 py-2 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition text-sm">
                                ✏️
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20 bg-white/5 rounded-2xl border border-white/5 border-dashed">
                    <span class="text-6xl mb-4 block">🎨</span>
                    <p class="text-gray-500 italic">Aucun template trouvé</p>
                    <a href="{{ route('admin.templates.create') }}"
                        class="inline-block mt-4 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                        Créer le premier template
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($templates->hasPages())
            <div class="mt-8">
                {{ $templates->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>