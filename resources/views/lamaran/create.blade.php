@extends('layouts.site')

@section('title', 'Lamar Posisi ' . $lowongan->nama_posisi . ' - Info Loker Panas')

@section('content')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8" 
         x-data="{
             cvSelected: false,
             ktpSelected: false,
             ijazahSelected: false,
             fotoSelected: false,
             optionalDocs: [],
             
             get allMandatoryFilled() {
                 return this.cvSelected && this.ijazahSelected && this.fotoSelected;
             },
             
             addDoc() {
                 this.optionalDocs.push({ id: Date.now(), name: '' });
             },
             
             removeDoc(id) {
                 this.optionalDocs = this.optionalDocs.filter(d => d.id !== id);
             }
         }">

        <!-- Top Breadcrumbs & Back -->
        <div class="flex items-center justify-between gap-4 mb-6">
            <a href="{{ route('lowongan.show', $lowongan->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:border-orange-400 text-xs font-bold transition shadow-sm">
                <span>&larr;</span>
                <span>Kembali ke Detail Lowongan</span>
            </a>

            <div class="hidden sm:flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('beranda') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('lowongan.index') }}" class="hover:text-orange-500 transition-colors">Lowongan</a>
                <span>/</span>
                <span class="text-slate-900 font-bold">Formulir Pelamaran</span>
            </div>
        </div>

        <!-- Job Summary Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-md border border-slate-200/80 mb-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-400/10 rounded-bl-full pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-5 relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-200 text-blue-600 font-extrabold text-2xl flex items-center justify-center shadow-sm shrink-0">
                    {{ strtoupper(substr($lowongan->nama_perusahaan, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0 space-y-1.5">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $lowongan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="text-xs text-orange-600 font-bold">{{ $lowongan->tipe_pekerjaan }}</span>
                    </div>
                    <h1 class="font-display text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight truncate">
                        {{ $lowongan->nama_posisi }}
                    </h1>
                    <p class="text-xs sm:text-sm font-bold text-slate-600 flex items-center gap-1.5">
                        <svg class="icon w-4 h-4 text-slate-400"><use href="#icon-building"/></svg>
                        {{ $lowongan->nama_perusahaan }} &bull; <svg class="icon w-3.5 h-3.5 text-slate-400"><use href="#icon-pin"/></svg> {{ $lowongan->lokasi }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Alert Notification -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs font-semibold space-y-1 shadow-sm">
                <div class="font-bold flex items-center gap-1.5 text-sm text-rose-900 mb-1">
                    <span>⚠️</span> Harap periksa kembali berkas yang Anda unggah:
                </div>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Pelamaran -->
        <form method="POST" action="{{ route('lamaran.store', $lowongan->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 1. Data Diri Pelamar (Otomatis dari Akun) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-orange-500 block">Bagian 1</span>
                        <h2 class="font-display text-base font-extrabold text-slate-900">Data Profil Pelamar</h2>
                    </div>
                    <a href="{{ route('profile.edit') }}" target="_blank" class="text-xs text-orange-500 font-bold hover:underline flex items-center gap-1">
                        Ubah Profil &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">Nama Lengkap & Panggilan</span>
                        <span class="font-bold text-slate-800 text-sm block">{{ $user->name }} {{ $user->nama_panggilan ? '(' . $user->nama_panggilan . ')' : '' }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">Nomor HP / WhatsApp</span>
                        <span class="font-bold text-slate-800 text-sm block">{{ $user->no_telepon ?: 'Belum diatur di profil' }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">Alamat Email</span>
                        <span class="font-bold text-slate-800 text-sm block">{{ $user->email }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block mb-0.5">Jenis Kelamin & Tanggal Lahir</span>
                        <span class="font-bold text-slate-800 text-sm block">
                            {{ $user->jenis_kelamin ?: '-' }} &bull; {{ $user->tgl_lahir ? $user->tgl_lahir->format('d M Y') : '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- 2. Dokumen Wajib (Mandatory Files: CV, Ijazah, Foto) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 space-y-5">
                <div class="pb-3 border-b border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-orange-500 block">Bagian 2 (Wajib)</span>
                    <h2 class="font-display text-base font-extrabold text-slate-900">Unggah Berkas Persyaratan Wajib</h2>
                    <p class="text-xs text-slate-500 mt-0.5">3 dokumen wajib di bawah ini harus dilampirkan sebelum mengirim lamaran.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- CV Wajib (PDF) -->
                    <div class="p-4 rounded-2xl border-2 transition-all" 
                         :class="cvSelected ? 'border-emerald-500 bg-emerald-50/40' : 'border-dashed border-slate-200 bg-slate-50 hover:bg-slate-100/70'">
                        <div class="flex items-center justify-between mb-2">
                            <label class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                <span>Curriculum Vitae (CV)</span>
                            </label>
                        </div>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded bg-slate-200 text-slate-700 uppercase inline-block mb-2">PDF (Maks 5MB)</span>
                        <input type="file" 
                               name="dokumen_cv" 
                               accept="application/pdf" 
                               @change="cvSelected = $event.target.files.length > 0"
                               class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-400 file:text-white hover:file:bg-orange-500 file:cursor-pointer"
                               required>
                        <p class="text-[10px] text-slate-400 mt-2" x-show="!cvSelected">Unggah CV terbaru Anda dalam bentuk PDF.</p>
                        <p class="text-[10px] text-emerald-600 font-bold mt-2 flex items-center gap-1" x-show="cvSelected">
                            <span>✓</span> CV siap dikirim
                        </p>
                    </div>

                    <!-- Ijazah Terakhir Wajib -->
                    <div class="p-4 rounded-2xl border-2 transition-all" 
                         :class="ijazahSelected ? 'border-emerald-500 bg-emerald-50/40' : 'border-dashed border-slate-200 bg-slate-50 hover:bg-slate-100/70'">
                        <div class="flex items-center justify-between mb-2">
                            <label class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                <span>Ijazah / SKL Terakhir</span>
                            </label>
                        </div>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded bg-slate-200 text-slate-700 uppercase inline-block mb-2">PDF/Foto (Maks 5MB)</span>
                        <input type="file" 
                               name="dokumen_ijazah" 
                               accept=".pdf,image/png,image/jpeg,image/jpg" 
                               @change="ijazahSelected = $event.target.files.length > 0"
                               class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-400 file:text-white hover:file:bg-orange-500 file:cursor-pointer"
                               required>
                        <p class="text-[10px] text-slate-400 mt-2" x-show="!ijazahSelected">Ijazah pendidikan terakhir sesuai kualifikasi.</p>
                        <p class="text-[10px] text-emerald-600 font-bold mt-2 flex items-center gap-1" x-show="ijazahSelected">
                            <span>✓</span> Ijazah siap dikirim
                        </p>
                    </div>

                    <!-- Pas Foto Formal Wajib -->
                    <div class="p-4 rounded-2xl border-2 transition-all" 
                         :class="fotoSelected ? 'border-emerald-500 bg-emerald-50/40' : 'border-dashed border-slate-200 bg-slate-50 hover:bg-slate-100/70'">
                        <div class="flex items-center justify-between mb-2">
                            <label class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                <span>Pas Foto Formal</span>
                            </label>
                        </div>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded bg-slate-200 text-slate-700 uppercase inline-block mb-2">Foto (Maks 3MB)</span>
                        <input type="file" 
                               name="dokumen_foto" 
                               accept="image/png,image/jpeg,image/jpg" 
                               @change="fotoSelected = $event.target.files.length > 0"
                               class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-400 file:text-white hover:file:bg-orange-500 file:cursor-pointer"
                               required>
                        <p class="text-[10px] text-slate-400 mt-2" x-show="!fotoSelected">Pas foto rapi (latar belakang bebas/formal).</p>
                        <p class="text-[10px] text-emerald-600 font-bold mt-2 flex items-center gap-1" x-show="fotoSelected">
                            <span>✓</span> Pas Foto siap dikirim
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Dokumen Pendukung & Opsional (Termasuk KTP) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 block">Bagian 3 (Opsional)</span>
                        <h2 class="font-display text-base font-extrabold text-slate-900">Dokumen Pendukung Tambahan</h2>
                        <p class="text-xs text-slate-500 mt-0.5">KTP, Kartu Keluarga (KK), Sertifikat Keahlian, Portofolio, SKCK, atau Surat Pengalaman Kerja.</p>
                    </div>

                    <button type="button" 
                            @click="addDoc()" 
                            class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition flex items-center gap-1.5 self-start cursor-pointer">
                        <span>+</span> Tambah Berkas Lain
                    </button>
                </div>

                <!-- KTP Card (Opsional) -->
                <div class="p-4 rounded-2xl border transition-all"
                     :class="ktpSelected ? 'border-emerald-500 bg-emerald-50/40' : 'border-slate-200 bg-slate-50/60'">
                    <div class="flex items-center justify-between mb-2">
                        <label class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                            <span>Kartu Tanda Penduduk (KTP)</span>
                            <span class="text-[10px] text-slate-400 font-normal">(Opsional / Tidak Wajib)</span>
                        </label>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded bg-slate-200 text-slate-700 uppercase">PDF/Foto (Maks 3MB)</span>
                    </div>
                    <input type="file" 
                           name="dokumen_ktp" 
                           accept=".pdf,image/png,image/jpeg,image/jpg" 
                           @change="ktpSelected = $event.target.files.length > 0"
                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 file:cursor-pointer">
                    <p class="text-[10px] text-emerald-600 font-bold mt-1.5 flex items-center gap-1" x-show="ktpSelected">
                        <span>✓</span> KTP dilampirkan
                    </p>
                </div>

                <!-- List Dynamic Optional Docs -->
                <div class="space-y-3">
                    <template x-for="(doc, idx) in optionalDocs" :key="doc.id">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <div class="flex-1 w-full sm:w-auto">
                                <label class="text-[10px] font-extrabold text-slate-500 uppercase tracking-wider block mb-1">Nama Dokumen</label>
                                <input type="text" 
                                       name="nama_dokumen_tambahan[]" 
                                       placeholder="Contoh: Sertifikat Digital Marketing / KK" 
                                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:border-orange-500 outline-none"
                                       required>
                            </div>
                            <div class="flex-1 w-full sm:w-auto">
                                <label class="text-[10px] font-extrabold text-slate-500 uppercase tracking-wider block mb-1">Pilih File (PDF/Gambar)</label>
                                <input type="file" 
                                       name="dokumen_tambahan[]" 
                                       accept=".pdf,image/png,image/jpeg,image/jpg,.zip"
                                       class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-200 file:text-slate-800 hover:file:bg-slate-300 file:cursor-pointer"
                                       required>
                            </div>
                            <button type="button" 
                                    @click="removeDoc(doc.id)" 
                                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition text-xs font-bold self-end sm:self-center mt-2 sm:mt-4 cursor-pointer"
                                    title="Hapus berkas ini">
                                ✕ Hapus
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- 4. Catatan / Pesan Pengantar (Opsional) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 space-y-3">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 block">Bagian 4</span>
                    <label for="catatan_pelamar" class="font-display text-base font-extrabold text-slate-900 block">
                        Pesan Pengantar / Catatan untuk Perusahaan <span class="text-xs text-slate-400 font-normal">(Opsional)</span>
                    </label>
                </div>
                <textarea id="catatan_pelamar" 
                          name="catatan_pelamar" 
                          rows="3" 
                          class="w-full px-4 py-3 rounded-2xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:border-orange-500 outline-none transition" 
                          placeholder="Tuliskan motivasi singkat, alasan ketertarikan, atau informasi ketersediaan mulai bekerja..."></textarea>
            </div>

            <!-- Validation Notice & Submit Button -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-md space-y-4">
                <!-- Status Box Warning if incomplete -->
                <div x-show="!allMandatoryFilled" class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-semibold flex items-center gap-2">
                    <span>⚠️</span>
                    <span>Tombol kirim akan aktif setelah Anda melampirkan <b>CV (PDF), Ijazah Terakhir, dan Pas Foto Formal</b>.</span>
                </div>

                <div x-show="allMandatoryFilled" class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold flex items-center gap-2">
                    <span>✓</span>
                    <span>Semua berkas wajib telah lengkap. Anda dapat mengirimkan lamaran sekarang.</span>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <p class="text-[11px] text-slate-400 leading-relaxed text-center sm:text-left">
                        Dengan menekan tombol kirim, Anda menyatakan bahwa seluruh berkas dan data yang diberikan adalah benar dan sah.
                    </p>
                    <button type="submit" 
                            :disabled="!allMandatoryFilled"
                            :class="allMandatoryFilled ? 'bg-orange-400 hover:bg-orange-500 text-white shadow-lg shadow-orange-400/25 cursor-pointer active:scale-[0.98]' : 'bg-slate-200 text-slate-400 cursor-not-allowed'"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-2xl font-bold text-xs transition-all flex items-center justify-center gap-2 shrink-0">
                        <span>Kirim Lamaran Sekarang</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

        </form>

    </div>

@endsection
