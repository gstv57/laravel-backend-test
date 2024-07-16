<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Builder;

trait QueryBuilderTrait
{
    protected Builder $query;

    public function aplicarFiltros($search)
    {
        if ($search) {
            $this->query->where(function ($q) use ($search) {
                $q->where('nome', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%')
                  ->orWhere('telefone', 'LIKE', '%' . $search . '%')
                  ->orWhere('status', 'LIKE', '%' . $search . '%')
                  ->orWhere('sexo', 'LIKE', '%' . $search . '%')
                  ->orWhere('data_de_nascimento', 'LIKE', '%' . $search . '%')
                  ->orWhere('cpf', 'LIKE', '%' . $search . '%');
            });
        }

        return $this;
    }
    public function aplicarOrdenacao($ordenar, $direcao)
    {
        $this->query->orderBy($ordenar, $direcao);

        return $this;
    }
    public function paginacao($porPagina = 10)
    {
        return $this->query->paginate($porPagina);
    }
}
