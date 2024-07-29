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
    Route::middleware('permission:access-control.dashboard')->get('/', fn() => Inertia::render('AccessControl/Dashboard'))->name('dashboard');
    customRoute('permission:access-control', 'users', UserController::class, ['index']);
    customRoute('permission:access-control', 'roles', RoleController::class, ['index', 'create', 'store', 'destroy']);
    customRoute('permission:access-control', 'permissions', PermissionController::class, ['index']);
});

function customRoute(
    string $permissionPrefix,
    string $name, string $controller,
    array $methods): void {
    foreach ($methods as $method) {
        Route::middleware("$permissionPrefix.$name.$method")
            ->resource($name, $controller)->only($method);
    }
}