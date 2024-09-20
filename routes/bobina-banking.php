<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking;

use App\Http\Controllers\Authenticated\BobinaBanking\Account\Key\EmailController;
use App\Http\Controllers\Authenticated\BobinaBanking\Account\Key\PhoneController;
use App\Http\Controllers\Authenticated\BobinaBanking\Account\Key\RandomController;
use App\Http\Controllers\Authenticated\BobinaBanking\Account\KeyController;
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

    Route::resource('accounts', AccountController::class)
        ->only(['index', 'create', 'store', 'destroy']);
    Route::group(['as' => 'accounts.', 'prefix' => 'accounts'], function () {
        Route::resource('key', KeyController::class)
        ->only(['index']);
        Route::group(['as' => 'key.', 'prefix' => 'key'], function () {
            Route::resource('email', EmailController::class)
                ->only(['index', 'create', 'store', 'destroy']);
            Route::resource('phone', PhoneController::class)
                ->only(['index', 'create', 'store', 'destroy']);
            Route::resource('random', RandomController::class)
                ->only(['index', 'create', 'store', 'destroy']);
        });
    });
    Route::resource('transaction-types', TransactionTypeController::class)
        ->only(['index', 'store', 'create', 'destroy']);
    Route::resource('transaction', TransactionController::class)
        ->only(['index', 'store', 'update', 'destroy', 'create']);

});
