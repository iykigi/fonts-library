<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Visitor;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {

            $ip = $request->ip();

            // key تایبەت بۆ IP
            $cacheKey = 'visitor_' . $ip;

            // ئەگەر هێشتا تۆمار نەکراوە
            if (!Cache::has($cacheKey)) {

                Visitor::create([
                    'ip_address' => $ip,
                    'user_agent' => $request->userAgent(),
                    'url' => $request->path(),
                ]);

                // 24 کاتژمێر قفل بکرێت
                Cache::put($cacheKey, true, now()->addDay());
            }
        }

        return $next($request);
    }
}
