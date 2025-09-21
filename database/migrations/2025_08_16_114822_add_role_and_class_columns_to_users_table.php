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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan foreign key untuk role_id setelah kolom 'password'
            $table->foreignId('role_id')->nullable()->after('password')->constrained()->onDelete('set null');
            // Menambahkan foreign key untuk class_id (khusus siswa)
            $table->foreignId('class_id')->nullable()->after('role_id')->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['class_id']);
            $table->dropColumn(['role_id', 'class_id']);
        });
    }
};
