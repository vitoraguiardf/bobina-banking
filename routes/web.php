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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::resource('office', OfficeController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('coil-storage', CoilStorageController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('transaction-types', TransactionTypeController::class)
    ->only(['index', 'store', 'create', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('transaction', TransactionController::class)
    ->only(['index', 'store', 'update', 'destroy', 'create'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
