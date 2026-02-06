<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a notification for a user.
     */
    public function notify(User $user, string $type, $notifiable = null, array $data = [])
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'notifiable_type' => $notifiable ? get_class($notifiable) : null,
            'notifiable_id' => $notifiable?->id,
            'data' => $data,
        ]);
    }

    /**
     * Notify multiple users.
     */
    public function notifyMany(array $users, string $type, $notifiable = null, array $data = [])
    {
        foreach ($users as $user) {
            $this->notify($user, $type, $notifiable, $data);
        }
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
    }

    /**
     * Mark all notifications as read for a user.
     */
    public function markAllAsRead(User $user)
    {
        $user->notifications()->unread()->update(['read_at' => now()]);
    }

    /**
     * Get unread count for a user.
     */
    public function getUnreadCount(User $user): int
    {
        return $user->notifications()->unread()->count();
    }

    /**
     * Get recent notifications for a user.
     */
    public function getRecent(User $user, int $limit = 10)
    {
        return $user->notifications()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Delete old read notifications (cleanup).
     */
    public function deleteOldReadNotifications(int $days = 30)
    {
        Notification::read()
            ->where('read_at', '<', now()->subDays($days))
            ->delete();
    }
}
