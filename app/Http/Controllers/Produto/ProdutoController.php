<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Trait\QueryBuilderTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    use QueryBuilderTrait;

    public function __construct()
    {
        $this->query = Produto::query();
    }

    public function index(Request $request)
    {
        $validate = $request->validate(['search' => 'string|max:50']);

        $produtos = $this
            ->aplicarPesquisa($request->input('search'), ['nome', 'descricao', 'preco', 'quantidade', 'status'])
            ->aplicarFiltros($request->only(['nome', 'descricao', 'preco', 'quantidade', 'status']))
            ->aplicarOrdenacao($request->input('sort', 'id'), $request->input('direction', 'asc'))
            ->paginacao();

        $queryString = $request->except('page');

        return view('dashboard.produtos.index', compact('produtos', 'queryString'));
    }
    public function create()
    {
        return view('dashboard.produtos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'       => ['required', 'min:5', 'max:40'],
            'descricao'  => ['required', 'min:10', 'max:255'],
            'preco'      => ['required', 'numeric', 'min:0'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'status'     => ['required', 'boolean'],
        ]);
        DB::beginTransaction();

        try {
            Produto::create($validated);
            DB::commit();

            return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Algo de errado, tente novamente.');
        }
    }

    public function edit(Produto $id)
    {
        return view('dashboard.produtos.edit', ['produto' => $id]);
    }

    public function update(Produto $id, Request $request)
    {
        $validated = $request->validate([
            'nome'       => ['required', 'min:5', 'max:40'],
            'descricao'  => ['required', 'min:10', 'max:255'],
            'preco'      => ['required', 'numeric', 'min:0'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'status'     => ['required', 'boolean'],
        ]);

        DB::beginTransaction();

        try {
            $id->update($validated);
            DB::commit();

            return redirect()->back()->with('success', 'Produto atualizado com sucesso.');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Erro ao atualizar o produto: ' . $e->getMessage());
        }
    }

    public function destroy(Produto $id)
    {
        DB::beginTransaction();

        try {
            $id->delete();
            DB::commit();

            return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
        } catch(Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Aconteceu algum problema ao excluir o produto. Entre em contato com o suporte');
        }
    }
}
