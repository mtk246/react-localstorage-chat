<?php

declare(strict_types=1);

namespace App\Roles\Middleware;

use App\Roles\Exceptions\RoleDeniedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * @class VerifyRole
 *
 * @brief Verifica roles de acceso
 *
 * Gestiona la verificación del rol de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
class VerifyRole
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param string $role
     *
     * @return mixed
     *
     * @throws RoleDeniedException
     */
    public function handle($request, \Closure $next, $role)
    {
        if ($this->auth->check() && $this->auth->user()->hasRole($role)) {
            return $next($request);
        }

        throw new RoleDeniedException($role);
    }
}
