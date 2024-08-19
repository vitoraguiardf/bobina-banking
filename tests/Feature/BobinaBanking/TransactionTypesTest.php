<?php

namespace Tests\Feature\BobinaBanking;

use App\Models\User;
use Tests\TestCase;

class TransactionTypesTest extends TestCase
{
    public function test_bobina_banking_transaction_types_render(): void
    {
        $this->get('/bobina-banking/transaction-types');
        $this->assertGuest();
        
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/bobina-banking/transaction-types');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
