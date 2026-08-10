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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('nama_posisi');
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan');
            $table->string('website_perusahaan')->nullable();
            $table->string('lokasi');
            $table->string('tingkat_pendidikan');
            $table->string('tipe_pekerjaan');
            $table->string('gaji')->nullable();
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->text('benefit')->nullable();
            $table->date('batas_lamar');
            $table->string('link_sumber');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
