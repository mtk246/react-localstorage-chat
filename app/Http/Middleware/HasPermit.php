<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;

final class HasPermit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next, string $permission)
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasPermission($permission)) {
            abort(403, __('auth.unauthorized'));
        }

        return $next($request);
    }
}
