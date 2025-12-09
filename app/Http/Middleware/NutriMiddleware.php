<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NutriMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo permite rol 2 (nutrióloga)
        if (!Auth::check() || Auth::user()->role !== 2) {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
