@extends('layouts.site')

@section('title', 'Info Loker Panas Semarang - Portal Lowongan Kerja Terpercaya')

@section('content')

    <!-- Hero Section -->
    <section class="hero-bg py-20 px-4 sm:px-6 relative overflow-hidden">
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <!-- Eyebrow Tag -->
            <span class="text-xs font-extrabold uppercase tracking-widest text-blue-500 mb-3 block">Info Loker Panas Semarang</span>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                Temukan Lowongan Kerja Terbaik di Semarang 
            </h1>
            <p class="text-slate-500 text-sm sm:text-base max-w-2xl mx-auto mb-10 leading-relaxed">
                Platform Lowongan Kerja Semarang Terupdate & Terpercaya. Cari Kerja Tanpa Ribet! 
            </p>

            <!-- Search form (Glass Card) -->
            <form action="{{ route('lowongan.index') }}" method="GET" class="glass-card p-3 rounded-2xl shadow-xl w-full max-w-3xl mx-auto flex flex-col sm:flex-row gap-3" role="search">
                <div class="flex-1 flex items-center bg-slate-50 border border-slate-200 rounded-xl px-4 focus-within:border-blue-300 transition">
                    <svg class="icon w-4 h-4 text-slate-400 shrink-0"><use href="#icon-search"/></svg>
                    <input type="text" name="q" placeholder="Cari posisi atau keahlian..." class="w-full bg-transparent px-3 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none border-none focus:ring-0">
                </div>
                <div class="sm:w-48 flex items-center bg-slate-50 border border-slate-200 rounded-xl px-4 focus-within:border-blue-300 transition">
                    <svg class="icon w-4 h-4 text-slate-400 shrink-0"><use href="#icon-pin"/></svg>
                    <input type="text" name="lokasi" placeholder="Lokasi (Semarang)" class="w-full bg-transparent px-3 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none border-none focus:ring-0">
                </div>
                <button type="submit" class="bg-orange-400 hover:bg-orange-500 text-white font-bold px-8 py-3 rounded-xl text-xs sm:text-sm transition shadow-lg shadow-orange-400/25 flex items-center justify-center gap-2">
                    <svg class="icon w-4 h-4"><use href="#icon-search"/></svg>
                    Cari
                </button>
            </form>

            <!-- Scrollable Category Pills -->
            <div class="flex items-center justify-center gap-2.5 mt-8 overflow-x-auto pb-2 scrollbar-none max-w-4xl mx-auto">
                @foreach($kategoriList as $k)
                <a href="{{ route('lowongan.index', ['kategori_id' => $k->id]) }}" class="cat-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 hover:border-orange-300 hover:text-orange-500 text-xs font-bold text-slate-600 transition shadow-sm">
                    <svg class="icon w-3.5 h-3.5 text-blue-500"><use href="#icon-tag"/></svg>
                    {{ $k->nama_kategori }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 -mt-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="glass-card p-5 rounded-2xl hover:shadow-md transition">
                <span class="text-xl font-extrabold text-slate-900 block leading-none">{{ number_format($totalLowongan) }}</span>
                <span class="text-[11px] font-bold text-slate-500 mt-1 block">Lowongan Aktif</span>
            </div>

            <div class="glass-card p-5 rounded-2xl hover:shadow-md transition">
                <span class="text-xl font-extrabold text-slate-900 block leading-none">{{ number_format($totalPerusahaan) }}</span>
                <span class="text-[11px] font-bold text-slate-500 mt-1 block">Perusahaan</span>
            </div>

            <div class="glass-card p-5 rounded-2xl hover:shadow-md transition">
                <span class="text-base font-extrabold text-slate-900 block leading-none">Semarang</span>
                <span class="text-[11px] font-bold text-slate-500 mt-1 block">Kota Semarang</span>
            </div>

            <div class="glass-card p-5 rounded-2xl hover:shadow-md transition">
                <span class="text-base font-extrabold text-slate-900 block leading-none">100% Gratis</span>
                <span class="text-[11px] font-bold text-slate-500 mt-1 block">Tanpa Potongan</span>
            </div>
        </div>
    </section>

    <!-- Latest Job Grid (3 Columns, Uniform Height) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-8 mb-12">
        <div class="flex justify-between items-end mb-6">
            <div>
                <span class="text-[11px] font-bold tracking-widest text-blue-500 uppercase">Rekomendasi Karir</span>
                <h2 class="text-lg font-bold text-slate-900">Lowongan Kerja Terbaru</h2>
            </div>
            <a href="{{ route('lowongan.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-orange-400 hover:bg-orange-500 transition shadow-md">
                <span>Lihat Semua</span>
                <svg class="icon w-3.5 h-3.5"><use href="#icon-chevron-right"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($lowonganTerbaru as $l)
            <div class="glass-card p-5 rounded-2xl border {{ $loop->first ? 'border-orange-300 ring-1 ring-orange-200' : 'border-slate-200' }} hover:border-orange-300 hover:shadow-md transition group relative flex flex-col h-full shadow-sm">
                @if($loop->first)
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
                            <svg class="icon w-3.5 h-3.5 text-blue-500 shrink-0" title="Verifikasi"><use href="#icon-badge-check"/></svg>
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

                <!-- Card action buttons aligned to bottom -->
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
            <div class="col-span-3 glass-card p-12 text-center shadow-sm">
                <svg class="icon w-12 h-12 text-slate-300 mx-auto mb-4"><use href="#icon-search-x"/></svg>
                <h3 class="text-slate-900 font-semibold mb-1">Belum ada lowongan terbaru</h3>
                <p class="text-slate-500 text-sm max-w-sm mx-auto">Silakan kembali lagi nanti untuk melihat informasi lowongan.</p>
            </div>
            @endforelse
        </div>
    </section>

@endsection