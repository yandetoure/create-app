<?php

namespace App\Services;

use App\Models\TimeEntry;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TimeTrackingService
{
    /**
     * Start a timer for a task.
     */
    public function startTimer(Task $task, User $user, ?string $description = null): TimeEntry
    {
        // Stop any running timers for this user
        $this->stopAllRunningTimers($user);

        return TimeEntry::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'project_id' => $task->project_id,
            'description' => $description,
            'started_at' => now(),
            'is_manual' => false,
        ]);
    }

    /**
     * Stop a running timer.
     */
    public function stopTimer(TimeEntry $entry): TimeEntry
    {
        if (!$entry->isRunning()) {
            throw new \Exception('Timer is not running');
        }

        $entry->ended_at = now();
        $entry->calculateDuration();

        return $entry;
    }

    /**
     * Stop all running timers for a user.
     */
    public function stopAllRunningTimers(User $user): void
    {
        $runningTimers = TimeEntry::running()->forUser($user->id)->get();

        foreach ($runningTimers as $timer) {
            $this->stopTimer($timer);
        }
    }

    /**
     * Get running timer for a user.
     */
    public function getRunningTimer(User $user): ?TimeEntry
    {
        return TimeEntry::running()
            ->forUser($user->id)
            ->with(['task', 'project'])
            ->first();
    }

    /**
     * Add a manual time entry.
     */
    public function addManualEntry(array $data): TimeEntry
    {
        $startedAt = Carbon::parse($data['started_at']);
        $endedAt = Carbon::parse($data['ended_at']);

        $entry = TimeEntry::create([
            'user_id' => $data['user_id'],
            'task_id' => $data['task_id'] ?? null,
            'project_id' => $data['project_id'] ?? null,
            'description' => $data['description'] ?? null,
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
            'is_manual' => true,
        ]);

        $entry->calculateDuration();

        return $entry;
    }

    /**
     * Get total time for a task.
     */
    public function getTotalTimeForTask(Task $task): int
    {
        return TimeEntry::where('task_id', $task->id)
            ->completed()
            ->sum('duration');
    }

    /**
     * Get total time for a project.
     */
    public function getTotalTimeForProject($projectId): int
    {
        return TimeEntry::where('project_id', $projectId)
            ->completed()
            ->sum('duration');
    }

    /**
     * Get total time for a user today.
     */
    public function getTodayTotalTime(User $user): int
    {
        return TimeEntry::forUser($user->id)
            ->today()
            ->completed()
            ->sum('duration');
    }

    /**
     * Get total time for a user this week.
     */
    public function getWeekTotalTime(User $user): int
    {
        return TimeEntry::forUser($user->id)
            ->thisWeek()
            ->completed()
            ->sum('duration');
    }

    /**
     * Get timesheet for a user.
     */
    public function getTimesheet(User $user, Carbon $startDate, Carbon $endDate)
    {
        return TimeEntry::forUser($user->id)
            ->whereBetween('started_at', [$startDate, $endDate])
            ->with(['task', 'project'])
            ->orderBy('started_at', 'desc')
            ->get();
    }

    /**
     * Format duration in hours and minutes.
     */
    public function formatDuration(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);

        if ($hours > 0) {
            return sprintf('%dh %02dm', $hours, $minutes);
        } else {
            return sprintf('%dm', $minutes);
        }
    }
}
