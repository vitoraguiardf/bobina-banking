<?php

namespace App;

enum CoilStorageHolderTypes: string
{
    case User = 'App\Models\User';
    case Office = 'App\Models\Office';
}
