<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $developer = auth()->user();

    // Get projects assigned to this developer
    $assignedProjects = \App\Models\Project::where('developer_id', $developer->id)
        ->with(['user', 'projectType', 'tasks'])
        ->get();

    // Calculate stats
    $stats = [
        'projets_assignés' => $assignedProjects->count(),
        'tâches_en_cours' => $assignedProjects->sum(function ($project) {
            return $project->tasks->where('status', 'in_progress')->count();
        }),
        'tâches_terminées' => $assignedProjects->sum(function ($project) {
            return $project->tasks->where('status', 'completed')->count();
        }),
    ];

    return view('developer.dashboard', compact('stats', 'assignedProjects'));
})->name('dashboard');

// Projects routes
Route::get('/projects', function () {
    $developer = auth()->user();
    $projects = \App\Models\Project::where('developer_id', $developer->id)
        ->with(['user', 'projectType', 'tasks'])
        ->get();

    return view('developer.projects.index', compact('projects'));
})->name('projects.index');

Route::get('/projects/{project}', function (\App\Models\Project $project) {
    // Ensure developer owns this project
    if ($project->developer_id !== auth()->id()) {
        abort(403);
    }

    $project->load(['user', 'projectType', 'tasks', 'deliverables']);

    return view('developer.projects.show', compact('project'));
})->name('projects.show');

// Tasks routes
Route::get('/tasks', function () {
    $developer = auth()->user();
    $tasks = \App\Models\Task::whereHas('project', function ($query) use ($developer) {
        $query->where('developer_id', $developer->id);
    })->with(['project'])->get();

    return view('developer.tasks.index', compact('tasks'));
})->name('tasks.index');

// Deliverables routes
Route::get('/deliverables', function () {
    $developer = auth()->user();
    $deliverables = \App\Models\Deliverable::whereHas('project', function ($query) use ($developer) {
        $query->where('developer_id', $developer->id);
    })->with(['project'])->get();

    return view('developer.deliverables.index', compact('deliverables'));
})->name('deliverables.index');
