<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

            return $this->getRuleListFormated($items, $name);
        } else {
            return collect(config('claim.formats'))->mapWithKeys(function ($item, $key) {
                $name = ClaimType::tryFrom($key)->getName();
                $formated = $this->getRuleListFormated($item, $name);

                return [$name => $formated];
            });
        }
    }

    private function getRuleListFormated(array $item, string $name): Collection
    {
        return collect($item)->map(function ($item) use ($name) {
            return collect($item)
                ->mapToGroups(function ($item, $key) {
                    $group = Str::onlyNumbers($key);
                    $item['code'] = $key;

                    return [$group => $item];
                })
                ->map(function ($item, $key) use ($name) {
                    return count($item) > 1
                        ? [
                            'code' => $key,
                            'type' => 'group',
                            'description' => __("claim.rules.{$name}.group.{$key}"),
                            'values' => $item->values(),
                        ]
                        : $item->first();
                })->values();
        });
    }
}
