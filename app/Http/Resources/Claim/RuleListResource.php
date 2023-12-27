<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

/** @property array<key, string> $resource */
final class RuleListResource extends JsonResource
{
    public function __construct($resource, protected readonly string $key, protected readonly array $custom = [])
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

            $data = $this->resource[$indice];

            if (array_key_exists($indice, $this->custom)) {
                $data['value'] = $this->custom[$indice];
            }

            return $this->mapGroup($this->key, $result, $levels, $data);
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
                'description' => __("claim.rules.{$groupName}.title"),
                'values' => [],
            ];
        }

        $result[$level]['values'] = $this->mapGroup($groupName, $result[$level]['values'], $levels, $value);

        return $result;
    }
}
