<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpRestriction;
use App\Models\User;

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
        return $next($request);
        if (isset($request->email)) {
            $validate = null;
            $user = User::where('email', $request->email)->first();
            $restrictions = IpRestriction::where([
                'ip_beginning' => $request->ip(),
                'rank'         => false
            ])->orWhere([
                ['ip_beginning', '<=', $request->ip()],
                ['ip_finish',    '>=', $request->ip()],
                ['rank',         '=',  true]
            ])->get();
            foreach ($restrictions as $restriction) {
                $users = $restriction->users;
                /** Restriction by billing company */
                $validate = $restriction->billingCompanies->where('id', $user->billingCompany->id ?? null)->first();
                if (isset($validate)) break;

                /** Restriction by roles */

                /** Restriction by user */
                $validate = $restriction->users->where('id', $user->id)->first();
                if (isset($validate)) break;
            }
            if ($validate) {
                return response()->json([
                    'error' => 'Access to the application has been restricted. contact support.',
                    'ip_restriction' => true], 403);
            }
        }
        return $next($request);
    }
}
