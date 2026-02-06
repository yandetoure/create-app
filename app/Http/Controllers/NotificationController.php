<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display all notifications.
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get notifications for dropdown (AJAX).
     */
    public function dropdown()
    {
        $notifications = $this->notificationService->getRecent(auth()->user(), 5);
        $unreadCount = $this->notificationService->getUnreadCount(auth()->user());

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $this->notificationService->markAsRead($notification);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect($notification->url ?? back());
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(auth()->user());

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Toutes les notifications ont été marquées comme lues');
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification supprimée');
    }
}
