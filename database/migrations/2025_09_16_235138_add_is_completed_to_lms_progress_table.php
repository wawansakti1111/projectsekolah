<?php

// database/migrations/YYYY_MM_DD_HHMMSS_add_is_completed_to_lms_progress_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lms_progress', function (Blueprint $table) {
            $table->boolean('is_completed')->default(false)->after('lms_content_id');
        });
    }

    public function down(): void
    {
        Schema::table('lms_progress', function (Blueprint $table) {
            $table->dropColumn('is_completed');
        });
    }
};
