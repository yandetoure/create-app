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

    $project->load(['user', 'projectType', 'tasks', 'deliverables', 'configuration']);

    return view('developer.projects.show', compact('project'));
})->name('projects.show');

Route::get('/projects/{project}/edit', function (\App\Models\Project $project) {
    // Ensure developer owns this project
    if ($project->developer_id !== auth()->id()) {
        abort(403);
    }

    $project->load(['user', 'projectType']);

    return view('developer.projects.edit', compact('project'));
})->name('projects.edit');

Route::post('/projects/{project}/update-info', function (\App\Models\Project $project, \Illuminate\Http\Request $request) {
    // Ensure developer owns this project
    if ($project->developer_id !== auth()->id()) {
        abort(403);
    }

    $validated = $request->validate([
        'deployment_url' => 'nullable|url',
        'staging_url' => 'nullable|url',
    ]);

    $project->update($validated);

    return redirect()->route('developer.projects.show', $project)->with('success', 'Informations de déploiement mises à jour !');
})->name('projects.update-info');

Route::post('/projects/{project}/upload-demo', function (\App\Models\Project $project, \Illuminate\Http\Request $request) {
    // Ensure developer owns this project
    if ($project->developer_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'demo_file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:51200', // 50MB max
    ]);

    $file = $request->file('demo_file');
    $path = $file->store('demos', 'public');

    $demoFiles = $project->demo_files ?? [];
    $demoFiles[] = [
        'path' => $path,
        'original_name' => $file->getClientOriginalName(),
        'size' => $file->getSize(),
        'type' => $file->getMimeType(),
        'uploaded_at' => now()->toDateTimeString(),
    ];

    $project->update(['demo_files' => $demoFiles]);

    return redirect()->route('developer.projects.show', $project)->with('success', 'Démo ajoutée avec succès !');
})->name('projects.upload-demo');

Route::post('/projects/{project}/add-comment', function (\App\Models\Project $project, \Illuminate\Http\Request $request) {
    // Ensure developer owns this project
    if ($project->developer_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $notes = $project->developer_notes ?? [];
    $notes[] = [
        'comment' => $request->comment,
        'created_at' => now()->toDateTimeString(),
    ];

    $project->update(['developer_notes' => $notes]);

    return redirect()->route('developer.projects.show', $project)->with('success', 'Commentaire ajouté !');
})->name('projects.add-comment');

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

// Task update route
Route::patch('/tasks/{task}', function (\App\Models\Task $task, \Illuminate\Http\Request $request) {
    // Ensure task belongs to developer's project
    if ($task->project->developer_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,completed',
    ]);

    $task->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Statut de la tâche mis à jour !');
})->name('tasks.update');

// Deliverable upload route
Route::post('/deliverables/{deliverable}/upload', function (\App\Models\Deliverable $deliverable, \Illuminate\Http\Request $request) {
    // Ensure deliverable belongs to developer's project
    if ($deliverable->project->developer_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'file' => 'required|file|max:10240',
    ]);

    $filePath = $request->file('file')->store('deliverables', 'public');

    $deliverable->update([
        'file_path' => $filePath,
        'status' => 'delivered',
        'delivered_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Livrable soumis avec succès !');
})->name('deliverables.upload');
