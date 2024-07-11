<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function createdCoilStorages(): HasMany {
        return $this->hasMany(CoilStorage::class, 'creator_user_id');
    }

    function createdTransactionTypes(): HasMany {
        return $this->hasMany(TransactionType::class, 'creator_user_id');
    }

    function createdTransactions(): HasMany {
        return $this->hasMany(Transaction::class, 'creator_user_id');
    }

    /**
     * Transações positivas/cretidatas/entrada/to_this
     */
    public function toTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transaction::class,
            CoilStorage::class, 'holder_id', 'to_storage_id', 'id', 'id')->where(
                'holder_type',
                array_search(static::class, Relation::morphMap() ?: [static::class])
            );
    }
    
    /**
     * Transações negativas/debitadas/saída/from_this
     */
    public function fromTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transaction::class,
            CoilStorage::class, 'holder_id', 'from_storage_id', 'id', 'id')
            ->where(
                'holder_type',
                array_search(static::class, Relation::morphMap() ?: [static::class])
            );
    }
}
