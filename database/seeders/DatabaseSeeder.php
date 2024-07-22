<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AccessControl\PermissionSeeder;
use Database\Seeders\AccessControl\RoleSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seeding default permissions
        $this->call(PermissionSeeder::class);
        // Seeding default roles
        $this->call(RoleSeeder::class);

    }
}
