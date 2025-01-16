<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MedewerkerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'medewerker') {
            return $next($request);
        }

        return redirect()->route('login'); 
    }
}