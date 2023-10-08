<?php

declare(strict_types=1);

namespace App\Http\Controllers\Claim;

use App\Actions\Claim\GetClaimRuleAction;
use App\Actions\Claim\StoreClaimRuleAction;
use App\Actions\Claim\UpdateClaimRuleAction;
use App\Enums\Claim\ClaimType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Claim\StoreRulesRequest;
use App\Http\Requests\Claim\UpdateRulesRequest;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RulesResource extends Controller
{
    public function getList(): JsonResponse
    {
        return response()->json(collect(config('claim.formats'))->mapWithKeys(function ($item, $key) {
            return [ClaimType::tryFrom($key)->getName() => $item];
        }));
    }

    public function index(Request $request, GetClaimRuleAction $getRule): JsonResponse
    {
        return response()->json($getRule->getAll($request->user()->billing_company_id));
    }

    public function store(StoreRulesRequest $request, StoreClaimRuleAction $storeRule): JsonResponse
    {
        return response()->json($storeRule->invoke($request->casted()));
    }

    public function show(Rules $rule): JsonResponse
    {
        return response()->json(new RuleResource($rule));
    }

    public function update(UpdateRulesRequest $request, Rules $rule, UpdateClaimRuleAction $updateRule): JsonResponse
    {
        return response()->json($updateRule->invoke($rule, $request->casted()));
    }

    public function destroy(Rules $rule): JsonResponse
    {
        return response()->json($rule->delete());
    }
}
