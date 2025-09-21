<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sdg_rubric_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdg_rubric_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('weight')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdg_rubric_items');
    }
};
