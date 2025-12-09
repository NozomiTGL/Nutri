<?php

namespace App\Http\Controllers;

use App\Models\User;

class NutriController extends Controller
{
    
    public function index()
    {
        
        $totalClientes = User::where('role', 1)->count();

        return view('nutri.dashboard', compact('totalClientes'));
    }
}
