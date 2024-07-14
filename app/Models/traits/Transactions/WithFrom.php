<?php

namespace App\Models\traits\Transactions;

use App\Models\CoilStorage;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Relation;

trait WithFrom
{
    /**
     * Transações negativas/debitadas/saída/from_this
     */
    public function fromTransactions(): HasManyThrough
    {
        return parent::hasManyThrough(
            Transaction::class,
            CoilStorage::class, 'holder_id', 'from_storage_id')
            ->where(
                'holder_type',
                array_search(parent::class, Relation::morphMap() ?: [parent::class])
            );
            /*->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.origin', '>', 0);*/
    }
}


