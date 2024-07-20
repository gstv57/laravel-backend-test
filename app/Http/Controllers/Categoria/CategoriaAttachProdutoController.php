<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\CategoriaProdutoAttachRequest;
use App\Models\{Categoria};
use Exception;
use Illuminate\Support\Carbon;

class CategoriaAttachProdutoController extends Controller
{
    public function __invoke(Categoria $categoria, CategoriaProdutoAttachRequest $request)
    {
        try {
            $produto_data = array_map(function ($produto_id) {
                return ['created_at' => Carbon::now(), 'produto_id' => $produto_id];
            }, $request->produtos);

            $categoria->produtos()->attach($produto_data);

            return redirect()->back()->with('success', 'Produtos adicionados a categoria com sucesso!');

        } catch (Exception $e) {
            dd($e->getMessage());

            return redirect()->back()->with('error', 'Produtos não adicionados a categoria. Entre em contato com o suporte.');
        }
    }
}
