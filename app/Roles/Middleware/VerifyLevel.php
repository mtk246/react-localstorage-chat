<?php

declare(strict_types=1);

namespace App\Roles\Middleware;

use App\Roles\Exceptions\LevelDeniedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * @class VerifyLevel
 *
 * @brief Verifica niveles de acceso
 *
 * Gestiona la verificación del nivel de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
class VerifyLevel
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
     * @param string $level
     *
     * @throws \App\Roles\Exceptions\LevelDeniedException
     */
    public function handle($request, \Closure $next, $level)
    {
        if ($this->auth->check() && $this->auth->user()->level() >= $level) {
            return $next($request);
        }

        throw new LevelDeniedException((string) $level);
    }
}
