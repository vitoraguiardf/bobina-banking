<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking\Account\Key;

use App\Http\Controllers\Authenticated\BobinaBanking\Controller;
use App\Http\Requests\BobinaBanking\Account\Key\StorePhoneRequest;
use App\Http\Requests\BobinaBanking\Account\Key\UpdatePhoneRequest;
use App\Models\Account\Key\Phone;
use Inertia\Inertia;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Authenticated/BobinaBanking/Account/Key/Phone/Index', [
            'items' => Phone::query()
            ->latest()
            ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        //
    }
}
