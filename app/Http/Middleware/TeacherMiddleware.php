<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()?->role || $request->user()->role !== 'Teacher') {
        return response()->json([
                'message' => 'Teacher permission only'
            ], 403);
        }
        return $next($request);
    }
}
