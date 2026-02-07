<x-dashboard-layout>
    <x-slot name="title">Livrables</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">📦 Mes Livrables</h2>
                <p class="text-gray-400 mt-2">Gérez les livrables et URLs de déploiement de vos projets</p>
            </div>
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/10">
                <span class="text-2xl font-black">{{ $deliverables->count() + $projects->count() }}</span>
                <span class="text-sm text-gray-400 ml-2">élément(s)</span>
            </div>
        </div>

        <!-- Project Deployment URLs -->
        @if($projects->count() > 0)
            <div class="space-y-4">
                <h3 class="text-xl font-bold flex items-center space-x-2">
                    <span>🚀</span>
                    <span>URLs de Déploiement</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($projects as $project)
                        <div
                            class="bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-2xl p-6 hover:border-indigo-500/40 transition">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold mb-2">{{ $project->name }}</h3>
                                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-lg text-xs font-bold">
                                        🌐 Déploiement
                                    </span>
                                </div>
                            </div>

                            <!-- Deployment URL -->
                            <div class="bg-black/20 rounded-xl p-4 mb-4">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">URL</p>
                                <a href="{{ $project->deployment_url }}" target="_blank"
                                    class="text-indigo-400 hover:text-indigo-300 break-all text-sm font-mono">
                                    {{ $project->deployment_url }}
                                </a>
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ $project->deployment_url }}" target="_blank"
                                    class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold text-center transition">
                                    🔗 Ouvrir
                                </a>
                                <a href="{{ route('developer.projects.show', $project) }}"
                                    class="px-4 py-2 bg-white/5 hover:bg-white/10 rounded-xl font-bold transition">
                                    👁️ Voir projet
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Deliverables List -->
        @if($deliverables->count() > 0)
            <div class="space-y-4">
                <h3 class="text-xl font-bold flex items-center space-x-2">
                    <span>📄</span>
                    <span>Autres Livrables</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($deliverables as $deliverable)
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-indigo-500/30 transition">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold mb-2">{{ $deliverable->label }}</h3>
                                    <a href="{{ route('developer.projects.show', $deliverable->project) }}"
                                        class="text-sm text-indigo-400 hover:text-indigo-300">
                                        {{ $deliverable->project->name }}
                                    </a>
                                </div>

                                <!-- Type Badge -->
                                @php
                                    $typeIcons = [
                                        'github' => '🔗',
                                        'figma' => '🎨',
                                        'logo' => '🖼️',
                                        'photo' => '📸',
                                        'doc' => '📄',
                                        'deployment' => '🚀',
                                    ];
                                    $icon = $typeIcons[$deliverable->type] ?? '📦';
                                @endphp
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg text-xs font-bold">
                                    {{ $icon }} {{ ucfirst($deliverable->type) }}
                                </span>
                            </div>

                            @if($deliverable->description)
                                <p class="text-gray-400 text-sm mb-4">{{ $deliverable->description }}</p>
                            @endif

                            <!-- URL -->
                            @if($deliverable->url)
                                <div class="bg-black/20 rounded-xl p-4 mb-4">
                                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">URL</p>
                                    <a href="{{ $deliverable->url }}" target="_blank"
                                        class="text-indigo-400 hover:text-indigo-300 break-all text-sm font-mono">
                                        {{ $deliverable->url }}
                                    </a>
                                </div>

                                <a href="{{ $deliverable->url }}" target="_blank"
                                    class="inline-flex items-center space-x-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span>Ouvrir</span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($deliverables->count() === 0 && $projects->count() === 0)
            <div class="text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-gray-500 italic">Aucun livrable pour le moment.</p>
                <p class="text-gray-600 text-sm mt-2">Ajoutez une URL de déploiement dans vos projets pour la voir ici !</p>
            </div>
        @endif
    </div>
</x-dashboard-layout>