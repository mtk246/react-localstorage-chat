<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

final class AddInactivityTimeHeader
{
    protected $webDowntime = 3600000;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $response = $next($request);
        if (isset($user)) {
            $inactivity_time = $this->webDowntime - ((\strtotime(Carbon::now()->toString()) - \strtotime($user->last_activity)) * 1000);
            if ($user->email == 'mr@ciph3r.co') {
                $response->headers->set('inactivity-time', 120000);
            } else {
                $response->headers->set('inactivity-time', $inactivity_time);
            }
        }
        return $response;
    }
}
