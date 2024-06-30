<?php

namespace App\Http\Controllers;

use App\Models\CoilStorage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CoilStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CoilStorage/Index', [
            'coilStorages' => CoilStorage::where('user_id', auth()->user()->id)->with('user:id,name')->latest()->get()
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
        $validated= $request->validate([
            'name' => ['required', 'string', 'max:128']
        ]);
        $request->user()->coilStorage()->create($validated);
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
