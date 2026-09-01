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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_panggilan', 100)->nullable()->after('name');
            $table->date('tgl_lahir')->nullable()->after('nama_panggilan');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('tgl_lahir');
            $table->string('no_telepon', 30)->nullable()->after('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_panggilan', 'tgl_lahir', 'jenis_kelamin', 'no_telepon']);
        });
    }
};
