<?php
// .../create_rubric_item_grades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rubric_item_grades', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke entri nilai utama di project_grades
            $table->foreignId('project_grade_id')->constrained()->cascadeOnDelete();

            // Kolom untuk polymorphic relationship
            // Bisa menyimpan nilai untuk ProjectRubricItem atau SdgRubricItem
            $table->morphs('gradable');

            $table->unsignedInteger('score'); // Nilai untuk indikator ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rubric_item_grades');
    }
};
