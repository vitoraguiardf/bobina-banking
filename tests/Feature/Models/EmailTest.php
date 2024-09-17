<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class EmailTest extends TestCase
{

    public function test_email_model(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}