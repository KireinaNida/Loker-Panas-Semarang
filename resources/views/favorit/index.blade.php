@extends('layouts.site')

@section('title', 'Favorit Saya - Info Loker Panas Semarang')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <!-- Breadcrumb & Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-2">
                <a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-slate-900 font-bold">Favorit Saya</span>
            </div>
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Lowongan Tersimpan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar lowongan kerja yang telah Anda tandai sebagai favorit.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($favoritList as $f)
            <div class="glass-card p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 hover:shadow-md transition group relative flex flex-col h-full shadow-sm">
                
                <span class="absolute top-4 right-4 flex items-center gap-1 px-2 py-0.5 bg-orange-50 border border-orange-200 text-orange-600 text-[10px] font-bold rounded-full">
                    <svg class="icon w-3 h-3"><use href="#icon-flame"/></svg> Hot
                </span>

                <div class="flex items-start gap-4 mb-3">
                    <!-- Initials Avatar -->
                    <div class="w-12 h-12 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-center text-blue-500 font-bold text-lg shrink-0 shadow-sm">
                        {{ strtoupper(substr($f->lowongan->nama_perusahaan, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-900 group-hover:text-orange-600 transition truncate">{{ $f->lowongan->nama_posisi }}</h3>
                        <p class="flex items-center gap-1 text-xs text-slate-500 truncate">
                            {{ $f->lowongan->nama_perusahaan }}
                            <svg class="icon w-3.5 h-3.5 text-blue-500 shrink-0" title="Terverifikasi"><use href="#icon-badge-check"/></svg>
                        </p>
                        <p class="flex items-center gap-1 text-xs text-slate-500 mt-1">
                            <svg class="icon w-3.5 h-3.5 shrink-0"><use href="#icon-pin"/></svg> {{ $f->lowongan->lokasi }}
                        </p>
                    </div>
                </div>

                <p class="text-xs font-semibold text-orange-600 mb-3">
                    {{ $f->lowongan->gaji ? $f->lowongan->gaji : 'Gaji Kompetitif' }}
                </p>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] rounded-lg">{{ $f->lowongan->tipe_pekerjaan }}</span>
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] rounded-lg">{{ $f->lowongan->tingkat_pendidikan }}</span>
                </div>

                <!-- Card Action Buttons -->
                <div class="grid grid-cols-2 gap-2 pt-3 mt-auto border-t border-slate-100">
                    <a href="{{ route('lowongan.show', $f->lowongan->id) }}" class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition text-center">
                        Detail
                    </a>
                    <form action="{{ route('favorit.destroy', $f->id) }}" method="POST" class="w-full" onsubmit="return confirm('Hapus lowongan ini dari favorit?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 rounded-xl text-xs font-bold transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-3 flex flex-col items-center justify-center text-center py-16 px-6">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 mb-4 shadow-sm">
                    <svg class="icon w-7 h-7"><use href="#icon-search-x"/></svg>
                </div>
                <h3 class="text-slate-900 font-semibold mb-1">Belum ada lowongan tersimpan</h3>
                <p class="text-slate-500 text-sm max-w-sm mb-5 font-semibold">Simpan lowongan yang kamu minati ke dalam daftar favorit agar mudah diakses di lain waktu.</p>
                <a href="{{ route('lowongan.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-orange-400 hover:bg-orange-500 text-white rounded-xl text-sm font-bold transition shadow-md shadow-orange-400/20">
                    Cari Lowongan Kerja &rarr;
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $favoritList->links() }}
        </div>
    </div>

@endsection