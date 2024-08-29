<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as AppController;
use Illuminate\Routing\Controllers\HasMiddleware;

abstract class Controller extends AppController implements HasMiddleware
{
    public static function middleware(): array {
        return ['auth:api', 'verified'];
    }
}
