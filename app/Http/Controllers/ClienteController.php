<?php

namespace App\Http\Controllers;

class ClienteController extends Controller
{
    /**
     * Dashboard del cliente.
     */
    public function index()
    {
        return view('cliente.dashboard');
    }
}
