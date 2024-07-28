<?php

namespace App\Models;

use App\Events\PagamentoCriado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends Model
{
    protected $fillable = ['total_pedido', 'pedido_id', 'tipo_de_pagamento'];

    protected $dispatchesEvents = [
        'created' => PagamentoCriado::class,
    ];
    public function pedido(): belongsTo
    {
        return $this->belongsTo(Pedido::class);
    }
}
