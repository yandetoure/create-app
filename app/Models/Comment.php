<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'content',
        'parent_id',
    ];

    /**
     * Get the user who created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the commentable entity (polymorphic).
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the parent comment (for nested replies).
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get the replies to this comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user');
    }

    /**
     * Check if user can delete this comment.
     */
    public function canDelete(User $user): bool
    {
        return $this->user_id === $user->id || $user->hasRole('admin');
    }

    /**
     * Get formatted time ago.
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
