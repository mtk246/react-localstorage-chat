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
        $rules->update($rulesWrapper->getRuleData());

        if ($rulesWrapper->hasResponsibilities()) {
            $rulesWrapper->getResponsibilities()->each(function ($responsibility) use ($rules) {
                $rules->typesOfResponsibilities()->attach($responsibility);
            });
        }

        $rules->insurancePlans()->sync($$rulesWrapper->getInsurancePlans());

        return new RuleResource($rules->refresh());
    }
}
