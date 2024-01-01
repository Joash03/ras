<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user ID is 1
        if (Auth::check() && Auth::user()->id == 1) {
            return $next($request);
        }

        // If the condition fails, you might want to redirect or handle it accordingly
        abort(403, 'Unauthorized action.');
    }
}
