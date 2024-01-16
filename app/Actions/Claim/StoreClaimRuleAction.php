<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claim\StoreRulesWrapper;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use Illuminate\Support\Facades\DB;

final class StoreClaimRuleAction
{
    public function invoke(StoreRulesWrapper $rulesWrapper): RuleResource
    {
        return DB::transaction(function () use ($rulesWrapper) {
            $rule = Rules::query()->create($rulesWrapper->getRuleData());

            if ($rulesWrapper->hasResponsibilities()) {
                $rulesWrapper->getResponsibilities()->each(function ($responsibility) use ($rule) {
                    $rule->typesOfResponsibilities()->attach($responsibility);
                });
            }

            $rule->companies()->attach($rulesWrapper->getCompanies());
            $rule->insuranceCompanies()->attach($rulesWrapper->getInsuranceCompanies());
            $rule->insurancePlans()->attach($rulesWrapper->getInsurancePlans());

            return new RuleResource($rule);
        });
    }
}
