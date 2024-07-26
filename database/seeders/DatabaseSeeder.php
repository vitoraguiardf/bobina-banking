<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Seeder as RootSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Access-Control
        $this->call(PermissionsSeeder::class);

        // Users
        $this->call(RootSeeder::class);
        User::factory(49)->create();

        // BobinaBanking
        $this->call(BobinaBankingSeeder::class);
        $this->call(BobinaBankingTestsSeeder::class);
        
    }
}
