<x-dashboard-layout>
    <x-slot name="title">Livrables</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">Mes Livrables</h2>
                <p class="text-gray-400 mt-2">Gérez les livrables de vos projets</p>
            </div>
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/10">
                <span class="text-2xl font-black">{{ $deliverables->count() }}</span>
                <span class="text-sm text-gray-400 ml-2">livrable(s)</span>
            </div>
        </div>

        <!-- Deliverables List -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($deliverables as $deliverable)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-indigo-500/30 transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold mb-2">{{ $deliverable->name }}</h3>
                            <a href="{{ route('developer.projects.show', $deliverable->project) }}"
                                class="text-sm text-indigo-400 hover:text-indigo-300">
                                {{ $deliverable->project->name }}
                            </a>
                        </div>

                        <!-- Status Badge -->
                        @if($deliverable->status === 'delivered')
                            <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg text-xs font-bold">✓
                                Livré</span>
                        @elseif($deliverable->status === 'in_progress')
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-lg text-xs font-bold">⚡ En
                                cours</span>
                        @else
                            <span class="px-3 py-1 bg-gray-500/20 text-gray-400 rounded-lg text-xs font-bold">⏸ En
                                attente</span>
                        @endif
                    </div>

                    @if($deliverable->description)
                        <p class="text-gray-400 text-sm mb-4">{{ $deliverable->description }}</p>
                    @endif

                    <!-- Due Date -->
                    @if($deliverable->due_date)
                        <div class="flex items-center space-x-2 text-sm mb-4">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-400">Échéance: {{ $deliverable->due_date->format('d/m/Y') }}</span>
                        </div>
                    @endif

                    <!-- File Upload -->
                    @if($deliverable->status !== 'delivered')
                        <form method="POST" action="{{ route('developer.deliverables.upload', $deliverable) }}"
                            enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <input type="file" name="file"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                        </form>
                    @else
                        <a href="{{ asset('storage/' . $deliverable->file_path) }}" target="_blank"
                            class="inline-flex items-center space-x-2 text-sm text-indigo-400 hover:text-indigo-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Télécharger le fichier</span>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-2 text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 italic">Aucun livrable pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>