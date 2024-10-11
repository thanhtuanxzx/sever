<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckQuyen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredQuyen
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredQuyen)
    {
        if (Auth::check() && Auth::user()->quyen == $requiredQuyen) {
            return $next($request);
        }

        return redirect('/index'); 
    }
}
