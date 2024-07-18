<?php

namespace App\Trait;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait QueryBuilderTrait
{
    protected Builder $query;

    public function aplicarFiltros(array $filtros = [])
    {
        foreach ($filtros as $key => $value) {
            if (!is_null($value) && $value !== '') {
                $this->query->where($key, 'LIKE', '%' . $value . '%');
            }
        }

        return $this;
    }

    public function aplicarPesquisa($termo = null, $campos = [])
    {
        try {
            if (!is_null($termo) && $termo !== '' && !empty($campos)) {
                $this->query->where(function ($query) use ($termo, $campos) {
                    foreach ($campos as $campo) {
                        $query->orWhere($campo, 'LIKE', '%' . $termo . '%');
                    }
                });
            }
            return $this;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function aplicarOrdenacao($coluna, $direcao = 'asc')
    {
        if ($coluna) {
            $this->query->orderBy($coluna, $direcao);
        }
        return $this;
    }

    public function paginacao($porPagina = 10)
    {
        return $this->query->paginate($porPagina);
    }
}
