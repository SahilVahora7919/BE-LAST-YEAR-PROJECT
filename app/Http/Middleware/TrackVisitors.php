<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TrackVisitors
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('visitors')) {
            Session::put('visitors', 1);
        } else {
            $visitors = Session::get('visitors');
            if (is_int($visitors)) {
                Session::put('visitors', $visitors + 1);
            } else {
                // Handle the case where the value in the session is not an integer
                // For example, set it to 1
                Session::put('visitors', 1);
            }
        }

        return $next($request);
    }
}
