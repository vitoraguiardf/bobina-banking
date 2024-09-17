<?php

namespace App\Models\traits;

use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait WithHoldedAccounts {
    /**
     * 
     */
    function holdedAccounts(): MorphMany {
        return parent::morphMany(Account::class, 'holder');
    }
}