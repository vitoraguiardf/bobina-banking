<?php

namespace App\Models\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Key extends Pivot
{
    protected $table = "account_keys";
    protected $fillable = [
        'creator_user_id',
    ];
    function key() {
        return $this->morphTo('key');
    }
    function account() {
        return $this->belongsTo(Account::class);
    }
}
