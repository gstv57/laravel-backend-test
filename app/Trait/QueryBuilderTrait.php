<?php

namespace App\Trait;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait QueryBuilderTrait
{
    protected Builder $query;

    public function aplicarFiltros(array $filtros = [])
    {
        foreach ($filtros as $campo => $valor) {
            if (!is_null($valor) && $valor !== '') {
                $this->query->where($campo, 'LIKE', '%' . $valor . '%');
            }
        }

        return $this;
    }

    public function aplicarPesquisa($termo)
    {
        try{
            if (!is_null($termo) && $termo !== '') {
                $this->query->where(function ($query) use ($termo) {
                    $query->where('nome', 'LIKE', '%' . $termo . '%')
                          ->orWhere('email', 'LIKE', '%' . $termo . '%')
                          ->orWhere('telefone', 'LIKE', '%' . $termo . '%')
                          ->orWhere('data_de_nascimento', 'LIKE', '%' . $termo . '%')
                          ->orWhere('cpf', 'LIKE', '%' . $termo . '%')
                          ->orWhere('sexo', 'LIKE', '%' . $termo . '%')
                          ->orWhere('status', 'LIKE', '%' . $termo . '%');
                });
            }
            return $this;
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function aplicarOrdenacao($ordenar, $direcao = 'asc')
    {
        if ($ordenar) {
            $this->query->orderBy($ordenar, $direcao);
        }

        return $this;
    }

    public function paginacao($porPagina = 10)
    {
        return $this->query->paginate($porPagina);
    }
}
