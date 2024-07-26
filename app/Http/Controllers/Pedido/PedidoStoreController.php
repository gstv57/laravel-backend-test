<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pedido\PedidoStoreRequest;
use App\Models\{Pedido};
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB};

class PedidoStoreController extends Controller
{
    public function __invoke(PedidoStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $pedido = Pedido::create([
                'cliente_id'             => $request->cliente_id,
                'status_do_pedido'       => 'pendente',
                'data_pedido_efetuado'   => Carbon::now(),
                'data_pedido_vencimento' => Carbon::now()->addDays(3),
            ]);
            $subtotal      = 0;
            $totalDesconto = 0;

            foreach ($request->produtos as $produto) {
                $valorProduto    = $produto['quantidade'] * $produto['valor_unitario'];
                $descontoProduto = $produto['desconto'] ?? 0;

                $pedido->produtos()->create([
                    'produto_id'     => $produto['produto_id'],
                    'quantidade'     => $produto['quantidade'],
                    'valor_unitario' => $produto['valor_unitario'],
                    'desconto'       => $descontoProduto,
                ]);

                $subtotal += $valorProduto;
                $totalDesconto += $descontoProduto;
            }

            $total = $subtotal - $totalDesconto;

            $pedido->update([
                'sub_total'    => $subtotal,
                'desconto'     => $totalDesconto,
                'total_pedido' => $total,
            ]);
            DB::commit();

            return to_route('pedidos.show', $pedido->id)->with('success', 'Pedido criado com sucesso!');
        } catch (Exception $e) {
            DB::rollback();
            return to_route('pedidos.create')->with('error', 'Pedido não criado com sucesso! Entre em contato com o suporte.');
        }
    }
}
