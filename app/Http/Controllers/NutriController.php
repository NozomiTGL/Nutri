<?php

namespace App\Http\Controllers;

use App\Models\User;

class NutriController extends Controller
{
    /**
     * Dashboard de la nutrióloga.
     */
    public function index()
    {
        // Contar clientes (role = 1) como ejemplo
        $totalClientes = User::where('role', 1)->count();

        return view('nutri.dashboard', compact('totalClientes'));
    }
}
