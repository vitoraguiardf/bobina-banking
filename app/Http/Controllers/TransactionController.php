<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Transaction/Index', [
            'items' => $request->user()->transactionsCreated()->with([
                'user:id,name',
                //'fromStorage:id,name',
                'fromStorage.user:id,name',
                // 'toStorage:id,name',
                'toStorage.user:id,name',
                ])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Transaction/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'transaction_type_id' => 'required',
            'from_storage_id' => 'nullable',
            'to_storage_id' => 'nullable',
            'quantity' => 'required|integer|min:1',
        ]);
        $request->user()->transactionsCreated()->create($validated);
        return redirect(route('transaction.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
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
