<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()?->role || $request->user()->role !== 'Student') {
        return response()->json([
                'message' => 'Student permission only'
            ], 403);
        }
        return $next($request);
    }
}
