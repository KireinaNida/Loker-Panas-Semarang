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
    Schema::table('lowongan', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('link_sumber');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('lowongan', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}
};
