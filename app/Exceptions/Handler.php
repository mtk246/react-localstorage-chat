<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Psr\Log\LogLevel;

class Handler extends ExceptionHandler
{
    /** @var array<int, class-string<\Throwable>> */
    protected $dontReport = [
    ];

    /** @var array<int, string> */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /** @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*> */
    protected $levels = [
        RenderableException::class => LogLevel::NOTICE,
    ];

    public function register(): void
    {
        $this->reportable(function (\Throwable $e) {
        });

        $this->renderable(function (RenderableException $e, Request $request) {
            return $e->render($request);
        });
    }
}
