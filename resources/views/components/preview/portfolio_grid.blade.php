<section id="portfolio" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }}">
        <div class="text-center mb-16">
            <h2 class="{{ $isMobile ? 'text-2xl' : 'text-4xl' }} font-bold mb-4">Mises en avant</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Découvrez quelques-unes de nos réalisations les plus marquantes.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-1 grid-flow-row-dense">
            <div class="lg:col-span-2 lg:row-span-2 relative aspect-[16/9] lg:aspect-auto overflow-hidden rounded-custom shadow-custom group">
                <img src="https://picsum.photos/seed/port1/1200/800" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Work 1">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-8">
                    <p class="text-primary font-bold text-xs uppercase tracking-widest mb-2">Design Web</p>
                    <h3 class="text-white text-2xl font-bold">Projet d'Identité Visuelle</h3>
                </div>
            </div>
            <div class="relative aspect-square overflow-hidden rounded-custom shadow-custom group">
                <img src="https://picsum.photos/seed/port2/600/600" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Work 2">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                    <p class="text-primary font-bold text-[10px] uppercase tracking-widest mb-1">Mobile App</p>
                    <h4 class="text-white font-bold">Concept Interface</h4>
                </div>
            </div>
            <div class="relative aspect-square overflow-hidden rounded-custom shadow-custom group">
                <img src="https://picsum.photos/seed/port3/600/600" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Work 3">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                    <p class="text-primary font-bold text-[10px] uppercase tracking-widest mb-1">Branding</p>
                    <h4 class="text-white font-bold">Packaging Durable</h4>
                </div>
            </div>
        </div>
    </div>
</section>
