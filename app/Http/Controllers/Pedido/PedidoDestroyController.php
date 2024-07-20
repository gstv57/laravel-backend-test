<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\DB;

class PedidoDestroyController extends Controller
{
    public function __invoke(Pedido $id)
    {
        DB::beginTransaction();

        try {
            $id->forceDelete();
            DB::commit();

            return to_route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
        } catch(Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }
}
