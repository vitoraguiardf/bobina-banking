<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking\Account\Key;

use App\Http\Requests\BobinaBanking\Account\Key\StoreRandomRequest;
use App\Http\Requests\BobinaBanking\Account\Key\UpdateRandomRequest;
use App\Models\Account\Key\Random;
use Inertia\Inertia;

class RandomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Authenticated/BobinaBanking/Account/Key/Random/Index', [
            'items' => Random::query()
            ->latest()
            ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRandomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Random $random)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRandomRequest $request, Random $random)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Random $random)
    {
        //
    }
}
