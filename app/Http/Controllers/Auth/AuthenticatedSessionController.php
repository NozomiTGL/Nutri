<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostrar formulario de login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Procesar login.
     */
    public function store(LoginRequest $request)
    {
        // 1) Autenticar (código estándar de Breeze)
        $request->authenticate();

        // 2) Regenerar la sesión
        $request->session()->regenerate();

        // 3) Usuario logueado
        $user = $request->user();

        // Convertimos el rol a entero para que no haya bronca
        $role = (int) $user->role;

        // 4) Redirigir según rol
        switch ($role) {
            case 3: // Admin
                return redirect()->route('admin.dashboard');

            case 2: // Nutrióloga
                return redirect()->route('nutri.dashboard');

            case 1: // Cliente
                return redirect()->route('cliente.dashboard');

            default:
                // Si por algo no tiene rol, lo mandamos al dashboard genérico
                return redirect()->route('dashboard');
        }
    }

    /**
     * Cerrar sesión.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
