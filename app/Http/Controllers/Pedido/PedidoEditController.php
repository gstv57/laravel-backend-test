<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\{Pedido, Produto};

class PedidoEditController extends Controller
{
    public function __invoke(Pedido $id)
    {
        $id->load('produtos.produto', 'cliente');
        $produtos = Produto::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.pedidos.edit', ['pedido' => $id, 'produtos' => $produtos]);
    }
}
