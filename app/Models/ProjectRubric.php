<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Tambahkan ini

class ProjectRubric extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id'
    ];

    /**
     * Get the project that owns the rubric.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the rubric items for the project rubric.
     */
    public function items()
    {
        return $this->hasMany(ProjectRubricItem::class);
    }
}
