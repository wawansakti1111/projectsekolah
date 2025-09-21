<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\LmsBookmark; // <-- Tambahkan ini

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'username',
        'role_id',
        'class_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
        // PASTIKAN TIPE DATA DI SINI HANYA 'BelongsTo'
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // PASTIKAN TIPE DATA DI SINI HANYA 'BelongsTo'
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
    // Di dalam class User
    public function lmsMaterials()
    {
        return $this->hasMany(LmsMaterial::class);
    }

    public function lmsCompletions()
    {
        return $this->belongsToMany(LmsContent::class, 'lms_progress')->withTimestamps();
    }
    public function bookmarkedLmsMaterials()
    {
        return $this->belongsToMany(LmsMaterial::class, 'lms_bookmarks')->withTimestamps();
    }



}
