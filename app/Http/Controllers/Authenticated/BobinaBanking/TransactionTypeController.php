<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking;

use App\Models\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Authenticated/BobinaBanking/TransactionTypes/Index', [
            'items' => TransactionType::with('creatorUser:id,name')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Authenticated/BobinaBanking/TransactionTypes/Create', []);
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
            'name' => 'required|string|max:128',
            'description' => 'nullable|max:1000',
            'origin' => 'required|integer|min:-1|max:1',
            'destin' => 'required|integer|min:-1|max:1',
        ]);
        TransactionType::create($validated);
        return redirect(route('bobina-banking.transaction-types.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionType $transactionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionType $transactionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionType $transactionType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionType $transactionType): RedirectResponse
    {
        Gate::authorize('delete', $transactionType);
        $transactionType->delete();
        return redirect(route('bobina-banking.transaction-types.index'));
    }
}
