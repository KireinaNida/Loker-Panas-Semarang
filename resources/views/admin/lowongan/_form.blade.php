<div x-data="{ tab: '{{ $errors->hasAny(['deskripsi', 'persyaratan', 'benefit']) ? 'detail' : ($errors->hasAny(['email_perusahaan', 'wa_perusahaan', 'website_perusahaan', 'link_sumber']) ? 'kontak' : 'dasar') }}' }">
    <div class="flex bg-white rounded-2xl p-1.5 mb-6 border border-panas-border max-w-md shadow-panas-sm">
        <button type="button" @click="tab = 'dasar'" :class="tab === 'dasar' ? 'bg-panas-dark text-panas-primary shadow-sm' : 'text-panas-dark/60 hover:text-panas-dark'" class="flex-1 py-2.5 rounded-xl text-xs font-bold transition-all">
            Info Dasar
        </button>
        <button type="button" @click="tab = 'detail'" :class="tab === 'detail' ? 'bg-panas-dark text-panas-primary shadow-sm' : 'text-panas-dark/60 hover:text-panas-dark'" class="flex-1 py-2.5 rounded-xl text-xs font-bold transition-all relative">
            Deskripsi
            @if($errors->hasAny(['deskripsi', 'persyaratan', 'benefit']))
                <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500"></span>
            @endif
        </button>
        <button type="button" @click="tab = 'kontak'" :class="tab === 'kontak' ? 'bg-panas-dark text-panas-primary shadow-sm' : 'text-panas-dark/60 hover:text-panas-dark'" class="flex-1 py-2.5 rounded-xl text-xs font-bold transition-all relative">
            Kontak
            @if($errors->hasAny(['email_perusahaan', 'wa_perusahaan', 'website_perusahaan', 'link_sumber']))
                <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500"></span>
            @endif
        </button>
    </div>

    {{-- TAB: Info Dasar --}}
    <div x-show="tab === 'dasar'" class="bg-white rounded-3xl p-6 sm:p-8 border border-panas-border shadow-panas-sm space-y-4 mb-6">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Nama Posisi</label>
                <input type="text" name="nama_posisi" value="{{ old('nama_posisi', $lowongan->nama_posisi ?? '') }}"
                       class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none"
                       placeholder="Contoh: Admin Operasional">
                @error('nama_posisi') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $lowongan->nama_perusahaan ?? '') }}"
                       class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none"
                       placeholder="Contoh: PT Sumber Makmur">
                @error('nama_perusahaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Alamat Perusahaan <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <textarea name="alamat_perusahaan" rows="2"
                      class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none"
                      placeholder="Alamat lengkap perusahaan di Semarang">{{ old('alamat_perusahaan', $lowongan->alamat_perusahaan ?? '') }}</textarea>
            @error('alamat_perusahaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Lokasi Kerja</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi ?? '') }}" placeholder="Contoh: Semarang Barat, Jawa Tengah"
                       class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
                @error('lokasi') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Kategori Pekerjaan</label>
                <select name="kategori_id" class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none cursor-pointer">
                    <option value="">Pilih Kategori</option>
                    @foreach(($kategoris ?? $kategori ?? []) as $k)
                    <option value="{{ $k->id }}" @selected(old('kategori_id', $lowongan->kategori_id ?? '') == $k->id)>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('kategori_id') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Tingkat Pendidikan</label>
                <select name="tingkat_pendidikan" class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none cursor-pointer">
                    <option value="">Pilih Jenjang</option>
                    @foreach(['SMA/SMK', 'D3', 'D4', 'S1', 'S2', 'Semua Jenjang'] as $opt)
                    <option value="{{ $opt }}" @selected(old('tingkat_pendidikan', $lowongan->tingkat_pendidikan ?? '') === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
                @error('tingkat_pendidikan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Tipe Pekerjaan</label>
                <select name="tipe_pekerjaan" class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none cursor-pointer">
                    <option value="">Pilih Tipe</option>
                    @foreach(['Full Time', 'Part Time', 'Kontrak', 'Magang', 'Freelance'] as $opt)
                    <option value="{{ $opt }}" @selected(old('tipe_pekerjaan', $lowongan->tipe_pekerjaan ?? '') === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
                @error('tipe_pekerjaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Status Postingan</label>
                <select name="status" class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none cursor-pointer">
                    <option value="aktif" @selected(old('status', $lowongan->status ?? 'aktif') === 'aktif')>Aktif</option>
                    <option value="nonaktif" @selected(old('status', $lowongan->status ?? '') === 'nonaktif')>Nonaktif</option>
                </select>
                @error('status') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Gaji <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
                <input type="text" name="gaji" value="{{ old('gaji', $lowongan->gaji ?? '') }}" placeholder="Contoh: Rp3.000.000 - Rp4.000.000"
                       class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
                @error('gaji') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Batas Lamar <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
                <input type="date" name="batas_lamar" value="{{ old('batas_lamar', isset($lowongan->batas_lamar) && $lowongan->batas_lamar ? $lowongan->batas_lamar->format('Y-m-d') : '') }}"
                       class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
                @error('batas_lamar') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Photo upload field removed in accordance with design specs -->
    </div>

    {{-- TAB: Deskripsi & Syarat --}}
    <div x-show="tab === 'detail'" x-cloak class="bg-white rounded-3xl p-6 sm:p-8 border border-panas-border shadow-panas-sm space-y-4 mb-6">
        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Deskripsi Pekerjaan <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none"
                      placeholder="Jelaskan gambaran umum tugas dan tanggung jawab pekerjaan...">{{ old('deskripsi', $lowongan->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Persyaratan Kualifikasi <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <textarea name="persyaratan" rows="4" placeholder="Satu baris per poin persyaratan"
                      class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">{{ old('persyaratan', $lowongan->persyaratan ?? '') }}</textarea>
            @error('persyaratan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Benefit & Fasilitas <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <textarea name="benefit" rows="3" placeholder="Gaji pokok, BPJS, bonus kinerja, dll"
                      class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">{{ old('benefit', $lowongan->benefit ?? '') }}</textarea>
            @error('benefit') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- TAB: Kontak --}}
    <div x-show="tab === 'kontak'" x-cloak class="bg-white rounded-3xl p-6 sm:p-8 border border-panas-border shadow-panas-sm space-y-4 mb-6">
        <p class="text-xs text-panas-dark/60 mb-2">Isi minimal salah satu kontak di bawah agar tombol "Lamar via Email/WhatsApp" muncul di halaman detail lowongan.</p>

        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Email Perusahaan <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <input type="email" name="email_perusahaan" value="{{ old('email_perusahaan', $lowongan->email_perusahaan ?? '') }}" placeholder="hrd@perusahaan.co.id"
                   class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
            @error('email_perusahaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Nomor WhatsApp Perusahaan <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <input type="text" name="wa_perusahaan" value="{{ old('wa_perusahaan', $lowongan->wa_perusahaan ?? '') }}" placeholder="6281234567890 (format 62, tanpa spasi/strip)"
                   class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
            @error('wa_perusahaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Website Perusahaan <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <input type="url" name="website_perusahaan" value="{{ old('website_perusahaan', $lowongan->website_perusahaan ?? '') }}" placeholder="https://perusahaan.co.id"
                   class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
            @error('website_perusahaan') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-panas-dark uppercase tracking-wider mb-1.5">Link Sumber / Info Resmi <span class="text-panas-dark/40 font-normal lowercase">(opsional)</span></label>
            <input type="text" name="link_sumber" value="{{ old('link_sumber', $lowongan->link_sumber ?? '') }}" placeholder="Link asal info lowongan (situs resmi, media sosial, dll)"
                   class="w-full border border-panas-border rounded-xl px-4 py-3 text-sm bg-panas-light/40 focus:bg-white focus:border-panas-ember outline-none">
            @error('link_sumber') <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <!-- Submit Action Buttons -->
    <div class="flex gap-3 justify-end items-center">
        <a href="{{ route('admin.lowongan.index') }}" class="px-5 py-3 rounded-xl border border-panas-border text-panas-dark text-xs font-bold hover:bg-panas-light transition-colors">
            Batal
        </a>
        <button type="submit" class="px-6 py-3 rounded-xl bg-panas-ember hover:bg-panas-ember-dark text-white text-xs font-bold shadow-panas-glow transition-all active:scale-[0.98]">
            Simpan Lowongan
        </button>
    </div>
</div>