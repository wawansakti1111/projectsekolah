<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke kuis induk.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Relasi ke semua pilihan jawaban untuk pertanyaan ini.
     */
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    /**
     * Relasi untuk mengambil hanya satu jawaban yang benar.
     */
    public function correctAnswer()
    {
        return $this->hasOne(QuestionOption::class)->where('is_correct', true);
    }
}
