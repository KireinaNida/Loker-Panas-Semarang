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

        <!-- Grid: Nama Lengkap & Nama Panggilan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- Nama Lengkap -->
            <div>
                <x-input-label for="name" value="Nama Lengkap" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="name" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                              type="text" 
                              name="name" 
                              :value="old('name')" 
                              placeholder="Nama lengkap sesuai KTP"
                              required 
                              autofocus 
                              autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Nama Panggilan -->
            <div>
                <x-input-label for="nama_panggilan" value="Nama Panggilan" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="nama_panggilan" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                              type="text" 
                              name="nama_panggilan" 
                              :value="old('nama_panggilan')" 
                              placeholder="Nama panggilan"
                              required />
                <x-input-error :messages="$errors->get('nama_panggilan')" class="mt-1" />
            </div>
        </div>

        <!-- Grid: Tanggal Lahir & Jenis Kelamin -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- Tanggal Lahir -->
            <div>
                <x-input-label for="tgl_lahir" value="Tanggal Lahir" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="tgl_lahir" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                              type="date" 
                              name="tgl_lahir" 
                              :value="old('tgl_lahir')" 
                              required />
                <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-1" />
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <select id="jenis_kelamin" 
                        name="jenis_kelamin" 
                        class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm text-slate-800"
                        required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1" />
            </div>
        </div>

        <!-- Grid: No Telepon & Email -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- No Telepon / WhatsApp -->
            <div>
                <x-input-label for="no_telepon" value="Nomor HP / WhatsApp" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="no_telepon" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                              type="tel" 
                              name="no_telepon" 
                              :value="old('no_telepon')" 
                              placeholder="Contoh: 081234567890"
                              required />
                <x-input-error :messages="$errors->get('no_telepon')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Alamat Email" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="email" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              placeholder="nama@email.com"
                              required 
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
        </div>

        <!-- Grid: Password & Confirm Password -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- Password -->
            <div>
                <x-input-label for="password" value="Kata Sandi" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="password" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm"
                              type="password"
                              name="password"
                              placeholder="Minimal 8 karakter"
                              required 
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Ulangi Kata Sandi" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5" />
                <x-text-input id="password_confirmation" 
                              class="block w-full px-4 py-2.5 rounded-xl border-panas-border bg-panas-light/40 focus:bg-white focus:border-panas-ember focus:ring-2 focus:ring-panas-ember/20 transition-all text-sm"
                              type="password"
                              name="password_confirmation" 
                              placeholder="Ulangi kata sandi"
                              required 
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 px-6 rounded-xl font-semibold text-sm bg-panas-ember hover:bg-panas-ember-dark text-white shadow-panas-glow transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-2 mt-4 cursor-pointer">
            <span>Daftar Akun Baru</span>
            <span>&rarr;</span>
        </button>
    </form>

    <!-- Login Link -->
    <div class="mt-6 text-center text-xs text-panas-dark/60 font-medium">
        Sudah memiliki akun? 
        <a href="{{ route('login') }}" class="text-panas-ember font-bold hover:underline">Masuk Sekarang</a>
    </div>
</x-guest-layout>
