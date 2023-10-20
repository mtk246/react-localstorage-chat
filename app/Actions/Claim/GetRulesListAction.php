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
        return collect(config('claim.formats'))->mapWithKeys(function ($item, $key) {
            $name = ClaimType::tryFrom($key)->getName();
            $formated = collect($item)->map(function ($item) use ($name) {
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

            return [$name => $formated];
        });
    }
}
