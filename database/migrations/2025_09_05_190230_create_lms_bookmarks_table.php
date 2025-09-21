<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lms_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lms_material_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // Kunci unik agar tidak bisa bookmark materi yang sama dua kali
            $table->unique(['user_id', 'lms_material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lms_bookmarks');
    }
};
