<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckSanctumTokenExpiry
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        var_dump("hiii-check token");
        $token = $user->currentAccessToken(); // fetch from author bearer then check in personal token db

        // If no token 
        if (! $token) {
            return response()->json(['message' => 'Invalid Token'], 401);
        }

        // Check DB-based expiry
        if ($token->expires_at && now()->greaterThan($token->expires_at)) {
            $token->delete(); // delete expired token

            return response()->json([
                'message' => 'Token expired'
            ], 401);
        }

        return $next($request);
    }
}
