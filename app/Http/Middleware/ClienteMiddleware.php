<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        
        if (!$user || $user->role !== 1) {
            abort(403, 'Acceso solo para clientes.');
        }

        return $next($request);
    }
}
