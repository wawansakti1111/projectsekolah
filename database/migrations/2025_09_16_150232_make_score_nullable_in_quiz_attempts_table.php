<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            // Mengubah kolom 'score' agar bisa menerima nilai NULL
            $table->unsignedInteger('score')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            // Mengembalikan ke kondisi semula jika migrasi di-rollback
            $table->unsignedInteger('score')->nullable(false)->change();
        });
    }
};
