<?php

namespace App\Models\traits;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait WithFromTransactions
{
    /**
     * Transações negativas/debitadas/saída/from_this
     */
    public function fromTransactions(): HasManyThrough
    {
        return parent::hasManyThrough(
            Transaction::class,
            Account::class, 'holder_id', 'from_account_id')
                // array_search($this::class, Relation::morphMap() ?: array($this::class)),
                ->where('holder_type', $this::class);
            /*->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.origin', '>', 0);*/
    }
}


