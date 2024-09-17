<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;

class BobinaBankingController extends Controller {

    function resume() {
        $user = User::query()
                ->select(['id', 'name', 'email'])
                ->with([
                    'accounts:holder_type,holder_id,name',
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
                'fromAccounts:id,name',
                'toAccounts:id,name',
                'fromAccounts.holder:type,id',
                'toAccounts.holder:type,id',
            );
        return response()->json($transactions->get());
    }

    function searchAccount(Request $request) {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'email'],
        ]);
        $query = Account::query();
        $query->select(['accounts.*']);
        if ($request->email != null) {
            $query->join('users', function (JoinClause $join) use ($request){
                $join->on('accounts.holder_id', '=', 'users.id')
                    ->where('accounts.holder_type', '=', User::class);
            });
            $query->where('users.email', '=', $request->email);
        }
        /*if ($query->count()<=0) {
            return response()->json(['message' => 'not found'], 404);
        }*/
        return response()->json($query->get());
    }

}