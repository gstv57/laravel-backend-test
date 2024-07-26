<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;

    protected $casts = [
        'data_de_nascimento' => 'datetime',
    ];

    protected $fillable = ['user_id', 'nome', 'email', 'telefone', 'data_de_nascimento', 'cpf', 'sexo', 'status'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
