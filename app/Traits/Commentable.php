<?php

namespace App\Traits;

use App\Models\Comment;

trait Commentable
{
    /**
     * Get all comments for this model.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id') // Only top-level comments
            ->with(['user', 'replies.user'])
            ->latest();
    }

    /**
     * Get all comments including replies.
     */
    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->with('user')
            ->latest();
    }

    /**
     * Add a comment to this model.
     */
    public function addComment(string $content, $userId = null, $parentId = null)
    {
        return $this->comments()->create([
            'user_id' => $userId ?? auth()->id(),
            'content' => $content,
            'parent_id' => $parentId,
        ]);
    }
}
