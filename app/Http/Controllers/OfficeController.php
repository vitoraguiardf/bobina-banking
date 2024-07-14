<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Office/Index', [
            'items' => Office::query()
            ->with([
                    'fromTransactions',
                    'toTransactions',
                    'coilStorages:holder_type,holder_id,name',
                    'creatorUser:id,name',
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
        return Inertia::render('Office/Create', [
            
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
            'description' => 'nullable|string|max:1000',
            'name' => 'required|string|min:10|max:150',
        ]);

        Office::create($validated);

        return redirect(route('office.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office): RedirectResponse
    {
        Gate::authorize('delete', $office);
        $office->delete();
        return redirect(route('office.index'));
    }
}
