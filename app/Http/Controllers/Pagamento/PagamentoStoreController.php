<?php

namespace App\Http\Controllers\Pagamento;

use App\Http\Controllers\Controller;
use App\Models\{Pagamento, Pedido};
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PagamentoStoreController extends Controller
{
    public function __invoke(Pedido $id, Request $request)
    {
        $request->validate(['forma_de_pagamento' => ['required', 'string']]);

        try {
            $id->update(['status_do_pedido' => 'processando', 'forma_de_pagamento' => $request->forma_de_pagamento]);

            $payload = [
                'total_pedido'      => $id->total_pedido,
                'pedido_id'         => $id->id,
                'tipo_de_pagamento' => $request->forma_de_pagamento,
            ];
            Pagamento::create($payload);

            return to_route('pedidos.show', $id)->with('success', 'Link de pagamento enviado para o e-mail do cliente');
        } catch (ModelNotFoundException) {
            return to_route('pedidos.index')->with('error', 'Algo de errado aconteceu, o e-mail do cliente do pedido não foi localizado.');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
