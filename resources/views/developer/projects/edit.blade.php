<x-dashboard-layout>
    <x-slot name="title">Modifier - {{ $project->name }}</x-slot>

    <div class="space-y-8">
        <!-- Back Button -->
        <a href="{{ route('developer.projects.show', $project) }}"
            class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-bold">Retour au projet</span>
        </a>

        <!-- Page Header -->
        <div>
            <h2 class="text-3xl font-black tracking-tight">Ajouter des informations</h2>
            <p class="text-gray-400 mt-2">Ajoutez des liens de déploiement, des démos et des commentaires</p>
        </div>

        <!-- Deployment URLs Form -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <h3 class="text-2xl font-black mb-6">🚀 Liens de Déploiement</h3>

            <form method="POST" action="{{ route('developer.projects.update-info', $project) }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">URL de Production</label>
                    <input type="url" name="deployment_url"
                        value="{{ old('deployment_url', $project->deployment_url) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="https://example.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">URL de Staging</label>
                    <input type="url" name="staging_url" value="{{ old('staging_url', $project->staging_url) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="https://staging.example.com">
                </div>

                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">
                    Enregistrer les liens
                </button>
            </form>
        </div>

        <!-- Demo Upload Form -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <h3 class="text-2xl font-black mb-6">🎬 Ajouter une Démo</h3>

            <form method="POST" action="{{ route('developer.projects.upload-demo', $project) }}"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Photo ou Vidéo</label>
                    <input type="file" name="demo_file" accept="image/*,video/*" required
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <p class="text-xs text-gray-500 mt-2">Images (JPG, PNG, GIF) ou Vidéos (MP4, MOV, AVI) - Max 50MB
                    </p>
                </div>

                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">
                    Uploader la démo
                </button>
            </form>
        </div>

        <!-- Add Comment Form -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
            <h3 class="text-2xl font-black mb-6">💬 Ajouter un Commentaire</h3>

            <form method="POST" action="{{ route('developer.projects.add-comment', $project) }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Votre commentaire</label>
                    <textarea name="comment" rows="4" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="Décrivez votre progression, les défis rencontrés, etc."></textarea>
                </div>

                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">
                    Ajouter le commentaire
                </button>
            </form>
        </div>
    </div>
</x-dashboard-layout>