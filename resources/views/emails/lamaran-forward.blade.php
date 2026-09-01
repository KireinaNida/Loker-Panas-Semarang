<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Kerja - Info Loker Panas Semarang</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 20px; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .header { background: linear-gradient(135deg, #fb923c, #3b82f6); padding: 24px 30px; color: #ffffff; }
        .header h1 { margin: 0; font-size: 20px; font-weight: 800; }
        .header p { margin: 4px 0 0 0; font-size: 13px; opacity: 0.9; }
        .content { padding: 30px; }
        .badge { display: inline-block; padding: 4px 12px; background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5; border-radius: 20px; font-size: 12px; font-weight: bold; margin-bottom: 15px; }
        .card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px; margin: 15px 0; }
        .card-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: bold; margin-bottom: 8px; }
        .row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px dashed #e2e8f0; font-size: 13px; }
        .row:last-child { border-bottom: none; }
        .label { color: #64748b; }
        .value { font-weight: bold; color: #0f172a; }
        .docs-list { list-style: none; padding: 0; margin: 8px 0 0 0; }
        .docs-item { padding: 8px 12px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; margin-bottom: 6px; font-size: 12px; font-weight: bold; color: #334155; }
        .footer { padding: 20px 30px; background: #f1f5f9; border-top: 1px solid #e2e8f0; text-align: center; font-size: 11px; color: #64748b; }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Info Loker Panas Semarang</h1>
            <p>Penerusan Berkas Lamaran Kerja Kandidat Terverifikasi</p>
        </div>

        <!-- Body -->
        <div class="content">
            <div class="badge">Lamaran Kerja Masuk</div>
            
            <h2 style="margin: 0 0 8px 0; font-size: 18px; color: #0f172a;">
                Posisi: {{ $lowongan->nama_posisi }}
            </h2>
            <p style="margin: 0 0 16px 0; font-size: 13px; color: #64748b;">
                Perusahaan: <b>{{ $lowongan->nama_perusahaan }}</b> &bull; Lokasi: {{ $lowongan->lokasi }}
            </p>

            <p style="font-size: 13px; color: #334155;">
                Halo Tim HRD <b>{{ $lowongan->nama_perusahaan }}</b>,<br>
                Berikut kami teruskan berkas lamaran kerja dari kandidat yang telah mendaftar melalui portal <b>Info Loker Panas Semarang</b> dan telah melewati tahap verifikasi kelengkapan berkas:
            </p>

            <!-- Profil Pelamar -->
            <div class="card">
                <div class="card-title">Profil & Data Diri Pelamar</div>
                <div class="row">
                    <span class="label">Nama Lengkap</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                @if($user->nama_panggilan)
                <div class="row">
                    <span class="label">Nama Panggilan</span>
                    <span class="value">{{ $user->nama_panggilan }}</span>
                </div>
                @endif
                <div class="row">
                    <span class="label">Alamat Email</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="row">
                    <span class="label">Nomor WhatsApp / HP</span>
                    <span class="value">{{ $user->no_telepon ?: '-' }}</span>
                </div>
                <div class="row">
                    <span class="label">Jenis Kelamin</span>
                    <span class="value">{{ $user->jenis_kelamin ?: '-' }}</span>
                </div>
                <div class="row">
                    <span class="label">Tanggal Lahir</span>
                    <span class="value">{{ $user->tgl_lahir ? $user->tgl_lahir->format('d F Y') : '-' }}</span>
                </div>
            </div>

            <!-- Pesan Pengantar -->
            @if($lamaran->catatan_pelamar)
            <div class="card" style="background: #fffbeb; border-color: #fde68a;">
                <div class="card-title" style="color: #b45309;">Pesan Pengantar / Catatan Pelamar</div>
                <p style="margin: 0; font-size: 13px; color: #78350f; font-style: italic;">
                    "{{ $lamaran->catatan_pelamar }}"
                </p>
            </div>
            @endif

            <!-- Lampiran Berkas -->
            <div class="card">
                <div class="card-title">Lampiran Berkas (Terlampir pada Email ini)</div>
                <ul class="docs-list">
                    @foreach($dokumens as $dok)
                    <li class="docs-item">
                        📎 {{ $dok->nama_dokumen }} ({{ $dok->nama_file_asli }}) - {{ $dok->formatted_size }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <p style="font-size: 12px; color: #64748b; margin-top: 20px;">
                Anda dapat langsung menghubungi kandidat melalui alamat email <b>{{ $user->email }}</b> atau nomor telepon <b>{{ $user->no_telepon }}</b> untuk tahapan seleksi / wawancara berikutnya.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            Email ini dikirim secara otomatis oleh sistem <b>Info Loker Panas Semarang</b>.<br>
            Portal Informasi Lowongan Kerja Terpercaya di Kota Semarang & Sekitarnya.
        </div>
    </div>

</body>
</html>
