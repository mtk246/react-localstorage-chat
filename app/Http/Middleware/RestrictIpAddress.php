<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpRestriction;

class RestrictIpAddress
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
        if (isset($request->email)) {
            if (($request->email == 'admin@henry.com') && ($request->ip() != '127.0.0.1')) {
                return response()->json([
                    'error' => 'Access to the application has been restricted. contact support.',
                    'ip_restriction' => true], 403);
            }
        }
        return $next($request);
    }
}
