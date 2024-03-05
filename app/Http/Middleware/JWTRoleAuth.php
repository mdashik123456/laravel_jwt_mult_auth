<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTRoleAuth extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     * @param  $request
     * @param Closure $next
     * @param null $role
     * @return mixed
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role=null)
    {
        try{
            $token_role = $this->auth->parseToken()->getClaim("role");
        }catch(JWTException $e){
            return response()->json(['error'=>'Unauthenticated.'], 401);
        }
        
        if($token_role != $role){
            return response()->json(['error'=> 'Unauthenticated'],402);
        }
        return $next($request);
    }
}
