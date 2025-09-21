<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('project_enrollments', function (Blueprint $table) {
            // Kita menggunakan DB::statement karena ini cara paling aman untuk mengubah kolom ENUM
            // Daftar status lengkap: pending, approved, rejected, submitted, revision_needed, graded
            DB::statement("ALTER TABLE project_enrollments CHANGE COLUMN status status ENUM('pending', 'approved', 'rejected', 'submitted', 'revision_needed', 'graded') NOT NULL DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_enrollments', function (Blueprint $table) {
            // Mengembalikan ke kondisi semula jika migrasi di-rollback
            DB::statement("ALTER TABLE project_enrollments CHANGE COLUMN status status ENUM('pending', 'approved', 'rejected', 'submitted') NOT NULL DEFAULT 'pending'");
        });
    }
};
