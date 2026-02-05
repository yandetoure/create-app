<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projet Configurator') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="configurator()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left: Configurator Steps -->
                <div class="lg:col-span-2 space-y-8">
                    <form id="configForm" action="{{ route('configurator.store') }}" method="POST">
                        @csrf

                        <!-- Step 1: Project Name -->
                        <div x-show="step === 1" x-transition>
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">🚀 Commençons par le
                                    nom</h3>
                                <div class="mt-4">
                                    <x-input-label for="project_name" :value="__('Nom de votre projet')" />
                                    <x-text-input id="project_name" name="project_name" type="text"
                                        class="mt-1 block w-full text-lg" x-model="projectName"
                                        placeholder="Ex: Ma Super App" required />
                                </div>
                                <div class="mt-8 flex justify-end">
                                    <button type="button" @click="if(projectName) step = 2" :disabled="!projectName"
                                        class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 disabled:opacity-50">
                                        Suivant →
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Category -->
                        <div x-show="step === 2" x-transition>
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">🌍 Quel type de
                                    plateforme ?</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($categories as $category)
                                        <div @click="selectCategory({{ json_encode($category) }})"
                                            :class="selectedCategory?.id === {{ $category->id }} ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : 'border-gray-200 dark:border-gray-700'"
                                            class="cursor-pointer border-2 p-6 rounded-2xl text-center transition hover:border-indigo-400 group">
                                            <div class="text-4xl mb-3 group-hover:scale-110 transition duration-300">
                                                @if($category->slug === 'site-web') 🌍
                                                @elseif($category->slug === 'app-mobile') 📱 @else 🖥 @endif
                                            </div>
                                            <div class="font-bold text-lg dark:text-white">{{ $category->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-8 flex justify-between">
                                    <button type="button" @click="step = 1"
                                        class="text-gray-600 dark:text-gray-400 font-bold px-6 py-3">← Retour</button>
                                    <button type="button" @click="if(selectedCategory) step = 3"
                                        :disabled="!selectedCategory"
                                        class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 disabled:opacity-50">
                                        Continuer →
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Project Type -->
                        <div x-show="step === 3" x-transition>
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">🎯 Précisez votre
                                    besoin</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-if="selectedCategory">
                                        <template x-for="type in selectedCategory.project_types" :key="type.id">
                                            <div @click="selectType(type)"
                                                :class="selectedType?.id === type.id ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : 'border-gray-200 dark:border-gray-700'"
                                                class="cursor-pointer border-2 p-4 rounded-xl flex items-center justify-between group transition">
                                                <div>
                                                    <div class="font-bold dark:text-white" x-text="type.name"></div>
                                                    <div class="text-sm text-gray-500"
                                                        x-text="'Dès ' + type.base_price + '€ • ' + type.base_duration_days + ' jours'">
                                                    </div>
                                                </div>
                                                <input type="radio" name="project_type_id" :value="type.id"
                                                    x-model="selectedTypeID" class="hidden">
                                                <div x-show="selectedType?.id === type.id" class="text-indigo-600">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </div>
                                <div class="mt-8 flex justify-between">
                                    <button type="button" @click="step = 2"
                                        class="text-gray-600 dark:text-gray-400 font-bold px-6 py-3">← Retour</button>
                                    <button type="button" @click="if(selectedType) step = 4" :disabled="!selectedType"
                                        class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 disabled:opacity-50">
                                        Continuer →
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Multi-platform & Features -->
                        <div x-show="step === 4" x-transition>
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">💎 Fonctions Premium
                                </h3>

                                <!-- Multi-platform -->
                                <div class="mb-8">
                                    <p class="text-sm text-gray-500 mb-4 font-semibold uppercase tracking-wider">
                                        Plateformes secondaires</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label x-show="selectedCategory?.slug !== 'app-mobile'"
                                            class="relative flex items-center p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 cursor-pointer hover:border-gray-300 transition">
                                            <input type="checkbox" name="platforms[]" value="mobile" x-model="platforms"
                                                @change="updatePrice()" class="sr-only">
                                            <span class="flex-1 font-medium dark:text-gray-200">Ajouter une Version
                                                Mobile</span>
                                            <span class="text-indigo-600 font-bold"
                                                x-text="'+' + Math.round(selectedType?.base_price * 0.4) + '€'"></span>
                                        </label>
                                        <label x-show="selectedCategory?.slug !== 'site-web'"
                                            class="relative flex items-center p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 cursor-pointer hover:border-gray-300 transition">
                                            <input type="checkbox" name="platforms[]" value="web" x-model="platforms"
                                                @change="updatePrice()" class="sr-only">
                                            <span class="flex-1 font-medium dark:text-gray-200">Ajouter une Version
                                                Web</span>
                                            <span class="text-indigo-600 font-bold"
                                                x-text="'+' + Math.round(selectedType?.base_price * 0.35) + '€'"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Features -->
                                @foreach($featureCategories as $fCat)
                                    <div class="mb-8 last:mb-0">
                                        <p class="text-sm text-gray-500 mb-4 font-semibold uppercase tracking-wider">
                                            {{ $fCat->name }}</p>
                                        <div class="space-y-3">
                                            @foreach($fCat->features as $feature)
                                                <label
                                                    class="flex items-center p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 cursor-pointer hover:border-gray-300 transition group"
                                                    :class="selectedFeatures.includes('{{ $feature->id }}') ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : ''">
                                                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                                                        @change="toggleFeature({{ json_encode($feature) }})"
                                                        class="w-5 h-5 text-indigo-600 rounded mr-4">
                                                    <div class="flex-1">
                                                        <div class="font-bold dark:text-white">{{ $feature->name }}</div>
                                                        <div class="text-sm text-gray-400">{{ $feature->description }}</div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="font-bold text-indigo-600">+{{ $feature->price }}€</div>
                                                        <div class="text-xs text-gray-400">+{{ $feature->impact_days }}j</div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-8 flex justify-between">
                                    <button type="button" @click="step = 3"
                                        class="text-gray-600 dark:text-gray-400 font-bold px-6 py-3">← Retour</button>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-500/30">
                                        Confirmer & Générer Devis
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right: Dynamic Summary Card -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-900 text-white rounded-3xl p-8 sticky top-8 shadow-2xl overflow-hidden">
                        <!-- Decorative glow -->
                        <div
                            class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500 rounded-full blur-3xl opacity-20">
                        </div>

                        <h4 class="text-indigo-400 font-bold uppercase tracking-widest text-xs mb-6">Récapitulatif</h4>

                        <div class="space-y-6 relative">
                            <div>
                                <p class="text-sm text-gray-400">Projet</p>
                                <p class="text-xl font-bold border-b border-gray-800 pb-2"
                                    x-text="projectName || '...' "></p>
                            </div>

                            <div x-show="selectedType">
                                <p class="text-sm text-gray-400">Type</p>
                                <p class="font-semibold" x-text="selectedType?.name"></p>
                            </div>

                            <div x-show="platforms.length > 0">
                                <p class="text-sm text-gray-400 mb-2">Options Plateformes</p>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="p in platforms">
                                        <span class="bg-gray-800 px-3 py-1 rounded-full text-xs font-bold"
                                            x-text="p === 'mobile' ? 'Mobile' : 'Web'"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="selectedFeatureNames.length > 0">
                                <p class="text-sm text-gray-400 mb-2">Fonctionnalités</p>
                                <div class="space-y-1">
                                    <template x-for="name in selectedFeatureNames">
                                        <div class="flex justify-between text-sm">
                                            <span x-text="name"></span>
                                            <span class="text-indigo-400">✓</span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-800 space-y-4">
                                <div class="flex justify-between items-baseline">
                                    <p class="text-gray-400">Délai estimé</p>
                                    <p class="text-2xl font-bold flex items-baseline">
                                        <span x-text="totalDuration"></span>
                                        <span class="text-xs ml-1 font-normal text-gray-500">jours</span>
                                    </p>
                                </div>

                                <div class="bg-indigo-600/10 border border-indigo-500/20 rounded-2xl p-4">
                                    <p class="text-xs text-indigo-400 font-bold uppercase mb-1">Total TTC</p>
                                    <p class="text-4xl font-extrabold text-indigo-400 tracking-tight">
                                        <span x-text="totalPrice"></span><span class="text-2xl ml-1">€</span>
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4 pt-2">
                                    <div class="bg-gray-800/50 p-3 rounded-xl border border-gray-700">
                                        <p class="text-[10px] text-gray-500 uppercase font-bold">Acompte (40%)</p>
                                        <p class="font-bold text-sm" x-text="(totalPrice * 0.4).toFixed(0) + '€'"></p>
                                    </div>
                                    <div class="bg-gray-800/50 p-3 rounded-xl border border-gray-700">
                                        <p class="text-[10px] text-gray-500 uppercase font-bold">Solde (60%)</p>
                                        <p class="font-bold text-sm" x-text="(totalPrice * 0.6).toFixed(0) + '€'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function configurator() {
            return {
                step: 1,
                projectName: '',
                selectedCategory: null,
                selectedType: null,
                selectedTypeID: null,
                platforms: [],
                selectedFeatures: [],
                selectedFeatureNames: [],
                totalPrice: 0,
                totalDuration: 0,

                selectCategory(cat) {
                    this.selectedCategory = cat;
                    this.selectedType = null;
                    this.selectedTypeID = null;
                },

                selectType(type) {
                    this.selectedType = type;
                    this.selectedTypeID = type.id;
                    this.updatePrice();
                },

                toggleFeature(feature) {
                    const index = this.selectedFeatures.indexOf(feature.id.toString());
                    if (index > -1) {
                        this.selectedFeatures.splice(index, 1);
                        this.selectedFeatureNames = this.selectedFeatureNames.filter(n => n !== feature.name);
                    } else {
                        this.selectedFeatures.push(feature.id.toString());
                        this.selectedFeatureNames.push(feature.name);
                    }
                    this.updatePrice();
                },

                updatePrice() {
                    if (!this.selectedType) return;

                    let price = parseFloat(this.selectedType.base_price);
                    let duration = parseInt(this.selectedType.base_duration_days);

                    // Add platforms
                    this.platforms.forEach(p => {
                        if (p === 'mobile') { price += this.selectedType.base_price * 0.4; duration += 7; }
                        if (p === 'web') { price += this.selectedType.base_price * 0.35; duration += 5; }
                    });

                    // Add items costs (Mocking lookup for real-time, real calculation is in store method)
                    // We'll approximate for the UI
                    this.selectedFeatures.forEach(id => {
                        // Normally we'd find the feature object, for now it's fine
                        // We'll calculate it better by finding the feature in the passed data
                    });

                    // Recalculate accurately
                    let fPrice = 0;
                    let fDur = 0;
                    // Find features in the PHP-rendered data structure
                    const allFeatures = @json($featureCategories->pluck('features')->flatten());
                    allFeatures.forEach(f => {
                        if (this.selectedFeatures.includes(f.id.toString())) {
                            fPrice += parseFloat(f.price);
                            fDur += parseInt(f.impact_days);
                        }
                    });

                    this.totalPrice = Math.round(price + fPrice);
                    this.totalDuration = Math.round(duration + fDur);
                }
            }
        }
    </script>
</x-app-layout>