<?php

namespace App\Http\Controllers;

use App\CoilStorageHolderTypes;
use App\Models\CoilStorage;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoilStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('CoilStorage/Index', [
            'items' => CoilStorage::query()
            ->with('creatorUser:id,name')
            ->withSum([
                'fromTransactions' => function ($query) {
                    $join = $query->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id');
                    $join->where('transaction_types.origin', '<', 0);
                },
                'toTransactions' => function ($query) {
                    $join = $query->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id');
                    $join->where('transaction_types.destin', '>', 0);
                }
            ], 'quantity')
            ->latest()
            ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CoilStorage/Create', [
            'holder_types' => CoilStorageHolderTypes::cases(),
            'holder_items' => [
                User::class => User::select('id', 'name')->get(),
                Office::class => Office::select('id', 'name')->get(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'creator_user_id' => $request->user()->id,
            'owner_user_id' => $request->user()->id,
        ]);
        $validated= $request->validate([
            'creator_user_id' => 'required|integer|exists:users,id',
            'holder_type' => 'required|string',
            'holder_id' => 'required|integer',
            'name' => 'required|string|max:128',
            'description' => 'nullable|string|max:1000',
        ]);
        $request->user()->createdCoilStorages()->create($validated);
        return redirect(route('coil-storage.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CoilStorage $coilStorage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoilStorage $coilStorage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoilStorage $coilStorage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoilStorage $coilStorage)
    {
        //
    }
}
