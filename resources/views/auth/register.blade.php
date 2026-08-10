<x-guest-layout>
    <!-- Header Inside Card -->
    <div class="mb-6 text-center">
        <h1 class="font-display text-2xl font-bold text-panas-dark">Buat Akun Baru</h1>
        <p class="text-sm text-panas-dark/60 mt-1">Bergabung untuk melamar lowongan impianmu di Semarang.</p>
    </div>

    @if (session('error'))
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium flex items-center gap-2">
            <span>⚠️</span> {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
            <x-text-input id="name" 
                          class="block w-full px-4 py-3 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          placeholder="Nama lengkap Anda"
                          required 
                          autofocus 
                          autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

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
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Kata Sandi" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
            <x-text-input id="password" 
                          class="block w-full px-4 py-3 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm"
                          type="password"
                          name="password"
                          placeholder="Minimal 8 karakter"
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
            <x-text-input id="password_confirmation" 
                          class="block w-full px-4 py-3 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm"
                          type="password"
                          name="password_confirmation" 
                          placeholder="Ulangi kata sandi"
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 px-6 rounded-xl font-semibold text-sm bg-panas-ember hover:bg-panas-ember-dark text-white shadow-panas-glow transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-2 mt-2">
            <span>Daftar Akun</span>
            <span>&rarr;</span>
        </button>
    </form>

    <!-- Visual Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-panas-border"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="bg-white px-3 text-panas-dark/40 font-medium">atau daftar dengan</span>
        </div>
    </div>

    <!-- Google Register Button -->
    <div>
        <a href="{{ route('auth.google.redirect') }}" class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-white border border-panas-border rounded-xl font-semibold text-sm text-panas-dark hover:bg-panas-cream hover:border-panas-ember/30 transition-all duration-200 shadow-panas-sm hover:shadow-md active:scale-[0.98]">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            Daftar dengan Google
        </a>
    </div>

    <!-- Login Link -->
    <div class="mt-6 text-center text-xs text-panas-dark/60 font-medium">
        Sudah memiliki akun? 
        <a href="{{ route('login') }}" class="text-panas-ember font-bold hover:underline">Masuk Sekarang</a>
    </div>
</x-guest-layout>
