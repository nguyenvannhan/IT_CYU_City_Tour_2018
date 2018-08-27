<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginStation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->role_id == 1) {
                return $next($request);
            } else {
                return redirect()->route('get_team_route');
            }
        }
        return redirect()->route('get_login_route');
    }
}
