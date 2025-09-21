<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGrade extends Model
{
    protected $guarded = ['id']; // Lebih aman daripada fillable

    // TAMBAHKAN RELASI INI
    public function itemGrades()
    {
        return $this->hasMany(RubricItemGrade::class);
    }

}
