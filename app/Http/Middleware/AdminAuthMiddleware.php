<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if user or admin entered login in page & register page, At home page login register must not allow to enter
        if(!empty(Auth::user())){ //  user & admin login register had passed
            if(url()->current() == route('auth#loginPage')  || url()->current() == route('auth#registerPage') ){
                return back();
            }
            // admin acoount did not call to User account
            if(Auth::user()->role == 'user'){
                // abort(404);
                return back();
            }
            return $next($request);
        }
        return $next($request);
    }
}
