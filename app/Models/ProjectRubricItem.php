<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectRubricItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_rubric_id',
        'name',
        'weight',
    ];

    /**
     * Get the rubric that owns the item.
     */
    // ▼▼▼ UBAH NAMA FUNGSI INI ▼▼▼
    public function projectRubric(): BelongsTo
    {
        return $this->belongsTo(ProjectRubric::class);
    }
}
