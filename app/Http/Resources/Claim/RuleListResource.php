<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

/** @property array<key, string> $resource */
final class RuleListResource extends JsonResource
{
    public function __construct($resource, protected string $key)
    {
        parent::__construct((array) $resource);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_reduce(array_keys($this->resource), function ($result, $indice) {
            $levels = explode('.', (string) $indice);

            return $this->mapGroup($this->key, $result, $levels, $this->resource[$indice]);
        }, []);
    }

    private function mapGroup(string $name, array $result, array $levels, $value)
    {
        $level = array_shift($levels);

        if (empty($levels)) {
            $result[$level] = [
                ...$value,
                'code' => $level,
            ];

            return $result;
        }

        $groupName = "{$name}.group.{$level}";

        if (!isset($result[$level])) {
            $result[$level] = [
                'type' => 'group',
                'code' => $level,
                'description' => __("claim.rules.{$groupName}"),
                'values' => [],
            ];
        }

        $result[$level]['values'] = $this->mapGroup($groupName, $result[$level]['values'], $levels, $value);

        return $result;
    }
}
