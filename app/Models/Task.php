<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category',
        'due_date',
        'assignee_id',
        'creator_id',
        'is_archived',
    ];

    protected $casts = [
        'due_date'    => 'date',
        'is_archived' => 'boolean',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // ── Scopes ─────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}