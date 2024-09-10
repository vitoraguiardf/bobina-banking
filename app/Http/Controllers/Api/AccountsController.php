<?php

namespace App\Http\Controllers\Api;

use App\Models\CoilStorage;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = CoilStorage::query();
        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CoilStorage $coilStorage)
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
