<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollment_members', function (Blueprint $table) {
            // Hapus kolom 'name' jika sudah ada
            $table->dropColumn('name');

            // Tambahkan kolom 'user_id'
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('enrollment_members', function (Blueprint $table) {
            // Hapus foreign key dan kolom user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Tambahkan kembali kolom 'name' jika diperlukan
            $table->string('name')->nullable();
        });
    }
};
