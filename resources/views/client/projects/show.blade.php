<x-dashboard-layout>
    <x-slot name="title">{{ $project->name }}</x-slot>

    <div class="space-y-8">
        <!-- Back Button -->
        <a href="{{ route('client.dashboard') }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour aux projets</span>
        </a>

        <!-- Project Header -->
        <div
            class="bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-[2rem] p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h2 class="text-4xl font-black tracking-tight mb-3">{{ $project->name }}</h2>
                    <p class="text-gray-400">{{ $project->projectType->name }}</p>
                </div>

                <!-- Status Badge -->
                @php
                    $statusConfig = [
                        'pending' => ['label' => 'En attente', 'class' => 'bg-gray-500/20 text-gray-400', 'icon' => '⏸'],
                        'in_progress' => ['label' => 'En cours', 'class' => 'bg-yellow-500/20 text-yellow-400', 'icon' => '⚡'],
                        'completed' => ['label' => 'Terminé', 'class' => 'bg-green-500/20 text-green-400', 'icon' => '✓'],
                    ];
                    $status = $statusConfig[$project->status] ?? $statusConfig['pending'];
                @endphp
                <span class="px-6 py-3 {{ $status['class'] }} rounded-2xl text-sm font-bold">
                    {{ $status['icon'] }} {{ $status['label'] }}
                </span>
            </div>

            <!-- Project Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-black/20 rounded-2xl p-6">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Prix Total</p>
                    <p class="text-3xl font-black">{{ number_format($project->total_price, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="bg-black/20 rounded-2xl p-6">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Développeur</p>
                    <p class="text-xl font-bold">{{ $project->developer ? $project->developer->name : 'Non assigné' }}
                    </p>
                </div>
                <div class="bg-black/20 rounded-2xl p-6">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Tâches</p>
                    <p class="text-xl font-bold">
                        {{ $project->tasks->where('status', 'completed')->count() }} / {{ $project->tasks->count() }}
                        terminées
                    </p>
                </div>
            </div>
        </div>

        <!-- Deployment URLs -->
        @if($project->deployment_url || $project->staging_url)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
                    <span>🚀</span>
                    <span>Liens de Déploiement</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($project->deployment_url)
                        <div class="bg-black/20 rounded-2xl p-6">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-3">Production</p>
                            <a href="{{ $project->deployment_url }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 break-all text-sm font-mono block mb-4">
                                {{ $project->deployment_url }}
                            </a>
                            <a href="{{ $project->deployment_url }}" target="_blank"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>Visiter</span>
                            </a>
                        </div>
                    @endif

                    @if($project->staging_url)
                        <div class="bg-black/20 rounded-2xl p-6">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-3">Staging</p>
                            <a href="{{ $project->staging_url }}" target="_blank"
                                class="text-indigo-400 hover:text-indigo-300 break-all text-sm font-mono block mb-4">
                                {{ $project->staging_url }}
                            </a>
                            <a href="{{ $project->staging_url }}" target="_blank"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-xl font-bold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>Visiter</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Demos (Photos/Videos) -->
        @if($project->demo_files && count($project->demo_files) > 0)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
                    <span>🎬</span>
                    <span>Démos & Aperçus</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($project->demo_files as $demoFile)
                        @php
                            $extension = pathinfo($demoFile, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'avi', 'webm']);
                        @endphp
                        <div class="bg-black/20 rounded-2xl overflow-hidden hover:scale-105 transition">
                            @if($isImage)
                                <img src="{{ asset('storage/' . $demoFile) }}" alt="Demo"
                                    class="w-full h-48 object-cover cursor-pointer"
                                    onclick="window.open('{{ asset('storage/' . $demoFile) }}', '_blank')">
                            @elseif($isVideo)
                                <video controls class="w-full h-48 object-cover">
                                    <source src="{{ asset('storage/' . $demoFile) }}" type="video/{{ $extension }}">
                                </video>
                            @else
                                <div class="w-full h-48 flex items-center justify-center bg-gray-800">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 mx-auto text-gray-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-xs text-gray-500">{{ strtoupper($extension) }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="p-4">
                                <a href="{{ asset('storage/' . $demoFile) }}" target="_blank" download
                                    class="text-xs text-indigo-400 hover:text-indigo-300 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Télécharger</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Deliverables -->
        @if($project->deliverables && $project->deliverables->count() > 0)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
                    <span>📦</span>
                    <span>Livrables</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($project->deliverables as $deliverable)
                        <div class="bg-black/20 rounded-2xl p-6 hover:bg-black/30 transition">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold mb-2">{{ $deliverable->label }}</h4>
                                    @if($deliverable->description)
                                        <p class="text-gray-400 text-sm">{{ $deliverable->description }}</p>
                                    @endif
                                </div>
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

                            @if($deliverable->url)
                                <a href="{{ $deliverable->url }}" target="_blank"
                                    class="inline-flex items-center space-x-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition text-sm">
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

        <!-- Tasks Progress -->
        @if($project->tasks && $project->tasks->count() > 0)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
                    <span>✅</span>
                    <span>Progression des Tâches</span>
                </h3>

                <!-- Progress Bar -->
                @php
                    $completedTasks = $project->tasks->where('status', 'completed')->count();
                    $totalTasks = $project->tasks->count();
                    $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                @endphp
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-gray-400">{{ $completedTasks }} / {{ $totalTasks }} tâches
                            terminées</span>
                        <span class="text-sm font-bold text-indigo-400">{{ round($progress) }}%</span>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-3 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-full rounded-full transition-all duration-500"
                            style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <!-- Tasks List -->
                <div class="space-y-3">
                    @foreach($project->tasks as $task)
                            <div class="bg-black/20 rounded-xl p-4 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if($task->status === 'completed')
                                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-6 h-6 bg-gray-600 rounded-full"></div>
                                    @endif
                                    <div>
                                        <p
                                            class="font-bold {{ $task->status === 'completed' ? 'text-gray-400 line-through' : 'text-white' }}">
                                            {{ $task->name }}
                                        </p>
                                        @if($task->description)
                                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($task->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-lg text-xs font-bold
                                            {{ $task->status === 'completed' ? 'bg-green-500/20 text-green-400' :
                        ($task->status === 'in_progress' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-gray-500/20 text-gray-400') }}">
                                    {{ $task->status === 'completed' ? '✓ Terminé' :
                        ($task->status === 'in_progress' ? '⚡ En cours' : '⏸ En attente') }}
                                </span>
                            </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <x-comments.section :commentable="$project" />
    </div>
</x-dashboard-layout>