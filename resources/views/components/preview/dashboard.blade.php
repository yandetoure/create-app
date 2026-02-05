<section id="dashboard" class="{{ $isMobile ? 'py-10 px-4' : 'py-24 px-8' }} bg-gray-50">
    <div class="{{ $isMobile ? '' : 'max-w-7xl mx-auto' }}">
        <div class="mb-12">
            <h2 class="{{ $isMobile ? 'text-2xl' : 'text-3xl' }} font-bold mb-2">Tableau de bord</h2>
            <p class="text-gray-500">Statistiques en temps réel de votre activité.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-custom shadow-custom border border-gray-100">
                <p class="text-[10px] text-primary font-bold uppercase mb-1">Visites</p>
                <p class="text-xl font-bold">12,450</p>
            </div>
            <div class="bg-white p-4 rounded-custom shadow-custom border border-gray-100">
                <p class="text-[10px] text-primary font-bold uppercase mb-1">Ventes</p>
                <p class="text-xl font-bold">3,450 FCFA</p>
            </div>
            <div
                class="{{ $isMobile ? 'hidden' : '' }} bg-white p-4 rounded-custom shadow-custom border border-gray-100">
                <p class="text-[10px] text-primary font-bold uppercase mb-1">Utilisateurs</p>
                <p class="text-xl font-bold">890</p>
            </div>
            <div
                class="{{ $isMobile ? 'hidden' : '' }} bg-white p-4 rounded-custom shadow-custom border border-gray-100">
                <p class="text-[10px] text-primary font-bold uppercase mb-1">Conversion</p>
                <p class="text-xl font-bold">2.4%</p>
            </div>
        </div>

        <div
            class="bg-white p-8 rounded-custom shadow-custom border border-gray-100 h-64 flex flex-col items-center justify-center text-gray-300">
            <div class="text-6xl mb-4 text-primary opacity-20">📊</div>
            <p class="font-bold text-gray-400">Graphique d'évolution</p>
        </div>
    </div>
</section>