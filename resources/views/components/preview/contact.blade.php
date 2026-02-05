<section id="contact" class="{{ $isMobile ? 'py-10' : 'py-24' }} px-6 bg-white">
    <div class="{{ $isMobile ? '' : 'max-w-3xl mx-auto' }}">
        <div class="text-center mb-12">
            <h2 class="{{ $isMobile ? 'text-2xl' : 'text-4xl' }} font-bold mb-4">Contactez-nous</h2>
            <p class="text-gray-500">Un projet à nous soumettre ? Remplissez ce formulaire.</p>
        </div>

        <form class="space-y-4">
            <div>
                <input type="text" placeholder="Votre Nom"
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-600 outline-none transition">
            </div>
            <div>
                <input type="email" placeholder="Email"
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-600 outline-none transition">
            </div>
            <div>
                <textarea rows="4" placeholder="Votre message..."
                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-600 outline-none transition"></textarea>
            </div>
            <button type="button"
                class="w-full bg-black text-white py-4 rounded-2xl font-bold hover:bg-gray-800 transition">
                Envoyer
            </button>
        </form>
    </div>
</section>