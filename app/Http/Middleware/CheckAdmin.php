<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');
        } else {
            if (Auth::guard($guard)->user()->role == 'admin') {
                return $next($request);
            } else {
                return redirect()->route('admin.login');
            }
        }
    }

}
