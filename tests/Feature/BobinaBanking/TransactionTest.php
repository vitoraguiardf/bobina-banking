<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_bobina_banking_transaction_render(): void
    {
        $this->get('/bobina-banking/transaction');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking/transaction');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
