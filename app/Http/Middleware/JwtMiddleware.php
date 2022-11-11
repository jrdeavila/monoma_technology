<?php

namespace App\Http\Middleware;

use App\Exceptions\ExpiredTokenException;
use App\Exceptions\InvalidTokenException;
use App\Exceptions\TokenNotFoundException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                throw new InvalidTokenException();
            } else if ($e instanceof TokenExpiredException) {
                throw new ExpiredTokenException();
            } else {
                throw new TokenNotFoundException();
            }
        }
        return $next($request);
    }
}
