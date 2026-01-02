<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    { 
        //auth user ahh?
        var_dump("sanctum");
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated.iii'], 401);
        }
        

        return $next($request);
    }
}
