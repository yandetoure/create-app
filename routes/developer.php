<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('developer.dashboard');
})->name('dashboard');

// Other developer routes...
