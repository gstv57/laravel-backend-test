<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'categoria_produtos', 'categoria_id', 'produto_id');
    }
}
