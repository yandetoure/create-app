<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        // Get the commentable entity
        $commentable = $comment->commentable;

        // Notify relevant users
        $this->notifyRelevantUsers($comment, $commentable);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'comment' => $comment->load('user'),
            ]);
        }

        return back()->with('success', 'Commentaire ajouté avec succès !');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        // Check if user can delete
        if (!$comment->canDelete(auth()->user())) {
            abort(403, 'Vous ne pouvez pas supprimer ce commentaire');
        }

        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Commentaire supprimé');
    }

    /**
     * Notify relevant users about the comment.
     */
    protected function notifyRelevantUsers(Comment $comment, $commentable)
    {
        $usersToNotify = [];

        // Determine who to notify based on commentable type
        if ($commentable instanceof \App\Models\Project) {
            // Notify client, developer, PM, CM (except the commenter)
            if ($commentable->user_id !== auth()->id()) {
                $usersToNotify[] = $commentable->user;
            }
            if ($commentable->developer_id && $commentable->developer_id !== auth()->id()) {
                $usersToNotify[] = $commentable->developer;
            }
            if ($commentable->project_manager_id && $commentable->project_manager_id !== auth()->id()) {
                $usersToNotify[] = $commentable->projectManager;
            }
            if ($commentable->community_manager_id && $commentable->community_manager_id !== auth()->id()) {
                $usersToNotify[] = $commentable->communityManager;
            }

            $subject = $commentable->name;
        } elseif ($commentable instanceof \App\Models\Task) {
            // Notify project owner and developer
            if ($commentable->project->user_id !== auth()->id()) {
                $usersToNotify[] = $commentable->project->user;
            }
            if ($commentable->project->developer_id && $commentable->project->developer_id !== auth()->id()) {
                $usersToNotify[] = $commentable->project->developer;
            }

            $subject = $commentable->name;
        }

        // Send notifications
        foreach ($usersToNotify as $user) {
            if ($user) {
                $this->notificationService->notify(
                    $user,
                    'comment_added',
                    $commentable,
                    [
                        'user_name' => auth()->user()->name,
                        'subject' => $subject ?? 'un élément',
                    ]
                );
            }
        }
    }
}
