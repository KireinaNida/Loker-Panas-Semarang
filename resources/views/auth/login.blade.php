<x-guest-layout>
    <!-- Header Inside Card -->
    <div class="mb-6 text-center">
        <h1 class="font-display text-2xl font-bold text-panas-dark">Masuk ke Akun</h1>
        <p class="text-sm text-panas-dark/60 mt-1">Lowongan kerja terbaru di Semarang menunggumu.</p>
    </div>

    <!-- Session / Flash Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('error'))
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium flex items-center gap-2">
            <span>⚠️</span> {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
            <x-text-input id="email" 
                          class="block w-full px-4 py-3 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          placeholder="nama@email.com"
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" value="Kata Sandi" class="font-semibold text-panas-dark text-xs uppercase tracking-wider" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-panas-ember hover:text-panas-ember-dark font-medium transition-colors" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                          class="block w-full px-4 py-3 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm"
                          type="password"
                          name="password"
                          placeholder="••••••••"
                          required 
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="rounded border-panas-border text-panas-ember shadow-sm focus:ring-panas-ember" name="remember">
                <span class="ms-2 text-xs font-medium text-panas-dark/70">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 px-6 rounded-xl font-semibold text-sm bg-panas-ember hover:bg-panas-ember-dark text-white shadow-panas-glow transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-2">
            <span>Masuk Sekarang</span>
            <span>&rarr;</span>
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-6 text-center text-xs text-panas-dark/60 font-medium">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-panas-ember font-bold hover:underline">Daftar Akun Baru</a>
    </div>
</x-guest-layout>