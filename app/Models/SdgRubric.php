<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SdgRubric extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'sdg_id',
    ];

    /**
     * Get the project that owns the SDG rubric.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the SDG that the rubric is for.
     */
    public function sdg(): BelongsTo
    {
        return $this->belongsTo(Sdg::class);
    }

    /**
     * Get the rubric items for the SDG rubric.
     */
    public function items(): HasMany
    {
        return $this->hasMany(SdgRubricItem::class);
    }
}
