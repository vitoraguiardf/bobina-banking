<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_bobina_banking_users_render(): void
    {
        $this->get('/bobina-banking/users');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking/users');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
