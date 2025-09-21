<?php

// database/migrations/xxxx_xx_xx_create_project_submissions_table.php

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
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->id();
            // Kunci asing untuk menghubungkan submission ke pendaftaran proyek
            $table->foreignId('project_enrollment_id')->constrained()->onDelete('cascade');

            // Kolom untuk file dan link
            $table->string('final_submission_file')->nullable();
            $table->string('final_submission_link')->nullable();

            // Timestamp untuk melacak kapan submission dibuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_submissions');
    }
};
