<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type',
        'indicator',
        'weight',
        'criteria',
    ];

    protected $casts = [
        'criteria' => 'array', // Otomatis konversi ke/dari JSON
    ];
}
