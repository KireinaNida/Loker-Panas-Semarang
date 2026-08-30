<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Info Loker Panas Semarang')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .icon { width: 1em; height: 1em; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; display: inline-block; vertical-align: middle; }
    </style>
</head>
<body class="font-sans antialiased text-slate-900 selection:bg-orange-400 selection:text-white min-h-screen flex flex-col justify-between pb-20 md:pb-0 relative overflow-x-hidden">

    <!-- Ambient Mesh Glow Blobs -->
    <div class="fixed top-0 left-1/4 w-[500px] h-[300px] bg-orange-400/5 rounded-full blur-[100px] pointer-events-none -z-10 animate-pulse"></div>
    <div class="fixed top-20 right-10 w-[400px] h-[300px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none -z-10"></div>

    <!-- SVG ICON LIBRARY -->
    <svg class="hidden" aria-hidden="true">
        <symbol id="icon-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></symbol>
        <symbol id="icon-pin" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></symbol>
        <symbol id="icon-cpu" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 1v3M15 1v3M9 20v3M15 20v3M1 9h3M1 15h3M20 9h3M20 15h3"/></symbol>
        <symbol id="icon-bar-chart" viewBox="0 0 24 24"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></symbol>
        <symbol id="icon-trending-up" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></symbol>
        <symbol id="icon-building" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/></symbol>
        <symbol id="icon-palette" viewBox="0 0 24 24"><circle cx="13.5" cy="6.5" r=".6" fill="currentColor" stroke="none"/><circle cx="17.5" cy="10.5" r=".6" fill="currentColor" stroke="none"/><circle cx="8.5" cy="7.5" r=".6" fill="currentColor" stroke="none"/><circle cx="6.5" cy="12.5" r=".6" fill="currentColor" stroke="none"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.9 0 1.6-.7 1.6-1.6 0-.4-.2-.8-.4-1.1-.3-.3-.4-.6-.4-1.1a1.6 1.6 0 0 1 1.6-1.6h2c3 0 5.5-2.5 5.5-5.5C21.9 6 17.4 2 12 2z"/></symbol>
        <symbol id="icon-headset" viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></symbol>
        <symbol id="icon-flame" viewBox="0 0 24 24"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></symbol>
        <symbol id="icon-check-circle" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></symbol>
        <symbol id="icon-chevron-right" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></symbol>
        <symbol id="icon-badge-check" viewBox="0 0 24 24"><path d="M12 2 4 6v6c0 5 3.5 8.5 8 10 4.5-1.5 8-5 8-10V6l-8-4Z"/><polyline points="9 12 11 14 15 10"/></symbol>
        <symbol id="icon-search-x" viewBox="0 0 24 24"><circle cx="10" cy="10" r="7"/><line x1="21" y1="21" x2="14.65" y2="14.65"/><line x1="7.5" y1="7.5" x2="12.5" y2="12.5"/><line x1="12.5" y1="7.5" x2="7.5" y2="12.5"/></symbol>
        <symbol id="icon-refresh" viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></symbol>
        <symbol id="icon-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></symbol>
        <symbol id="icon-home" viewBox="0 0 24 24"><path d="M3 9.5 12 3l9 6.5"/><path d="M5 10v10a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V10"/></symbol>
        <symbol id="icon-heart" viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></symbol>
        <symbol id="icon-zap" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></symbol>
        <symbol id="icon-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></symbol>
        <symbol id="icon-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></symbol>
        <symbol id="icon-graduation" viewBox="0 0 24 24"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1 3 3 6 3s6-2 6-3v-5"/></symbol>
        <symbol id="icon-mail" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></symbol>
        <symbol id="icon-message" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></symbol>
        </svg>

        <!-- Main Navigation Bar -->
    <nav class="glass-header border-b border-slate-200 sticky top-0 z-40 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-tr from-orange-400 to-blue-500 rounded-xl flex items-center justify-center font-extrabold text-xl text-white shadow-lg shadow-orange-400/20 group-hover:scale-105 transition-transform duration-300">
                    I
                </div>
                <div>
                    <span class="font-display text-base sm:text-lg font-extrabold text-slate-900 tracking-tight leading-none block group-hover:text-orange-500 transition-colors">Info Loker Panas</span>
                    <span class="text-[10px] font-bold text-orange-400 uppercase tracking-widest block mt-0.5">Semarang</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-1 bg-slate-100 p-1.5 rounded-2xl border border-slate-200 text-xs font-bold text-slate-600 shadow-sm">
                <a href="{{ route('beranda') }}" class="px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('beranda') ? 'bg-orange-400 text-white shadow-md' : 'hover:text-orange-500 hover:bg-white' }}">
                    <svg class="icon w-4 h-4"><use href="#icon-home"/></svg> Beranda
                </a>
                <a href="{{ route('lowongan.index') }}" class="px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('lowongan.*') ? 'bg-orange-400 text-white shadow-md' : 'hover:text-orange-500 hover:bg-white' }}">
                    <svg class="icon w-4 h-4"><use href="#icon-search"/></svg> Lowongan
                </a>
                @auth
                    <a href="{{ route('favorit.index') }}" class="px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('favorit.*') ? 'bg-orange-400 text-white shadow-md' : 'hover:text-orange-500 hover:bg-white' }}">
                        <svg class="icon w-4 h-4"><use href="#icon-heart"/></svg> Favorit
                    </a>
                @endauth
            </div>

            <!-- User / Auth Action Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-2.5">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl text-xs font-extrabold uppercase tracking-wider bg-orange-400 text-white hover:bg-orange-500 transition-all shadow-md flex items-center gap-1.5">
                                <svg class="icon w-3.5 h-3.5"><use href="#icon-zap"/></svg> Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('profile.edit') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 transition-all border border-slate-200 shadow-sm flex items-center gap-2">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-5 h-5 rounded-full object-cover border border-orange-400">
                                @else
                                    <svg class="icon w-4 h-4"><use href="#icon-user"/></svg>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" title="Keluar dari akun" class="p-2.5 rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 border border-transparent hover:border-red-200 transition-all">
                                <svg class="icon w-[18px] h-[18px]"><use href="#icon-logout"/></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="text-xs font-bold text-slate-600 hover:text-orange-500 transition-colors px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100">
                        Daftar
                    </a>
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-orange-400 hover:bg-orange-500 text-white transition-all duration-300 shadow-md">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Notifications -->
    @if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4">
        @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl shadow-sm flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <svg class="icon w-5 h-5 text-emerald-500"><use href="#icon-check-circle"/></svg>
                <span class="text-xs font-bold">{{ session('success') }}</span>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-2xl shadow-sm flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <svg class="icon w-5 h-5 text-rose-500"><use href="#icon-search-x"/></svg>
                <span class="text-xs font-bold">{{ session('error') }}</span>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-20 pt-14 pb-24 md:pb-12 text-slate-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-tr from-orange-400 to-blue-500 rounded-xl flex items-center justify-center font-extrabold text-xl text-white shadow-lg shadow-orange-400/20">I</div>
                    <div>
                        <span class="font-display text-base sm:text-lg font-extrabold text-slate-900 block">Info Loker Panas</span>
                        <span class="text-[10px] font-bold text-orange-400 uppercase tracking-widest">Semarang</span>
                    </div>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed max-w-md">
                    Platform lowongan kerja terdepan khusus area Semarang dan sekitarnya. Menyajikan informasi karir paling hangat, terpercaya, dan mudah diakses untuk semua jenjang karir.
                </p>
                <div class="space-y-2 pt-1">
                    <p class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                        <span>📸 Instagram:</span>
                        <a href="https://instagram.com/infolokerpanas.semarang" target="_blank" class="text-orange-500 hover:underline">@infolokerpanas.semarang</a>
                    </p>
                    <p class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                        <span>💬 Pasang Loker:</span>
                        <a href="https://wa.me/6287760282511" target="_blank" class="text-orange-500 hover:underline">+62 877-6028-2511</a>
                    </p>
                </div>
            </div>
            <div>
                <h4 class="font-display text-xs font-extrabold uppercase tracking-wider text-slate-900 mb-4">Navigasi Utama</h4>
                <ul class="space-y-2.5 text-xs font-semibold text-slate-600">
                    <li><a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors flex items-center gap-1.5"><svg class="icon w-3 h-3"><use href="#icon-chevron-right"/></svg> Beranda</a></li>
                    <li><a href="{{ route('lowongan.index') }}" class="hover:text-orange-500 transition-colors flex items-center gap-1.5"><svg class="icon w-3 h-3"><use href="#icon-chevron-right"/></svg> Semua Lowongan</a></li>
                    @auth
                        <li><a href="{{ route('favorit.index') }}" class="hover:text-orange-500 transition-colors flex items-center gap-1.5"><svg class="icon w-3 h-3"><use href="#icon-chevron-right"/></svg> Favorit Saya</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="font-display text-xs font-extrabold uppercase tracking-wider text-slate-900 mb-4">Jangkauan Area</h4>
                <p class="text-xs text-slate-500 leading-relaxed font-semibold flex items-start gap-1.5">
                    <svg class="icon w-3.5 h-3.5 shrink-0 mt-0.5"><use href="#icon-pin"/></svg>
                    <span>Kota Semarang, Semarang Barat, Semarang Timur, Tembalang, Pedurungan, Ungaran, Kendal, Demak & sekitarnya.</span>
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-400 font-semibold">
            <div>
                &copy; {{ date('Y') }} Info Loker Panas Semarang. Hak cipta dilindungi.
            </div>
            <div class="flex items-center gap-4">
                <span>Dibuat untuk Pencari Kerja Semarang</span>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar (md:hidden) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-xl border-t border-slate-200 shadow-lg">
        <div class="flex justify-around items-center py-2">
            <a href="{{ route('beranda') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold transition-all {{ request()->routeIs('beranda') ? 'text-orange-500 scale-105' : 'text-slate-400' }}">
                <svg class="icon w-5 h-5"><use href="#icon-home"/></svg> Beranda
            </a>
            <a href="{{ route('lowongan.index') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold transition-all {{ request()->routeIs('lowongan.*') ? 'text-orange-500 scale-105' : 'text-slate-400' }}">
                <svg class="icon w-5 h-5"><use href="#icon-search"/></svg> Lowongan
            </a>
            @auth
                <a href="{{ route('favorit.index') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold transition-all {{ request()->routeIs('favorit.*') ? 'text-orange-500 scale-105' : 'text-slate-400' }}">
                    <svg class="icon w-5 h-5"><use href="#icon-heart"/></svg> Favorit
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold text-orange-500">
                        <svg class="icon w-5 h-5"><use href="#icon-zap"/></svg> Admin
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold transition-all {{ request()->routeIs('profile.*') ? 'text-orange-500 scale-105' : 'text-slate-400' }}">
                        <svg class="icon w-5 h-5"><use href="#icon-user"/></svg> Profil
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center gap-1 text-[10px] font-bold text-slate-400">
                    <svg class="icon w-5 h-5"><use href="#icon-user"/></svg> Masuk
                </a>
            @endauth
        </div>
    </nav>

</body>
</html>