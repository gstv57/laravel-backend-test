<?php

namespace Database\Seeders;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ClienteFactory::class);
    }
}
