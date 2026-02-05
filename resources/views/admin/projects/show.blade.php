<x-dashboard-layout>
    <x-slot name="title">Détails du Projet: {{ $project->name }}</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-10 shadow-2xl">
                <div class="flex items-start justify-between mb-10">
                    <div class="flex items-center space-x-6">
                        <div
                            class="w-20 h-20 rounded-3xl bg-indigo-600/20 flex items-center justify-center text-3xl font-black text-indigo-400 border border-indigo-600/30">
                            {{ substr($project->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-3xl font-black">{{ $project->name }}</h2>
                            <p class="text-gray-400 font-bold uppercase text-xs tracking-widest mt-1">
                                {{ $project->projectType->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-black text-white">
                            {{ number_format($project->total_price, 0, ',', ' ') }} FCFA</div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Budget Total Estimé
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-widest text-indigo-400 mb-6">Fonctionnalités
                            incluses</h4>
                        <div class="space-y-4">
                            @foreach($project->features as $feature)
                                <div class="flex items-start space-x-3 group">
                                    <div class="w-5 h-5 rounded-lg bg-green-500/20 flex items-center justify-center mt-0.5">
                                        <svg class="w-3 h-3 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-white">{{ $feature->name }}</div>
                                        <p class="text-[10px] text-gray-500 line-clamp-1 italic">{{ $feature->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-black uppercase tracking-widest text-indigo-400 mb-6">Plateformes &
                            Durée</h4>
                        <div class="space-y-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->platforms as $plat)
                                    <span
                                        class="px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-xs font-black uppercase tracking-widest text-gray-300">
                                        {{ $plat->platform_type }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="p-6 bg-indigo-600/10 rounded-3xl border border-indigo-600/20">
                                <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-1">Durée
                                    Estimée</p>
                                <div class="text-3xl font-black">±{{ $project->total_duration }} jours</div>
                                <p class="text-xs text-indigo-300/60 mt-2 italic">* Basé sur la complexité des modules
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task Monitoring -->
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-10">
                <h3 class="text-xl font-bold mb-8">Monitoring des tâches ({{ $project->tasks->count() }})</h3>
                <div class="space-y-4">
                    @foreach($project->tasks as $task)
                        <div
                            class="flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-2xl hover:bg-white/[0.04] transition">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-2 h-2 rounded-full {{ $task->status === 'completed' ? 'bg-green-500' : ($task->status === 'in_progress' ? 'bg-blue-500' : 'bg-gray-700') }}">
                                </div>
                                <span
                                    class="text-sm font-bold {{ $task->status === 'completed' ? 'text-gray-500 line-through' : 'text-white' }}">{{ $task->name }}</span>
                            </div>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ $task->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar / Actions -->
        <div class="space-y-8">
            <!-- Assignment Card -->
            <div
                class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 shadow-2xl overflow-hidden relative group">
                <div
                    class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-600/20 blur-3xl opacity-0 group-hover:opacity-100 transition duration-700">
                </div>
                <h4 class="text-xs font-black uppercase tracking-widest text-indigo-400 mb-6 relative">Assignation &
                    Statut</h4>

                <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-6 relative">
                    @csrf
                    @method('PUT')

                    <div>
                        <label
                            class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2 block">Développeur
                            en charge</label>
                        <select name="developer_id"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none">
                            <option value="">Non assigné</option>
                            @foreach($developers as $dev)
                                <option value="{{ $dev->id }}" {{ $project->developer_id == $dev->id ? 'selected' : '' }}>
                                    {{ $dev->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2 block">État du
                            projet</label>
                        <select name="status"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm outline-none focus:border-indigo-500 transition appearance-none">
                            <option value="new" {{ $project->status === 'new' ? 'selected' : '' }}>Nouveau</option>
                            <option value="pending" {{ $project->status === 'pending' ? 'selected' : '' }}>En attente
                            </option>
                            <option value="in_progress" {{ $project->status === 'in_progress' ? 'selected' : '' }}>En
                                développement</option>
                            <option value="completed" {{ $project->status === 'completed' ? 'selected' : '' }}>Terminé
                            </option>
                            <option value="cancelled" {{ $project->status === 'cancelled' ? 'selected' : '' }}>Annulé
                            </option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 py-5 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-600/20 active:scale-95">
                        Mettre à jour
                    </button>
                </form>
            </div>

            <!-- Client Info Card -->
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-6">Informations Client</h4>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-xl font-black">
                        {{ substr($project->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold">{{ $project->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $project->user->email }}</div>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="mailto:{{ $project->user->email }}"
                        class="block text-center py-3 bg-white/5 rounded-xl text-xs font-bold hover:bg-white/10 transition">Envoyer
                        un Email</a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>