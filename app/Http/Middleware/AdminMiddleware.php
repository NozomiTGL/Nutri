<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo permite pasar si está logueado y es rol 3 (admin)
        if (!Auth::check() || Auth::user()->role !== 3) {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
