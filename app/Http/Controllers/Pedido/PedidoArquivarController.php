<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\{DB, Log};

class PedidoArquivarController extends Controller
{
    public function __invoke(Pedido $id)
    {
        try {
            DB::beginTransaction();
            $id->update(['status_do_pedido' => 'arquivado']);
            $id->save();
            $id->delete();
            DB::commit();

            return redirect()->back()->with('success', 'Pedido arquivado com sucesso!');
        } catch(Exception $e) {
            Log::warning($e->getMessage());
            DB::rollback();

            return redirect()->back()->with('error', 'Aconteceu um erro ao arquivar o pedido, entre em contato com o suporte.');
        }
    }
}
