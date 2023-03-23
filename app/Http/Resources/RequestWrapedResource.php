<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Container\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RequestWrapedResource extends JsonResource
{
    public function __construct(object $resource, protected ?object $request = null)
    {
        $this->request ??= Container::getInstance()->make('request');

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an HTTP response.
     *
     * @param \Illuminate\Http\Request|null $request
     */
    public function response($request = null): JsonResponse
    {
        return $this->toResponse($request ?: $this->request);
    }

    /**
     * Prepare the resource for JSON serialization.
     *
     * @return array<key, string>
     */
    public function jsonSerialize(): array
    {
        return $this->resolve($this->request);
    }
}
