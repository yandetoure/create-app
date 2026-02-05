<?php

use App\Http\Controllers\Client\ProjectConfigurationController;

Route::get('/dashboard', function () {
    $projects = auth()->user()->clientProjects()->with('projectType')->latest()->paginate(10);
    return view('client.dashboard', compact('projects'));
})->name('dashboard');

Route::get('/projects/{project}/configure', [ProjectConfigurationController::class, 'edit'])->name('projects.configure');
Route::post('/projects/{project}/configure', [ProjectConfigurationController::class, 'update'])->name('projects.configure.update');
