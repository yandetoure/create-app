<section id="hero"
    class="{{ $isMobile ? 'pt-10 pb-6' : 'py-32' }} px-6 bg-gradient-to-br from-indigo-50 to-white overflow-hidden relative">
    <div class="{{ $isMobile ? 'text-center' : 'max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12' }}">
        <div class="{{ $isMobile ? '' : 'flex-1' }}">
            <h1
                class="{{ $isMobile ? 'text-3xl' : 'text-7xl' }} font-extrabold tracking-tight leading-tight text-gray-900 mb-6">
                Bienvenue sur <span class="text-indigo-600">{{ $project->name }}</span>
            </h1>
            <p class="{{ $isMobile ? 'text-sm' : 'text-xl' }} text-gray-600 mb-8 max-w-2xl">
                Ceci est une preview générée automatiquement pour votre projet de
                <strong>{{ $project->projectType->name }}</strong>.
                Imaginez vos clients ici.
            </p>
            <div class="flex {{ $isMobile ? 'flex-col space-y-3' : 'space-x-4' }}">
                <button
                    class="bg-indigo-600 text-white {{ $isMobile ? 'w-full' : 'px-8 py-4' }} rounded-xl font-bold shadow-xl shadow-indigo-600/20 active:scale-95 transition">
                    Commencer maintenant
                </button>
                <button
                    class="bg-white text-gray-900 border border-gray-200 {{ $isMobile ? 'w-full' : 'px-8 py-4' }} rounded-xl font-bold active:scale-95 transition">
                    En savoir plus
                </button>
            </div>
        </div>
        @if(!$isMobile)
            <div class="flex-1 relative">
                <div
                    class="bg-indigo-600 w-full aspect-video rounded-3xl shadow-2xl relative z-10 overflow-hidden flex items-center justify-center text-white text-4xl font-bold opacity-20">
                    Visual Mockup Here
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400 rounded-full blur-3xl opacity-20"></div>
            </div>
        @endif
    </div>
</section>