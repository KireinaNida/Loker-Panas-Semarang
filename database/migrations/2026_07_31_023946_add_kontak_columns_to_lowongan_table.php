<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->string('email_perusahaan')->nullable()->after('link_sumber');
            $table->string('wa_perusahaan', 20)->nullable()->after('email_perusahaan');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropColumn(['email_perusahaan', 'wa_perusahaan']);
        });
    }
};