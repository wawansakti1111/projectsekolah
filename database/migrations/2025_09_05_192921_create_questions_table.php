<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            // Menghubungkan opsi ke pertanyaan induknya
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->text('option_text');
            // Menandai apakah ini adalah jawaban yang benar
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
