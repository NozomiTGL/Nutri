<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Producto;
use App\Models\Recomendacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecomendacionController extends Controller
{
    
    public function create(Evaluacion $evaluacion)
    {
        $productos = Producto::with('categoria')->get();

        return view('nutri.recomendaciones.create', compact('evaluacion', 'productos'));
    }

    
    public function store(Request $request, Evaluacion $evaluacion)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'productos'   => 'required|array',
            'productos.*' => 'exists:productos,id',
        ]);

        $nutri = Auth::user();

        $recomendacion = Recomendacion::create([
            'evaluacion_id' => $evaluacion->id,
            'user_id'       => $nutri->id,
            'titulo'        => $request->titulo,
            'descripcion'   => $request->descripcion,
        ]);

        $attachData = [];
        foreach ($request->productos as $productoId) {
            $attachData[$productoId] = [
                'dosis' => $request->input('dosis.' . $productoId) ?? null,
            ];
        }

        $recomendacion->productos()->attach($attachData);

        return redirect()
            ->route('nutri.evaluaciones.show', $evaluacion)
            ->with('success', 'Recomendación creada correctamente.');
    }


   
    public function clienteIndex()
    {
        $user = Auth::user();

        $evaluaciones = $user->evaluaciones()
            ->with(['recomendaciones.productos.categoria'])
            ->get();

        return view('cliente.recomendaciones.index', compact('evaluaciones'));
    }
}
