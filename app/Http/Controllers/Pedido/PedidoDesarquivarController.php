<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoDesarquivarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $pedido = Pedido::withTrashed()->findOrFail($id);
        DB::beginTransaction();

        try {
            $pedido->restore();
            $pedido->update(['status_do_pedido' => 'pendente']);
            $pedido->save();
            DB::commit();

            return to_route('pedidos.show', $pedido->id)->with('success', 'Pedido desarquivado com sucesso!');

        } catch(Exception $e) {
            DB::rollback();
            dd($e->getMessage());

            return redirect()->back()->with('error', 'Aconteceu algo de errado ao restaurar o pedido, entre em contato com o suporte.');
        }
    }
}
