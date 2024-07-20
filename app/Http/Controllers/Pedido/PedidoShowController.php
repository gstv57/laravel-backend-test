<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;

class PedidoShowController extends Controller
{
    public function __invoke(Pedido $id)
    {
        try {
            $id->load('produtos.produto', 'cliente');

            return view('dashboard.pedidos.show', ['pedido' => $id]);
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Aconteceu um problema ao tentar exibir o pedido. Entre em contato com o suporte.');
        }
    }
}
