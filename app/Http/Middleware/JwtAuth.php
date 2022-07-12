<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JwtAuth
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
		$token = $request->header("Token");
		if(is_null($token)) {
			return response("Error", 403);
		}
		try {
			$decoded = JWT::decode($token, new Key(env("JWT_KEY"), "HS256"));
			$request->decoded = $decoded;
			return $next($request);
		} catch(Exception $e) {
			return response("Error", 403);
		}
    }
}
