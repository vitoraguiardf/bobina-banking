<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class PhoneTest extends TestCase
{

    public function test_phone_model(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}