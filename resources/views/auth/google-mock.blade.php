<x-guest-layout>
    <!-- Header Inside Card -->
    <div class="mb-6 text-center">
        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 009 14a15.825 15.825 0 00-3-4.706V3.086c0-.83.682-1.464 1.498-1.323a18.2 18.2 0 0110.004 0c.816-.14 1.498.493 1.498 1.323v6.208c0 1.258-.38 2.47-1.087 3.493l-.226.327c-.28.406-.39.913-.3 1.4l.261 1.393c.123.659-.144 1.332-.69 1.699a13.3 13.3 0 01-5.186 2.05"/>
            </svg>
        </div>
        <h1 class="font-display text-2xl font-bold text-panas-dark">Developer Mock Login</h1>
        <p class="text-sm text-panas-dark/60 mt-1">Gunakan akun simulasi Google untuk masuk ke sistem.</p>
    </div>

    <!-- Alert Dev Mode -->
    <div class="mb-5 p-3.5 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-xs font-semibold leading-relaxed">
        🛠️ <strong>Mode Pengembang Aktif:</strong> Kredensial Google di file <code class="bg-amber-100/50 px-1 py-0.5 rounded">.env</code> Anda tidak valid atau tidak dikonfigurasi. Silakan pilih akun terdaftar atau masukkan email untuk mensimulasikan login Google.
    </div>

    <!-- Pilihan User Terdaftar -->
    <div class="space-y-3.5">
        <h3 class="font-bold text-xs uppercase text-slate-400 tracking-wider">Pilih Akun yang Sudah Terdaftar</h3>
        <div class="space-y-2 max-h-56 overflow-y-auto pr-1 scrollbar-thin">
            @forelse($users as $user)
                <form method="POST" action="{{ route('auth.google.mock-login') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <button type="submit" class="w-full flex items-center justify-between p-3 bg-slate-50 hover:bg-orange-50 border border-slate-100 hover:border-orange-200 rounded-xl transition-all text-left group">
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-slate-800 group-hover:text-orange-600 truncate">{{ $user->name }}</p>
                            <p class="text-[11px] text-slate-500 truncate">{{ $user->email }}</p>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold tracking-wider uppercase shrink-0 {{ $user->role === 'admin' ? 'bg-orange-100 text-orange-600' : 'bg-slate-200 text-slate-600' }}">
                            {{ $user->role }}
                        </span>
                    </button>
                </form>
            @empty
                <p class="text-xs text-slate-500 italic text-center py-4">Belum ada akun terdaftar.</p>
            @endforelse
        </div>

        <!-- Custom Mock Email -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-100"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="bg-white px-3 text-slate-400 font-semibold">atau buat akun Google baru</span>
            </div>
        </div>

        <form method="POST" action="{{ route('auth.google.mock-login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="mock_name" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5 block">Nama Lengkap</label>
                <input type="text" id="mock_name" name="name" placeholder="John Doe" required
                       class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all text-xs font-semibold">
            </div>

            <div>
                <label for="mock_email" class="font-semibold text-panas-dark text-xs uppercase tracking-wider mb-1.5 block">Alamat Email Google</label>
                <input type="email" id="mock_email" name="email" placeholder="johndoe@gmail.com" required
                       class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all text-xs font-semibold">
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl font-bold text-xs uppercase tracking-wider bg-orange-400 hover:bg-orange-500 text-white shadow-lg shadow-orange-400/20 transition-all active:scale-[0.98]">
                Simulasikan Pendaftaran Google
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('login') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 transition">
                &larr; Kembali ke Login Biasa
            </a>
        </div>
    </div>
</x-guest-layout>
