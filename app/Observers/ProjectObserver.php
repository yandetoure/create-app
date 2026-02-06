<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Task;
use App\Services\NotificationService;

class ProjectObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        // Auto-generate tasks from templates
        $templates = \App\Models\TaskTemplate::where('is_active', true)
            ->orderBy('order')
            ->get();

        foreach ($templates as $template) {
            Task::create([
                'project_id' => $project->id,
                'name' => $template->name,
                'description' => $template->description,
                'category' => $template->category,
                'status' => 'pending',
            ]);
        }

        // Also create tasks for selected features
        foreach ($project->features as $feature) {
            Task::create([
                'project_id' => $project->id,
                'name' => $feature->name,
                'description' => $feature->description,
                'category' => 'development',
                'status' => 'pending',
            ]);
        }

        // Notify developer if assigned
        if ($project->developer_id) {
            $this->notificationService->notify(
                $project->developer,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }

        // Notify project manager if assigned
        if ($project->project_manager_id) {
            $this->notificationService->notify(
                $project->projectManager,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }

        // Notify community manager if assigned
        if ($project->community_manager_id) {
            $this->notificationService->notify(
                $project->communityManager,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        // If developer was just assigned, notify them
        if ($project->isDirty('developer_id') && $project->developer_id) {
            $this->notificationService->notify(
                $project->developer,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }

        // If project manager was just assigned, notify them
        if ($project->isDirty('project_manager_id') && $project->project_manager_id) {
            $this->notificationService->notify(
                $project->projectManager,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }

        // If community manager was just assigned, notify them
        if ($project->isDirty('community_manager_id') && $project->community_manager_id) {
            $this->notificationService->notify(
                $project->communityManager,
                'project_assigned',
                $project,
                ['project_name' => $project->name]
            );
        }

        // If project status changed to completed, notify client
        if ($project->isDirty('status') && $project->status === 'completed') {
            $this->notificationService->notify(
                $project->user,
                'project_completed',
                $project,
                ['project_name' => $project->name]
            );
        }
    }
}