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
    DB::statement('ALTER TABLE lowongan MODIFY link_sumber VARCHAR(255) NULL');
    DB::statement('ALTER TABLE lowongan MODIFY gaji VARCHAR(100) NULL');
    DB::statement('ALTER TABLE lowongan MODIFY alamat_perusahaan VARCHAR(200) NULL');
    DB::statement('ALTER TABLE lowongan MODIFY website_perusahaan VARCHAR(200) NULL');
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    DB::statement('ALTER TABLE lowongan MODIFY link_sumber VARCHAR(255) NOT NULL');
    DB::statement('ALTER TABLE lowongan MODIFY gaji VARCHAR(100) NOT NULL');
    DB::statement('ALTER TABLE lowongan MODIFY alamat_perusahaan VARCHAR(200) NOT NULL');
    DB::statement('ALTER TABLE lowongan MODIFY website_perusahaan VARCHAR(200) NOT NULL');
}
};
