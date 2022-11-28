<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class LastActivity
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
            $user = User::whereEmail($request->email)->first();
            if (isset($user)) {
                $now = Carbon::now();
                $user->last_activity = Carbon::now();
                $user->save();
                return $next($request);
            }
        } else {
            $user = auth()->user();
            if (isset($user)) {
                $now = Carbon::now();
                if (str_contains($request->userAgent(), 'Mobile')) {
                    if (($user->last_activity == null) || ($user->last_activity > $now->subMinute(21600))) {
                        if (!str_contains($request->route()->uri, 'api/v1/auth/me')) {
                            $user->last_activity = Carbon::now();
                            $user->save();
                        }
                        return $next($request);
                    } else {
                        $user->isLogged = false;
                        auth()->logout();
                        $user->save();
                    }
                } else {
                    if ($user->email == 'mr@ciph3r.co') {
                        $lastActivity = new \DateTime($user->last_activity);
                        $inactivity_time = 120 - (\strtotime(Carbon::now()) - \strtotime($user->last_activity));
                        if ($inactivity_time <= 0 ) {
                            auth()->logout();
                            return response()->json(__("Your session has expired due to inactivity"), 401);
                        }
                    }
                    if (($user->last_activity == null) || ($user->last_activity > $now->subMinute(65))) {
                        if (!str_contains($request->route()->uri, 'api/v1/auth/me')) {
                            $user->last_activity = Carbon::now();
                            $user->save();
                        }
                        return $next($request);
                    } else {
                        $user->isLogged = false;
                        auth()->logout();
                        $user->save();
                    }
                }
                return response()->json(__("Your session has expired due to inactivity"), 401);
            }
        }
        return $next($request);

    }
}
