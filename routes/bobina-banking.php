<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group([
    'namespace' => 'App\Http\Controllers\Authenticated\BobinaBanking',
    'as' => 'bobina-banking.',
    'prefix' => 'bobina-banking',
    'middleware' => ['auth', 'web', 'auth:web', 'verified'/*, 'role:office.admin'*/],
], function () {
    Route::get('/', fn() => Inertia::render('Authenticated/BobinaBanking/Dashboard'))->name('dashboard');

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
