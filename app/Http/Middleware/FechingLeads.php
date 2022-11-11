<?php

namespace App\Http\Middleware;

use App\Exceptions\AgentUnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class FechingLeads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $user = JWTAuth::toUser($token);
        if ($user->role == 'manager') {
            return $next($request);
        }
        throw new AgentUnauthorizedException();
    }
}
