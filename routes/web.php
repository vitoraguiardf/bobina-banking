<?php

use App\Http\Controllers\Authenticated\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Welcome', [
    'canAccessControl' => Route::has('access-control.dashboard'),
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION
]));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', fn () => Inertia::render('Authenticated/Dashboard'))
            ->name('dashboard');
    });
    
});

require __DIR__.'/auth.php';
require __DIR__.'/access-control.php';
require __DIR__.'/bobina-banking.php';
