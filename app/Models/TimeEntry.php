<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeEntry extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'project_id',
        'description',
        'started_at',
        'ended_at',
        'duration',
        'is_manual',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_manual' => 'boolean',
    ];

    /**
     * Get the user who created this entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the task associated with this entry.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the project associated with this entry.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Calculate and update duration.
     */
    public function calculateDuration()
    {
        if ($this->started_at && $this->ended_at) {
            $this->duration = $this->ended_at->diffInSeconds($this->started_at);
            $this->save();
        }
    }

    /**
     * Check if timer is running.
     */
    public function isRunning(): bool
    {
        return $this->started_at && !$this->ended_at;
    }

    /**
     * Get formatted duration.
     */
    public function getFormattedDurationAttribute(): string
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%dh %02dm', $hours, $minutes);
        } elseif ($minutes > 0) {
            return sprintf('%dm %02ds', $minutes, $seconds);
        } else {
            return sprintf('%ds', $seconds);
        }
    }

    /**
     * Scope for running timers.
     */
    public function scopeRunning($query)
    {
        return $query->whereNotNull('started_at')->whereNull('ended_at');
    }

    /**
     * Scope for completed entries.
     */
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('started_at')->whereNotNull('ended_at');
    }

    /**
     * Scope for today's entries.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('started_at', Carbon::today());
    }

    /**
     * Scope for this week's entries.
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('started_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ]);
    }

    /**
     * Scope for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
