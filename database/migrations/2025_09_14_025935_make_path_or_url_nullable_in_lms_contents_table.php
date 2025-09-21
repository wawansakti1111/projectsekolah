<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lms_contents', function (Blueprint $table) {
            $table->string('path_or_url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('lms_contents', function (Blueprint $table) {
            // Mengembalikan ke kondisi semula jika migrasi di-rollback
            $table->string('path_or_url')->nullable(false)->change();
        });
    }
};
