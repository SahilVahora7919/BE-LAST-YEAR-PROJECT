<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class TrackUniqueVisitors
{
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip();

        if (!Cache::has('unique_visitors')) {
            Cache::forever('unique_visitors', [$ipAddress]);
        } else {
            $uniqueVisitors = Cache::get('unique_visitors');
            if (!in_array($ipAddress, $uniqueVisitors)) {
                $uniqueVisitors[] = $ipAddress;
                Cache::forever('unique_visitors', $uniqueVisitors);
            }
        }

        // If the user is logged in, you can track unique visitors per user
        if (auth()->check()) {
            $userId = auth()->id();
            $userKey = "unique_visitors_user_$userId";

            if (!Cache::has($userKey)) {
                Cache::forever($userKey, [$ipAddress]);
            } else {
                $userUniqueVisitors = Cache::get($userKey);
                if (!in_array($ipAddress, $userUniqueVisitors)) {
                    $userUniqueVisitors[] = $ipAddress;
                    Cache::forever($userKey, $userUniqueVisitors);
                }
            }
        }

        return $next($request);
    }
}
