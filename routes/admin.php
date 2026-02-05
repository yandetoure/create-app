<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\FeatureController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::resource('developers', DeveloperController::class)->only(['index', 'show']);
Route::resource('project-types', ProjectTypeController::class);
Route::resource('features', FeatureController::class);

Route::get('/deliverables', function () {
    return view('admin.deliverables.index');
})->name('deliverables.index');