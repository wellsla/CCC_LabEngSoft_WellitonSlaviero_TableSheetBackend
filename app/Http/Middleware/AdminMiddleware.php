<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            throw new AuthorizationException('Acesso negado. Apenas administradores podem realizar esta ação.');
        }

        return $next($request);
    }
}
