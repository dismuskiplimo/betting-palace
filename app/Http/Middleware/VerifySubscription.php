<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;

class VerifySubscription
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
        if(auth()->user()->subscription_active() && auth()->user()->subscription_expires_at->lt(Carbon::now())){
            auth()->user()->subscription_expires_at = null;
            auth()->user()->update();
        }

        return $next($request);
    }
}
