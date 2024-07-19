<?php

use App\Http\Controllers\CoilStorageController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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
        Route::get('/dashboard', fn () => Inertia::render('Dashboard'))
            ->name('dashboard');
Route::resource('users', UserController::class)
            ->only(['index']);
Route::resource('office', OfficeController::class)
            ->only(['index', 'create', 'store', 'destroy']);
Route::resource('coil-storage', CoilStorageController::class)
            ->only(['index', 'create', 'store', 'destroy']);
Route::resource('transaction-types', TransactionTypeController::class)
            ->only(['index', 'store', 'create', 'destroy']);
Route::resource('transaction', TransactionController::class)
            ->only(['index', 'store', 'update', 'destroy', 'create']);
    });
    
});

require __DIR__.'/auth.php';
