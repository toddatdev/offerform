<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Stevebauman\Location\Facades\Location;

class SetUserIPBasedPositionDataIntoSession
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
        if (!app()->environment('local')) {
            if ($position = Location::get(request()->getClientIp())) {
                // Successfully retrieved position.
                session()->put('ip_position:timezone', $position->timezone);
                logger()->info('IP Position', $position->toArray());
            } else {
                // Failed retrieving position.
            }
        }
        return $next($request);
    }
}
