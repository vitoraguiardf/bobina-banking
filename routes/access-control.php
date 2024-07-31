<?php

namespace App\Http\Controllers\AccessControl;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group([
    'namespace' => 'App\Http\Controllers\AccessControl',
    'as' => 'access-control.',
    'prefix' => 'access-control',
    'middleware' => ['auth', 'web', 'auth:web', 'verified', 'role:office.admin'],
], function () {
    Route::middleware('permission:access-control.dashboard')
        ->get('/', fn() => Inertia::render('AccessControl/Dashboard'))
        ->name('dashboard');
    
    foreach (['index'] as $method)
        Route::middleware("permission:access-control.users.$method")
            ->resource('users', UserController::class)->only($method);
    
    foreach (['index', 'create', 'store', 'destroy'] as $method)
        Route::middleware("permission:access-control.roles.$method")
            ->resource('roles', RoleController::class)->only($method);
    
    foreach (['index'] as $method)
        Route::middleware("permission:access-control.permissions.$method")
            ->resource('permissions', PermissionController::class)->only($method);
});
