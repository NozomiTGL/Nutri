<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    
    public function clienteForm()
    {
        $user = Auth::user();

        
        $evaluacion = $user->evaluaciones()->first();

        return view('cliente.evaluacion_form', compact('evaluacion'));
    }

    
    public function clienteStore(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'peso'             => 'required|numeric|min:1',
            'estatura'         => 'required|numeric|min:0.5',
            'objetivo'         => 'required|string|max:255',
            'actividad_fisica' => 'required|string|max:255',
            'restricciones'    => 'nullable|string',
        ]);

        
        if ($user->evaluaciones()->exists()) {
            return redirect()
                ->route('cliente.evaluacion.form')
                ->with('success', 'Ya tienes una evaluación registrada. Puedes actualizarla.');
        }

        Evaluacion::create([
            'user_id'          => $user->id,
            'peso'             => $request->peso,
            'estatura'         => $request->estatura,
            'objetivo'         => $request->objetivo,
            'actividad_fisica' => $request->actividad_fisica,
            'restricciones'    => $request->restricciones,
        ]);

        return redirect()
            ->route('cliente.evaluacion.form')
            ->with('success', 'Evaluación guardada correctamente.');
    }

    
    public function clienteUpdate(Request $request)
    {
        $user = Auth::user();
        $evaluacion = $user->evaluaciones()->firstOrFail();

        $request->validate([
            'peso'             => 'required|numeric|min:1',
            'estatura'         => 'required|numeric|min:0.5',
            'objetivo'         => 'required|string|max:255',
            'actividad_fisica' => 'required|string|max:255',
            'restricciones'    => 'nullable|string',
        ]);

        $evaluacion->update([
            'peso'             => $request->peso,
            'estatura'         => $request->estatura,
            'objetivo'         => $request->objetivo,
            'actividad_fisica' => $request->actividad_fisica,
            'restricciones'    => $request->restricciones,
        ]);

        return redirect()
            ->route('cliente.evaluacion.form')
            ->with('success', 'Evaluación actualizada correctamente.');
    }

  
    public function nutriIndex()
    {
        $evaluaciones = Evaluacion::with('user')->latest()->get();

        return view('nutri.evaluaciones.index', compact('evaluaciones'));
    }

 
    public function nutriShow(Evaluacion $evaluacion)
    {
        $evaluacion->load('user');

        return view('nutri.evaluaciones.show', compact('evaluacion'));
    }
}
