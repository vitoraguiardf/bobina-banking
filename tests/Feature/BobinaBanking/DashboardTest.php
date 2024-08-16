<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_bobina_banking_dashboard_render(): void
    {

        $this->get('/bobina-banking');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
