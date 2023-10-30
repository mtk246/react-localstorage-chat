<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Container\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RequestWrapedResource extends JsonResource
{
    public function __construct($resource, protected $request = null)
    {
        $this->request ??= Container::getInstance()->make('request');

        parent::__construct($resource);
    }

    public function withRequest($request): self
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Create a new anonymous resource collection.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function collection($resource, $request = null)
    {
        return tap(new AnonymousResourceCollection($resource, static::class), function ($collection) use ($request) {
            $collection->collection->map(function ($collect) use ($request) {
                $collect->withRequest($request);
            });

            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = true === (new static([]))->preserveKeys;
            }
        });
    }

    public function resolve($request = null)
    {
        return parent::resolve($request ?: $this->request);
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
