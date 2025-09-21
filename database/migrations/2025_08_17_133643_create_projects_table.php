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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Guru yang membuat
            $table->string('title'); // Judul Proyek
            $table->string('subject'); // Mata Pelajaran
            $table->text('description'); // Deskripsi singkat
            $table->string('attachment_path')->nullable(); // Path untuk file materi/lampiran
            $table->date('deadline')->nullable(); // Batas waktu (opsional)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
