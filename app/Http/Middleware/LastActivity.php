<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LastActivity
{
    /**
     * Handle an incoming request.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next)
    {
        if (isset($request->email)) {
            if (str_contains($request->route()->uri, 'api/v1/auth/login')) {
                $user = User::whereEmail(strtolower($request->email))->first();
                if (isset($user)) {
                    if (false == $user->status) {
                        return response()->json(['error' => __('Your user is inactive, for more information contact the administrator.')], 401);
                    }
                    if (true == $user->isLogged) {
                        $lastActivity = new \DateTime((string) $user->last_activity);
                        $inactivity_time = 120 - (\strtotime(Carbon::now()->toString()) - \strtotime((string) $user->last_activity));
                        if ($inactivity_time <= 0) {
                            $user->isLogged = false;
                            // $user->last_login = Carbon::now();
                            $now = Carbon::now();
                            $user->last_activity = Carbon::now();
                            $user->save();

                            return $next($request);
                        }
                    } else {
                        $now = Carbon::now();
                        $user->last_activity = Carbon::now();
                        $user->save();

                        return $next($request);
                    }
                }
            }
        } else {
            $user = \Auth::user();
            if (isset($user)) {
                $now = Carbon::now();
                if (str_contains($request->userAgent(), 'Mobile')) {
                    if ((null == $user->last_activity) || ($user->last_activity > $now->subMinute(21600))) {
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
                    /* @todo validación mike */
                    if ('mr@ciph3r.co' == $user->email) {
                        if ((null == $user->last_activity) || ($user->last_activity > $now->subMinute(2))) {
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

                    if ((null == $user->last_activity) || ($user->last_activity > $now->subMinute(65))) {
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

                return response()->json(__('Your session has expired due to inactivity'), 401);
            }
        }

        return $next($request);
    }
}
