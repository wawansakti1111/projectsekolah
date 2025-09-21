<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    /**
     * Casts atribut agar tipe datanya sesuai.
     */
    protected $casts = [
        'shuffle_questions' => 'boolean',
        'show_correct_answers' => 'boolean',
        'allow_multiple_attempts' => 'boolean',
    ];

    /**
     * Relasi ke guru yang membuat kuis.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke materi LMS yang terkait (jika ada).
     */
    public function lmsMaterial()
    {
        return $this->belongsTo(LmsMaterial::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function lmsContent()
    {
        return $this->hasOne(LmsContent::class);
    }

}
