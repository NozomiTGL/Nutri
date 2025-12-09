<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteRecomendacionController extends Controller
{
   
    public function index()
    {
        $user = Auth::user();

        $evaluaciones = Evaluacion::with([
                'recomendaciones.productos.categoria',
                'recomendaciones.nutri',
            ])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cliente.recomendaciones.index', compact('evaluaciones'));
    }
}
