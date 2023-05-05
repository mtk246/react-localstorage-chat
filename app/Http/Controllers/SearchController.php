<?php

namespace App\Http\Controllers;

use App\Models\BillingCompany;
use App\Models\Claim;
use App\Models\Company;
use App\Models\Facility;
use App\Models\HealthProfessional;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $search = $request->input('query', '');

        $results = collect()
            ->merge(BillingCompany::search($search)->get())
            ->merge(Claim::search($search)->get())
            ->merge(Company::search($search)->get())
            ->merge(Facility::search($search)->get())
            ->merge(HealthProfessional::search($search)->get())
            ->groupBy(fn ($result) => class_basename($result));

        return response()->json($results);
    }
}
