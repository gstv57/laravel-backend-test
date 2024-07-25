<?php

use App\Http\Controllers\Categoria\CategoriaAttachlessProdutoController;
use App\Http\Controllers\Categoria\{CategoriaAttachProdutoController, CategoriaShowController};
use App\Http\Controllers\Categoria\{CategoriaCreateController, CategoriaIndexController, CategoriaStoreController};
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Pagamento\{PagamentoCreateController, PagamentoStoreController};
use App\Http\Controllers\Pedido\{PedidoArquivarController, PedidoDesarquivarController, PedidoDestroyController};
use App\Http\Controllers\Pedido\{PedidoCreateController};
use App\Http\Controllers\Pedido\{PedidoEditController, PedidoUpdateController};
use App\Http\Controllers\Pedido\{PedidoIndexController, PedidoShowController, PedidoStoreController};
use App\Http\Controllers\Produto\ProdutoController;
use App\Http\Controllers\{PedidoProdutoDestroyAjaxController, ProfileController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/criar', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/criar', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/editar/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/editar/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/excluir/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos/criar', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::post('/produtos/ajax', [ProdutoController::class, 'ajax'])->name('produtos.ajax.search');
    Route::get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/excluir/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    Route::post('/produtos/categoria/{categoria}', CategoriaAttachProdutoController::class)->name('produtos.categoria.attach');
    Route::delete('/produtos/{id}/categoria/{categoria}', CategoriaAttachlessProdutoController::class)->name('produtos.categoria.attachless');

    Route::get('/categorias', CategoriaIndexController::class)->name('categorias.index');
    Route::get('/categorias/criar', CategoriaCreateController::class)->name('categorias.create');
    Route::post('/categorias/criar', CategoriaStoreController::class)->name('categorias.store');
    Route::get('/categorias/exibir/{id}', CategoriaShowController::class)->name('categorias.show');

    Route::get('/pedidos', PedidoIndexController::class)->name('pedidos.index');
    Route::get('/pedidos/criar', PedidoCreateController::class)->name('pedidos.create');
    Route::post('/pedidos/criar', PedidoStoreController::class)->name('pedidos.store');
    Route::get('/pedidos/exibir/{id}', PedidoShowController::class)->name('pedidos.show');
    Route::get('/pedidos/editar/{id}', PedidoEditController::class)->name('pedidos.edit');
    Route::delete('/pedidos/editar/{id}', PedidoProdutoDestroyAjaxController::class)->name('pedidos.destroy.produto');
    Route::put('/pedidos/editar/{id}', PedidoUpdateController::class)->name('pedidos.update');
    Route::delete('/pedidos/arquivar/{id}', PedidoArquivarController::class)->name('pedidos.arquivar');
    Route::post('/pedidos/desarquivar/{id}', PedidoDesarquivarController::class)->name('pedidos.desarquivar');
    Route::delete('/pedidos/excluir/{id}', PedidoDestroyController::class)->name('pedidos.destroy');

    Route::get('/pagamento/criar/{id}', PagamentoCreateController::class)->name('pagamento.create');
    Route::post('/pagamento/criar/{id}', PagamentoStoreController::class)->name('pagamento.store');
});

require __DIR__ . '/auth.php';
