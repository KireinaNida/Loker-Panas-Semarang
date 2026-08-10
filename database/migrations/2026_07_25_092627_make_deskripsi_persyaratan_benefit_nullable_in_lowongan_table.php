<?php

use Illuminate\Support\Facades\DB;
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
    Schema::table('lowongan', function (Blueprint $table) {
        $table->text('deskripsi')->nullable()->change();
        $table->text('persyaratan')->nullable()->change();
        $table->text('benefit')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('lowongan', function (Blueprint $table) {
        $table->text('deskripsi')->nullable(false)->change();
        $table->text('persyaratan')->nullable(false)->change();
        $table->text('benefit')->nullable(false)->change();
    });
}
};
