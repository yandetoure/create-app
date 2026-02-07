<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeatureCategoryController;
use App\Http\Controllers\Admin\CoreFeatureController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ProjectManagementController;

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

// Template & Component Management
Route::resource('templates', \App\Http\Controllers\Admin\TemplateController::class);
Route::resource('components', \App\Http\Controllers\Admin\ComponentController::class);
Route::post('templates/{template}/toggle-active', [\App\Http\Controllers\Admin\TemplateController::class, 'toggleActive'])->name('templates.toggle-active');
Route::post('templates/{template}/assign-component', [\App\Http\Controllers\Admin\TemplateController::class, 'assignComponent'])->name('templates.assign-component');
Route::delete('templates/{template}/remove-component/{component}', [\App\Http\Controllers\Admin\TemplateController::class, 'removeComponent'])->name('templates.remove-component');


Route::post('core-features/{coreFeature}/toggle', [CoreFeatureController::class, 'toggleStatus'])->name('core-features.toggle');
Route::resource('core-features', CoreFeatureController::class);

Route::get('/deliverables', function () {
    return view('admin.deliverables.index');
})->name('deliverables.index');

Route::get('team', [TeamController::class, 'index'])->name('team.index');
Route::get('team/{user}', [TeamController::class, 'show'])->name('team.show');

Route::get('projects/{project}/manage', [ProjectManagementController::class, 'manage'])->name('projects.manage');
Route::post('projects/{project}/assign', [ProjectManagementController::class, 'assign'])->name('projects.assign');
Route::post('projects/{project}/deliverables', [ProjectManagementController::class, 'storeDeliverable'])->name('deliverables.store');
Route::post('projects/{project}/tasks', [ProjectManagementController::class, 'storeTask'])->name('tasks.store');
Route::put('tasks/{task}/status', [ProjectManagementController::class, 'updateTaskStatus'])->name('tasks.update-status');