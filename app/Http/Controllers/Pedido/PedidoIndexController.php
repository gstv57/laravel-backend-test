<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $pedidos = Pedido::withTrashed()
                ->paginate(10);

        return view('dashboard.pedidos.index', compact('pedidos'));
    }
}
