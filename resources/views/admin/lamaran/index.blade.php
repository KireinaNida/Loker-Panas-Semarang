@extends('layouts.admin')

@section('title', 'Daftar Lamaran Masuk - Info Loker Panas')
@section('page-title', 'Daftar Lamaran Masuk')
@section('page-subtitle', 'Kelola, verifikasi berkas, teruskan ke perusahaan, atau tolak lamaran kandidat')

@section('content')

    <div class="p-6 space-y-6" 
         x-data="{
             previewOpen: false,
             previewUrl: '',
             previewTitle: '',
             isPdf: false,
             
             forwardOpen: false,
             forwardActionUrl: '',
             forwardCandidateName: '',
             forwardCompanyEmail: '',
             
             rejectOpen: false,
             rejectActionUrl: '',
             rejectCandidateName: '',

             openPreview(url, title, isPdfFile) {
                 this.previewUrl = url;
                 this.previewTitle = title;
                 this.isPdf = isPdfFile;
                 this.previewOpen = true;
             },

             openForward(actionUrl, candidateName, companyEmail) {
                 this.forwardActionUrl = actionUrl;
                 this.forwardCandidateName = candidateName;
                 this.forwardCompanyEmail = companyEmail;
                 this.forwardOpen = true;
             },

             openReject(actionUrl, candidateName) {
                 this.rejectActionUrl = actionUrl;
                 this.rejectCandidateName = candidateName;
                 this.rejectOpen = true;
             }
         }">

        <!-- Status Counter Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('admin.lamaran.index', ['status' => 'all']) }}" class="p-5 rounded-2xl bg-white border {{ !request('status') || request('status') === 'all' ? 'border-orange-400 ring-2 ring-orange-400/20' : 'border-slate-200' }} shadow-sm transition hover:shadow">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 block">Total Lamaran</span>
                <span class="text-2xl font-extrabold text-slate-900 block mt-1">{{ number_format($countTotal) }}</span>
            </a>

            <a href="{{ route('admin.lamaran.index', ['status' => 'Menunggu Review']) }}" class="p-5 rounded-2xl bg-white border {{ request('status') === 'Menunggu Review' ? 'border-amber-400 ring-2 ring-amber-400/20' : 'border-slate-200' }} shadow-sm transition hover:shadow">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-600 block flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Menunggu Review</span>
                </span>
                <span class="text-2xl font-extrabold text-amber-600 block mt-1">{{ number_format($countMenunggu) }}</span>
            </a>

            <a href="{{ route('admin.lamaran.index', ['status' => 'Diteruskan']) }}" class="p-5 rounded-2xl bg-white border {{ request('status') === 'Diteruskan' ? 'border-emerald-400 ring-2 ring-emerald-400/20' : 'border-slate-200' }} shadow-sm transition hover:shadow">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-600 block">Diteruskan (Lolos)</span>
                <span class="text-2xl font-extrabold text-emerald-600 block mt-1">{{ number_format($countDiteruskan) }}</span>
            </a>

            <a href="{{ route('admin.lamaran.index', ['status' => 'Ditolak']) }}" class="p-5 rounded-2xl bg-white border {{ request('status') === 'Ditolak' ? 'border-rose-400 ring-2 ring-rose-400/20' : 'border-slate-200' }} shadow-sm transition hover:shadow">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-rose-600 block">Ditolak</span>
                <span class="text-2xl font-extrabold text-rose-600 block mt-1">{{ number_format($countDitolak) }}</span>
            </a>
        </div>

        <!-- Filter & Search Card -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <form method="GET" action="{{ route('admin.lamaran.index') }}" class="flex flex-col md:flex-row items-center gap-3">
                <!-- Status Hidden Filter if active -->
                <input type="hidden" name="status" value="{{ request('status', 'all') }}">

                <!-- Search Input -->
                <div class="relative flex-1 w-full">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari nama pelamar, email, atau nomor HP..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:border-orange-500 outline-none">
                    <svg class="icon w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"><use href="#icon-search"/></svg>
                </div>

                <!-- Select Lowongan -->
                <div class="w-full md:w-64">
                    <select name="lowongan_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:border-orange-500 outline-none text-slate-700">
                        <option value="">-- Semua Lowongan --</option>
                        @foreach($lowongans as $loker)
                            <option value="{{ $loker->id }}" {{ request('lowongan_id') == $loker->id ? 'selected' : '' }}>
                                {{ $loker->nama_posisi }} ({{ $loker->nama_perusahaan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-initial px-5 py-2.5 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-sm">
                        Filter
                    </button>
                    @if(request()->anyFilled(['q', 'lowongan_id', 'status']))
                        <a href="{{ route('admin.lamaran.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Applications Table -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase text-[10px] font-extrabold tracking-wider">
                        <tr>
                            <th class="py-3.5 px-4">Kandidat Pelamar</th>
                            <th class="py-3.5 px-4">Posisi & Perusahaan</th>
                            <th class="py-3.5 px-4">Berkas Terlampir (Klik Preview)</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4">Tanggal Masuk</th>
                            <th class="py-3.5 px-4 text-center">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($lamarans as $item)
                            <tr class="hover:bg-slate-50/70 transition">
                                <!-- Candidate Info -->
                                <td class="py-4 px-4 align-top">
                                    <div class="font-bold text-slate-900 text-sm">
                                        {{ $item->user->name ?? 'User Terhapus' }}
                                        @if($item->user->nama_panggilan)
                                            <span class="text-xs font-semibold text-slate-500">({{ $item->user->nama_panggilan }})</span>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5 space-y-0.5">
                                        <div>📧 {{ $item->user->email ?? '-' }}</div>
                                        <div>📱 {{ $item->user->no_telepon ?: '-' }}</div>
                                        <div class="text-[10px] text-slate-400">
                                            {{ $item->user->jenis_kelamin ?: '-' }} &bull; {{ $item->user->tgl_lahir ? $item->user->tgl_lahir->format('d M Y') : '-' }}
                                        </div>
                                    </div>
                                    @if($item->catatan_pelamar)
                                        <div class="mt-2 p-2 bg-amber-50 rounded-lg text-[10px] text-amber-900 border border-amber-200">
                                            <b>Pesan Pelamar:</b> "{{ $item->catatan_pelamar }}"
                                        </div>
                                    @endif
                                </td>

                                <!-- Job Position -->
                                <td class="py-4 px-4 align-top">
                                    <div class="font-bold text-slate-900">
                                        {{ $item->lowongan->nama_posisi ?? '-' }}
                                    </div>
                                    <div class="text-xs font-semibold text-slate-500 mt-0.5">
                                        {{ $item->lowongan->nama_perusahaan ?? '-' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-1">
                                        Email: <b>{{ $item->lowongan->email_perusahaan ?: 'Belum diatur' }}</b>
                                    </div>
                                </td>

                                <!-- Documents List with In-App Preview -->
                                <td class="py-4 px-4 align-top">
                                    <div class="flex flex-wrap gap-1.5 max-w-xs">
                                        @foreach($item->dokumen as $dok)
                                            <button type="button"
                                                    @click="openPreview('{{ $dok->file_url }}', '{{ $dok->nama_dokumen }} - {{ $item->user->name }}', {{ $dok->isPdf() ? 'true' : 'false' }})"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-orange-100 hover:text-orange-700 text-[11px] font-bold text-slate-700 border border-slate-200 transition cursor-pointer"
                                                    title="Pratinjau {{ $dok->nama_dokumen }}">
                                                <svg class="icon w-3 h-3 text-slate-400"><use href="#icon-eye"/></svg>
                                                <span>{{ $dok->nama_dokumen }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-4 align-top">
                                    @if($item->status === 'Menunggu Review')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu Review
                                        </span>
                                    @elseif($item->status === 'Diteruskan')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span>✓</span> Diteruskan
                                        </span>
                                        @if($item->diteruskan_at)
                                            <span class="block text-[9px] text-slate-400 mt-1">
                                                {{ $item->diteruskan_at->format('d/m/y H:i') }}
                                            </span>
                                        @endif
                                    @elseif($item->status === 'Ditolak')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-extrabold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span>✕</span> Ditolak
                                        </span>
                                        @if($item->catatan_admin)
                                            <p class="text-[10px] text-rose-800 italic mt-1 max-w-[180px]">
                                                "{{ $item->catatan_admin }}"
                                            </p>
                                        @endif
                                    @endif
                                </td>

                                <!-- Date -->
                                <td class="py-4 px-4 align-top text-slate-500 text-[11px]">
                                    {{ $item->created_at->format('d M Y') }}<br>
                                    <span class="text-[10px] text-slate-400">{{ $item->created_at->format('H:i') }} WIB</span>
                                </td>

                                <!-- Verification Action Buttons -->
                                <td class="py-4 px-4 align-top text-center">
                                    <div class="flex flex-col gap-1.5 items-center justify-center">
                                        @if($item->status !== 'Diteruskan')
                                            <button type="button" 
                                                    @click="openForward('{{ route('admin.lamaran.forward', $item->id) }}', '{{ $item->user->name }}', '{{ $item->lowongan->email_perusahaan ?? '' }}')"
                                                    class="w-full px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold transition flex items-center justify-center gap-1 shadow-sm cursor-pointer"
                                                    title="Setujui & teruskan ke email perusahaan">
                                                <span>✓</span> Kirim ke Perusahaan
                                            </button>
                                        @else
                                            <span class="text-[10px] font-bold text-emerald-600 py-1">✓ Berkas Sudah Dikirim</span>
                                        @endif

                                        @if($item->status !== 'Ditolak')
                                            <button type="button" 
                                                    @click="openReject('{{ route('admin.lamaran.reject', $item->id) }}', '{{ $item->user->name }}')"
                                                    class="w-full px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-[11px] font-bold transition flex items-center justify-center gap-1 cursor-pointer"
                                                    title="Tolak lamaran dengan alasan">
                                                <span>✕</span> Tolak
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <p class="font-bold text-sm">Tidak ada berkas lamaran yang ditemukan</p>
                                    <p class="text-xs text-slate-400 mt-1">Lamaran yang dikirimkan oleh pencari kerja akan muncul pada tabel ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($lamarans->hasPages())
                <div class="p-4 border-t border-slate-200">
                    {{ $lamarans->links() }}
                </div>
            @endif
        </div>

        <!-- MODAL 1: In-Browser Document Preview (PDF & Image Viewer) -->
        <div x-show="previewOpen" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm" @click="previewOpen = false"></div>

            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-5xl rounded-3xl bg-white shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[90vh]" @click.stop>
                    <!-- Modal Header -->
                    <div class="p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <div class="flex items-center gap-2.5">
                            <span class="text-lg">📄</span>
                            <div>
                                <h3 class="text-sm font-extrabold text-slate-900" x-text="previewTitle"></h3>
                                <p class="text-[10px] text-slate-500">Pratinjau dokumen langsung di dalam browser</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a :href="previewUrl" target="_blank" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-orange-400 text-xs font-bold text-slate-700 transition">
                                Buka di Tab Baru ↗
                            </a>
                            <button @click="previewOpen = false" class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 hover:bg-slate-300 flex items-center justify-center transition cursor-pointer">
                                ✕
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body / Previewer -->
                    <div class="flex-1 p-4 bg-slate-100 overflow-auto flex items-center justify-center">
                        <!-- If PDF -->
                        <template x-if="isPdf">
                            <iframe :src="previewUrl" class="w-full h-[70vh] rounded-xl border border-slate-300 shadow-inner bg-white"></iframe>
                        </template>

                        <!-- If Image -->
                        <template x-if="!isPdf">
                            <img :src="previewUrl" class="max-h-[70vh] max-w-full rounded-xl object-contain shadow-md border border-slate-300">
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL 2: Approve & Forward to Employer Modal -->
        <div x-show="forwardOpen" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="forwardOpen = false"></div>

            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl border border-slate-200" @click.stop>
                    <form method="POST" :action="forwardActionUrl" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-extrabold mb-2">
                            ✉️
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900">Kirim Berkas ke Perusahaan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Anda akan meneruskan seluruh berkas persyaratan kandidat <b x-text="forwardCandidateName"></b> langsung ke alamat email HRD perusahaan.
                        </p>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1.5">Alamat Email HRD Tujuan</label>
                            <input type="email" 
                                   name="email_tujuan" 
                                   :value="forwardCompanyEmail" 
                                   placeholder="hrd@perusahaan.com"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:border-emerald-500 outline-none"
                                   required>
                            <span class="text-[10px] text-slate-400 mt-1 block">Pastikan alamat email di atas aktif untuk menerima berkas pelamar.</span>
                        </div>

                        <div class="flex items-center gap-2 pt-3">
                            <button type="button" @click="forwardOpen = false" class="flex-1 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-md">
                                Kirim Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL 3: Reject Application Modal with Reason -->
        <div x-show="rejectOpen" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="rejectOpen = false"></div>

            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl border border-slate-200" @click.stop>
                    <form method="POST" :action="rejectActionUrl" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl font-extrabold mb-2">
                            ⚠️
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900">Tolak Berkas Lamaran</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Masukkan alasan penolakan untuk kandidat <b x-text="rejectCandidateName"></b>. Catatan ini akan ditampilkan pada halaman riwayat pelamar.
                        </p>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1.5">Alasan / Catatan Penolakan (Wajib)</label>
                            <textarea name="catatan_admin" 
                                      rows="3" 
                                      placeholder="Contoh: Kualifikasi jenjang pendidikan belum memenuhi syarat atau dokumen KTP kurang jelas..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:border-rose-500 outline-none"
                                      required></textarea>
                        </div>

                        <div class="flex items-center gap-2 pt-3">
                            <button type="button" @click="rejectOpen = false" class="flex-1 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition shadow-md">
                                Tolak Lamaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
