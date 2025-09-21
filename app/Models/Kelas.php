<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel di database adalah 'classes', jadi kita perlu spesifikasikan
    protected $table = 'classes';

    protected $fillable = ['name', 'user_id'];

    public function students(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function homeroomTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
