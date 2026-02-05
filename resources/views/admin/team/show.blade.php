<x-dashboard-layout>
    <x-slot name="title">Profil de l'Équipe : {{ $user->name }}</x-slot>

    <div class="space-y-12">
        <!-- Profile Header -->
        <div
            class="bg-white/5 border border-white/10 rounded-[3.5rem] p-12 shadow-2xl backdrop-blur-md relative overflow-hidden">
            <div class="absolute top-0 right-0 p-12">
                <span
                    class="px-6 py-2 rounded-full bg-indigo-600/20 text-indigo-400 text-xs font-black uppercase tracking-widest border border-indigo-600/30">
                    {{ $user->roles->first()->name ?? 'Membre' }}
                </span>
            </div>

            <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
                <div
                    class="w-32 h-32 rounded-3xl bg-indigo-600 flex items-center justify-center text-5xl font-black italic shadow-2xl shadow-indigo-600/20">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="text-center md:text-left">
                    <h2 class="text-4xl font-black italic mb-2 tracking-tight">{{ $user->name }}</h2>
                    <p class="text-gray-400 font-bold mb-6 italic">{{ $user->email }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                        <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/5">
                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">Total Projets
                            </p>
                            <p class="text-xl font-black italic leading-none">
                                {{ $user->projects->count() + $user->managedProjects->count() + $user->communityProjects->count() }}
                            </p>
                        </div>
                        <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/5">
                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">Tâches
                                Assignées</p>
                            <p class="text-xl font-black italic leading-none">{{ $user->assignedTasks->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Projects Column -->
            <div class="lg:col-span-2 space-y-8">
                <h3 class="text-sm font-black uppercase tracking-widest text-white px-2 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span>Projets Assignés</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $allProjects = collect([])
                            ->merge($user->projects)
                            ->merge($user->managedProjects)
                            ->merge($user->communityProjects)
                            ->unique('id');
                    @endphp

                    @forelse($allProjects as $project)
                        <div
                            class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 hover:bg-white/10 transition group">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h4 class="text-lg font-black italic group-hover:text-indigo-400 transition">
                                        {{ $project->name }}</h4>
                                    <span
                                        class="text-[10px] text-gray-500 font-black uppercase tracking-widest">{{ $project->projectType->name }}</span>
                                </div>
                                <span
                                    class="px-3 py-1 bg-indigo-600/20 text-indigo-400 text-[10px] font-black rounded-full uppercase">
                                    {{ $project->status }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-400 italic">Assigné comme :
                                    @if($project->developer_id == $user->id) Dev @endif
                                    @if($project->project_manager_id == $user->id) PM @endif
                                    @if($project->community_manager_id == $user->id) CM @endif
                                </span>
                                <a href="{{ route('admin.projects.manage', $project) }}"
                                    class="text-indigo-400 hover:text-white transition text-xs font-black italic">Gérer
                                    →</a>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-2 text-center py-12 bg-white/5 rounded-[2.5rem] border border-dashed border-white/10 italic text-gray-500">
                            Aucun projet assigné pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tasks Sidebar -->
            <div class="space-y-8">
                <h3 class="text-sm font-black uppercase tracking-widest text-white px-2 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Dernières Tâches</span>
                </h3>

                <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 space-y-4">
                    @forelse($user->assignedTasks->sortByDesc('created_at')->take(10) as $task)
                        <div class="p-4 bg-white/[0.02] border border-white/5 rounded-2xl">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest {{ $task->status == 'completed' ? 'text-green-400' : 'text-indigo-400' }}">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </span>
                                <span class="text-[9px] text-gray-500">{{ $task->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm font-bold text-white mb-1">{{ $task->name }}</p>
                            <p class="text-[10px] text-gray-500 italic">{{ $task->project->name }}</p>
                        </div>
                    @empty
                        <p class="text-center py-8 italic text-gray-500 text-xs">Aucune tâche assignée.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>