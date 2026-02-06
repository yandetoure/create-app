<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the notifiable entity (polymorphic).
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Scope to get only unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope to get only read notifications.
     */
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    /**
     * Check if notification is unread.
     */
    public function isUnread()
    {
        return is_null($this->read_at);
    }

    /**
     * Get formatted message based on notification type.
     */
    public function getMessageAttribute()
    {
        return match ($this->type) {
            'project_assigned' => "Vous avez été assigné au projet \"{$this->data['project_name']}\"",
            'task_status_changed' => "La tâche \"{$this->data['task_name']}\" est maintenant {$this->data['status']}",
            'comment_added' => "{$this->data['user_name']} a commenté sur \"{$this->data['subject']}\"",
            'deliverable_uploaded' => "Un livrable a été soumis pour \"{$this->data['project_name']}\"",
            'demo_added' => "Une nouvelle démo a été ajoutée au projet \"{$this->data['project_name']}\"",
            'project_completed' => "Le projet \"{$this->data['project_name']}\" est terminé",
            default => "Nouvelle notification",
        };
    }

    /**
     * Get icon for notification type.
     */
    public function getIconAttribute()
    {
        return match ($this->type) {
            'project_assigned' => '📋',
            'task_status_changed' => '✅',
            'comment_added' => '💬',
            'deliverable_uploaded' => '📦',
            'demo_added' => '🎬',
            'project_completed' => '🎉',
            default => '🔔',
        };
    }

    /**
     * Get URL for notification.
     */
    public function getUrlAttribute()
    {
        if ($this->notifiable_type && $this->notifiable_id) {
            $model = $this->notifiable_type::find($this->notifiable_id);

            if ($model instanceof Project) {
                return route('developer.projects.show', $model);
            }
            // Add more model types as needed
        }

        return '#';
    }
}
