<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // Menghubungkan kuis dengan guru yang membuatnya
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // Menghubungkan kuis dengan materi LMS (opsional)
            $table->foreignId('lms_material_id')->nullable()->constrained('lms_materials')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
