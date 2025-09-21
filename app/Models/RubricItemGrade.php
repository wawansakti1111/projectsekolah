<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubricItemGrade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Relasi ke nilai utama
    public function projectGrade()
    {
        return $this->belongsTo(ProjectGrade::class);
    }

    // Relasi polymorphic ke item rubrik
    public function gradable()
    {
        return $this->morphTo();
    }
}
