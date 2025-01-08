<?php

namespace App\Http\Middleware;

use Closure;

class IsStandard
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
        if(!auth()->user()->is_standard_user()){
            return redirect()->route('dashboard');
        }
        
        return $next($request);
    }
}
