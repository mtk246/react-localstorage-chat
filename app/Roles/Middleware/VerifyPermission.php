<?php

declare(strict_types=1);

namespace App\Roles\Middleware;

use App\Roles\Exceptions\PermissionDeniedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * @class VerifyPermission
 *
 * @brief Verifica permisos de acceso
 *
 * Gestiona la verificación del permiso de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
class VerifyPermission
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
     * @param string $permission
     *
     * @return mixed
     *
     * @throws \App\Roles\Exceptions\PermissionDeniedException
     */
    public function handle($request, \Closure $next, $permission)
    {
        if ($this->auth->check() && $this->auth->user()->hasPermission($permission)) {
            return $next($request);
        }

        throw new PermissionDeniedException($permission);
    }
}
