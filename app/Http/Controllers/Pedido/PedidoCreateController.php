<?php

namespace App\Http\Controllers\Pedido;

use App\Contracts\{ClienteContract, ProdutoContract};
use App\Http\Controllers\Controller;
use App\Http\Requests\Pedido\PedidoCreateRequest;
use Exception;

class PedidoCreateController extends Controller
{
    private $produtoRepository;

    private $clienteRepository;

    public function __construct(ProdutoContract $produtoRepository, ClienteContract $clienteRepository)
    {
        $this->produtoRepository = $produtoRepository;
        $this->clienteRepository = $clienteRepository;
    }
    public function __invoke(PedidoCreateRequest $request)
    {
        $produto_query = $request->input('search_produto');

        $produtos = $this->produtoRepository->paginate(4);
        $clientes = $this->clienteRepository->all();

        try {
            if ($produto_query) {
                $produtos = $this->produtoRepository->search($produto_query, 4);
            }

            return view('dashboard.pedidos.create', compact('produtos', 'clientes'));

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
