<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 w-full max-w-sm" :status="session('status')" />

    <div
        class="w-full max-w-md bg-white/5 backdrop-blur-2xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
        <!-- Abstract gradient for visual interest -->
        <div
            class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-600/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-1000">
        </div>

        <div class="relative z-10">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Bon retour</h1>
            <p class="text-gray-500 mb-10 text-sm">Prêt à configurer votre prochain chef-d'œuvre ?</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email"
                        class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Mot
                            de passe</label>
                        @if (Route::has('password.request'))
                            <a class="text-[11px] font-bold text-indigo-400 hover:text-indigo-300 transition"
                                href="{{ route('password.request') }}">
                                Oublié ?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox"
                            class="rounded-lg bg-white/5 border-white/10 text-indigo-600 focus:ring-indigo-500/20 w-5 h-5 transition"
                            name="remember">
                        <span class="ms-3 text-sm text-gray-400 group-hover:text-gray-300 transition">Se souvenir de
                            moi</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 py-5 rounded-2xl font-bold text-lg hover:bg-indigo-700 shadow-xl shadow-indigo-600/20 active:scale-[0.98] transition duration-200">
                        Se connecter
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500">Pas encore de compte ?
                    <a href="{{ route('register') }}"
                        class="text-indigo-400 font-bold hover:text-indigo-300 transition">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>