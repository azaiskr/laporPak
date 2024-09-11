<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');
        $token = PersonalAccessToken::where('token',  $apiKey)->first();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED)->setStatusCode(401);
        }

        if ($token->expires_at && $token->expires_at < now()) {
            $token->delete();
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED)->setStatusCode(401);
        }

        $token->update(['last_used_at' => now()]);

        return $next($request);
    }
}
