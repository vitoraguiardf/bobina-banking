<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class CoilStorageTest extends TestCase
{
    public function test_bobina_banking_coil_storage_render(): void
    {
        $this->get('/bobina-banking/coil-storage');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking/coil-storage');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
