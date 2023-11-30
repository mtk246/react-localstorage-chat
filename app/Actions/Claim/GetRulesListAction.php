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
                return $this->getRuleListFormated($item, $name);
            });
        } else {
            return collect(config('claim.formats'))->mapWithKeys(function ($items, $key) {
                $name = ClaimType::tryFrom($key)->getName();
                $formated = collect($items)->map(function ($item) use ($name) {
                    return $this->getRuleListFormated($item, $name);
                });

                return [$name => $formated];
            });
        }
    }

    private function getRuleListFormated(array $array, string $name): array
    {
        return array_reduce(array_keys($array), function ($result, $index) use ($array, $name) {
            $levels = explode('.', (string) $index);

            $group = &$result;
            $lastLevel = end($levels);

            foreach ($levels as $level) {
                if (!isset($group[$level])) {
                    $group[$level] = ($level !== $lastLevel) ? [
                        'type' => 'group',
                        'description' => __("claim.rules.{$name}.group.{$level}"),
                        'values' => [],
                    ] : $array[$index];
                    continue;
                }

                if ($level === $lastLevel) {
                    $group = &$group[$level];
                    continue;
                }

                $group = &$group[$level]['values'];
            }

            return $result;
        }, []);
    }
}
