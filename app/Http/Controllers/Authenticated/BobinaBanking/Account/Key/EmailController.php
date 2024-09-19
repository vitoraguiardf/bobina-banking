<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking\Account\Key;

use App\Http\Requests\BobinaBanking\Account\Key\StoreEmailRequest;
use App\Http\Requests\BobinaBanking\Account\Key\UpdateEmailRequest;
use App\Models\Account\Key\Email;
use Inertia\Inertia;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Authenticated/BobinaBanking/Account/Key/Email/Index', [
            'items' => Email::query()
            ->latest()
            ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        //
    }
}
