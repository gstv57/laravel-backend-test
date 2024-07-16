<?php

use App\Http\Controllers\Cliente\ClienteController;
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
});

require __DIR__ . '/auth.php';
