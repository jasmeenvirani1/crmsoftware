<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // app/Http/Middleware/RoleMiddleware.php

    public function handle($request, Closure $next, ...$roles)
    {
        // Get the authenticated user
return        $user = Auth::user();
        // // Check if the user has any of the required roles
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {

                return redirect()->route('logout');
            }
        }

        // // If the user does not have any of the required roles, redirect or show an error
        return redirect()->route('logout');
    }
}
