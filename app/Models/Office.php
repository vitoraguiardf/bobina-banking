<?php

namespace App\Models;

use App\Models\traits\WithCreator;
use App\Models\traits\WithFromTransactions;
use App\Models\traits\WithHoldedAccounts;
use App\Models\traits\WithToTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory, WithCreator, WithFromTransactions, WithToTransactions, WithHoldedAccounts;
    protected $fillable = [
        'creator_user_id',
        'description',
        'name',
    ];
}
