<section id="contact" class="{{ $isMobile ? 'py-10' : 'py-24' }} px-6 bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-3xl mx-auto' }}">
        <div class="text-center mb-12">
            <h2 class="{{ $isMobile ? 'text-2xl' : 'text-4xl' }} font-bold mb-4">
                @if($project->projectType->category->slug === 'e-commerce')
                    Une question sur nos produits ?
                @elseif($project->projectType->category->slug === 'service')
                    Demander une consultation
                @else
                    Contactez-nous
                @endif
            </h2>
            <p class="text-gray-500">
                @if($project->projectType->category->slug === 'e-commerce')
                    Notre équipe support est là pour vous aider.
                @else
                    Un projet à nous soumettre ? Remplissez ce formulaire.
                @endif
            </p>
        </div>

        <form class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="Votre Nom"
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-custom focus:ring-2 focus:ring-primary outline-none transition">
                <input type="email" placeholder="Email"
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-custom focus:ring-2 focus:ring-primary outline-none transition">
            </div>
            <div>
                <textarea rows="4" placeholder="Votre message..."
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-custom focus:ring-2 focus:ring-primary outline-none transition"></textarea>
            </div>

            @if($project->configuration->contact_phone || $project->configuration->contact_email || $project->configuration->opening_hours)
                <div class="mt-8 p-6 bg-gray-50 rounded-custom grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                    @if($project->configuration->contact_phone)
                        <div class="flex items-center space-x-3 text-gray-600">
                            <span class="text-primary">📞</span>
                            <span>{{ $project->configuration->contact_phone }}</span>
                        </div>
                    @endif
                    @if($project->configuration->contact_email)
                        <div class="flex items-center space-x-3 text-gray-600">
                            <span class="text-primary">📧</span>
                            <span>{{ $project->configuration->contact_email }}</span>
                        </div>
                    @endif
                    @if($project->configuration->opening_hours)
                        <div class="flex items-center space-x-3 text-gray-600">
                            <span class="text-primary">⏰</span>
                            <span>{{ $project->configuration->opening_hours }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <button type="button"
                class="w-full bg-primary text-white py-4 rounded-custom font-bold hover:opacity-90 transition shadow-lg shadow-primary/20">
                Envoyer
            </button>
        </form>
    </div>
</section>