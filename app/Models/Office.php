<?php

namespace App\Models;

use App\Models\traits\CoilStorages\WithCoilStorages;
use App\Models\traits\Transactions\WithFrom;
use App\Models\traits\Transactions\WithTo;
use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory, WithCreator, WithFrom, WithTo, WithCoilStorages;
    protected $fillable = [
        'creator_user_id',
        'description',
        'name',
    ];
}
