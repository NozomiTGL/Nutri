<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración.
     */
    public function index()
    {
        $totalProductos  = Producto::count();
        $totalCategorias = Categoria::count();

        return view('admin.dashboard', compact('totalProductos', 'totalCategorias'));
    }
}
