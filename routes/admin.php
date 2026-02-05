<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeatureCategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('projects/{project}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
Route::post('projects/{project}/reject', [ProjectController::class, 'reject'])->name('projects.reject');
Route::resource('projects', ProjectController::class);

Route::resource('developers', DeveloperController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class);
Route::resource('feature-categories', FeatureCategoryController::class);
Route::resource('project-types', ProjectTypeController::class);
Route::post('features/{feature}/toggle-base', [FeatureController::class, 'toggleBase'])->name('features.toggle-base');
Route::resource('features', FeatureController::class);

Route::get('/deliverables', function () {
    return view('admin.deliverables.index');
})->name('deliverables.index');