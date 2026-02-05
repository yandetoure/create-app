<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projet : ') }} {{ $project->name }}
            </h2>
            <div class="space-x-4">
                <a href="{{ route('preview.show', $project->preview_slug) }}" target="_blank"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-indigo-500/30">
                    👁️ Voir la Preview
                </a>
                <a href="{{ route('projects.pdf', $project) }}"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold border border-gray-700">
                    📄 Télécharger PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status & High level info -->
                <div class="md:col-span-2 space-y-6">
                    <div
                        class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="bg-indigo-100 dark:bg-indigo-900/30 p-3 rounded-xl text-indigo-600 text-2xl">
                                🏗️
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold dark:text-white">Configuration validée</h3>
                                <p class="text-gray-500">Référence : {{ $project->quote->reference }}</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                    {{ $project->status }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase font-bold">Prix Total</p>
                                <p class="text-xl font-bold dark:text-white">
                                    {{ number_format($project->total_price, 0) }}€
                                </p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase font-bold">Délai estimé</p>
                                <p class="text-xl font-bold dark:text-white">{{ $project->total_duration }} jours</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase font-bold">Acompte</p>
                                <p class="text-xl font-bold text-indigo-600">
                                    {{ number_format($project->quote->deposit_amount, 0) }}€
                                </p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase font-bold">Type</p>
                                <p class="text-xl font-bold dark:text-white">{{ $project->projectType->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Features List -->
                    <div
                        class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h4 class="text-lg font-bold mb-6 dark:text-white">Détails de la solution</h4>
                        <div class="space-y-4">
                            <!-- Base Type -->
                            <div class="flex items-start p-4 rounded-xl bg-gray-50 dark:bg-gray-900/50">
                                <div
                                    class="w-10 h-10 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-4">
                                    ✓
                                </div>
                                <div>
                                    <p class="font-bold dark:text-white">Base: {{ $project->projectType->name }}</p>
                                    <p class="text-sm text-gray-500">Structure logicielle de base optimisée pour
                                        {{ $project->projectType->category->name }}
                                    </p>
                                </div>
                            </div>

                            @foreach($project->features as $feature)
                                <div class="flex items-start p-4 rounded-xl bg-gray-50 dark:bg-gray-900/50">
                                    <div
                                        class="w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mr-4">
                                        +
                                    </div>
                                    <div>
                                        <p class="font-bold dark:text-white">{{ $feature->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $feature->description }}</p>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <p class="font-bold text-indigo-600">+{{ number_format($feature->price, 0) }}€</p>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($project->platforms as $platform)
                                <div
                                    class="flex items-start p-4 rounded-xl border-2 border-indigo-100 dark:border-indigo-900/30">
                                    <div
                                        class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center mr-4">
                                        📱
                                    </div>
                                    <div>
                                        <p class="font-bold dark:text-white">Multi-plateforme :
                                            {{ ucfirst($platform->platform_type) }}
                                        </p>
                                        <p class="text-sm text-gray-500">Adaptation et déploiement spécifique</p>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <p class="font-bold text-indigo-600">
                                            +{{ number_format($platform->additional_price, 0) }}€</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Payment Modal/Info -->
                <div class="space-y-6">
                    <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-xl">
                        <h4 class="text-indigo-200 font-bold uppercase text-xs mb-4">Modalités de paiement</h4>
                        <div class="space-y-6">
                            <div>
                                <p class="text-3xl font-extrabold mb-1">
                                    {{ number_format($project->quote->deposit_amount, 0) }}€
                                </p>
                                <p class="text-indigo-200 text-sm">Acompte à régler pour démarrer (40%)</p>
                            </div>
                            <div class="pt-6 border-t border-indigo-500 space-y-4">
                                <button
                                    class="w-full bg-white text-indigo-600 font-bold py-4 rounded-2xl hover:bg-gray-100 transition shadow-lg">
                                    Payer l'acompte par Carte
                                </button>
                                <p class="text-[10px] text-center text-indigo-200 opacity-70">
                                    Paiement sécurisé via Stripe. Facture générée automatiquement après paiement.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h5 class="font-bold mb-4 dark:text-white">Timeline estimée</h5>
                        <div class="relative pl-6 border-l-2 border-indigo-100 dark:border-indigo-900">
                            <div class="mb-4 relative">
                                <span
                                    class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-indigo-600 ring-4 ring-white dark:ring-gray-800"></span>
                                <p class="font-bold text-sm dark:text-white text-indigo-600">Configuration terminée</p>
                                <p class="text-xs text-gray-400">Aujourd'hui</p>
                            </div>
                            <div class="mb-4 relative">
                                <span
                                    class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-gray-200 dark:bg-gray-700 ring-4 ring-white dark:ring-gray-800"></span>
                                <p class="font-bold text-sm dark:text-white">Validation technique</p>
                                <p class="text-xs text-gray-400">J+1</p>
                            </div>
                            <div class="relative">
                                <span
                                    class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-gray-200 dark:bg-gray-700 ring-4 ring-white dark:ring-gray-800"></span>
                                <p class="font-bold text-sm dark:text-white">Livraison projet</p>
                                <p class="text-xs text-gray-400">J+{{ $project->total_duration }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>