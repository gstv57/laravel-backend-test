<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Models\{Categoria, Produto};
use Exception;
use Illuminate\Support\Facades\DB;

class CategoriaAttachlessProdutoController extends Controller
{
    public function __invoke(Produto $id, Categoria $categoria)
    {
        DB::beginTransaction();

        try {
            $categoria->produtos()->detach($id->id);
            DB::commit();

            return redirect()->back()->with('success', 'Produto removido da categoria');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Produto não foi removido da categoria. Entre em contato com o suporte.');
        }
    }
}
