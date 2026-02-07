<x-dashboard-layout>
    <div class="space-y-8">
        <!-- Back Button -->
        <a href="{{ route('client.projects.templates.index', $project) }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour aux templates</span>
        </a>

        <!-- Template Header -->
        <div
            class="bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-[2rem] p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h2 class="text-4xl font-black tracking-tight mb-3">{{ $template->name }}</h2>
                    <p class="text-gray-400">{{ $template->description }}</p>
                </div>
                <span class="px-6 py-3 bg-purple-500/20 text-purple-400 rounded-2xl text-sm font-bold">
                    {{ ucfirst($template->category) }}
                </span>
            </div>

            <!-- Template Image -->
            @if($template->preview_image)
                <img src="{{ asset('storage/' . $template->preview_image) }}" alt="{{ $template->name }}"
                    class="w-full max-w-4xl rounded-2xl border border-white/10">
            @endif
        </div>

        <!-- Live Preview -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-black flex items-center space-x-2">
                    <span>👁️</span>
                    <span>Aperçu en Direct</span>
                </h3>
                <a href="{{ route('templates.live-preview', $template) }}" target="_blank"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition text-sm">
                    🔍 Voir en Plein Écran
                </a>
            </div>
            
            <div class="bg-black/40 rounded-2xl overflow-hidden border border-white/10">
                <iframe 
                    src="{{ route('templates.live-preview', $template) }}" 
                    class="w-full h-[600px] bg-white"
                    frameborder="0"
                    loading="lazy"
                ></iframe>
            </div>
            <p class="text-xs text-gray-500 mt-4 text-center">
                💡 Cliquez sur "Voir en Plein Écran" pour une meilleure expérience
            </p>
        </div>

        <!-- Components List -->
        @if($template->components->count() > 0)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
                    <span>🧩</span>
                    <span>Composants Inclus ({{ $template->components->count() }})</span>
                </h3>

                <div class="space-y-4">
                    @php
                        $componentsBySection = $template->components->groupBy('pivot.section_name');
                    @endphp

                    @foreach($componentsBySection as $sectionName => $sectionComponents)
                        <div class="bg-black/20 rounded-2xl p-6">
                            <h4 class="text-lg font-bold mb-4 text-indigo-400">
                                {{ ucfirst($sectionName) }}
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($sectionComponents as $component)
                                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-bold mb-1">{{ $component->name }}</h5>
                                                @if($component->description)
                                                    <p class="text-xs text-gray-500">{{ $component->description }}</p>
                                                @endif
                                            </div>
                                            <span
                                                class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg text-xs font-bold ml-3">
                                                {{ \App\Models\Component::getTypes()[$component->type] ?? $component->type }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Select Template Button -->
        @if($project->template_id !== $template->id)
            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 text-center">
                <h3 class="text-2xl font-black mb-4">Prêt à utiliser ce template ?</h3>
                <p class="text-gray-400 mb-6">Ce template sera appliqué à votre projet "{{ $project->name }}"</p>

                <form action="{{ route('client.projects.templates.select', $project) }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ $template->id }}">
                    <button type="submit"
                        class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 rounded-2xl font-black text-lg transition">
                        ✨ Choisir ce Template
                    </button>
                </form>
            </div>
        @else
            <div class="bg-green-500/10 border border-green-500/20 rounded-[2rem] p-8 text-center">
                <span class="text-6xl mb-4 block">✓</span>
                <h3 class="text-2xl font-black mb-2 text-green-400">Template Actuel</h3>
                <p class="text-gray-400">Ce template est déjà utilisé pour votre projet</p>
            </div>
        @endif
    </div>
</x-dashboard-layout>