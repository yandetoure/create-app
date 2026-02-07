<x-dashboard-layout>
    <div class="space-y-8">
        <!-- Back Button -->
        <a href="{{ route('client.projects.show', $project) }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour au projet</span>
        </a>

        <!-- Header -->
        <div
            class="bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-[2rem] p-8">
            <h2 class="text-4xl font-black tracking-tight mb-3">Choisir un Template</h2>
            <p class="text-gray-400">{{ $project->name }} - {{ $project->projectType->name }}</p>
        </div>

        <!-- Category Filter -->
        @if(count($categories) > 1)
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('client.projects.templates.index', $project) }}"
                    class="px-6 py-3 {{ !request('category') ? 'bg-indigo-600' : 'bg-white/5 hover:bg-white/10' }} rounded-xl font-bold transition">
                    Tous
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('client.projects.templates.index', ['project' => $project, 'category' => $category]) }}"
                        class="px-6 py-3 {{ request('category') === $category ? 'bg-indigo-600' : 'bg-white/5 hover:bg-white/10' }} rounded-xl font-bold transition">
                        {{ ucfirst($category) }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Templates Grid -->
        @if($templates->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($templates as $template)
                    <div
                        class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-indigo-500/50 transition group">
                        <!-- Template Image -->
                        @if($template->preview_image)
                            <img src="{{ asset('storage/' . $template->preview_image) }}" alt="{{ $template->name }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div
                                class="w-full h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                                <span class="text-6xl">🎨</span>
                            </div>
                        @endif

                        <!-- Template Info -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-black">{{ $template->name }}</h3>
                                @if($project->template_id === $template->id)
                                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg text-xs font-bold">
                                        ✓ Actuel
                                    </span>
                                @endif
                            </div>

                            @if($template->description)
                                <p class="text-gray-400 text-sm mb-4">{{ $template->description }}</p>
                            @endif

                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded">
                                    {{ ucfirst($template->category) }}
                                </span>
                                <span>{{ $template->components->count() }} composants</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-3">
                                <a href="{{ route('client.projects.templates.preview', [$project, $template]) }}"
                                    class="flex-1 px-4 py-2 bg-white/5 hover:bg-white/10 rounded-xl font-bold text-center transition">
                                    👁️ Aperçu
                                </a>
                                @if($project->template_id !== $template->id)
                                    <form action="{{ route('client.projects.templates.select', $project) }}" method="POST"
                                        class="flex-1">
                                        @csrf
                                        <input type="hidden" name="template_id" value="{{ $template->id }}">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                                            Choisir
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center">
                <span class="text-6xl mb-4 block">🎨</span>
                <h3 class="text-2xl font-black mb-2">Aucun template disponible</h3>
                <p class="text-gray-400">Aucun template n'est disponible pour ce type de projet.</p>
            </div>
        @endif
    </div>
</x-dashboard-layout>