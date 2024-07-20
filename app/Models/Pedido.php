<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $casts = [
        'data_pedido_efetuado'   => 'datetime',
        'data_pedido_pagamento'  => 'datetime',
        'data_pedido_entrega'    => 'datetime',
        'data_pedido_vencimento' => 'datetime',
    ];

    protected $fillable = ['cliente_id', 'status_do_pedido', 'data_pedido_efetuado', 'data_pedido_pagamento', 'data_pedido_entrega', 'data_pedido_vencimento', 'sub_total', 'desconto', 'total_pedido'];

    public function produtos()
    {
        return $this->hasMany(PedidoProduto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
