<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('lead.dashboard');
})->name('dashboard');
