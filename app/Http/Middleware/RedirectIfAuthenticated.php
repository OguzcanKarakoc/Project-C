<?php

namespace App\Http\Middleware;

use App\Http\Controllers\admin\AdminController;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }else{
         return redirect()->action('admin\AdminController@login')->with('flash_message_error','Please login to access');
        }

        return $next($request);
    }
}
