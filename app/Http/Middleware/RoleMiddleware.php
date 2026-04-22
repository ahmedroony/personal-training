<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $user_types): Response
    {
        if (Auth::check() && Auth::user()->userType) {
            $role = Auth::user()->userType->name;

            if ($role === 'Admin') {
                return $next($request);
            }

            if ($role === $user_types) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
