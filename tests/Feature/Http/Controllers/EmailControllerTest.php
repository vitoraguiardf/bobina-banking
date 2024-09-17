<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class EmailControllerTest extends TestCase
{

    public function test_email_controller(): void
    {
        $response = $this->get('/');
    
        $response->assertStatus(200);
    }
}