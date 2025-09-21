<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE project_enrollments MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'submitted') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE project_enrollments MODIFY COLUMN status ENUM('pending', 'approved', 'rejected') NOT NULL");
    }
};
