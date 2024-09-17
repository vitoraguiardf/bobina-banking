<?php

namespace App\Models;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Account extends Model
{
    use HasFactory, WithCreator;
    protected $fillable = [
        'creator_user_id',
        'holder_type',
        'holder_id',
        'name',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['holder_name'];

    /**
     * Usuário titular da conta
     */
    function holder(): MorphTo {
        return $this->morphTo('holder');
    }
    
    /**
     * Nome do titular da conta
     */
    function getHolderNameAttribute() {
        $holder = $this->holder;
        return $holder ? $holder->name : null;
    }
    
    /**
     * Transações positivas/cretidatas/entrada/to_this
     */
    function toTransactions(): HasMany {
        return $this->hasMany(Transaction::class, 'to_account_id');
    }

    /**
     * Transações negativas/debitadas/saída/from_this
     */
    function fromTransactions(): HasMany {
        return $this->hasMany(Transaction::class, 'from_account_id');
    }

}
