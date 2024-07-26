<?php

namespace Database\Seeders;

use App\Models\Produto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Cliente, Pedido, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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

        $user = User::factory()->create([
            'name'     => 'dev',
            'email'    => 'cliente@example.com',
            'password' => 123,
        ]);

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
            'email'   => $user->email,
        ]);

        $produto = Produto::factory()->create();

        $pedido = Pedido::create([
            'cliente_id'             => $cliente->id,
            'status_do_pedido'       => 'pendente',
            'data_pedido_efetuado'   => Carbon::now(),
            'data_pedido_vencimento' => Carbon::now()->addDays(3),
        ]);

        $pedido->produtos()->create([
            'produto_id'     => $produto->id,
            'quantidade'     => 1,
            'valor_unitario' => floatval(200),
            'desconto'       => 50,
        ]);

        $pedido->update([
            'sub_total'    => 200,
            'desconto'     => 50,
            'total_pedido' => 150,
        ]);

    }
}
