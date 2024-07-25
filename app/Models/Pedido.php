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

    public function atualizar_pedido_valores()
    {
        $total_desconto = 0;
        $sub_total      = 0;

        foreach ($this->produtos as $produto) {
            $valor_produto    = $produto->quantidade * $produto->valor_unitario;
            $desconto_produto = $produto->desconto;

            $sub_total += $valor_produto;
            $total_desconto += $desconto_produto;
        }

        $total = $sub_total - $total_desconto;

        $this->update([
            'sub_total'    => $sub_total,
            'desconto'     => $total_desconto,
            'total_pedido' => $total,
        ]);

    }
}
