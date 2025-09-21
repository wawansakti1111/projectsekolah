<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // 1. Status Kuis (draft, active)
            $table->string('status')->default('draft')->after('lms_material_id');

            // 2. Batas Waktu Pengerjaan (dalam menit)
            $table->unsignedInteger('duration')->nullable()->after('status');

            // 3. Pengaturan Boolean
            $table->boolean('shuffle_questions')->default(false)->after('duration');
            $table->boolean('show_correct_answers')->default(true)->after('shuffle_questions');
            $table->boolean('allow_multiple_attempts')->default(false)->after('show_correct_answers');
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'duration',
                'shuffle_questions',
                'show_correct_answers',
                'allow_multiple_attempts'
            ]);
        });
    }
};
