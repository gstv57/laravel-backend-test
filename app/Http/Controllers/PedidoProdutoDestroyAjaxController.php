<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoProdutoDestroyAjaxController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Pedido $id, Request $request)
    {
        $validated = $request->validate([
            'produto_id' => ['required', 'exists:pedido_produtos,produto_id'],
        ]);

        DB::beginTransaction();

        try {
            $produto = $id->produtos()->where('produto_id', $request->produto_id)->first();
            $produto->delete();
            DB::commit();

            return response()->json(['success', 'Produto deletado do pedido com sucesso!']);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error', 'Aconteceu um erro ao deleter o produto do pedido, entre em contato com o suporte.']);
        }
    }
}
