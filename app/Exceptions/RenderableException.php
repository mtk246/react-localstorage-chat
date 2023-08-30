<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class RenderableException extends \Exception
{
    protected ?string $logMessage = null;

    public function __construct(
        protected readonly ?string $renderMessage = null,
        protected readonly int $status = 400,
        protected readonly ?array $body = null,
        protected readonly ?array $headers = null,
        protected readonly ?int $options = null,
        ?string $message = null,
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct(__($message ?? $this->logMessage ?? '', $this->body ?? []), $code, $previous);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(['error' => [
                'code' => $this->code,
                'message' => __($this->renderMessage ?? $this->message, $this->body ?? []),
            ]],
            $this->status,
            $this->headers ?? [],
            $this->options ?? 0
        );
    }
}
