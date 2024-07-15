<?php

namespace App;

use App\Models\Office;
use App\Models\User;

enum CoilStorageHolderTypes: string
{
    case User = User::class;
    case Office = Office::class;
}
