<x-app-layout>
    <div class="min-h-screen bg-[#020617] text-white font-['Outfit'] antialiased overflow-x-hidden" x-data="configurator()">
        
        <!-- Background Orbs -->
        <div class="fixed top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        <div class="fixed bottom-0 left-0 w-[300px] h-[300px] bg-indigo-500/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Header/Progression -->
            <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-tighter mb-2">Configurateur</h2>
                    <p class="text-gray-400">Étape <span x-text="step" class="text-indigo-400 font-bold"></span> sur 4</p>
                </div>
                
                <div class="flex items-center space-x-2">
                    <template x-for="i in 4">
                        <div class="h-1.5 rounded-full transition-all duration-500"
                             :class="step >= i ? 'w-12 bg-indigo-600' : 'w-6 bg-white/10'"></div>
                    </template>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start text-base">

                <!-- Main area: Steps -->
                <div class="lg:col-span-2">
                    <form id="configForm" action="{{ route('configurator.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_type_id" :value="selectedTypeID">
                        <template x-for="p in platforms">
                            <input type="hidden" name="platforms[]" :value="p">
                        </template>
                        <template x-for="f in selectedFeatures">
                            <input type="hidden" name="features[]" :value="f">
                        </template>

                        <!-- Step 1: Identity -->
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                                <h3 class="text-3xl font-bold mb-8 flex items-center">
                                    <span class="w-12 h-12 rounded-2xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center mr-4 text-xl">01</span>
                                    Quel est le nom du projet ?
                                </h3>
                                <div class="space-y-4">
                                    <label class="text-sm font-bold text-gray-500 uppercase tracking-widest pl-1">Identité</label>
                                    <input type="text" x-model="projectName" name="project_name"
                                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-xl font-medium focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700"
                                           placeholder="Ex: MySaaS Platform">
                                </div>
                                <div class="mt-12 flex justify-end">
                                    <button type="button" @click="if(projectName) step = 2"
                                            class="group bg-indigo-600 px-8 py-5 rounded-2xl font-bold flex items-center hover:bg-indigo-700 transition disabled:opacity-30"
                                            :disabled="!projectName">
                                        Continuer
                                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Platform -->
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                                <h3 class="text-3xl font-bold mb-8 flex items-center">
                                    <span class="w-12 h-12 rounded-2xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center mr-4 text-xl">02</span>
                                    Choisissez la plateforme
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                    @foreach($categories as $category)
                                        <div @click="selectCategory({{ json_encode($category) }})"
                                             class="relative cursor-pointer group rounded-3xl border transition-all duration-300 p-8 flex flex-col items-center text-center overflow-hidden"
                                             :class="selectedCategory?.id === {{ $category->id }} ? 'bg-indigo-600 border-indigo-500 shadow-xl shadow-indigo-600/20 translate-y-[-4px]' : 'bg-white/5 border-white/5 hover:border-white/20'">
                                            <div class="text-5xl mb-6 transform group-hover:scale-110 transition duration-500">
                                                @if($category->slug === 'site-web') 🌍
                                                @elseif($category->slug === 'app-mobile') 📱 @else 🖥 @endif
                                            </div>
                                            <span class="font-bold text-lg" x-cloak>{{ $category->name }}</span>
                                            <div x-show="selectedCategory?.id === {{ $category->id }}" class="absolute top-4 right-4 text-white">
                                                 <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-12 flex justify-between">
                                    <button type="button" @click="step = 1" class="text-gray-500 font-bold px-8 hover:text-white transition">← Retour</button>
                                    <button type="button" @click="if(selectedCategory) step = 3"
                                            class="bg-indigo-600 px-8 py-5 rounded-2xl font-bold flex items-center hover:bg-indigo-700 transition disabled:opacity-30"
                                            :disabled="!selectedCategory">
                                        Suivant
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Specific Type -->
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                                <h3 class="text-3xl font-bold mb-8 flex items-center">
                                    <span class="w-12 h-12 rounded-2xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center mr-4 text-xl">03</span>
                                    Détails du projet
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-if="selectedCategory">
                                        <template x-for="type in selectedCategory.project_types" :key="type.id">
                                            <div @click="selectType(type)"
                                                :class="selectedType?.id === type.id ? 'border-indigo-500 bg-indigo-600/20' : 'border-white/5 bg-white/5 hover:border-white/20'"
                                                class="cursor-pointer border px-6 py-5 rounded-2xl flex items-center justify-between group transition duration-300">
                                                <div>
                                                    <div class="font-bold text-lg mb-1" x-text="type.name"></div>
                                                    <div class="text-sm text-gray-500" x-text="'Dès ' + type.base_price + '€ • ±' + type.base_duration_days + ' jours'"></div>
                                                </div>
                                                <div x-show="selectedType?.id === type.id" class="text-indigo-400">
                                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </div>
                                <div class="mt-12 flex justify-between">
                                    <button type="button" @click="step = 2" class="text-gray-500 font-bold px-8 hover:text-white transition">← Retour</button>
                                    <button type="button" @click="if(selectedType) step = 4"
                                            class="bg-indigo-600 px-8 py-5 rounded-2xl font-bold flex items-center hover:bg-indigo-700 transition disabled:opacity-30"
                                            :disabled="!selectedType">
                                        Suivant
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Add-ons -->
                        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                                <h3 class="text-3xl font-bold mb-4 flex items-center">
                                    <span class="w-12 h-12 rounded-2xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center mr-4 text-xl">04</span>
                                    Modules & Options
                                </h3>
                                <p class="text-gray-500 mb-10">Personnalisez votre projet avec des fonctionnalités premium.</p>

                                <!-- Platforms -->
                                <div class="mb-12">
                                    <h4 class="text-xs font-bold uppercase tracking-widest text-indigo-400 mb-6">Multi-Plateforme</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <label x-show="selectedCategory?.slug !== 'app-mobile'"
                                            class="flex items-center p-6 rounded-2xl border cursor-pointer border-white/5 bg-white/5 transition"
                                            :class="platforms.includes('mobile') ? 'border-indigo-500 bg-indigo-600/10' : 'hover:border-white/20'">
                                            <input type="checkbox" value="mobile" x-model="platforms" @change="updatePrice()" class="sr-only">
                                            <div class="flex-1">
                                                <div class="font-bold">Application iOS/Android</div>
                                                <div class="text-xs text-gray-500 mt-1">Version native compilée</div>
                                            </div>
                                            <div class="text-indigo-400 font-bold">+<span x-text="Math.round(selectedType?.base_price * 0.4)"></span>€</div>
                                        </label>
                                        <label x-show="selectedCategory?.slug !== 'site-web'"
                                            class="flex items-center p-6 rounded-2xl border cursor-pointer border-white/5 bg-white/5 transition"
                                            :class="platforms.includes('web') ? 'border-indigo-500 bg-indigo-600/10' : 'hover:border-white/20'">
                                            <input type="checkbox" value="web" x-model="platforms" @change="updatePrice()" class="sr-only">
                                            <div class="flex-1">
                                                <div class="font-bold">Accès Web Browser</div>
                                                <div class="text-xs text-gray-500 mt-1">Responsive Desktop</div>
                                            </div>
                                            <div class="text-indigo-400 font-bold">+<span x-text="Math.round(selectedType?.base_price * 0.35)"></span>€</div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Features -->
                                @foreach($featureCategories as $fCat)
                                    <div class="mb-12 last:mb-0">
                                        <h4 class="text-xs font-bold uppercase tracking-widest text-indigo-400 mb-6">{{ $fCat->name }}</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                            @foreach($fCat->features as $feature)
                                                <label class="flex items-center p-6 rounded-2xl border cursor-pointer border-white/5 bg-white/5 transition"
                                                       :class="selectedFeatures.includes('{{ $feature->id }}') ? 'border-indigo-500 bg-indigo-600/10' : 'hover:border-white/20'">
                                                    <input type="checkbox" @change="toggleFeature({{ json_encode($feature) }})" class="sr-only">
                                                    <div class="flex-1">
                                                        <div class="font-bold">{{ $feature->name }}</div>
                                                        <div class="text-xs text-gray-500 mt-1">{{ $feature->description }}</div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-indigo-400 font-bold">+{{ round($feature->price) }}€</div>
                                                        <div class="text-[10px] text-gray-500">+{{ $feature->impact_days }}j</div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-12 flex justify-between">
                                    <button type="button" @click="step = 3" class="text-gray-500 font-bold px-8 hover:text-white transition">← Retour</button>
                                    <button type="submit"
                                            class="bg-white text-black px-12 py-5 rounded-2xl font-bold shadow-xl shadow-white/5 hover:bg-gray-200 transition">
                                        Finaliser & Devis →
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Sidebar: Recalculated Summary -->
                <aside class="lg:sticky lg:top-24 space-y-6">
                    <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-2xl overflow-hidden relative group">
                        <!-- Design dots -->
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-black/20 rounded-full blur-3xl"></div>

                        <div class="relative z-10">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-white/50 mb-8">Devis Estimé</h4>
                            
                            <div class="space-y-6">
                                <template x-if="projectName">
                                    <div>
                                        <p class="text-[10px] font-bold uppercase text-white/40 mb-1">Candidat</p>
                                        <p class="text-2xl font-bold truncate" x-text="projectName"></p>
                                    </div>
                                </template>

                                <div class="pt-6 border-t border-white/10 space-y-4">
                                    <div class="flex justify-between items-end">
                                        <p class="text-sm font-medium text-white/60 italic">Livraison</p>
                                        <p class="text-3xl font-black">±<span x-text="totalDuration"></span>j</p>
                                    </div>
                                    
                                    <div class="pt-4 flex flex-col">
                                        <p class="text-[10px] font-bold uppercase text-white/40 mb-1">Montant Total HT</p>
                                        <p class="text-6xl font-black tracking-tighter" x-text="totalPrice + '€'"></p>
                                    </div>
                                </div>

                                <div class="pt-6 grid grid-cols-2 gap-4">
                                    <div class="bg-black/20 rounded-2xl p-4">
                                        <p class="text-[9px] text-white/30 uppercase font-black">Acompte (40%)</p>
                                        <p class="font-bold" x-text="(totalPrice * 0.4).toFixed(0) + '€'"></p>
                                    </div>
                                    <div class="bg-black/20 rounded-2xl p-4">
                                        <p class="text-[9px] text-white/30 uppercase font-black">Solde (60%)</p>
                                        <p class="font-bold" x-text="(totalPrice * 0.6).toFixed(0) + '€'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Tips -->
                    <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 hidden md:block">
                        <div class="flex items-start space-x-4">
                            <div class="bg-yellow-500/10 text-yellow-500 p-2 rounded-lg">💡</div>
                            <p class="text-sm text-gray-400">Chaque option est modifiable ultérieurement avec votre conseiller dédié.</p>
                        </div>
                    </div>
                </aside>

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
                    this.platforms = [];
                    this.updatePrice();
                },

                selectType(type) {
                    this.selectedType = type;
                    this.selectedTypeID = type.id;
                    this.updatePrice();
                },

                toggleFeature(feature) {
                    const idStr = feature.id.toString();
                    const index = this.selectedFeatures.indexOf(idStr);
                    if (index > -1) {
                        this.selectedFeatures.splice(index, 1);
                        this.selectedFeatureNames = this.selectedFeatureNames.filter(n => n !== feature.name);
                    } else {
                        this.selectedFeatures.push(idStr);
                        this.selectedFeatureNames.push(feature.name);
                    }
                    this.updatePrice();
                },

                updatePrice() {
                    if (!this.selectedType) {
                        this.totalPrice = 0;
                        this.totalDuration = 0;
                        return;
                    }

                    let price = parseFloat(this.selectedType.base_price);
                    let duration = parseInt(this.selectedType.base_duration_days);

                    // Add platforms multipliers
                    this.platforms.forEach(p => {
                        if (p === 'mobile') { price += this.selectedType.base_price * 0.4; duration += 7; }
                        if (p === 'web') { price += this.selectedType.base_price * 0.35; duration += 5; }
                    });

                    // Match features
                    let fPrice = 0;
                    let fDur = 0;
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