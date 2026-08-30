<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Info Loker Panas')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .icon { width: 1em; height: 1em; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; display: inline-block; vertical-align: middle; }
        .icon-fill { fill: currentColor; }
        .nav-link.active { background: rgba(249, 115, 22, 0.08); border: 1px solid rgba(249, 115, 22, 0.35); color: #c2410c; }
        *:focus-visible { outline: 2px solid #3b82f6 !important; outline-offset: 2px !important; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 min-h-screen">

    <!-- SVG ICON LIBRARY -->
    <svg class="hidden" aria-hidden="true">
        <symbol id="icon-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></symbol>
        <symbol id="icon-briefcase" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><path d="M2 13h20"/></symbol>
        <symbol id="icon-tag" viewBox="0 0 24 24"><path d="M20.59 13.41 12 22l-9-9 8.59-8.59A2 2 0 0 1 13 4h6a2 2 0 0 1 2 2v6a2 2 0 0 1-.41 1.41Z"/><circle cx="16.5" cy="7.5" r="1"/></symbol>
        <symbol id="icon-building" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/></symbol>
        <symbol id="icon-flame" viewBox="0 0 24 24"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></symbol>
        <symbol id="icon-users" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></symbol>
        <symbol id="icon-settings" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></symbol>
        <symbol id="icon-plus" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></symbol>
        <symbol id="icon-pencil" viewBox="0 0 24 24"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></symbol>
        <symbol id="icon-trash" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></symbol>
        <symbol id="icon-bell" viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></symbol>
        <symbol id="icon-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></symbol>
        <symbol id="icon-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></symbol>
        <symbol id="icon-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></symbol>
        <symbol id="icon-check" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></symbol>
        <symbol id="icon-home" viewBox="0 0 24 24"><path d="M3 9.5 12 3l9 6.5"/><path d="M5 10v10a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V10"/></symbol>
        <symbol id="icon-pin" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></symbol>
        <symbol id="icon-folder" viewBox="0 0 24 24"><path d="M4 4h6l2 3h8a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z"/></symbol>
        <symbol id="icon-click" viewBox="0 0 24 24"><path d="m9 9 5 12 1.8-5.2L21 14Z"/><path d="M7.2 2.2 8 5.1M2.2 7.2 5.1 8M2 13l1-2.5 2.5-1"/></symbol>
        <symbol id="icon-heart" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></symbol>
        <symbol id="icon-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></symbol>
        <symbol id="icon-x" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></symbol>
    </svg>

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

        <!-- Mobile Sidebar Backdrop Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-30 lg:hidden"
             @click="sidebarOpen = false"
             x-cloak>
        </div>

        <!-- SIDEBAR -->
        <aside id="sidebar" 
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="w-64 shrink-0 bg-white border-r border-slate-200 flex-col justify-between fixed lg:sticky top-0 left-0 h-screen z-40 transition-transform duration-300 ease-in-out flex shadow-lg lg:shadow-none"
               x-cloak>
            <div>
                <div class="h-20 flex items-center justify-between px-6 border-b border-slate-200">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-tr from-orange-400 to-blue-500 rounded-xl flex items-center justify-center font-extrabold text-xl text-white shadow-lg shadow-orange-400/20">I</div>
                        <div>
                            <span class="text-lg font-bold tracking-tight text-slate-900">Info Loker<span class="text-orange-500"> Panas</span></span>
                            <span class="block text-[10px] text-slate-500 -mt-1 tracking-widest uppercase">Admin Panel</span>
                        </div>
                    </a>
                    <button class="lg:hidden p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600" @click="sidebarOpen = false" aria-label="Close sidebar">
                        <svg class="icon w-5 h-5"><use href="#icon-x"/></svg>
                    </button>
                </div>

                <nav class="p-4 space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? '' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-grid"/></svg> Dashboard
                    </a>
                    <a href="{{ route('admin.lowongan.index') }}" class="nav-link {{ request()->routeIs('admin.lowongan.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.lowongan.*') ? '' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-briefcase"/></svg> Lowongan
                    </a>
                    <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.kategori.*') ? '' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-tag"/></svg> Kategori
                    </a>
                    <a href="{{ route('admin.favorit.index') }}" class="nav-link {{ request()->routeIs('admin.favorit.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.favorit.*') ? '' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-heart"/></svg> Favorit
                    </a>
                    <a href="{{ route('admin.review.index') }}" class="nav-link {{ request()->routeIs('admin.review.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.review.*') ? '' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }} transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-star"/></svg> Review
                    </a>
                    <a href="{{ route('beranda') }}" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-home"/></svg> Lihat Situs
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3 px-2 py-2 mb-2">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-orange-400 to-blue-500 flex items-center justify-center text-sm font-bold text-white shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-red-50 hover:text-red-500 transition">
                        <svg class="icon w-[18px] h-[18px]"><use href="#icon-logout"/></svg> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 min-w-0" x-data="@yield('page-data', '{}')">

            <!-- TOPBAR -->
            <header class="bg-white/90 backdrop-blur sticky top-0 z-30 border-b border-slate-200">
                <div class="h-20 flex items-center justify-between px-6 gap-4">
                    <div class="flex items-center gap-3">
                        <button class="lg:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-600" @click="sidebarOpen = true" aria-label="Open sidebar">
                            <svg class="icon w-5 h-5"><use href="#icon-grid"/></svg>
                        </button>
                        <div>
                            <h1 class="text-lg font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-xs text-slate-500">@yield('page-subtitle', '')</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @yield('topbar-actions')
                    </div>
                </div>
            </header>

            @if(session('success') || session('error'))
            <div class="px-6 pt-6">
                @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-xl text-xs font-bold">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-xl text-xs font-bold">{{ session('error') }}</div>
                @endif
            </div>
            @endif

            <main class="p-6 space-y-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>