<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('review', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('komentar');
            $table->timestamp('dibalas_at')->nullable()->after('balasan');
        });
    }

    public function down(): void
    {
        Schema::table('review', function (Blueprint $table) {
            $table->dropColumn(['balasan', 'dibalas_at']);
        });
    }
};