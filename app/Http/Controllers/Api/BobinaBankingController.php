<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use App\Models\User;

class BobinaBankingController extends Controller {

    function resume() {
        $user = User::query()
                ->select(['id', 'name', 'email'])
                ->with([
                    'coilStorages:holder_type,holder_id,name',
                ])
                ->withSum([
                    'fromTransactions',
                    'toTransactions',
                ], 'quantity')
                ->where('users.id', '=', auth('api')->user()->id);
        return response()->json($user->first());
    }

    function transactions() {
        $transactions = Transaction::query()
            ->with(
                'type:id,name,origin,destin',
                'fromStorage:id,name',
                'toStorage:id,name',
                'fromStorage.holder:type,id',
                'toStorage.holder:type,id',
            );
        return response()->json($transactions->get());
    }

}