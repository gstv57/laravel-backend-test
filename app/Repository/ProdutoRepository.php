<?php

namespace App\Repository;

use App\Contracts\ProdutoContract;
use App\Models\Produto;

class ProdutoRepository implements ProdutoContract
{
    public function paginate(int $paginas = 5)
    {
        return Produto::paginate($paginas);
    }

    public function search(string $query = '', int $paginas = 5)
    {
        return Produto::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('nome', 'like', "%$query%")
                ->orWhere('descricao', 'like', "%$query%");
        })
            ->paginate($paginas);
    }
}
