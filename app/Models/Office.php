<?php

namespace App\Models;

use App\Models\traits\Transactions\WithFrom;
use App\Models\traits\Transactions\WithTo;
use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Office extends Model
{
    use HasFactory, WithCreator, WithFrom, WithTo;
    protected $fillable = [
        'creator_user_id',
        'description',
        'name',
    ];

    function coilStorages(): MorphMany {
        return $this->morphMany(CoilStorage::class, 'holder');
    }
}
