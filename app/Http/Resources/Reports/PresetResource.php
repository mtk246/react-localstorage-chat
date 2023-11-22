<?php

declare(strict_types=1);

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @todo: Refactor when upgrading to laravel 10
 */
final class PresetResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Operation successfully.',
            'data' => $this->resource,
        ];
    }
}
