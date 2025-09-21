<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Tambahkan ini
use App\Models\LmsMaterial; // <-- Tambahkan ini
use App\Models\LmsProgress; // <-- Tambahkan ini


class LmsContent extends Model
{
    use HasFactory;
    protected $fillable = ['lms_material_id', 'title', 'description', 'type', 'path_or_url', 'order_column','quiz_id'];

    public function material() {
        // ▼▼▼ INILAH PERBAIKANNYA ▼▼▼
        // Secara eksplisit beritahu Laravel untuk menggunakan kolom 'lms_material_id'
        return $this->belongsTo(LmsMaterial::class, 'lms_material_id');
        // ▲▲▲ PERBAIKAN SELESAI ▲▲▲
    }

    public function completions()
    {
        return $this->belongsToMany(User::class, 'lms_progress')->withTimestamps();
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function lmsMaterial(): BelongsTo
    {
        return $this->belongsTo(LmsMaterial::class, 'lms_material_id');
    }
    public function progress()
    {
        return $this->hasMany(LmsProgress::class);
    }



}
