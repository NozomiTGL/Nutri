<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario ADMIN
        User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('pepe'),
                'role'     => 3,   // 3 = admin
            ]
        );

        // Usuario NUTRIÓLOGA
        User::updateOrCreate(
            ['email' => 'nutri@mail.com'],
            [
                'name'     => 'Nutrióloga Demo',
                'password' => bcrypt('pepe'),
                'role'     => 2,   // 2 = nutriólogo
            ]
        );

        // Usuario CLIENTE
        User::updateOrCreate(
            ['email' => 'cliente@mail.com'],
            [
                'name'     => 'Cliente Demo',
                'password' => bcrypt('pepe'),
                'role'     => 1,   // 1 = cliente
            ]
        );


        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
