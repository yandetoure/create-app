<x-dashboard-layout>
    <x-slot name="title">{{ $project->name }}</x-slot>

    <div class="space-y-8">
        <!-- Back Button -->
        <a href="{{ route('developer.projects.index') }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour aux projets</span>
        </a>

        <!-- Project Header -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-600/20 flex items-center justify-center text-indigo-400 font-bold text-2xl border border-indigo-600/20">
                        {{ substr($project->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tight">{{ $project->name }}</h2>
                        <p class="text-gray-400 mt-1">{{ $project->projectType->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Client Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-white/10">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Client</p>
                    <p class="text-white font-bold">{{ $project->user->name }}</p>
                    <p class="text-gray-400 text-sm">{{ $project->user->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Statut</p>
                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-lg text-sm font-bold">
                        {{ ucfirst($project->status ?? 'En cours') }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Progression</p>
                    @php
                        $totalTasks = $project->tasks->count();
                        $completedTasks = $project->tasks->where('status', 'completed')->count();
                        $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                    @endphp
                    <div class="flex items-center space-x-3">
                        <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-600 transition-all" style="width: {{ $progress }}%"></div>
                        </div>
                        <span class="text-indigo-400 font-bold text-sm">{{ round($progress) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Section -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-black">Tâches</h3>
                <div class="text-sm text-gray-400">
                    <span class="font-bold text-white">{{ $project->tasks->count() }}</span> tâche(s)
                </div>
            </div>

            <div class="space-y-3">
                @forelse($project->tasks as $task)
                    <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4 flex-1">
                            <!-- Status Indicator -->
                            <div
                                class="w-4 h-4 rounded {{ $task->status === 'completed' ? 'bg-green-500' : ($task->status === 'in_progress' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                            </div>

                            <div class="flex-1">
                                <h4
                                    class="font-bold {{ $task->status === 'completed' ? 'text-gray-500 line-through' : 'text-white' }}">
                                    {{ $task->name }}
                                </h4>
                                @if($task->description)
                                    <p class="text-gray-400 text-sm mt-1">{{ Str::limit($task->description, 100) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button -->
                        @if($task->status !== 'completed')
                            <form method="POST" action="{{ route('developer.tasks.update', $task) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status"
                                    value="{{ $task->status === 'pending' ? 'in_progress' : 'completed' }}">
                                <button type="submit"
                                    class="px-4 py-2 {{ $task->status === 'pending' ? 'bg-yellow-600/20 text-yellow-400 hover:bg-yellow-600' : 'bg-green-600/20 text-green-400 hover:bg-green-600' }} rounded-xl text-sm font-bold hover:text-white transition">
                                    {{ $task->status === 'pending' ? 'Démarrer' : 'Terminer' }}
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 italic text-center py-8">Aucune tâche pour ce projet.</p>
                @endforelse
            </div>
        </div>

        <!-- Deliverables Section -->
        @if($project->deliverables->count() > 0)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-black">Livrables</h3>
                    <div class="text-sm text-gray-400">
                        <span class="font-bold text-white">{{ $project->deliverables->count() }}</span> livrable(s)
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($project->deliverables as $deliverable)
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="font-bold">{{ $deliverable->name }}</h4>
                                @if($deliverable->status === 'delivered')
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded text-xs font-bold">✓
                                        Livré</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded text-xs font-bold">En
                                        attente</span>
                                @endif
                            </div>

                            @if($deliverable->description)
                                <p class="text-gray-400 text-sm mb-3">{{ $deliverable->description }}</p>
                            @endif

                            @if($deliverable->status !== 'delivered')
                                <form method="POST" action="{{ route('developer.deliverables.upload', $deliverable) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                                </form>
                            @else
                                <a href="{{ asset('storage/' . $deliverable->file_path) }}" target="_blank"
                                    class="inline-flex items-center space-x-2 text-sm text-indigo-400 hover:text-indigo-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Télécharger</span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-dashboard-layout>