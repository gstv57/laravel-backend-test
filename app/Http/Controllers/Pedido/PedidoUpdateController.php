<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class PedidoUpdateController extends Controller
{
    public function __invoke(Pedido $id, Request $request)
    {
        DB::beginTransaction();

        try {
            $produtos_pedido = $request->produtos;

            foreach ($produtos_pedido as $produto) {

                $desconto_produto  = (float) $produto['desconto'] ?? 0;
                $produto_existente = $id->produtos()->where('produto_id', $produto['produto_id'])->first();

                if ($produto_existente) {
                    $produto_existente->update([
                        'quantidade'     => $produto['quantidade'],
                        'valor_unitario' => $produto['valor_unitario'],
                        'desconto'       => $desconto_produto,
                    ]);
                }

                if(!$produto_existente) {
                    $id->produtos()->create([
                        'produto_id'     => $produto['produto_id'],
                        'quantidade'     => $produto['quantidade'],
                        'valor_unitario' => $produto['valor_unitario'],
                        'desconto'       => $desconto_produto,
                    ]);
                }
            }

            $id->atualizar_pedido_valores();
            DB::commit();

            return to_route('pedidos.show', $id)->with('success', 'Pedido atualizado com sucesso!');

        } catch (Exception $e) {
            DB::rollback();
            Log::error('Erro ao atualizar pedido: ' . $e->getMessage());

            return back()->with('error', 'Erro ao atualizar o pedido.');
        }
    }
}
