<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Enums\HealthProfessional\AuthorizationType;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property AuthorizationType $resource */
final class AuthorizationResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->value,
            'name' => $this->resource->getName(),
        ];
    }
}
