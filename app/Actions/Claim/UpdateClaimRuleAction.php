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
        return new RuleResource($rules->query()->update($rulesWrapper->getRuleData()));
    }
}
