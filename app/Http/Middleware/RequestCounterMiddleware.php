<?php

namespace App\Http\Middleware;

use Closure;

class RequestCounterMiddleware
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
        $numberOfRequests = session('number_of_requests', 0);
        session(['number_of_requests' => $numberOfRequests + 1]);

        return $next($request);
    }
}
