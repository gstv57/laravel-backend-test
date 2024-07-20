<?php

namespace App\Http\Controllers\Pagamento;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;
use Illuminate\Http\Request;

class PagamentoStoreController extends Controller
{
    public function __invoke(Pedido $id, Request $request)
    {
        $validated = $request->validate(["forma_de_pagamento" => ['required', 'string']]);

        try {
            $id->update(['status_do_pedido' => 'processando', 'forma_de_pagamento' => $request->forma_de_pagamento]);

            // dispatch e-mail com link de pagamento
            return to_route('pedidos.show', $id)->with('success', 'Link de pagamento enviado para o e-mail do cliente');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
