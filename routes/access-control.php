<?php

namespace App\Http\Controllers\AccessControl;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group([
    'namespace' => 'App\Http\Controllers\AccessControl',
    'as' => 'access-control.',
    'prefix' => 'access-control',
    'middleware' => ['auth', 'web', 'auth:web', 'verified', 'role_or_permission:admin'],
], function () {
    Route::get('/', fn() => Inertia::render('AccessControl/Dashboard'))->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});
