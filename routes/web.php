<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/configurator', [App\Http\Controllers\ConfiguratorController::class, 'index'])->name('configurator.index');
    Route::post('/configurator', [App\Http\Controllers\ConfiguratorController::class, 'store'])->name('configurator.store');
    Route::get('/projects/{project}', [App\Http\Controllers\ConfiguratorController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/pdf', [App\Http\Controllers\QuoteController::class, 'download'])->name('projects.pdf');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/preview/{slug}', [App\Http\Controllers\PreviewController::class, 'show'])->name('preview.show');

require __DIR__ . '/auth.php';
