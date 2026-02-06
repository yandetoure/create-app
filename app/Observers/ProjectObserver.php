<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Task;

class ProjectObserver
{
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
                'status' => 'pending',
            ]);
        }

        // Also create tasks for selected features
        foreach ($project->features as $feature) {
            Task::create([
                'project_id' => $project->id,
                'name' => $feature->name,
                'description' => $feature->description,
                'status' => 'pending',
            ]);
        }
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        // If developer is assigned, maybe notify or update status
    }
}