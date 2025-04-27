<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ You forgot this!
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!Auth::check()) {
            // If not logged in
            return redirect('/student/login'); // or abort(401);
        }

        if ($role && Auth::user()->role !== $role) {
            // If user role doesn't match
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
