<section id="hero"
    class="{{ $isMobile ? 'pt-10 pb-6' : 'py-32' }} px-6 bg-gradient-to-br from-indigo-50 to-white overflow-hidden relative">
    <div class="{{ $isMobile ? 'text-center' : 'max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12' }}">
        <div class="{{ $isMobile ? '' : 'flex-1' }}">
            <h1
                class="{{ $isMobile ? 'text-3xl' : 'text-7xl' }} font-extrabold tracking-tight leading-tight text-gray-900 mb-6">
                Bienvenue sur <span class="text-primary">{{ $project->name }}</span>
            </h1>
            <p class="{{ $isMobile ? 'text-sm' : 'text-xl' }} text-gray-600 mb-8 max-w-2xl">
                @if($project->configuration->copywriting_brief)
                    {{ Str::limit($project->configuration->copywriting_brief, 200) }}
                @else
                    Ceci est une preview générée automatiquement pour votre projet de
                    <strong>{{ $project->projectType->name }}</strong>.
                    Imaginez vos clients ici.
                @endif
            </p>
            <div class="flex {{ $isMobile ? 'flex-col space-y-3' : 'space-x-4' }}">
                @if($project->projectType->category->slug === 'e-commerce')
                    <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'shop']) }}"
                        class="bg-primary text-white {{ $isMobile ? 'w-full' : 'px-8 py-4' }} rounded-custom font-bold shadow-custom active:scale-95 transition text-center inline-block">
                        Découvrir la boutique
                    </a>
                @elseif($project->projectType->category->slug === 'showcase' || $project->projectType->category->slug === 'portfolio')
                    <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'portfolio']) }}"
                        class="bg-primary text-white {{ $isMobile ? 'w-full' : 'px-8 py-4' }} rounded-custom font-bold shadow-custom active:scale-95 transition text-center inline-block">
                        Voir les projets
                    </a>
                @else
                    <button
                        class="bg-primary text-white {{ $isMobile ? 'w-full' : 'px-8 py-4' }} rounded-custom font-bold shadow-custom active:scale-95 transition">
                        Commencer maintenant
                    </button>
                @endif

                <a href="{{ route('preview.show', ['slug' => $project->preview_slug, 'page' => 'contact']) }}"
                    class="bg-white text-gray-900 border border-gray-200 {{ $isMobile ? 'w-full text-center' : 'px-8 py-4' }} rounded-custom font-bold active:scale-95 transition inline-block">
                    Nous contacter
                </a>
            </div>
        </div>
        @if(!$isMobile)
            <div class="flex-1 relative">
                <div
                    class="bg-primary/20 w-full aspect-video rounded-custom shadow-custom border-2 border-primary/10 relative z-10 overflow-hidden flex items-center justify-center text-primary text-4xl font-bold">
                    @if($project->configuration->logo_path)
                        <img src="{{ asset('storage/' . $project->configuration->logo_path) }}"
                            class="max-h-24 w-auto drop-shadow-2xl" alt="Mockup Logo">
                    @else
                        {{ $project->name }}
                    @endif
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400 rounded-full blur-3xl opacity-20"></div>
            </div>
        @endif
    </div>
</section>