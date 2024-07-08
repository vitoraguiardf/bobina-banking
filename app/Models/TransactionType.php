<?php

namespace App\Models;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory, WithCreator;
    protected $fillable = [
        'creator_user_id',
        'name',
        'description',
        'origin',
        'destin'
    ];
}