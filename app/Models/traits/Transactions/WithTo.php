<?php

namespace App\Models\traits\Transactions;

use App\Models\CoilStorage;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Relation;

trait WithTo
{
    /**
     * Transações positivas/credidatas/entrada/to_this
     */
    public function toTransactions(): HasManyThrough
    {
        return parent::hasManyThrough(
            Transaction::class,
            CoilStorage::class, 'holder_id', 'to_storage_id')
                // array_search($this::class, Relation::morphMap() ?: array($this::class)),
                ->where('holder_type', $this::class);
            /*->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id');
            ->where('transaction_types.destin', '<', 0);*/
    }
}
