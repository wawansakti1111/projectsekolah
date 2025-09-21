<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'group_name',
        'reason_to_join',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // di dalam class ProjectEnrollment
    public function members()
    {
        return $this->hasMany(EnrollmentMember::class);
    }
    public function allMembers()
    {
        return $this->members(); // Ini perlu disesuaikan jika ketua disimpan di tabel lain
    }
    public function submissions()
    {
        return $this->hasMany(ProjectSubmission::class, 'project_enrollment_id')->latest();
    }
    public function grades()
    {
        return $this->hasMany(ProjectGrade::class);
    }


}
