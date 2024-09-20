<?php

namespace App\Models;

use App\Models\Account\Key;
use App\Models\Account\Key\Email;
use App\Models\Account\Key\Phone;
use App\Models\Account\Key\Random;
use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    function keys() {
        return $this->hasMany(Key::class);
    }

    function createRandomKey() {
        return $this->randomKeys()->create(['creator_user_id' => 1, 'name' => fake()->unique()->uuid()]);
    }
    
    function createEmailKey() {
        return $this->emailKeys()->create(['creator_user_id' => 1, 'name' => fake()->unique()->safeEmail()]);
    }
    
    function createPhoneKey() {
        return $this->phoneKeys()->create(['creator_user_id' => 1, 'name' => fake()->unique()->phoneNumber()]);
    }

    function randomKeys(): MorphToMany {
        return $this->morphedByMany(Random::class, "key", "account_keys");
    }

    function emailKeys(): MorphToMany {
        return $this->morphedByMany(Email::class, "key", "account_keys");
    }

    function phoneKeys() {
        return $this->morphedByMany(Phone::class, "key", "account_keys");
    }

}
