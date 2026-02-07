<x-admin-layout>
    <x-slot name="title">Composants</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">🧩 Composants</h2>
                <p class="text-gray-400 mt-2">Bibliothèque de composants réutilisables</p>
            </div>
            <a href="{{ route('admin.components.create') }}"
                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-2xl font-bold transition">
                + Nouveau Composant
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Type</label>
                    <select name="type"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white">
                        <option value="">Tous</option>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
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

        <!-- Components Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($components as $component)
                <div
                    class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-indigo-500/30 transition group">
                    <!-- Preview -->
                    @if($component->preview_image)
                        <div class="h-32 bg-gray-800 overflow-hidden">
                            <img src="{{ asset('storage/' . $component->preview_image) }}" alt="{{ $component->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">
                        </div>
                    @else
                        <div class="h-32 bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                            <span class="text-4xl">🧩</span>
                        </div>
                    @endif>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1">
                                <h3 class="font-bold mb-1 text-sm">{{ $component->name }}</h3>
                                <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded text-xs font-bold">
                                    {{ $types[$component->type] ?? $component->type }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-500 mt-3 mb-3">
                            <span>{{ $component->templates->count() }} templates</span>
                            <span class="{{ $component->is_active ? 'text-green-400' : 'text-gray-500' }}">
                                {{ $component->is_active ? '✓' : '⏸' }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.components.show', $component) }}"
                                class="flex-1 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold text-center transition text-xs">
                                Voir
                            </a>
                            <a href="{{ route('admin.components.edit', $component) }}"
                                class="px-3 py-2 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition text-xs">
                                ✏️
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-20 bg-white/5 rounded-2xl border border-white/5 border-dashed">
                    <span class="text-6xl mb-4 block">🧩</span>
                    <p class="text-gray-500 italic">Aucun composant trouvé</p>
                    <a href="{{ route('admin.components.create') }}"
                        class="inline-block mt-4 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                        Créer le premier composant
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($components->hasPages())
            <div class="mt-8">
                {{ $components->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>