<?php

namespace Database\Seeders;

use App\Models\{Cliente, User};
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
            'name'     => 'dev',
            'email'    => 'dev@example.com',
            'password' => 123,
        ]);
        Cliente::factory(100)->create();
    }
}
