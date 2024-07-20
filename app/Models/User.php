<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\traits\CoilStorages\WithCoilStorages;
use App\Models\traits\Transactions\WithFrom;
use App\Models\traits\Transactions\WithTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, WithFrom, WithTo, WithCoilStorages, HasRoles;

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
}
