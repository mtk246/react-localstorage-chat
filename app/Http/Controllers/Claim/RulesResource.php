<?php

declare(strict_types=1);

namespace App\Http\Controllers\Claim;

use App\Actions\Claim\GetClaimRuleAction;
use App\Actions\Claim\StoreClaimRuleAction;
use App\Actions\Claim\UpdateClaimRuleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Claim\StoreRulesRequest;
use App\Http\Requests\Claim\UpdateRulesRequest;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RulesResource extends Controller
{
    public function index(Request $request, GetClaimRuleAction $getRule): JsonResponse
    {
        return response()->json($getRule->getAll($request->user()->billing_company_id));
    }

    public function store(StoreRulesRequest $request, StoreClaimRuleAction $storeRule): JsonResponse
    {
        return response()->json($storeRule->invoke($request->getRulesWrapper()));
    }

    public function show(Rules $rules): JsonResponse
    {
        return response()->json(new RuleResource($rules));
    }

    public function update(UpdateRulesRequest $request, Rules $rules, UpdateClaimRuleAction $updateRule): JsonResponse
    {
        return response()->json($updateRule->invoke($rules, $request->getRulesWrapper()));
    }

    public function destroy(Rules $rules): JsonResponse
    {
        return response()->json($rules->delete());
    }
}
