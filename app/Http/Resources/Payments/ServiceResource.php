<?php

declare(strict_types=1);

namespace App\Http\Resources\Payments;

use Illuminate\Http\Resources\Json\JsonResource;

final class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
