<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class ProtectRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $request->attributes->set('auth_user', $user);
        } catch (TokenInvalidException $ex) {
            return response()->json(['error_message' => 'Token inválido'], 401);
        } catch (TokenExpiredException $ex) {
            return response()->json(['error_message' => 'Token inválido'], 401);
        } catch (JWTException $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error_message' => 'Erro interno na validação do token'], 500);
        }

        return $next($request);
    }
}
