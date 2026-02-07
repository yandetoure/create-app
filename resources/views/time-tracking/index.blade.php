<x-dashboard-layout>
    <x-slot name="title">Time Tracking</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">⏱️ Time Tracking</h2>
                <p class="text-gray-400 mt-2">Suivez votre temps de travail sur les tâches</p>
            </div>

            <!-- Stats Cards -->
            <div class="flex space-x-4">
                <div class="bg-white/5 border border-white/10 rounded-2xl px-6 py-4">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">Aujourd'hui</p>
                    <p class="text-2xl font-black">
                        {{ app(\App\Services\TimeTrackingService::class)->formatDuration($stats['today']) }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl px-6 py-4">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">Cette semaine</p>
                    <p class="text-2xl font-black">
                        {{ app(\App\Services\TimeTrackingService::class)->formatDuration($stats['week']) }}</p>
                </div>
            </div>
        </div>

        <!-- Running Timer Alert -->
        @if($runningTimer)
            <div class="bg-red-500/10 border border-red-500/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        <div>
                            <p class="font-bold text-white">Chronomètre en cours</p>
                            <p class="text-sm text-gray-400 mt-1">
                                Tâche: <span class="text-indigo-400">{{ $runningTimer->task->name }}</span>
                                • Démarré {{ $runningTimer->started_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('time-tracking.stop', $runningTimer) }}">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 rounded-xl font-bold transition">
                            ⏹️ Arrêter
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Date Range Filter -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <form method="GET" action="{{ route('time-tracking.index') }}" class="flex items-end space-x-4">
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">Date de début</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">Date de fin</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white">
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Time Entries List -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold">Entrées de temps</h3>

            @forelse($entries as $entry)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-indigo-500/30 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <!-- Task Info -->
                            @if($entry->task)
                                <div class="flex items-center space-x-3 mb-2">
                                    <h4 class="font-bold text-white">{{ $entry->task->name }}</h4>
                                    @if($entry->task->project)
                                        <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-lg text-xs font-bold">
                                            {{ $entry->task->project->name }}
                                        </span>
                                    @endif
                                </div>
                            @elseif($entry->project)
                                <h4 class="font-bold text-white mb-2">{{ $entry->project->name }}</h4>
                            @endif

                            <!-- Description -->
                            @if($entry->description)
                                <p class="text-gray-400 text-sm mb-3">{{ $entry->description }}</p>
                            @endif

                            <!-- Time Info -->
                            <div class="flex items-center space-x-6 text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $entry->started_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $entry->started_at->format('H:i') }} -
                                        {{ $entry->ended_at ? $entry->ended_at->format('H:i') : 'En cours' }}</span>
                                </div>
                                @if($entry->is_manual)
                                    <span class="px-2 py-1 bg-gray-600/20 text-gray-400 rounded text-xs font-bold">
                                        Manuel
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Duration & Actions -->
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-2xl font-black text-indigo-400">{{ $entry->formatted_duration }}</p>
                            </div>

                            @if(!$entry->isRunning())
                                <form method="POST" action="{{ route('time-tracking.destroy', $entry) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Supprimer cette entrée ?')"
                                        class="p-2 text-gray-500 hover:text-red-400 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
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
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-500 italic">Aucune entrée de temps pour cette période.</p>
                    <p class="text-gray-600 text-sm mt-2">Démarrez un chronomètre sur une tâche pour commencer !</p>
                </div>
            @endforelse
        </div>

        <!-- Total -->
        @if($entries->count() > 0)
            <div class="bg-indigo-600/10 border border-indigo-500/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <p class="text-lg font-bold text-white">Temps total pour cette période</p>
                    <p class="text-3xl font-black text-indigo-400">
                        {{ app(\App\Services\TimeTrackingService::class)->formatDuration($stats['total']) }}
                    </p>
                </div>
            </div>
        @endif
    </div>
</x-dashboard-layout>