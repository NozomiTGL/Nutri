<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NutriMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
       
        if (!Auth::check() || Auth::user()->role !== 2) {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
