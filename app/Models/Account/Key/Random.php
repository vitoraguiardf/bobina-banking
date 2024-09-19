<?php

namespace App\Models\Account\Key;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
    use HasFactory, WithCreator;
    protected $fillable = [
        'creator_user_id',
        'random',
    ];
}
