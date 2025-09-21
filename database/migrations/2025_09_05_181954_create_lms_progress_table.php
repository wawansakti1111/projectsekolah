<?php
// .../create_lms_progress_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lms_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lms_content_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // Kunci unik agar siswa tidak bisa menyelesaikan konten yang sama dua kali
            $table->unique(['user_id', 'lms_content_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lms_progress');
    }
};
