<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('dashboard.categoria.create');
    }
}
