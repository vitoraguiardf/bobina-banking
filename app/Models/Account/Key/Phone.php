<?php

namespace App\Models\Account\Key;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory, WithCreator;
    protected $table = "phone_account_keys";
    protected $fillable = [
        'creator_user_id',
        'number',
    ];
}
