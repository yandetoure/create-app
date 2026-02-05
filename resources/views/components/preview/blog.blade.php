<section id="blog" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }}">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="{{ $isMobile ? 'text-2xl' : 'text-3xl' }} font-bold mb-2">Notre Blog</h2>
                <p class="text-gray-500">Dernières actualités.</p>
            </div>
            @if(!$isMobile)
                <a href="#" class="text-primary font-bold">Tout voir →</a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group cursor-pointer">
                <div
                    class="bg-primary/10 aspect-video rounded-custom mb-4 overflow-hidden group-hover:opacity-80 transition flex items-center justify-center shadow-custom">
                    <span class="text-primary text-2xl">📸</span>
                </div>
                <p class="text-[10px] text-primary font-bold mb-2">Technologie</p>
                <h3 class="font-bold text-lg mb-2">Titre de l'article de démo</h3>
                <p class="text-sm text-gray-400">Petit extrait court pour simuler le contenu du blog...</p>
            </div>
            <div class="{{ $isMobile ? 'hidden' : '' }} group cursor-pointer">
                <div
                    class="bg-pink-100 aspect-video rounded-custom mb-4 overflow-hidden group-hover:opacity-80 transition flex items-center justify-center shadow-custom">
                    <span class="text-pink-600 text-2xl">🎨</span>
                </div>
                <p class="text-[10px] text-pink-600 font-bold mb-2">Design</p>
                <h3 class="font-bold text-lg mb-2">Comment optimiser vos conversions</h3>
                <p class="text-sm text-gray-400">Quelques conseils pratiques pour votre projet.</p>
            </div>
            <div class="{{ $isMobile ? 'hidden' : '' }} group cursor-pointer">
                <div
                    class="bg-orange-100 aspect-video rounded-custom mb-4 overflow-hidden group-hover:opacity-80 transition flex items-center justify-center shadow-custom">
                    <span class="text-orange-600 text-2xl">📈</span>
                </div>
                <p class="text-[10px] text-orange-600 font-bold mb-2">Business</p>
                <h3 class="font-bold text-lg mb-2">Lancer sa startup en 2024</h3>
                <p class="text-sm text-gray-400">Les étapes clés de la réussite.</p>
            </div>
        </div>
    </div>
</section>