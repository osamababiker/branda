<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isAdmin
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
      if(Auth::check()){
        if(Auth::user() and Auth::user()->role == 1 or Auth::user()->role == 2){
            return $next($request);
        }
      }
      return redirect('/');
    }
}
