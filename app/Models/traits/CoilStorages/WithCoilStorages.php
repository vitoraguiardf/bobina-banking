<?php

namespace App\Models\traits\CoilStorages;

use App\Models\CoilStorage;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait WithCoilStorages {
    /**
     * 
     */
    function coilStorages(): MorphMany {
        return parent::morphMany(CoilStorage::class, 'holder');
    }
}