<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 2:
                    return redirect('/pos');
                case 1:
                    return redirect('/dashboard');
                case 0:
                    return redirect('/dashboard/guest');
                default:
                    return view('/welcome'); // Default home for unknown roles
            }
        }

        // Continue with the request
        $response = $next($request);

        // Add cache control headers
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
