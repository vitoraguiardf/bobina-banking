<?php

namespace App\Models;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, WithCreator;
    protected $fillable = [
        'creator_user_id',
        'transaction_type_id',
        'from_account_id',
        'to_account_id',
        'description',
        'quantity',
    ];
    function fromAccount(): BelongsTo {
        return $this->belongsTo(Account::class);
    }
    function toAccount(): BelongsTo {
        return $this->belongsTo(Account::class);
    }
    function transactionType(): BelongsTo {
        return $this->belongsTo(TransactionType::class);
    }
}
