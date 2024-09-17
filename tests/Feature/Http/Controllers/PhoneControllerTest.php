<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class PhoneControllerTest extends TestCase
{

    public function test_phone_controller(): void
    {
        $response = $this->get('/');
    
        $response->assertStatus(200);
    }
}