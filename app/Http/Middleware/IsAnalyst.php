<?php

namespace App\Http\Middleware;

use Closure;

class IsAnalyst
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
        if(!auth()->user()->is_analyst()){
            return redirect()->route('dashboard');
        }
        
        return $next($request);
    }
}
