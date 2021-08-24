<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                $data = [
                    "code" => 400,
                    "status" => false,
                    "message" => "Token Is Invalid"
                ];
                return response()->json($data, 400);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $data = [
                    "code" => 400,
                    "status" => false,
                    "message" => "Token Is Expired"
                ];
                return response()->json($data, 400);
            } else {
                $data = [
                    "code" => 404,
                    "status" => false,
                    "message" => "Authorization Not Found"
                ];
                return response()->json($data, 404);
            }
        }
        return $next($request);
    }
}
