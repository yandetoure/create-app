@props(['task'])

@php
    $timeTrackingService = app(\App\Services\TimeTrackingService::class);
    $runningTimer = $timeTrackingService->getRunningTimer(auth()->user());
    $isTimerRunning = $runningTimer && $runningTimer->task_id === $task->id;
    $totalTime = $timeTrackingService->getTotalTimeForTask($task);
@endphp

<div x-data="{
    running: {{ $isTimerRunning ? 'true' : 'false' }},
    entryId: {{ $runningTimer && $isTimerRunning ? $runningTimer->id : 'null' }},
    elapsed: {{ $runningTimer && $isTimerRunning ? $runningTimer->started_at->diffInSeconds(now()) : 0 }},
    timer: null,
    
    startTimer() {
        fetch('{{ route('time-tracking.start') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                task_id: {{ $task->id }}
            })
        })
        .then(res => res.json())
        .then(data => {
            this.running = true;
            this.entryId = data.entry.id;
            this.elapsed = 0;
            this.startCounting();
        });
    },
    
    stopTimer() {
        fetch(`/time-tracking/${this.entryId}/stop`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            this.running = false;
            this.stopCounting();
            location.reload(); // Reload to update total time
        });
    },
    
    startCounting() {
        this.timer = setInterval(() => {
            this.elapsed++;
        }, 1000);
    },
    
    stopCounting() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },
    
    formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        
        if (hours > 0) {
            return `${hours}h ${String(minutes).padStart(2, '0')}m ${String(secs).padStart(2, '0')}s`;
        } else if (minutes > 0) {
            return `${minutes}m ${String(secs).padStart(2, '0')}s`;
        } else {
            return `${secs}s`;
        }
    }
}" x-init="if (running) startCounting()" class="flex items-center space-x-3">

    <!-- Total Time Display -->
    @if($totalTime > 0)
        <div class="flex items-center space-x-2 text-gray-400 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $timeTrackingService->formatDuration($totalTime) }}</span>
        </div>
    @endif

    <!-- Timer Display (when running) -->
    <div x-show="running" x-cloak class="flex items-center space-x-2 bg-red-500/20 text-red-400 px-3 py-1 rounded-lg">
        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
        <span x-text="formatTime(elapsed)" class="font-mono text-sm font-bold"></span>
    </div>

    <!-- Start/Stop Button -->
    <button @click="running ? stopTimer() : startTimer()"
        :class="running ? 'bg-red-600 hover:bg-red-700' : 'bg-indigo-600 hover:bg-indigo-700'"
        class="px-3 py-1 rounded-lg text-white text-sm font-bold transition flex items-center space-x-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path x-show="!running" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            <path x-show="!running" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            <path x-show="running" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            <path x-show="running" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
        </svg>
        <span x-text="running ? 'Stop' : 'Start'"></span>
    </button>
</div>