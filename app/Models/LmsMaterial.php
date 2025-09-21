<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LmsMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subject_id', 'title', 'description', 'order_column'];

    public function uploader() { return $this->belongsTo(User::class, 'user_id'); }
    public function subject() { return $this->belongsTo(Subject::class); }
    public function contents() { return $this->hasMany(LmsContent::class)->orderBy('order_column'); }
    public function attachments() {
        return $this->hasMany(LmsContent::class);

    }
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'lms_bookmarks')->withTimestamps();
    }

}
