<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'creator_user_id' => auth('api')->user()->id,
        ]);        
        $validated = $request->validate([
            'creator_user_id' => 'required|integer|exists:users,id',
            'description' => 'nullable|string|max:150',
            'transaction_type_id' => 'required|integer|exists:transaction_types,id',
            'from_storage_id' => 'nullable|integer|exists:coil_storages,id',
            'to_storage_id' => 'nullable|integer|exists:coil_storages,id',
            'quantity' => 'required|integer|min:0',
        ]);
        Transaction::create($validated);
        return response()->json(['message' => 'Registrado com sucesso!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
