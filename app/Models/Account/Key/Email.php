<?php

namespace App\Models\Account\Key;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory, WithCreator;
    protected $table = "email_account_keys";
    protected $fillable = [
        'creator_user_id',
        'name',
    ];
}
