<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongan')->onDelete('cascade');
            $table->enum('status', ['Menunggu Review', 'Diteruskan', 'Ditolak'])->default('Menunggu Review');
            $table->text('catatan_admin')->nullable();
            $table->text('catatan_pelamar')->nullable();
            $table->timestamp('diteruskan_at')->nullable();
            $table->timestamp('ditolak_at')->nullable();
            $table->timestamps();
        });

        Schema::create('dokumen_lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamaran')->onDelete('cascade');
            $table->string('jenis_dokumen', 50); // 'cv', 'ktp', 'ijazah', 'foto_formal', 'tambahan'
            $table->string('nama_dokumen', 150); // e.g. "Curriculum Vitae (CV)", "KTP", "Sertifikat BNSP"
            $table->string('nama_file_asli');
            $table->string('file_path');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('mime_type', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_lamaran');
        Schema::dropIfExists('lamaran');
    }
};
