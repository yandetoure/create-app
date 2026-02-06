<x-dashboard-layout>
    <x-slot name="title">Mes Projets</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">Projets Assignés</h2>
                <p class="text-gray-400 mt-2">Gérez vos projets et suivez leur progression</p>
            </div>
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/10">
                <span class="text-2xl font-black">{{ $projects->count() }}</span>
                <span class="text-sm text-gray-400 ml-2">projet(s)</span>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($projects as $project)
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
                                        {{ $project->name }}
                                    </h3>
                                    <p class="text-gray-400 text-sm">Client: <span
                                            class="text-white">{{ $project->user->name }}</span> •
                                        {{ $project->projectType->name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Progress Bar -->
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

                            <!-- Task Summary -->
                            <div class="mt-6 flex items-center space-x-6 text-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <span
                                        class="text-gray-400">{{ $project->tasks->where('status', 'in_progress')->count() }}
                                        en cours</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                    <span class="text-gray-400">{{ $completedTasks }} terminées</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                                    <span class="text-gray-400">{{ $project->tasks->where('status', 'pending')->count() }}
                                        en attente</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <a href="{{ route('developer.projects.edit', $project) }}"
                                class="bg-yellow-600/10 text-yellow-400 px-6 py-3 rounded-2xl font-bold hover:bg-yellow-600 hover:text-white transition">
                                Ajouter des infos
                            </a>
                            <a href="{{ route('developer.projects.show', $project) }}"
                                class="bg-indigo-600/10 text-indigo-400 px-6 py-3 rounded-2xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Voir le projet
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-500 italic">Aucun projet ne vous a été assigné pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>