<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('secret.secret_key');

        if ($request->bearerToken() !== $token){
            throw new HttpResponseException(
                new JsonResponse([
                    'code' => 401,
                    'message' => 'Unauthorized',
                ], 401)
            );
        }

        return $next($request);
    }
}
