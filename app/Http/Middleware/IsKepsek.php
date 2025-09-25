<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsKepsek
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role?->name === 'kepsek') {
            return $next($request);
        }

        abort(403);
    }
}