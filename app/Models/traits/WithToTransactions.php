<?php

namespace App\Models\traits;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait WithToTransactions
{
    /**
     * Transações positivas/credidatas/entrada/to_this
     */
    public function toTransactions(): HasManyThrough
    {
        return parent::hasManyThrough(
            Transaction::class,
            Account::class, 'holder_id', 'to_account_id')
                // array_search($this::class, Relation::morphMap() ?: array($this::class)),
                ->where('holder_type', $this::class);
            /*->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id');
            ->where('transaction_types.destin', '<', 0);*/
    }
}
