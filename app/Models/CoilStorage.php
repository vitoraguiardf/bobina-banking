<?php

namespace App\Models;

use App\Models\traits\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoilStorage extends Model
{
    use HasFactory, WithCreator;
    protected $fillable = [
        'name'
    ];
}
