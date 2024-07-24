<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking;

use App\Models\CoilStorage;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Authenticated/BobinaBanking/Transaction/Index', [
            'items' => Transaction::query()
                ->with([
                    'type:id,name',
                    'creatorUser:id,name',
                    'fromStorage.holder:id,name',
                    'toStorage.holder:id,name',
                ])
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coilStorages = 
        CoilStorage::
            select('id', 'name', 'holder_type', 'holder_id')
            ->with('holder:id,name')
            ->get();
        return Inertia::render('Authenticated/BobinaBanking/Transaction/Create', [
            'type_items' => TransactionType::select('id', 'name', 'description', 'origin', 'destin')->get(),
            'from_items' => $coilStorages,
            'to_items' => $coilStorages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'creator_user_id' => $request->user()->id,
        ]);
        $validated = $request->validate([
            'creator_user_id' => 'required|integer|exists:users,id',
            'transaction_type_id' => 'required|integer|exists:transaction_types,id',
            'from_storage_id' => 'nullable|exists:coil_storages,id',
            'to_storage_id' => 'nullable|exists:coil_storages,id',
            'description' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
        ]);
        Transaction::create($validated);
        return redirect(route('bobina-banking.transaction.index'));
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
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        Gate::authorize('update', $transaction);

        $validated = $request->validate([
            'description' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
        ]);

        $transaction->update($validated);
        
        return redirect(route('bobina-banking.transaction.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        Gate::authorize('delete', $transaction);

        $transaction->delete();

        return redirect(route('bobina-banking.transaction.index'));
    }
}
