<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;

final class AddInactivityTimeHeader
{
    private $webDowntime = 3600000;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next)
    {
        $user = auth()->user();
        $response = $next($request);
        if (isset($user)) {
            $inactivity_time = $this->webDowntime - ((\strtotime(Carbon::now()->toString()) - \strtotime($user->last_activity)) * 1000);
            if ('mr@ciph3r.co' == $user->email) {
                $response->headers->set('inactivity-time', 120000);
            } else {
                $response->headers->set('inactivity-time', $inactivity_time);
            }
        }

        return $response;
    }
}
