<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // <-- Pastikan ini ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_sdg');
    }
}
