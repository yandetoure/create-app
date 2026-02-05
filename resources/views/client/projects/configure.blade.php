<x-dashboard-layout>
    <x-slot name="title">Configuration du Projet : {{ $project->name }}</x-slot>

    <form action="{{ route('client.projects.configure.update', $project) }}" method="POST" enctype="multipart/form-data"
        class="space-y-12">
        @csrf

        <!-- Design & Branding Section -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl backdrop-blur-md">
            <h3 class="text-xl font-black italic mb-8 flex items-center space-x-3 text-indigo-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.414-1.414a2 2 0 012.828 0l2.828 2.828a2 2 0 010 2.828l-1.414 1.414m-7.071-7.071L5.657 8.757a2 2 0 000 2.828l2.828 2.828a2 2 0 002.828 0l2.828-2.828a2 2 0 000-2.828L11 7.343z" />
                </svg>
                <span>Design & Branding</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Couleur
                        Primaire</label>
                    <input type="color" name="primary_color" value="{{ $configuration->primary_color ?? '#4f46e5' }}"
                        class="w-full h-12 rounded-xl bg-white/5 border border-white/10 cursor-pointer">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Couleur
                        Secondaire</label>
                    <input type="color" name="secondary_color"
                        value="{{ $configuration->secondary_color ?? '#10b981' }}"
                        class="w-full h-12 rounded-xl bg-white/5 border border-white/10 cursor-pointer">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Style de
                        Design</label>
                    <select name="design_style"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white font-bold">
                        <option value="modern" {{ ($configuration->design_style ?? '') == 'modern' ? 'selected' : '' }}>
                            Moderne & Épuré</option>
                        <option value="minimalist" {{ ($configuration->design_style ?? '') == 'minimalist' ? 'selected' : '' }}>Minimaliste</option>
                        <option value="corporate" {{ ($configuration->design_style ?? '') == 'corporate' ? 'selected' : '' }}>Professionnel / Corporate</option>
                        <option value="vibrant" {{ ($configuration->design_style ?? '') == 'vibrant' ? 'selected' : '' }}>
                            Vibrant & Créatif</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Nom de Domaine
                    Souhaité</label>
                <input type="text" name="domain_name" value="{{ $configuration->domain_name }}"
                    placeholder="ex: mon-entreprise.com"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white font-bold placeholder:text-white/20">
            </div>
        </div>

        <!-- Media Assets Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 shadow-2xl backdrop-blur-md">
                <h3 class="text-xl font-black italic mb-8 flex items-center space-x-3 text-pink-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Logos & Bannières</span>
                </h3>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Logo
                            (PNG/SVG)</label>
                        <input type="file" name="logo"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                        @if($configuration->logo_path)
                            <div class="mt-4 p-4 bg-white/5 rounded-2xl border border-white/10">
                                <img src="{{ asset('storage/' . $configuration->logo_path) }}" class="h-12 w-auto"
                                    alt="Logo actuel">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 shadow-2xl backdrop-blur-md">
                <h3 class="text-xl font-black italic mb-8 flex items-center space-x-3 text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Contact & Infos</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div class="space-y-2">
                        <label class="text-gray-500 font-bold uppercase tracking-widest">Téléphone</label>
                        <input type="text" name="contact_phone" value="{{ $configuration->contact_phone }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-2">
                        <label class="text-gray-500 font-bold uppercase tracking-widest">Email Public</label>
                        <input type="email" name="contact_email" value="{{ $configuration->contact_email }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3">
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Horaires
                        d'ouverture</label>
                    <input type="text" name="opening_hours" value="{{ $configuration->opening_hours }}"
                        placeholder="ex: Lun-Ven: 08h-18h"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3">
                </div>
            </div>
        </div>

        <!-- Copywriting & Form Section -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl backdrop-blur-md">
            <h3 class="text-xl font-black italic mb-8 flex items-center space-x-3 text-yellow-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Contenus & Services</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Brief de Copywriting
                        (Textes du site)</label>
                    <textarea name="copywriting_brief" rows="6"
                        class="w-full bg-white/5 border border-white/10 rounded-3xl p-6 text-white font-medium focus:ring-2 focus:ring-indigo-500 outline-none"
                        placeholder="Décrivez votre activité, vos valeurs et le ton que vous souhaitez employer...">{{ $configuration->copywriting_brief }}</textarea>
                </div>

                <div class="space-y-6">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Types de Formulaires
                        Souhaités</label>
                    <div class="grid grid-cols-1 gap-4">
                        @php
                            $forms = ['Contact Standard', 'Demande de Devis', 'Inscription Newsletter', 'Réservation / RDV', 'Recrutement'];
                            $selectedForms = $configuration->form_types ?? [];
                        @endphp
                        @foreach($forms as $form)
                            <label
                                class="flex items-center space-x-4 p-4 bg-white/5 border border-white/10 rounded-2xl cursor-pointer hover:bg-white/10 transition">
                                <input type="checkbox" name="form_types[]" value="{{ $form }}" {{ in_array($form, $selectedForms) ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500">
                                <span class="font-bold">{{ $form }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="sticky bottom-8 z-50">
            <div
                class="bg-indigo-600/20 border border-indigo-500/30 backdrop-blur-xl p-4 rounded-[2rem] flex items-center justify-between shadow-2xl">
                <div class="px-6 hidden md:block">
                    <p class="text-indigo-400 font-black italic">Prêt à donner vie à votre vision ?</p>
                    <p class="text-[10px] text-indigo-500 uppercase font-black tracking-widest">Enregistrez vos
                        préférences pour l'équipe</p>
                </div>
                <button type="submit"
                    class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-black italic px-12 py-4 rounded-2xl shadow-xl shadow-indigo-600/40 transition hover:scale-105">
                    Enregistrer la Configuration
                </button>
            </div>
        </div>
    </form>
</x-dashboard-layout>