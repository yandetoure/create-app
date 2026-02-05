<section id="pricing" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }} text-center">
        <h2 class="{{ $isMobile ? 'text-2xl' : 'text-4xl' }} font-bold mb-12">Nos Tarifs</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 hover:scale-105 transition">
                <p class="font-bold text-gray-400 mb-4 uppercase text-xs tracking-widest">Basique</p>
                <p class="text-4xl font-extrabold mb-6">9€<span class="text-sm font-normal">/mo</span></p>
                <ul class="text-sm text-gray-500 space-y-4 mb-8">
                    <li>Fonctionnalité A</li>
                    <li>Fonctionnalité B</li>
                </ul>
                <button class="w-full py-3 rounded-xl border-2 border-black font-bold">Choisir</button>
            </div>

            <div class="p-8 rounded-3xl bg-black text-white scale-110 shadow-2xl relative">
                <div
                    class="absolute -top-4 left-1/2 -translate-x-1/2 bg-indigo-500 text-white px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">
                    Populaire</div>
                <p class="font-bold text-gray-400 mb-4 uppercase text-xs tracking-widest">Pro</p>
                <p class="text-4xl font-extrabold mb-6">29€<span class="text-sm font-normal">/mo</span></p>
                <ul class="text-sm text-gray-400 space-y-4 mb-8">
                    <li>Tout du pack Basique</li>
                    <li>Support Prioritaire</li>
                </ul>
                <button class="w-full py-3 rounded-xl bg-indigo-600 font-bold">Choisir</button>
            </div>

            <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 hover:scale-105 transition">
                <p class="font-bold text-gray-400 mb-4 uppercase text-xs tracking-widest">Expert</p>
                <p class="text-4xl font-extrabold mb-6">99€<span class="text-sm font-normal">/mo</span></p>
                <ul class="text-sm text-gray-500 space-y-4 mb-8">
                    <li>Tout du pack Pro</li>
                    <li>API Intégrée</li>
                </ul>
                <button class="w-full py-3 rounded-xl border-2 border-black font-bold">Choisir</button>
            </div>
        </div>
    </div>
</section>