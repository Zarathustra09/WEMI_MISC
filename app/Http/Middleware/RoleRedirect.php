<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
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
                    return redirect('/welcome'); // Default home for unknown roles
            }
        }

        // Continue with the request
        return $next($request);
    }
}
