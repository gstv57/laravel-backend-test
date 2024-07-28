<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope};
use Illuminate\Queue\SerializesModels;

class PagamentoCriado extends Mailable
{
    use Queueable;
    use SerializesModels;

    public Cliente $cliente;
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Link para finalizar seu pagamento',
            to: $this->cliente->email,
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'mail.pagamento.criado',
            with: [
                'cliente' => $this->cliente,
            ],
        );
    }
}
