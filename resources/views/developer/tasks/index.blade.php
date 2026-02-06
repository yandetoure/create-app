<x-dashboard-layout>
    <x-slot name="title">Mes Tâches</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">Toutes mes Tâches</h2>
                <p class="text-gray-400 mt-2">Gérez et suivez l'avancement de vos tâches</p>
            </div>
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/10">
                <span class="text-2xl font-black">{{ $tasks->count() }}</span>
                <span class="text-sm text-gray-400 ml-2">tâche(s)</span>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex space-x-2 p-1 bg-white/5 rounded-2xl border border-white/10 w-fit" x-data="{ filter: 'all' }">
            <button @click="filter = 'all'"
                :class="filter === 'all' ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:text-white'"
                class="px-6 py-2 rounded-xl font-bold text-sm transition">
                Toutes ({{ $tasks->count() }})
            </button>
            <button @click="filter = 'pending'"
                :class="filter === 'pending' ? 'bg-gray-600 text-white' : 'text-gray-400 hover:text-white'"
                class="px-6 py-2 rounded-xl font-bold text-sm transition">
                En attente ({{ $tasks->where('status', 'pending')->count() }})
            </button>
            <button @click="filter = 'in_progress'"
                :class="filter === 'in_progress' ? 'bg-yellow-600 text-white' : 'text-gray-400 hover:text-white'"
                class="px-6 py-2 rounded-xl font-bold text-sm transition">
                En cours ({{ $tasks->where('status', 'in_progress')->count() }})
            </button>
            <button @click="filter = 'completed'"
                :class="filter === 'completed' ? 'bg-green-600 text-white' : 'text-gray-400 hover:text-white'"
                class="px-6 py-2 rounded-xl font-bold text-sm transition">
                Terminées ({{ $tasks->where('status', 'completed')->count() }})
            </button>
        </div>

        <!-- Tasks List -->
        <div class="space-y-4" x-data="{ filter: 'all' }">
            @forelse($tasks as $task)
                <div x-show="filter === 'all' || filter === '{{ $task->status }}'"
                    class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-indigo-500/30 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <!-- Status Badge -->
                                @if($task->status === 'completed')
                                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg text-xs font-bold">✓
                                        Terminée</span>
                                @elseif($task->status === 'in_progress')
                                    <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-lg text-xs font-bold">⚡
                                        En cours</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-500/20 text-gray-400 rounded-lg text-xs font-bold">⏸
                                        En attente</span>
                                @endif

                                <!-- Project Badge -->
                                <a href="{{ route('developer.projects.show', $task->project) }}"
                                    class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-lg text-xs font-bold hover:bg-indigo-500 hover:text-white transition">
                                    {{ $task->project->name }}
                                </a>
                            </div>

                            <h3 class="text-lg font-bold mb-2">{{ $task->name }}</h3>

                            @if($task->description)
                                <p class="text-gray-400 text-sm">{{ $task->description }}</p>
                            @endif

                            <!-- Due Date -->
                            @if($task->due_date)
                                <div class="mt-3 flex items-center space-x-2 text-sm">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-400">Échéance: {{ $task->due_date->format('d/m/Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
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
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-500 italic">Aucune tâche assignée pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>