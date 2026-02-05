<section id="map" class="{{ $isMobile ? 'py-6 px-4' : 'py-20 px-8' }} bg-gray-50">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }}">
        <div class="flex items-center space-x-4 mb-8">
            <span class="text-3xl">📍</span>
            <h2 class="{{ $isMobile ? 'text-xl' : 'text-3xl' }} font-bold">Localisation & Tracking</h2>
        </div>

        <div
            class="bg-primary/10 rounded-custom h-64 md:h-96 flex items-center justify-center border-4 border-white shadow-custom overflow-hidden relative">
            <!-- Mock Map Background -->
            <div
                class="absolute inset-0 opacity-40 bg-[url('https://api.mapbox.com/styles/v1/mapbox/light-v10/static/0,0,1/400x400')] bg-cover">
            </div>
            <div class="relative z-10 text-primary bg-white px-6 py-2 rounded-full font-bold shadow-custom">
                Composant Carte Interactif Activé
            </div>
        </div>
    </div>
</section>