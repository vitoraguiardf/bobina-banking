<?php

namespace App\Models\traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait WithCreator
{
    function user(): BelongsTo {
        return parent::belongsTo(User::class);
    }
}
