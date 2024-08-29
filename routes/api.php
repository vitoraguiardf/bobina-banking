<?php

use Illuminate\Support\Facades\Route;

// api group
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'as' => 'api.',
], function () {

    // auth group
    Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
        Route::name('login')->post('login', 'AuthController@login');
        Route::name('logout')->post('logout', 'AuthController@logout');
        Route::name('refresh')->post('refresh', 'AuthController@refresh');
        Route::name('me')->post('me', 'AuthController@me');
    });

    // bobina-banking-mobile
    Route::group(['as' => 'bobina-banking.', 'prefix' => 'bobina-banking'], function () {
        Route::name('resume')->get('resume', 'BobinaBankingController@resume');
        Route::name('transactions')->get('transactions', 'BobinaBankingController@transactions');
        Route::apiResource('transaction-type', 'TransactionTypeController')->only('index');
    });

});