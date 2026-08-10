@extends('layouts.site')

@section('title', 'Cari Lowongan Kerja Semarang - Info Loker Panas')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 600)">
        
        <!-- Breadcrumb & Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-2">
                <a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 font-bold">Cari Lowongan</span>
            </div>
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Cari Lowongan Kerja di Semarang</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Temukan pekerjaan impianmu berdasarkan kategori, pendidikan, dan tipe pekerjaan.</p>
        </div>

        <!-- Filter Card Container -->
        <form action="{{ route('lowongan.index') }}" method="GET" class="glass-card p-5 mb-8 rounded-2xl shadow-sm border border-slate-200/80 space-y-4">
            <!-- Search & Location Row -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-6 relative">
                    <input type="text" name="q" placeholder="Cari posisi atau perusahaan..." value="{{ request('q') }}" 
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-orange-500/50 focus:ring-2 focus:ring-orange-400/20 text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none transition-all">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm text-slate-400">🔍</span>
                </div>
                <div class="sm:col-span-4 relative">
                    <input type="text" name="lokasi" placeholder="Lokasi (Semarang)" value="{{ request('lokasi') }}" 
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-orange-500/50 focus:ring-2 focus:ring-orange-400/20 text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none transition-all">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm text-slate-400">📍</span>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full py-3 px-4 bg-orange-400 hover:bg-orange-500 text-white rounded-xl font-bold text-xs sm:text-sm transition shadow-lg shadow-orange-400/25 active:scale-[0.98]">
                        Cari Loker
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left Sidebar Filter (1 col) -->
            <aside class="space-y-4 lg:col-span-1">
                <div class="glass-card p-5 rounded-2xl space-y-4 shadow-sm border border-slate-200/80">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-200 pb-3">Filter Lowongan</h3>
                    
                    <form action="{{ route('lowongan.index') }}" method="GET" id="sidebarFilterForm" class="space-y-4">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                        @if(request('lokasi')) <input type="hidden" name="lokasi" value="{{ request('lokasi') }}"> @endif

                        <div>
                            <label for="kategori_id" class="text-xs text-slate-500 block mb-2">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-orange-500/50" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tingkat_pendidikan" class="text-xs text-slate-500 block mb-2">Pendidikan</label>
                            <select id="tingkat_pendidikan" name="tingkat_pendidikan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-orange-500/50" onchange="this.form.submit()">
                                <option value="">Semua Jenjang</option>
                                @foreach(['SMA/SMK', 'D3', 'D4', 'S1', 'S2', 'Semua Jenjang'] as $opt)
                                    <option value="{{ $opt }}" {{ request('tingkat_pendidikan') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tipe_pekerjaan" class="text-xs text-slate-500 block mb-2">Tipe Pekerjaan</label>
                            <select id="tipe_pekerjaan" name="tipe_pekerjaan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-orange-500/50" onchange="this.form.submit()">
                                <option value="">Semua Tipe</option>
                                @foreach(['Full Time', 'Part Time', 'Kontrak', 'Magang', 'Freelance'] as $opt)
                                    <option value="{{ $opt }}" {{ request('tipe_pekerjaan') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if(request()->anyFilled(['q', 'lokasi', 'kategori_id', 'tingkat_pendidikan', 'tipe_pekerjaan']))
                            <a href="{{ route('lowongan.index') }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 rounded-xl text-xs font-bold transition">
                                <svg class="icon w-3.5 h-3.5"><use href="#icon-refresh"/></svg> Reset Filter
                            </a>
                        @endif
                    </form>
                </div>
            </aside>

            <!-- Grid Konten di Kanan (3 cols) -->
            <section class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <span class="text-[11px] font-bold tracking-widest text-blue-500 uppercase">Semua Loker</span>
                        <h2 class="text-lg font-bold text-slate-900">Daftar Lowongan Kerja</h2>
                    </div>
                    <span class="text-xs text-slate-500">Menampilkan {{ number_format($lowongan->total()) }} lowongan</span>
                </div>

                <!-- SKELETON LOADING STATE -->
                <div x-show="loading" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @for($i = 0; $i < 6; $i++)
                    <div class="glass-card p-5 rounded-2xl border border-slate-200 flex flex-col h-full shadow-sm" aria-hidden="true">
                        <div class="flex items-start gap-4 mb-3">
                            <div class="w-12 h-12 rounded-xl skeleton shrink-0"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-4 w-3/4 rounded skeleton"></div>
                                <div class="h-3 w-1/2 rounded skeleton"></div>
                                <div class="h-3 w-2/3 rounded skeleton"></div>
                            </div>
                        </div>
                        <div class="h-3 w-1/3 rounded skeleton mb-4"></div>
                        <div class="flex gap-2 mb-4">
                            <div class="h-6 w-16 rounded-lg skeleton"></div>
                            <div class="h-6 w-16 rounded-lg skeleton"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 pt-3 mt-auto border-t border-slate-100">
                            <div class="h-8 rounded-xl skeleton"></div>
                            <div class="h-8 rounded-xl skeleton"></div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- ACTUAL CONTENT -->
                <div x-show="!loading" x-cloak class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @forelse($lowongan as $l)
                    <div class="glass-card p-5 rounded-2xl border {{ $l->gaji ? 'border-orange-300 ring-1 ring-orange-200' : 'border-slate-200/80' }} hover:border-orange-300 hover:shadow-md transition group relative flex flex-col h-full shadow-sm">
                        @if($l->gaji)
                        <span class="absolute -top-2.5 left-5 px-2.5 py-0.5 bg-orange-400 text-white text-[10px] font-bold rounded-full shadow">Rekomendasi</span>
                        @endif

                        <span class="absolute top-4 right-4 flex items-center gap-1 px-2 py-0.5 bg-orange-50 border border-orange-200 text-orange-600 text-[10px] font-bold rounded-full">
                            <svg class="icon w-3 h-3"><use href="#icon-flame"/></svg> Hot
                        </span>

                        <div class="flex items-start gap-4 mb-3">
                            <!-- Initials Avatar -->
                            <div class="w-12 h-12 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-center text-blue-500 font-bold text-lg shrink-0 shadow-sm">
                                {{ strtoupper(substr($l->nama_perusahaan, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-900 group-hover:text-orange-600 transition truncate">{{ $l->nama_posisi }}</h3>
                                <p class="flex items-center gap-1 text-xs text-slate-500 truncate">
                                    {{ $l->nama_perusahaan }}
                                    <svg class="icon w-3.5 h-3.5 text-blue-500 shrink-0" title="Terverifikasi"><use href="#icon-badge-check"/></svg>
                                </p>
                                <p class="flex items-center gap-1 text-xs text-slate-500 mt-1">
                                    <svg class="icon w-3.5 h-3.5 shrink-0"><use href="#icon-pin"/></svg> {{ $l->lokasi }}
                                </p>
                            </div>
                        </div>

                        <p class="text-xs font-semibold text-orange-600 mb-3">
                            {{ $l->gaji ? $l->gaji : 'Gaji Kompetitif' }}
                        </p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] rounded-lg">{{ $l->tipe_pekerjaan }}</span>
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] rounded-lg">{{ $l->tingkat_pendidikan }}</span>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="grid grid-cols-2 gap-2 pt-3 mt-auto border-t border-slate-100">
                            <a href="{{ route('lowongan.show', $l->id) }}" class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition text-center">
                                Detail
                            </a>
                            <a href="{{ route('lamaran.cepat', $l->id) }}" class="w-full py-2 flex items-center justify-center gap-1.5 bg-orange-400 hover:bg-orange-500 text-white rounded-xl text-xs font-bold transition">
                                <svg class="icon w-3.5 h-3.5"><use href="#icon-check-circle"/></svg> Lamar Cepat
                            </a>
                        </div>
                    </div>
                    @empty
                    <!-- EMPTY STATE -->
                    <div class="col-span-3 flex flex-col items-center justify-center text-center py-16 px-6">
                        <div class="w-16 h-16 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 mb-4 shadow-sm">
                            <svg class="icon w-7 h-7"><use href="#icon-search-x"/></svg>
                        </div>
                        <h3 class="text-slate-900 font-semibold mb-1">Lowongan tidak ditemukan</h3>
                        <p class="text-slate-500 text-sm max-w-sm mb-5 font-semibold">Coba ubah kata kunci pencarian atau reset filter untuk melihat semua lowongan.</p>
                        <a href="{{ route('lowongan.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-orange-400 hover:bg-orange-500 text-white rounded-xl text-sm font-bold transition shadow-md shadow-orange-400/20">
                            <svg class="icon w-4 h-4"><use href="#icon-refresh"/></svg> Reset Filter
                        </a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8" x-show="!loading">
                    {{ $lowongan->links() }}
                </div>
            </section>
        </div>
    </div>

@endsection