<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    { 

        var_dump($request->user());
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated!!'], 401);
        }
    
        return $next($request);
    }
}
