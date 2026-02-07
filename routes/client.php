<?php

use App\Http\Controllers\Client\ProjectConfigurationController;

Route::get('/dashboard', function () {
    $projects = auth()->user()->clientProjects()->with('projectType')->latest()->paginate(10);
    return view('client.dashboard', compact('projects'));
})->name('dashboard');

// Project detail route
Route::get('/projects/{project}', function ($projectId) {
    $project = \App\Models\Project::with([
        'projectType',
        'developer',
        'tasks',
        'deliverables',
        'comments.user',
        'comments.replies.user'
    ])->findOrFail($projectId);

    // Verify ownership
    if ($project->user_id !== auth()->id()) {
        abort(403, 'Accès non autorisé');
    }

    return view('client.projects.show', compact('project'));
})->name('projects.show');

Route::get('/projects/{project}/configure', [ProjectConfigurationController::class, 'edit'])->name('projects.configure');
Route::post('/projects/{project}/configure', [ProjectConfigurationController::class, 'update'])->name('projects.configure.update');
