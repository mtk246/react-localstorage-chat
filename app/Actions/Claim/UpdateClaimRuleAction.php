<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claim\UpdateRulesWrapper;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;

final class UpdateClaimRuleAction
{
    public function invoke(Rules $rules, UpdateRulesWrapper $rulesWrapper): RuleResource
    {
        if ($rulesWrapper->hasChangeStatus()) {
            $rules->update([
                'active' => $rulesWrapper->getActive(),
            ]);

            return new RuleResource($rules->refresh());
        }

        $rules->update($rulesWrapper->getRuleData());

        if ($rulesWrapper->hasResponsibilities()) {
            $rules->typesOfResponsibilities()->sync($rulesWrapper->getResponsibilities()->toArray());
        }

        $rules->companies()->sync($rulesWrapper->getCompanies());
        $rules->insuranceCompanies()->sync($rulesWrapper->getInsuranceCompanies());
        $rules->insurancePlans()->sync($rulesWrapper->getInsurancePlans());

        return new RuleResource($rules->refresh());
    }
}
