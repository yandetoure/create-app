<x-dashboard-layout>
    <x-slot name="title">Livraison du Projet & Actifs</x-slot>

    <div
        class="flex flex-col items-center justify-center min-h-[60vh] text-center p-12 bg-white/5 border border-white/10 border-dashed rounded-[3rem]">
        <div
            class="w-24 h-24 bg-indigo-600/20 rounded-full flex items-center justify-center text-5xl mb-8 animate-pulse">
            🎁
        </div>
        <h3 class="text-3xl font-black mb-4">Espace des Livrables</h3>
        <p class="text-gray-500 max-w-md mx-auto mb-10 leading-relaxed font-medium">
            Ici, les administrateurs pourront déposer les fichiers finaux, les accès aux dépôts GitHub, et les liens de
            déploiement pour les clients.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl">
            <div class="p-6 bg-white/[0.03] rounded-3xl border border-white/5">
                <div class="text-indigo-400 text-2xl mb-4">📂</div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-2">Code Source</h4>
                <p class="text-[10px] text-gray-500">ZIP ou lien Repository</p>
            </div>
            <div class="p-6 bg-white/[0.03] rounded-3xl border border-white/5">
                <div class="text-green-400 text-2xl mb-4">🚀</div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-2">Déploiement</h4>
                <p class="text-[10px] text-gray-500">URL de production / staging</p>
            </div>
            <div class="p-6 bg-white/[0.03] rounded-3xl border border-white/5">
                <div class="text-yellow-400 text-2xl mb-4">📄</div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-2">Documentation</h4>
                <p class="text-[10px] text-gray-500">Guide utilisateur & technique</p>
            </div>
        </div>
    </div>
</x-dashboard-layout>