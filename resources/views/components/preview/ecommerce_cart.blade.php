<section id="cart" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-gray-50 min-h-[60vh]">
    <div class="{{ $isMobile ? '' : 'max-w-4xl mx-auto' }}">
        <div class="bg-white rounded-custom shadow-custom overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Votre Panier</h2>
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">2 articles</span>
            </div>

            <div class="p-8 space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                        <img src="https://picsum.photos/seed/p1/200/200" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold">Produit Premium A</h4>
                        <p class="text-sm text-gray-400">Taille: L | Couleur: Noir</p>
                    </div>
                    <p class="font-bold text-primary">25.000 FCFA</p>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                        <img src="https://picsum.photos/seed/p2/200/200" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold">Pack Découverte</h4>
                        <p class="text-sm text-gray-400">Édition Limitée</p>
                    </div>
                    <p class="font-bold text-primary">12.500 FCFA</p>
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500">Sous-total</span>
                    <span class="text-2xl font-black">37.500 FCFA</span>
                </div>
                <button
                    class="w-full bg-primary text-white py-4 rounded-custom font-bold shadow-lg shadow-primary/20 active:scale-95 transition">
                    Passer à la caisse
                </button>
            </div>
        </div>
    </div>
</section>