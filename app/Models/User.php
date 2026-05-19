<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Relationships ──────────────────────────────────────────

    // Task yang diassign ke user ini
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }

    // Task yang dibuat oleh user ini
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }
}