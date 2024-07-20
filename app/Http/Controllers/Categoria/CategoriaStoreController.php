<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\CategoriaStoreRequest;
use App\Models\Categoria;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoriaStoreController extends Controller
{
    public function __invoke(CategoriaStoreRequest $request)
    {
        DB::beginTransaction();

        try {

            Categoria::create($request->all());
            DB::commit();

            return to_route('categorias.index')->with('success', 'Categoria criada com sucesso!');

        } catch(Exception $e) {
            DB::rollback();

            return response()->back()->with('error', 'Categoria não criada com sucesso! Entre em contato com o suporte.');
        }
    }
}
