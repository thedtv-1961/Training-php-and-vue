<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Administrator
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
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole(config('users.roles.admin')) || $user->hasRole(config('users.roles.group_manager'))) {
                return $next($request);
            } else {
                Auth::logout();

                return redirect()->route('getLogin');
            }
        }
        
        return redirect()->route('getLogin');
    }
}
