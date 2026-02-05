<x-guest-layout>
    <div
        class="w-full max-w-xl bg-white/5 backdrop-blur-2xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
        <div
            class="absolute -top-10 -left-10 w-32 h-32 bg-indigo-600/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-1000">
        </div>

        <div class="relative z-10">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Créer un compte</h1>
            <p class="text-gray-500 mb-8 text-sm">Rejoignez la révolution du configurateur digital.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Nom
                            complet</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            autocomplete="name"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email"
                            class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required
                            autocomplete="username"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Role Selection (Visual for now) -->
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Vous êtes ?</label>
                    <div class="grid grid-cols-2 gap-4" x-data="{ selected: 'client' }">
                        <label @click="selected = 'client'"
                            :class="selected === 'client' ? 'border-indigo-500 bg-indigo-600/10' : 'border-white/5 bg-white/5'"
                            class="flex flex-col items-center p-4 rounded-2xl border cursor-pointer transition">
                            <input type="radio" name="role" value="client" class="hidden" checked>
                            <span class="text-2xl mb-1">💼</span>
                            <span class="font-bold text-sm">Client</span>
                        </label>
                        <label @click="selected = 'developer'"
                            :class="selected === 'developer' ? 'border-indigo-500 bg-indigo-600/10' : 'border-white/5 bg-white/5'"
                            class="flex flex-col items-center p-4 rounded-2xl border cursor-pointer transition">
                            <input type="radio" name="role" value="developer" class="hidden">
                            <span class="text-2xl mb-1">👨‍💻</span>
                            <span class="font-bold text-sm">Développeur</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Mot
                            de passe</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation"
                            class="text-xs font-bold uppercase tracking-widest text-gray-500 pl-1">Confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none placeholder:text-gray-700">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 py-5 rounded-2xl font-bold text-lg hover:bg-indigo-700 shadow-xl shadow-indigo-600/20 active:scale-[0.98] transition duration-200">
                        S'inscrire
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500">Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-indigo-400 font-bold hover:text-indigo-300 transition">Se
                        connecter</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>