<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = $this->filtroCliente($request);

        return view('dashboard.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('dashboard.clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'               => ['required'],
            'email'              => ['required', 'unique:clientes'],
            'telefone'           => ['required', 'min:10', 'max:11'],
            'data_de_nascimento' => ['required'],
            'cpf'                => ['required', 'unique:clientes'],
            'sexo'               => ['required', 'in:m,f'],
        ]);

        DB::beginTransaction();

        try {
            Cliente::create($validated);
            DB::commit();

            return redirect()->route('clientes.index')->with('success', 'Cadastro realizado com sucesso.');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('clientes.index')->with('error', 'Cadastro não realizado com sucesso. Entre em contato com o suporte.');
        }
    }

    public function edit(Cliente $id)
    {
        return view('dashboard.clientes.edit', [
            'cliente' => $id,
        ]);
    }

    public function update(Cliente $id, Request $request)
    {
        $validated = $request->validate([
            'nome'               => ['required'],
            'email'              => ['required', 'email', 'unique:clientes,email,' . $id->id],
            'telefone'           => ['required', 'min:10', 'max:11'],
            'data_de_nascimento' => ['required'],
            'cpf'                => ['required', 'unique:clientes,cpf,' . $id->id],
            'sexo'               => ['required', 'in:m,f'],
        ]);
        DB::beginTransaction();

        try {
            $id->update($validated);
            DB::commit();

            return redirect()->route('clientes.index')->with('success', "Cliente: {$id->nome} atualizado com sucesso.");
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('clientes.index')->with('error', "Falha ao atualizar: {$id->nome}. Entre em contato com o suporte.");
        }
    }

    public function destroy(Cliente $id, Request $request)
    {
        DB::beginTransaction();

        try {
            $id->delete();
            DB::commit();

            return redirect()->route('clientes.index')->with('success', "Cliente: {$id->nome} excluído com sucesso.");
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('clientes.index')->with('error', "Cliente: {$id->nome} não foi excluído com sucesso.");
        }
    }

    protected function filtroCliente(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('telefone', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('sexo', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('data_de_nascimento', 'LIKE', '%' . $request->input('search') . '%')
                    ->orWhere('cpf', 'LIKE', '%' . $request->input('search') . '%');
            });
        }

        $sort      = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

        $clientes = $query->paginate(10);

        return $clientes->appends($request->query());
    }
}
