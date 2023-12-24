<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('api/*') && !$request->user()->is_admin) {

            $result = failedResponse(Response::HTTP_UNAUTHORIZED, ['error' => 'You are not authorized to access this route']);
            return response()->json($result, Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
