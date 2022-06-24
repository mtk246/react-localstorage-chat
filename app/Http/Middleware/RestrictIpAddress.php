<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpRestriction;
use App\Models\IpRestrictionMult;
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
        if (isset($request->email)) {
            $validate = null;
            $user = User::where('email', $request->email)->first();
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = null;
            } else {
                $billingCompany = $user->billingCompanies->first();
            }

            $restrictions = IpRestrictionMult::where([
                'ip_beginning' => $request->ip(),
                'rank'         => false
            ])->orWhere([
                ['ip_beginning', '<=', $request->ip()],
                ['ip_finish',    '>=', $request->ip()],
                ['rank',         '=',  true]
            ])->get();

            foreach ($restrictions as $restriction) {
                $ipRestriction = $restriction->ipRestriction;
                if ($ipRestriction->entity == 'user') {
                    /** Restriction by user */
                    $validate = $ipRestriction->users->where('id', $user->id)->first();
                    if (isset($validate)) break;

                }
                /** Restriction by billing company */
                else if ($ipRestriction->entity == 'role') {
                    /** Restriction by roles */
                    $roles = $user->roles;
                    foreach ($roles as $role) {
                        $validate = $ipRestriction->roles->where('id', $role->id)->first();
                        if (isset($validate)) break;
                    }
                }
                else {
                    $validate = ($ipRestriction->billing_company_id == ($billingCompany->id ?? null)) ? true : null;
                    if (isset($validate)) break;
                }
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
