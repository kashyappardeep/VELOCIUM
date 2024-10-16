<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/'); // Redirect to login page if not authenticated
        }

        // Check if the user has the required role
        if (Auth::user()->role !== $role) {
            return redirect('/'); // Redirect to a different page if the user doesn't have the required role
        }

        return $next($request); // Proceed with the request if the role matches
    }
}
