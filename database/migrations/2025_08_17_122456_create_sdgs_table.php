<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sdgs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama SDG, contoh: "Tanpa Kemiskinan"
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdgs');
    }
};
