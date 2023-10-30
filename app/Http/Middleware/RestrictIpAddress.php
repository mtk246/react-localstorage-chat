<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\IpRestrictionMult;
use App\Models\User;
use Illuminate\Http\Request;

class RestrictIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next)
    {
        if (isset($request->email)) {
            $user = User::whereEmail(strtolower($request->email))->first();
        } else {
            $user = auth()->user();
        }

        if (isset($user)) {
            $validate = null;
            if ($user->hasRole('superuser')) {
                $billingCompany = null;
            } else {
                $billingCompany = $user->billingCompanies->first();
            }

            $restrictions = IpRestrictionMult::where([
                'ip_beginning' => $request->ip(),
                'rank' => false,
            ])->orWhere([
                ['ip_beginning', '<=', $request->ip()],
                ['ip_finish',    '>=', $request->ip()],
                ['rank',         '=',  true],
            ])->get();

            foreach ($restrictions as $restriction) {
                $ipRestriction = $restriction->ipRestriction;
                if ('user' == $ipRestriction->entity) {
                    /** Restriction by user */
                    $validate = $ipRestriction->users->where('id', $user->id)->first();
                    if (isset($validate)) {
                        break;
                    }
                }
                /* Restriction by billing company */
                elseif ('role' == $ipRestriction->entity) {
                    /** Restriction by roles */
                    $roles = $user->roles;
                    foreach ($roles as $role) {
                        $validate = $ipRestriction->roles->where('id', $role->id)->first();
                        if (isset($validate)) {
                            break;
                        }
                    }
                } else {
                    $validate = ($ipRestriction->billing_company_id == ($billingCompany->id ?? null)) ? true : null;
                    if (isset($validate)) {
                        break;
                    }
                }
                if (isset($validate)) {
                    break;
                }
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
