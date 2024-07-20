<?php

namespace App\Http\Controllers\Pagamento;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagamentoCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Pedido $id)
    {
        $id->load('cliente', 'produtos.produto');

        return view('dashboard.pagamento.create', ['pedido' => $id]);
    }
}
