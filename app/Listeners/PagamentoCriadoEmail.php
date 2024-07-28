<?php

namespace App\Listeners;

use App\Events\PagamentoCriado;
use App\Mail\PagamentoCriado as PagamentoMail;
use App\Models\Pedido;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\{Log, Mail};

class PagamentoCriadoEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PagamentoCriado $event): void
    {
        try {
            $pagamento = $event->pagamento;
            $pedido    = Pedido::find($pagamento->pedido_id)
                ->with('cliente')
                ->first();

            Mail::to($pedido->cliente->email)->send(new PagamentoMail($pedido->cliente));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
