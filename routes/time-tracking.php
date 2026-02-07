<?php

use App\Http\Controllers\TimeEntryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Time tracking routes
    Route::get('/time-tracking', [TimeEntryController::class, 'index'])->name('time-tracking.index');
    Route::post('/time-tracking/start', [TimeEntryController::class, 'start'])->name('time-tracking.start');
    Route::post('/time-tracking/{entry}/stop', [TimeEntryController::class, 'stop'])->name('time-tracking.stop');
    Route::post('/time-tracking', [TimeEntryController::class, 'store'])->name('time-tracking.store');
    Route::delete('/time-tracking/{entry}', [TimeEntryController::class, 'destroy'])->name('time-tracking.destroy');
    Route::get('/time-tracking/current', [TimeEntryController::class, 'current'])->name('time-tracking.current');
});
