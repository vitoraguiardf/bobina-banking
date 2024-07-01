<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('TransactionTypes/Index', [
            'items' => TransactionType::with('user:id,name')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'description' => 'max:1000',
        ]);
        $request->user()->transactionTypes()->create($validated);
        return redirect(route('transaction-types.index'));
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
    public function destroy(TransactionType $transactionType)
    {
        //
    }
}
