<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke pertanyaan induk.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
