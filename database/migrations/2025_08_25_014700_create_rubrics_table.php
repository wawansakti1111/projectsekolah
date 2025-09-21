<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['project', 'sdg']); // Jenis rubrik
            $table->string('indicator'); // Nama indikator, cth: "Kreativitas"
            $table->integer('weight'); // Bobot penilaian, cth: 20 (untuk 20%)
        $table->json('criteria'); // Menyimpan kriteria skor, cth: [{"score": 4, "description": "Sangat Baik"}]
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubrics');
    }
};
