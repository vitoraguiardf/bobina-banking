<?php

namespace App\Http\Controllers\Authenticated\BobinaBanking;

use App\AccountHolderTypes;
use App\Models\Account;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Authenticated/BobinaBanking/Account/Index', [
            'items' => Account::query()
            ->with([
                'creatorUser:id,name',
                'holder:id,name',
            ])
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
        return Inertia::render('Authenticated/BobinaBanking/Account/Create', [
            'holder_types' => AccountHolderTypes::cases(),
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
        $request->user()->createdAccounts()->create($validated);
        return redirect(route('bobina-banking.accounts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account): RedirectResponse
    {
        Gate::authorize('delete', $account);
        $account->delete();
        return redirect(route('bobina-banking.accounts.index'));
    }
}
