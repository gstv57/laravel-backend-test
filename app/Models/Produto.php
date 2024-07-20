<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'preco', 'quantidade', 'status'];

    public function pedidos()
    {
        return $this->hasMany(PedidoProduto::class);
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_produtos', 'produto_id', 'categoria_id');
    }
}
