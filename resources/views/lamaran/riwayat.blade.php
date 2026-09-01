@extends('layouts.site')

@section('title', 'Riwayat Lamaran Saya - Info Loker Panas')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-slate-900 font-bold">Riwayat Lamaran</span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900">Pelacakan Status Lamaran</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau progres dan status verifikasi berkas lamaran Anda secara real-time.</p>
            </div>

            <a href="{{ route('lowongan.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-md shadow-orange-400/20 self-start sm:self-auto">
                <svg class="icon w-4 h-4"><use href="#icon-search"/></svg>
                <span>Cari Loker Lainnya</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl text-xs font-bold flex items-center gap-2 shadow-sm">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-2xl text-xs font-bold flex items-center gap-2 shadow-sm">
                <span>⚠️</span> {{ session('error') }}
            </div>
        @endif

        <!-- List Lamaran -->
        <div class="space-y-6">
            @forelse($lamarans as $lamaran)
                <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 transition-all hover:border-slate-300 relative overflow-hidden">
                    
                    <!-- Top Ribbon status indicator -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 text-blue-600 font-extrabold text-lg flex items-center justify-center shrink-0">
                                {{ strtoupper(substr($lamaran->lowongan->nama_perusahaan ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-display text-base sm:text-lg font-extrabold text-slate-900 hover:text-orange-500 transition">
                                    <a href="{{ route('lowongan.show', $lamaran->lowongan_id) }}">
                                        {{ $lamaran->lowongan->nama_posisi ?? 'Posisi Tidak Ditemukan' }}
                                    </a>
                                </h3>
                                <p class="text-xs font-bold text-slate-500 mt-0.5">
                                    {{ $lamaran->lowongan->nama_perusahaan ?? '-' }} &bull; {{ $lamaran->lowongan->lokasi ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex items-center gap-3">
                            @if($lamaran->status === 'Menunggu Review')
                                <span class="px-4 py-1.5 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1.5 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>Menunggu Review</span>
                                </span>
                            @elseif($lamaran->status === 'Diteruskan')
                                <span class="px-4 py-1.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5 shadow-sm">
                                    <span>✓</span>
                                    <span>Diteruskan ke Perusahaan</span>
                                </span>
                            @elseif($lamaran->status === 'Ditolak')
                                <span class="px-4 py-1.5 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200 flex items-center gap-1.5 shadow-sm">
                                    <span>✕</span>
                                    <span>Lamaran Ditolak</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Status Description Card -->
                    <div class="my-4 p-4 rounded-2xl text-xs font-medium {{ $lamaran->status === 'Menunggu Review' ? 'bg-amber-50/50 border border-amber-200 text-amber-900' : ($lamaran->status === 'Diteruskan' ? 'bg-emerald-50/50 border border-emerald-200 text-emerald-900' : 'bg-rose-50/50 border border-rose-200 text-rose-900') }}">
                        @if($lamaran->status === 'Menunggu Review')
                            <p class="leading-relaxed">
                                ⏳ <b>Status:</b> Berkas lamaran Anda telah kami terima dan saat ini berada dalam <b>antrean verifikasi berkas</b> oleh tim verifikator Info Loker Panas Semarang.
                            </p>
                        @elseif($lamaran->status === 'Diteruskan')
                            <p class="leading-relaxed">
                                🎉 <b>Status:</b> Selamat! Berkas lamaran Anda telah <b>lolos verifikasi</b> dan berhasil diteruskan secara otomatis ke alamat email resmi HRD <b>{{ $lamaran->lowongan->nama_perusahaan }}</b> ({{ $lamaran->lowongan->email_perusahaan ?: 'HRD Perusahaan' }}) pada {{ $lamaran->diteruskan_at ? $lamaran->diteruskan_at->format('d M Y, H:i') : $lamaran->updated_at->format('d M Y, H:i') }} WIB.
                            </p>
                        @elseif($lamaran->status === 'Ditolak')
                            <div class="space-y-1.5">
                                <p class="font-bold text-rose-900">
                                    ⚠️ Lamaran Anda belum dapat diteruskan ke pihak perusahaan.
                                </p>
                                @if($lamaran->catatan_admin)
                                    <div class="p-3 bg-white rounded-xl border border-rose-200 text-rose-800 text-xs font-semibold">
                                        <span class="block text-[10px] uppercase tracking-wider text-slate-400 font-extrabold mb-0.5">Alasan / Catatan Admin:</span>
                                        "{{ $lamaran->catatan_admin }}"
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Submitted Documents Preview List -->
                    <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mr-1">Berkas Terkirim:</span>
                            @foreach($lamaran->dokumen as $dok)
                                <a href="{{ $dok->file_url }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 hover:bg-orange-50 hover:text-orange-600 border border-slate-200 text-slate-700 font-bold transition text-[11px]">
                                    <svg class="icon w-3.5 h-3.5 text-slate-400"><use href="#icon-tag"/></svg>
                                    <span>{{ $dok->nama_dokumen }}</span>
                                    <span class="text-[9px] text-slate-400 font-normal">({{ $dok->formatted_size }})</span>
                                </a>
                            @endforeach
                        </div>

                        <div class="text-[11px] text-slate-400 shrink-0 font-medium">
                            Dikirim pada {{ $lamaran->created_at->format('d M Y, H:i') }} WIB
                        </div>
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-sm space-y-3">
                    <div class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 text-2xl font-bold flex items-center justify-center mx-auto mb-2">
                        📄
                    </div>
                    <h3 class="font-display text-lg font-bold text-slate-900">Belum Ada Lamaran Kerja</h3>
                    <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto">
                        Anda belum pernah mengirimkan lamaran pekerjaan melalui Info Loker Panas. Temukan lowongan kerja yang cocok sekarang!
                    </p>
                    <div class="pt-3">
                        <a href="{{ route('lowongan.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-md shadow-orange-400/20">
                            <span>Jelajahi Lowongan Kerja</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            @endforelse

            <div class="pt-4">
                {{ $lamarans->links() }}
            </div>
        </div>

    </div>

@endsection
