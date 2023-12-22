<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use App\Http\Requests\Claim\GetRulesListRequest;
use App\Http\Resources\Claim\RuleListResource;
use Illuminate\Support\Collection;

final class GetRulesListAction
{
    public function invoke(GetRulesListRequest $request): Collection
    {
        return collect(config('claim.formats'))
            ->when($type = $request->get('type'), fn (Collection $collection) => $collection->only($type))
            ->mapWithKeys(function (array $items, $key) {
                $name = ClaimType::tryFrom($key)->getName();

                return [$name => collect($items)->map(fn ($format, $formatKey) => new RuleListResource($format, $formatKey))];
            });
    }
}
