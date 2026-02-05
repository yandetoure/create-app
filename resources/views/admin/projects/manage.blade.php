<x-dashboard-layout>
    <x-slot name="title">Gestion du Projet : {{ $project->name }}</x-slot>

    <div class="space-y-12">
        <!-- Team Assignment Section -->
        <div class="bg-white/5 border border-white/10 rounded-[3rem] p-10 shadow-2xl backdrop-blur-md">
            <h4 class="text-xl font-black mb-8 italic flex items-center space-x-3">
                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Assignation de l'Équipe</span>
            </h4>

            <form action="{{ route('admin.projects.assign', $project) }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Développeur
                        Principal</label>
                    <select name="developer_id"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none text-white">
                        <option value="">Non assigné</option>
                        @foreach($developers as $dev)
                            <option value="{{ $dev->id }}" {{ $project->developer_id == $dev->id ? 'selected' : '' }}
                                class="bg-gray-900">{{ $dev->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Chef de Projet
                        (PM)</label>
                    <select name="project_manager_id"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none text-white">
                        <option value="">Non assigné</option>
                        @foreach($projectManagers as $pm)
                            <option value="{{ $pm->id }}" {{ $project->project_manager_id == $pm->id ? 'selected' : '' }}
                                class="bg-gray-900">{{ $pm->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Community Manager
                        (CM)</label>
                    <select name="community_manager_id"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none text-white">
                        <option value="">Non assigné</option>
                        @foreach($communityManagers as $cm)
                            <option value="{{ $cm->id }}" {{ $project->community_manager_id == $cm->id ? 'selected' : '' }}
                                class="bg-gray-900">{{ $cm->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 px-10 py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20 active:scale-95">
                        Enregistrer l'équipe
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Tasks Management -->
            <div class="space-y-6">
                <div class="flex justify-between items-center px-2">
                    <h4 class="text-sm font-black uppercase tracking-widest text-white">Tâches & Avancement</h4>
                    <span
                        class="px-3 py-1 bg-white/5 rounded-full text-[10px] font-black text-indigo-400">{{ $project->tasks->count() }}
                        Tâches</span>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-[3rem] p-8 space-y-6">
                    <!-- New Task Form -->
                    <form action="{{ route('admin.tasks.store', $project) }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="name" placeholder="Nom de la tâche..."
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition"
                            required>
                        <div class="grid grid-cols-2 gap-4">
                            <select name="assigned_to"
                                class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs outline-none focus:border-indigo-500 transition text-white">
                                <option value="">Assigner à...</option>
                                @if($project->developer)
                                    <option value="{{ $project->developer_id }}">{{ $project->developer->name }} (Dev)
                                </option> @endif
                                @if($project->projectManager)
                                    <option value="{{ $project->project_manager_id }}">{{ $project->projectManager->name }}
                                (PM)</option> @endif
                                @if($project->communityManager)
                                    <option value="{{ $project->community_manager_id }}">
                                {{ $project->communityManager->name }} (CM)</option> @endif
                            </select>
                            <select name="priority"
                                class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs outline-none focus:border-indigo-500 transition text-white">
                                <option value="low">Priorité Basse</option>
                                <option value="medium" selected>Priorité Moyenne</option>
                                <option value="high">Priorité Haute</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full py-3 bg-white/10 rounded-2xl font-bold text-xs hover:bg-indigo-600 transition">Ajouter
                            la tâche</button>
                    </form>

                    <!-- Task List -->
                    <div class="space-y-3">
                        @foreach($project->tasks as $task)
                            <div
                                class="group bg-white/[0.02] border border-white/5 p-4 rounded-2xl flex items-center justify-between hover:bg-white/5 transition">
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('admin.tasks.update-status', $task) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="bg-transparent text-[10px] font-black uppercase tracking-widest {{ $task->status == 'completed' ? 'text-green-400' : 'text-indigo-400' }} outline-none cursor-pointer">
                                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}
                                                class="bg-slate-900">En attente</option>
                                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}
                                                class="bg-slate-900">En cours</option>
                                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}
                                                class="bg-slate-900">Terminée</option>
                                        </select>
                                    </form>
                                    <div>
                                        <p
                                            class="text-sm font-bold {{ $task->status == 'completed' ? 'line-through text-gray-600' : 'text-white' }}">
                                            {{ $task->name }}</p>
                                        <p class="text-[9px] text-gray-500">
                                            @if($task->assignedUser) Assigné à <span
                                            class="text-indigo-400">{{ $task->assignedUser->name }}</span> @endif
                                            • <span
                                                class="{{ $task->priority == 'high' ? 'text-red-400' : ($task->priority == 'medium' ? 'text-yellow-400' : 'text-blue-400') }}">{{ strtoupper($task->priority) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Deliverables & Links -->
            <div class="space-y-6">
                <h4 class="text-sm font-black uppercase tracking-widest text-white px-2">Livrables & Ressources</h4>

                <div class="bg-white/5 border border-white/10 rounded-[3rem] p-8 space-y-6">
                    <!-- New Deliverable Form -->
                    <form action="{{ route('admin.deliverables.store', $project) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <select name="type"
                                class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs outline-none focus:border-indigo-500 transition text-white">
                                <option value="github">Lien GitHub</option>
                                <option value="figma">Maquette (Figma/Adobe)</option>
                                <option value="logo">Lien Logo</option>
                                <option value="photo">Photos / Assets</option>
                                <option value="doc">Cahier des charges</option>
                                <option value="deployment">Lien Déploiement</option>
                                <option value="code">Lien Code Source</option>
                            </select>
                            <input type="text" name="label" placeholder="Libellé (ex: V1.0 Backend)"
                                class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs outline-none focus:border-indigo-500 transition"
                                required>
                        </div>
                        <input type="url" name="url" placeholder="URL (https://...)"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs outline-none focus:border-indigo-500 transition">
                        <button type="submit"
                            class="w-full py-3 bg-white/10 rounded-2xl font-bold text-xs hover:bg-green-600 transition">Enregistrer
                            le livrable</button>
                    </form>

                    <!-- Deliverable List -->
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($project->deliverables as $del)
                            <a href="{{ $del->url }}" target="_blank"
                                class="group flex items-center justify-between p-5 bg-white/[0.02] border border-white/5 rounded-2xl hover:bg-white/10 transition">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-indigo-600/20 flex items-center justify-center text-indigo-400">
                                        @if($del->type == 'github') <svg class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                            </svg>
                                        @elseif($del->type == 'figma') <svg class="w-5 h-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        @else <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.803a4 4 0 015.656 0l4 4a4 4 0 11-5.656 5.656l-1.102-1.101" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-white">{{ $del->label }}</p>
                                        <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest">
                                            {{ $del->type }}</p>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-gray-700 group-hover:text-white transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>