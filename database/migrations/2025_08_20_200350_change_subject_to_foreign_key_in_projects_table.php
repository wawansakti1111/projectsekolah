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
        Schema::table('projects', function (Blueprint $table) {
            // Hapus kolom 'subject' yang lama
            $table->dropColumn('subject');
            // Tambahkan kolom 'subject_id' yang baru setelah 'user_id'
            $table->foreignId('subject_id')->after('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn('subject_id');
            $table->string('subject'); // Kembalikan kolom 'subject' jika rollback
        });
    }

};
