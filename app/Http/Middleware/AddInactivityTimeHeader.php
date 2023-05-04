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
            if (('mr@ciph3r.co' == $user->email) || ('hp@ciph3r.co' == $user->email)) {
                $inactivity_time = 120000 - ((\strtotime(Carbon::now()->toString()) - \strtotime($user->last_activity ?? '')) * 1000);
            } else {
                $inactivity_time = $this->webDowntime - ((\strtotime(Carbon::now()->toString()) - \strtotime((string) $user->last_activity ?? '')) * 1000);
            }
            $response->headers->set('inactivity-time', (string) $inactivity_time);
        }

        return $response;
    }
}
