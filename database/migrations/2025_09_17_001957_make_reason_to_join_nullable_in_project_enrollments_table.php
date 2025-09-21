<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_enrollments', function (Blueprint $table) {
            $table->string('reason_to_join')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('project_enrollments', function (Blueprint $table) {
            $table->string('reason_to_join')->nullable(false)->change();
        });
    }
};
