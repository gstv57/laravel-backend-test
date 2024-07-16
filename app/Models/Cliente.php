<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'data_de_nascimento', 'cpf', 'sexo', 'status'];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
