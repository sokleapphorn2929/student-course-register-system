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
        $user = $request->user();
        
        // Allow access if user is Teacher OR Admin
        if ($user && ($user->role === 'Teacher' || $user->role === 'Admin')) {
            return $next($request);
        }
        
        return response()->json([
            'message' => 'Teacher permission only'
        ], 403);
    }
}