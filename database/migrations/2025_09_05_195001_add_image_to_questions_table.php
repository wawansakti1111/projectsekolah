<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            // Menambahkan kolom untuk path gambar setelah question_text
            // Dibuat nullable karena tidak semua pertanyaan punya gambar
            $table->string('image')->nullable()->after('question_text');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
