<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EtudiantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isEtudiant()) {
            abort(403, 'Accès refusé. Vous devez être étudiant.');
        }

        return $next($request);
    }
}
