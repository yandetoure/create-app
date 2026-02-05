<section id="products" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }}">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="{{ $isMobile ? 'text-2xl' : 'text-4xl' }} font-bold mb-2">Notre Boutique</h2>
                <p class="text-gray-500">Découvrez nos produits sélectionnés pour vous.</p>
            </div>
            <div class="flex space-x-2">
                <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-xs font-bold shadow-sm">Nouveaux</span>
                <span class="px-4 py-2 bg-gray-100 text-gray-500 rounded-full text-xs font-bold">Populaires</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($mockData['products'] ?? [] as $product)
                <div class="group">
                    <div class="relative aspect-square mb-4 overflow-hidden rounded-custom shadow-custom bg-gray-100">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-x-4 bottom-4 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300">
                            <button class="w-full bg-black text-white py-3 rounded-xl font-bold text-sm shadow-xl active:scale-95 transition">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $product['name'] }}</h3>
                            <p class="text-sm text-gray-500">Catégorie Premium</p>
                        </div>
                        <p class="font-black text-primary">{{ $product['price'] }} FCFA</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
