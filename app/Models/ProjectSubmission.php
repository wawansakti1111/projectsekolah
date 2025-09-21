<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_enrollment_id',
        'final_submission_file',
        'final_submission_link',
    ];

    /**
     * Get the enrollment that owns the submission.
     */
    public function enrollment()
    {
        return $this->belongsTo(ProjectEnrollment::class, 'project_enrollment_id');
    }
}
