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
        'comments.replies.user',
        'template.components'
    ])->findOrFail($projectId);

    // Verify ownership
    if ($project->user_id !== auth()->id()) {
        abort(403, 'Accès non autorisé');
    }

    return view('client.projects.show', compact('project'));
})->name('projects.show');

Route::get('/projects/{project}/configure', [ProjectConfigurationController::class, 'edit'])->name('projects.configure');
Route::post('/projects/{project}/configure', [ProjectConfigurationController::class, 'update'])->name('projects.configure.update');

// Template selection routes
Route::get('/projects/{project}/templates', [\App\Http\Controllers\Client\TemplateController::class, 'index'])->name('projects.templates.index');
Route::get('/projects/{project}/templates/{template}/preview', [\App\Http\Controllers\Client\TemplateController::class, 'preview'])->name('projects.templates.preview');
Route::post('/projects/{project}/templates/select', [\App\Http\Controllers\Client\TemplateController::class, 'select'])->name('projects.templates.select');

// Public template live preview (no auth required)
Route::get('/templates/{template}/live-preview', [\App\Http\Controllers\Client\TemplateController::class, 'livePreview'])
    ->name('templates.live-preview')
    ->withoutMiddleware(['auth', 'role:client']);
