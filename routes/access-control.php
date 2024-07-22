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
    Route::get('/', fn() => Inertia::render('AccessControl/Dashboard'))->name('dashboard');
    Route::middleware('permission:acl.users.index')->resource('users', UserController::class);
    Route::middleware('permission:acl.roles.index')->resource('roles', RoleController::class);
    Route::middleware('permission:acl.permissions.index')->resource('permissions', PermissionController::class);
});
