<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use App\Models\Task;
use App\Services\TimeTrackingService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeEntryController extends Controller
{
    protected $timeTrackingService;

    public function __construct(TimeTrackingService $timeTrackingService)
    {
        $this->timeTrackingService = $timeTrackingService;
    }

    /**
     * Display time entries for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // Get date range (default to this week)
        $startDate = $request->get('start_date')
            ? Carbon::parse($request->get('start_date'))
            : Carbon::now()->startOfWeek();

        $endDate = $request->get('end_date')
            ? Carbon::parse($request->get('end_date'))
            : Carbon::now()->endOfWeek();

        $entries = $this->timeTrackingService->getTimesheet($user, $startDate, $endDate);
        $runningTimer = $this->timeTrackingService->getRunningTimer($user);

        $stats = [
            'today' => $this->timeTrackingService->getTodayTotalTime($user),
            'week' => $this->timeTrackingService->getWeekTotalTime($user),
            'total' => $entries->sum('duration'),
        ];

        return view('time-tracking.index', compact('entries', 'runningTimer', 'stats', 'startDate', 'endDate'));
    }

    /**
     * Start a timer for a task.
     */
    public function start(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'description' => 'nullable|string|max:500',
        ]);

        $task = Task::findOrFail($request->task_id);

        // Verify user has access to this task
        if ($task->project->developer_id !== auth()->id()) {
            abort(403, 'Vous n\'avez pas accès à cette tâche');
        }

        $entry = $this->timeTrackingService->startTimer($task, auth()->user(), $request->description);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'entry' => $entry->load('task'),
            ]);
        }

        return back()->with('success', 'Chronomètre démarré !');
    }

    /**
     * Stop the running timer.
     */
    public function stop(TimeEntry $entry)
    {
        // Verify ownership
        if ($entry->user_id !== auth()->id()) {
            abort(403);
        }

        $this->timeTrackingService->stopTimer($entry);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'entry' => $entry->fresh(),
            ]);
        }

        return back()->with('success', 'Chronomètre arrêté ! Durée: ' . $entry->formatted_duration);
    }

    /**
     * Store a manual time entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'nullable|exists:tasks,id',
            'project_id' => 'nullable|exists:projects,id',
            'description' => 'nullable|string|max:500',
            'started_at' => 'required|date',
            'ended_at' => 'required|date|after:started_at',
        ]);

        $entry = $this->timeTrackingService->addManualEntry([
            'user_id' => auth()->id(),
            'task_id' => $request->task_id,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'started_at' => $request->started_at,
            'ended_at' => $request->ended_at,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'entry' => $entry->load(['task', 'project']),
            ]);
        }

        return back()->with('success', 'Entrée de temps ajoutée !');
    }

    /**
     * Delete a time entry.
     */
    public function destroy(TimeEntry $entry)
    {
        // Verify ownership
        if ($entry->user_id !== auth()->id()) {
            abort(403);
        }

        $entry->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Entrée supprimée');
    }

    /**
     * Get current running timer (API).
     */
    public function current()
    {
        $timer = $this->timeTrackingService->getRunningTimer(auth()->user());

        return response()->json([
            'running' => $timer ? true : false,
            'timer' => $timer ? $timer->load('task') : null,
        ]);
    }
}
