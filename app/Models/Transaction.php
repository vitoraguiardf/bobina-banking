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
        'from_storage_id',
        'to_storage_id',
        'description',
        'quantity',
    ];
    function fromStorage(): BelongsTo {
        return $this->belongsTo(CoilStorage::class);
    }
    function toStorage(): BelongsTo {
        return $this->belongsTo(CoilStorage::class);
    }
    function type(): BelongsTo {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
}
