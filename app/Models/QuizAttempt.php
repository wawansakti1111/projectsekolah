<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke siswa yang mengerjakan.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke kuis yang dikerjakan.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Relasi ke semua rincian jawaban siswa untuk percobaan ini.
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
