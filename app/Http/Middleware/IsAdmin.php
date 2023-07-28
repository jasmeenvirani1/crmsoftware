<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->user_type == 'Admin') {
            return $next($request);
        } else {
            \Auth::logout();
            session()->flash('error', "You don't have admin access.");
            return redirect()->route('login');
        }
    }

}
