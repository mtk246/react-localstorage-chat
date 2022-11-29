<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;

class CheckAvailableUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = Device::whereIp($request->ip())->where(false)->first();

        if( !is_null($ip) ){
            return response()->json("Your user is inactive, for more information contact the administrator.", 401);
        }

        return $next($request);
    }
}
