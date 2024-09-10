<?php

namespace App\Http\Controllers\Api;

use App\Models\CoilStorage;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;

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

    function searchAccount(Request $request) {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'email'],
        ]);
        $query = CoilStorage::query();
        $query->select(['coil_storages.*']);
        if ($request->email != null) {
            $query->join('users', function (JoinClause $join) use ($request){
                $join->on('coil_storages.holder_id', '=', 'users.id')
                    ->where('coil_storages.holder_type', '=', User::class);
            });
            $query->where('users.email', '=', $request->email);
        }
        if ($query->count()<=0) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json($query->get());
    }

}