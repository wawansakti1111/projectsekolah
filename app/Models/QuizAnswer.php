<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke percobaan kuis induk.
     */
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    /**
     * Relasi ke pertanyaan yang dijawab.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Relasi ke opsi jawaban yang dipilih siswa.
     */
    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }
}
