<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Ledger\GetClaimsPatientAction;
use App\Actions\Ledger\SearchAction;
use App\Http\Requests\Ledger\SearchRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;

final class LedgerController extends Controller
{
    public function search(SearchAction $action, SearchRequest $request): JsonResponse
    {
        return response()->json($action->search($request->validated()));
    }

    public function getClaims(GetClaimsPatientAction $action, Patient $patient): JsonResponse
    {
        return response()->json($action->getClaims($patient));
    }
}
