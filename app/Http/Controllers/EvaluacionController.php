<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    /**
     * FORMULARIO para que el cliente cree/actualice su evaluación.
     * (Un cliente solo tendrá UNA evaluación).
     */
    public function clienteForm()
    {
        $user = Auth::user();

        // Traemos la primera evaluación del cliente (si existe)
        $evaluacion = $user->evaluaciones()->first();

        return view('cliente.evaluacion_form', compact('evaluacion'));
    }

    /**
     * Guarda una nueva evaluación para el cliente.
     */
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

        // Si ya tiene evaluación, no creamos otra
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

    /**
     * Actualiza la evaluación existente del cliente.
     */
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

    /**
     * LISTADO para que la nutrióloga vea todas las evaluaciones.
     */
    public function nutriIndex()
    {
        $evaluaciones = Evaluacion::with('user')->latest()->get();

        return view('nutri.evaluaciones.index', compact('evaluaciones'));
    }

    /**
     * Detalle de una evaluación para la nutrióloga.
     */
    public function nutriShow(Evaluacion $evaluacion)
    {
        $evaluacion->load('user');

        return view('nutri.evaluaciones.show', compact('evaluacion'));
    }
}
