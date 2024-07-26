<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder as DatabaseSeeder;

/**
 * Personalização da classe Seeder
 */
class Seeder extends DatabaseSeeder
{
    /**
     * Incuindo um usuário Root compartilhado entre os seeders
     */    
    public static ?User $ROOT_USER;

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // Cria o usuário root
        static::$ROOT_USER ??= User::factory()->create([
            'name' => env('ROOT_USER_NAME', 'Root User'),
            'email' => env('ROOT_USER_EMAIL', 'root@my-app.com'),
            'password' => env('ROOT_USER_PASSWORD', 'password'),
        ]);

        // Atribui pemissões do usuário root
        static::$ROOT_USER->assignRole('office.admin');
        static::$ROOT_USER->save();
    }
}
