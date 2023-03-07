<?php

namespace App\Http\Middleware;

use App\Http\Helper\ApiResponse;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) throw new Exception('User Not Found');
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return ApiResponse::error(401, $e->getMessage());
            } elseif ($e instanceof TokenExpiredException) {
                return ApiResponse::error(401, $e->getMessage());
            } else {
                if ($e->getMessage() === 'User Not Found') {
                    return ApiResponse::error(404, $e->getMessage());
                }
                return ApiResponse::error(401, $e->getMessage());
            }
        }
        return $next($request);
    }

}
