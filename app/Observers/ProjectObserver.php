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
        // 1. Create a base task for the project type
        Task::create([
            'project_id' => $project->id,
            'name' => "Initialisation: " . $project->projectType->name,
            'description' => "Configuration de base pour un projet de type " . $project->projectType->name,
            'status' => 'pending',
        ]);

        // 2. Create tasks for each feature selected
// Note: In some cases features might be attached after creation.
// For a simple implementation, we'll handle features here if they exist.
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