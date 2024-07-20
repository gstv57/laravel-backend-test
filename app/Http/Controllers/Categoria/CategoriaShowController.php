<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Models\{Categoria, Produto};
use Exception;

class CategoriaShowController extends Controller
{
    public function __invoke(Categoria $id)
    {
        try {
            $id->load('produtos');
            $produtos = Produto::all();

            return view('dashboard.categoria.show', [
                'categoria' => $id,
                'produtos'  => $produtos,
            ]);
        } catch (Exception $e) {
            return to_route('categorias.index')->with('error', 'Erro ao exibir categoria. Entre em contato com o suporte.');
        }
    }
}
