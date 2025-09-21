<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini


class EnrollmentMember extends Model
{
    use HasFactory;

    // Perbaiki fillable: Gunakan 'user_id'
    protected $fillable = ['project_enrollment_id', 'user_id'];

    /**
     * Get the user that owns the enrollment member.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
