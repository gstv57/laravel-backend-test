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

    public function aplicarPesquisa($search = null, $colunas = [])
    {
        try {
            if (!is_null($search) && $search !== '' && !empty($colunas)) {
                $this->query->where(function ($query) use ($search, $colunas) {
                    foreach ($colunas as $coluna) {
                        $query->orWhere($coluna, 'LIKE', '%' . $search . '%');
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
