<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongan')->onDelete('cascade');
            $table->string('metode'); // 'email' atau 'wa'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_lamaran');
    }
};