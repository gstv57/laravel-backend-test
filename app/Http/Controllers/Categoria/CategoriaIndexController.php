<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Trait\QueryBuilderTrait;
use Exception;
use Illuminate\Http\Request;

class CategoriaIndexController extends Controller
{
    use QueryBuilderTrait;

    public function __construct()
    {
        $this->query = Categoria::query();
    }

    public function __invoke(Request $request)
    {
        $validate = $request->validate(['search' => 'string|max:50']);

        try {
            $categorias = $this
                ->aplicarPesquisa($request->input('search'), ['nome'])
                ->aplicarFiltros($request->only(['nome']))
                ->aplicarOrdenacao($request->input('sort', 'id'), $request->input('direction', 'asc'))
                ->paginacao();

            $queryString = $request->except('page');

            return view('dashboard.categoria.index', compact('categorias', 'queryString'));

        } catch(Exception $e) {
            dd($e->getMessage());
        }

    }
}
