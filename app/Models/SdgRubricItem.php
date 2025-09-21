<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SdgRubricItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sdg_rubric_id',
        'name',   // <-- Tambahkan ini
        'weight', // <-- Tambahkan ini
    ];

    /**
     * Get the SDG rubric that owns the item.
     */
    public function rubric(): BelongsTo
    {
        // ▼▼▼ PERBAIKAN: Tambahkan 'sdg_rubric_id' sebagai parameter kedua ▼▼▼
        return $this->belongsTo(SdgRubric::class, 'sdg_rubric_id');
    }
}
