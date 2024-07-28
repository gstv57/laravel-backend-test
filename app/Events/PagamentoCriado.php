<?php

namespace App\Events;

use App\Models\Pagamento;
use Illuminate\Broadcasting\{InteractsWithSockets, PrivateChannel};
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PagamentoCriado
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Pagamento $pagamento;
    public function __construct(Pagamento $pagamento)
    {
        $this->pagamento = $pagamento;
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
