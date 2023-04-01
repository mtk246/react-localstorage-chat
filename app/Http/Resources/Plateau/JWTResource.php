<?php

declare(strict_types=1);

namespace App\Http\Resources\Plateau;

use App\Http\Resources\RequestWrapedResource;
use Lcobucci\JWT\Token\Plain;

/** @property Plain $resource */
final class JWTResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        /** @var \DateTimeImmutable|null */
        $issuedAt = $this->resource->claims()->get('iat');
        /** @var \DateTimeImmutable|null */
        $expiresAt = $this->resource->claims()->get('exp');

        return [
            'jwt' => $this->resource->toString(),
            'issued_at' => $issuedAt?->getTimestamp(),
            'expires_at' => $expiresAt?->getTimestamp(),
        ];
    }
}
