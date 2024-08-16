<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class OfficeTest extends TestCase
{
    public function test_bobina_banking_office_render(): void
    {
        $this->get('/bobina-banking/office');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking/office');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
