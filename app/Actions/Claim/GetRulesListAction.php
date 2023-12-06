<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Support\Collection;

final class GetRulesListAction
{
    public function invoke(): Collection
    {
        $claimType = match (request()->input('type')) {
            'professional' => ClaimType::PROFESSIONAL,
            'institutional' => ClaimType::INSTITUTIONAL,
            default => null,
        };

        if ($claimType) {
            $items = config('claim.formats.'.$claimType->value);
            $name = $claimType->getName();

            return collect($items)->map(function ($item) use ($name) {
                return $this->mapToGroups($item, $name);
            });
        }

        return collect(config('claim.formats'))->mapWithKeys(function ($items, $key) {
            $name = ClaimType::tryFrom($key)->getName();
            $formated = collect($items)->map(function ($item) use ($name) {
                return $this->mapToGroups($item, $name);
            });

            return [$name => $formated];
        });
    }

    private function mapToGroups(array $values, string $name): array
    {
        return array_reduce(array_keys($values), function ($result, $indice) use ($name, $values) {
            $levels = explode('.', (string) $indice);

            return $this->mapGroup($name, $result, $levels, $values[$indice]);
        }, []);
    }

    private function mapGroup(string $name, array $result, array $levels, $value)
    {
        $level = array_shift($levels);

        if (empty($levels)) {
            $result[$level] = $value;

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
