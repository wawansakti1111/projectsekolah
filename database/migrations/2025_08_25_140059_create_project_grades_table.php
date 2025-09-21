<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_enrollment_id')->constrained()->cascadeOnDelete();
            $table->integer('score')->nullable();
            $table->string('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_grades');
    }
};
