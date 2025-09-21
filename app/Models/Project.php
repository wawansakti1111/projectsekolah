<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProjectSubmission; // <-- Tambahkan ini

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'title',
        'description',
        'attachment_path',
        'deadline',
    ];

    /**
     * Mendapatkan data mata pelajaran proyek ini.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Mendapatkan data guru yang memiliki proyek ini.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendapatkan data SDGs yang terkait dengan proyek ini.
     */
    public function sdgs()
    {
        return $this->belongsToMany(Sdg::class, 'project_sdg');
    }
    public function rubrics()
    {
        return $this->hasMany(Rubric::class);
    }
    public function enrollments()
    {
        return $this->hasMany(ProjectEnrollment::class);
    }
    public function projectRubric()
    {
        return $this->hasOne(ProjectRubric::class);
    }

    public function sdgRubrics()
    {
        return $this->hasMany(SdgRubric::class);
    }
    public function submissions()
    {
        return $this->hasMany(ProjectSubmission::class);
    }

}
