<x-dashboard-layout>
    <x-slot name="title">Console Développeur</x-slot>

    <div class="space-y-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($stats as $label => $value)
                <div class="bg-white/5 border border-white/10 p-8 rounded-3xl shadow-xl">
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">
                        {{ str_replace('_', ' ', $label) }}</p>
                    <div class="flex items-end space-x-2">
                        <span class="text-4xl font-black tracking-tighter">{{ $value }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Assigned Projects -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($assignedProjects as $project)
                <div
                    class="bg-white/5 border border-white/10 rounded-[2rem] p-8 hover:border-indigo-500/30 transition shadow-xl group">
                    <div class="flex flex-col md:flex-row justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-600/20 flex items-center justify-center text-indigo-400 font-bold border border-indigo-600/20">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold group-hover:text-indigo-400 transition">
                                        {{ $project->name }}</h3>
                                    <p class="text-gray-400 text-sm">Client: <span
                                            class="text-white">{{ $project->user->name }}</span> •
                                        {{ $project->projectType->name }}</p>
                                </div>
                            </div>

                            <!-- Progress Bar (Simulation based on tasks) -->
                            @php
                                $totalTasks = $project->tasks->count();
                                $completedTasks = $project->tasks->where('status', 'completed')->count();
                                $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                            @endphp
                            <div class="mt-6">
                                <div class="flex justify-between text-xs font-bold uppercase tracking-widest mb-2">
                                    <span class="text-gray-500">Progression</span>
                                    <span class="text-indigo-400">{{ round($progress) }}%</span>
                                </div>
                                <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 transition-all duration-1000"
                                        style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <a href="{{ route('projects.show', $project) }}"
                                class="bg-indigo-600/10 text-indigo-400 px-6 py-3 rounded-2xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Gérer les tâches
                            </a>
                        </div>
                    </div>

                    @if($project->tasks->isNotEmpty())
                        <div class="mt-8 pt-8 border-t border-white/5 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($project->tasks->take(4) as $task)
                                <div class="flex items-center space-x-3 p-4 bg-white/[0.02] rounded-2xl border border-white/5">
                                    <div
                                        class="w-4 h-4 rounded shadow-inner {{ $task->status === 'completed' ? 'bg-green-500' : 'bg-white/10' }}">
                                    </div>
                                    <span
                                        class="text-sm font-medium {{ $task->status === 'completed' ? 'text-gray-500 line-through' : 'text-white' }}">{{ $task->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                    <p class="text-gray-500 italic">Aucun projet ne vous a été assigné pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>