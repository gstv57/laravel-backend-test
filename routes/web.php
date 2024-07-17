<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Produto\ProdutoController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/excluir/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
});

require __DIR__ . '/auth.php';
