<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lms_contents', function (Blueprint $table) {
            // Tambahkan kolom untuk foreign key ke kuis, dibuat nullable
            $table->foreignId('quiz_id')->nullable()->after('lms_material_id')->constrained('quizzes')->nullOnDelete();
        });

        // Ubah tipe data kolom 'type' untuk menambahkan 'quiz'
        // ENUM('file', 'video_link') menjadi ENUM('file', 'video_link', 'quiz')
        DB::statement("ALTER TABLE lms_contents CHANGE COLUMN type type ENUM('file', 'video_link', 'quiz') NOT NULL");
    }

    public function down(): void
    {
        Schema::table('lms_contents', function (Blueprint $table) {
            // Hapus foreign key constraint sebelum drop kolom
            $table->dropForeign(['quiz_id']);
            $table->dropColumn('quiz_id');
        });

        // Kembalikan kolom 'type' ke kondisi semula
        DB::statement("ALTER TABLE lms_contents CHANGE COLUMN type type ENUM('file', 'video_link') NOT NULL");
    }
};
