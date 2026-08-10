@extends('layouts.site')

@section('title', $lowongan->nama_posisi . ' - ' . $lowongan->nama_perusahaan . ' - Info Loker Panas')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-8" x-data="{ tab: 'deskripsi' }">

        <!-- Top Bar with Back Button & Breadcrumb -->
        <div class="flex items-center justify-between gap-4 mb-6">
            <button onclick="window.history.back()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:border-orange-400 text-xs font-bold transition shadow-sm cursor-pointer">
                <span>&larr;</span>
                <span>Kembali</span>
            </button>

            <div class="hidden sm:flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('lowongan.index') }}" class="hover:text-orange-500 transition-colors">Lowongan</a>
                <span>/</span>
                <span class="text-slate-900 font-bold truncate max-w-xs">{{ $lowongan->nama_posisi }}</span>
            </div>
        </div>

        <!-- Header Card Lowongan -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-slate-200/80 mb-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-400/10 rounded-bl-full pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row sm:items-start gap-6 relative z-10">
                <!-- Initials Avatar logo -->
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden border border-slate-200 flex-shrink-0 bg-blue-50 text-blue-500 font-extrabold text-3xl flex items-center justify-center shadow-md">
                    {{ strtoupper(substr($lowongan->nama_perusahaan, 0, 1)) }}
                </div>

                <div class="space-y-3 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $lowongan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="text-xs text-slate-400 font-semibold">
                            Diposting {{ $lowongan->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                        {{ $lowongan->nama_posisi }}
                    </h1>

                    <p class="text-sm font-bold text-slate-700 flex items-center gap-1.5">
                        <svg class="icon w-4 h-4 text-slate-400"><use href="#icon-building"/></svg>
                        {{ $lowongan->nama_perusahaan }}
                    </p>

                    <div class="flex flex-wrap items-center gap-2 pt-1">
                        <span class="text-xs bg-slate-100 border border-slate-200 text-slate-600 px-3 py-1 rounded-full font-semibold flex items-center gap-1.5">
                            <svg class="icon w-3.5 h-3.5"><use href="#icon-pin"/></svg> {{ $lowongan->lokasi }}
                        </span>
                        <span class="text-xs bg-slate-100 border border-slate-200 text-slate-600 px-3 py-1 rounded-full font-semibold flex items-center gap-1.5">
                            <svg class="icon w-3.5 h-3.5"><use href="#icon-clock"/></svg> {{ $lowongan->tipe_pekerjaan }}
                        </span>
                        <span class="text-xs bg-slate-100 border border-slate-200 text-slate-600 px-3 py-1 rounded-full font-semibold flex items-center gap-1.5">
                            <svg class="icon w-3.5 h-3.5"><use href="#icon-graduation"/></svg> {{ $lowongan->tingkat_pendidikan }}
                        </span>
                    </div>

                    @if($lowongan->gaji)
                    <div class="pt-2">
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">ESTIMASI GAJI</span>
                        <span class="text-base font-extrabold text-orange-500">{{ $lowongan->gaji }}</span>
                    </div>
                    @endif

                    <!-- Rating Summary -->
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-600 pt-1">
                        <span class="text-amber-500 text-sm">★</span>
                        <span>{{ number_format($avgRating, 1) }}</span>
                        <span class="text-slate-400">({{ $totalReview }} ulasan pelamar)</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="hidden md:flex flex-col gap-3 items-end flex-shrink-0">
                    <div class="flex flex-wrap gap-2 justify-end items-center">
                        @auth
                            @if($lowongan->email_perusahaan)
                            <a href="{{ route('lamaran.email', $lowongan->id) }}" class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-orange-500 text-white text-xs font-bold transition shadow-sm flex items-center gap-2">
                                <svg class="icon w-4 h-4"><use href="#icon-mail"/></svg> Lamar via Email
                            </a>
                            @endif
                            @if($lowongan->wa_perusahaan)
                            <a href="{{ route('lamaran.wa', $lowongan->id) }}" class="px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm flex items-center gap-2">
                                <svg class="icon w-4 h-4"><use href="#icon-message"/></svg> Lamar via WhatsApp
                            </a>
                            @endif

                            <form action="{{ route('favorit.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                                <button type="submit" class="px-4 py-3 rounded-xl border {{ $isFavorited ? 'bg-rose-50 text-rose-600 border-rose-200 font-bold' : 'text-slate-700 border-slate-200 hover:border-orange-400 bg-white' }} text-xs font-semibold transition flex items-center gap-1.5 shadow-sm" title="{{ $isFavorited ? 'Hapus dari favorit' : 'Tambah ke favorit' }}">
                                    <svg class="icon {{ $isFavorited ? 'icon-fill' : '' }} w-4 h-4"><use href="#icon-heart"/></svg>
                                    <span>{{ $isFavorited ? 'Tersimpan' : 'Favorit' }}</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-3 rounded-xl border border-slate-200 text-slate-700 hover:border-orange-400 bg-white text-xs font-semibold transition flex items-center gap-1.5 shadow-sm" title="Login untuk menyimpan favorit">
                                <svg class="icon w-4 h-4"><use href="#icon-heart"/></svg>
                                <span>Favorit</span>
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-lg shadow-orange-400/20 flex items-center gap-2">
                                <span>Login untuk Melamar</span>
                                <span>&rarr;</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation (Deskripsi / Ulasan) -->
        <div class="flex bg-slate-100 p-1.5 mb-6 border border-slate-200 shadow-sm rounded-2xl">
            <button @click="tab = 'deskripsi'" :class="tab === 'deskripsi' ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="flex-1 text-center py-3 rounded-xl text-xs font-bold transition-all">
                Deskripsi Pekerjaan
            </button>
            <button @click="tab = 'ulasan'" :class="tab === 'ulasan' ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="flex-1 text-center py-3 rounded-xl text-xs font-bold transition-all">
                Ulasan & Rating ({{ $totalReview }})
            </button>
        </div>

        <!-- Panel Deskripsi -->
        <!-- Panel Deskripsi -->
        <div x-show="tab === 'deskripsi'" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 mb-8 space-y-6">
    <div>
        <h2 class="font-display text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-200">Deskripsi Pekerjaan</h2>
        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line font-medium">
            {{ $lowongan->deskripsi ?: 'Deskripsi detail pekerjaan tidak dilampirkan oleh perusahaan.' }}
        </div>
    </div>

    @if($lowongan->persyaratan)
    <div>
        <h2 class="font-display text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-200">Persyaratan</h2>
        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line font-medium">
            {{ $lowongan->persyaratan }}
        </div>
    </div>
    @endif

    @if($lowongan->benefit)
    <div>
        <h2 class="font-display text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-200">Benefit</h2>
        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line font-medium">
            {{ $lowongan->benefit }}
        </div>
    </div>
    @endif
</div>

        <!-- Panel Ulasan -->
        <div x-show="tab === 'ulasan'" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 mb-8">
            @auth
            <!-- Form Kirim Ulasan -->
            <form action="{{ route('review.store') }}" method="POST" class="mb-8 border-b border-slate-200 pb-8 space-y-4">
                @csrf
                <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                <h3 class="font-display text-sm font-bold text-slate-900">Berikan Ulasan & Rating</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Rating Bintang</label>
                        <select name="rating" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs bg-slate-50 focus:bg-white focus:border-orange-500/50 outline-none" required>
                            <option value="">Pilih Rating (1 - 5 Bintang)</option>
                            <option value="5">★★★★★ (5 - Sangat Baik)</option>
                            <option value="4">★★★★ (4 - Baik)</option>
                            <option value="3">★★★ (3 - Cukup)</option>
                            <option value="2">★★ (2 - Kurang)</option>
                            <option value="1">★ (1 - Buruk)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Komentar / Pengalaman <span class="text-slate-400 font-normal lowercase">(wajib jika rating ≤ 2)</span></label>
                    <textarea name="komentar" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-xs bg-slate-50 focus:bg-white focus:border-orange-500/50 outline-none" placeholder="Tuliskan ulasan atau pengalaman kamu saat melamar/wawancara di perusahaan ini..."></textarea>
                </div>

                <button type="submit" class="px-6 py-2.5 bg-orange-400 hover:bg-orange-500 text-white rounded-xl font-bold text-xs transition shadow-md">
                    Kirim Ulasan
                </button>
            </form>
            @else
            <div class="p-4 bg-slate-100 rounded-2xl border border-slate-200 text-xs text-slate-600 mb-6 flex items-center justify-between">
                <span>Ingin memberi ulasan? Silakan masuk ke akun kamu terlebih dahulu.</span>
                <a href="{{ route('login') }}" class="font-bold text-orange-500 hover:underline">Login Sekarang &rarr;</a>
            </div>
            @endauth

            <!-- List Ulasan -->
            <div class="space-y-4">
                @forelse($lowongan->review as $r)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1.5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-orange-400 text-white text-xs font-bold flex items-center justify-center">
                                {{ strtoupper(substr($r->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="font-bold text-xs text-slate-800">{{ $r->user->name ?? 'User Terverifikasi' }}</span>
                        </div>
                        <span class="text-amber-500 text-xs font-bold">
                            {{ str_repeat('★', $r->rating) }}{{ str_repeat('☆', 5 - $r->rating) }}
                        </span>
                    </div>
                    @if($r->komentar)
                    <p class="text-xs text-slate-600 pl-9 font-semibold">{{ $r->komentar }}</p>
                    @endif
                    <p class="text-[10px] text-slate-400 pl-9 font-semibold">{{ $r->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <p class="text-xs text-slate-500 text-center py-6 font-semibold">Belum ada ulasan untuk lowongan ini. Jadilah yang pertama memberikan ulasan!</p>
                @endforelse
            </div>
        </div>

        <!-- Lowongan Terkait -->
        @if($lowonganTerkait->count())
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
            <h2 class="font-display text-sm font-bold text-slate-900 mb-4">Lowongan Kerja Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($lowonganTerkait as $l)
                <a href="{{ route('lowongan.show', $l->id) }}" class="border border-slate-200 rounded-2xl p-4 hover:shadow-sm hover:border-orange-400 transition block group bg-slate-50">
                    <p class="font-bold text-xs text-slate-800 group-hover:text-orange-500 transition line-clamp-1">{{ $l->nama_posisi }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1">
                        <svg class="icon w-3 h-3"><use href="#icon-building"/></svg> {{ $l->nama_perusahaan }}
                    </p>
                    <p class="text-[10px] text-slate-400 mt-1 flex items-center gap-1">
                        <svg class="icon w-3 h-3"><use href="#icon-pin"/></svg> {{ $l->lokasi }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>

    <!-- Mobile Sticky CTA Bar -->
    @auth
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 px-4 py-3 flex items-center gap-2 shadow-lg">
        @if($lowongan->email_perusahaan)
        <a href="{{ route('lamaran.email', $lowongan->id) }}" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold">
            <svg class="icon w-3.5 h-3.5"><use href="#icon-mail"/></svg> Email
        </a>
        @endif
        @if($lowongan->wa_perusahaan)
        <a href="{{ route('lamaran.wa', $lowongan->id) }}" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-emerald-600 text-white text-xs font-bold">
            <svg class="icon w-3.5 h-3.5"><use href="#icon-message"/></svg> WA
        </a>
        @endif
        <form action="{{ route('favorit.store') }}" method="POST" class="flex-shrink-0">
            @csrf
            <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
            <button type="submit" class="px-3 py-2.5 rounded-xl border {{ $isFavorited ? 'bg-rose-50 text-rose-600 border-rose-200' : 'border-slate-200 bg-slate-50 text-slate-700' }} text-xs font-bold">
                <svg class="icon {{ $isFavorited ? 'icon-fill' : '' }} w-4 h-4"><use href="#icon-heart"/></svg>
            </button>
        </form>
    </div>
    @else
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 px-4 py-3 flex items-center gap-2 shadow-lg">
        <a href="{{ route('login') }}" class="flex-1 text-center py-3 rounded-xl bg-orange-400 text-white text-xs font-bold shadow-md">Login untuk Melamar</a>
        <a href="{{ route('login') }}" class="px-3.5 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-xs font-bold flex items-center">
            <svg class="icon w-4 h-4"><use href="#icon-heart"/></svg>
        </a>
    </div>
    @endauth

@endsection