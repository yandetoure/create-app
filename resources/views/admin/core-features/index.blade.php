<x-dashboard-layout>
    <x-slot name="title">Fonctionnalités de Base</x-slot>

    <div class="space-y-8">
        <!-- Header with Create Button -->
        <div class="flex justify-between items-center px-2">
            <div>
                <h3 class="text-2xl font-black text-white mb-2">Fonctionnalités de Base</h3>
                <p class="text-sm text-gray-400">Gérez les fonctionnalités automatiquement incluses dans tous les
                    nouveaux projets</p>
            </div>
            <a href="{{ route('admin.core-features.create') }}"
                class="bg-indigo-600 px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nouvelle Fonctionnalité</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 rounded-2xl p-4 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Core Features Table -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/5">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                Fonctionnalité</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                Description</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">
                                Statut</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($coreFeatures as $feature)
                            <tr class="hover:bg-white/[0.03] transition relative group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-white">{{ $feature->name }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm text-gray-400 max-w-md">
                                        {{ $feature->description ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if($feature->is_active)
                                        <span
                                            class="px-3 py-1 bg-green-500/10 text-[10px] font-black uppercase tracking-widest text-green-400 rounded-full border border-green-500/10">
                                            Actif
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-gray-500/10 text-[10px] font-black uppercase tracking-widest text-gray-400 rounded-full border border-gray-500/10">
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right flex items-center justify-end space-x-2">
                                    <!-- Toggle Status -->
                                    <form action="{{ route('admin.core-features.toggle', $feature) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" title="Changer le statut"
                                            class="p-3 {{ $feature->is_active ? 'bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500' : 'bg-green-500/10 text-green-400 hover:bg-green-500' }} rounded-xl hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.core-features.edit', $feature) }}" title="Modifier"
                                        class="p-3 bg-white/5 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.core-features.destroy', $feature) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Supprimer cette fonctionnalité de base ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Supprimer"
                                            class="p-3 bg-red-500/10 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-gray-500 italic text-sm">
                                    Aucune fonctionnalité de base définie pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-indigo-600/5 border border-indigo-600/10 rounded-2xl p-6">
            <div class="flex items-start space-x-4">
                <div class="bg-indigo-500/10 text-indigo-400 p-2 rounded-lg">💡</div>
                <div class="flex-1">
                    <h4 class="font-bold text-white mb-2">À propos des fonctionnalités de base</h4>
                    <p class="text-sm text-gray-400">
                        Les fonctionnalités de base sont automatiquement incluses dans tous les nouveaux projets créés
                        via le configurateur.
                        Exemples : Lien GitHub, Nom de domaine, Configuration base de données, SEO de base, Hébergement,
                        etc.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>