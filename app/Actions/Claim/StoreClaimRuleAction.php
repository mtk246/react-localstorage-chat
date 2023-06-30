<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claim\RulesWrapper;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claim\Rules;
use Illuminate\Support\Facades\DB;

final class StoreClaimRuleAction
{
    public function invoke(RulesWrapper $rulesWrapper): RuleResource
    {
        return DB::transaction(function () use ($rulesWrapper) {
            $rules = tap(Rules::query()->create($rulesWrapper->getRuleData()), function (Rules $rules) use ($rulesWrapper) {
                if ($rulesWrapper->getCompanies()->isNotEmpty()) {
                    $rules->companies()->sync($rulesWrapper->getCompanies());
                }
            });

            return new RuleResource($rules);
        });
    }
}
