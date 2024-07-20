<?php

namespace App\Contracts;

interface ProdutoContract
{
    public function paginate(int $paginas);
    public function search(string $query, int $paginas);
}
