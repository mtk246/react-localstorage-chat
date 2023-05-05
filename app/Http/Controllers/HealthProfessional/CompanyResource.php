<?php

namespace App\Http\Controllers\HealthProfessional;

use App\Actions\HealthProfessional\GetCompanyAction;
use App\Actions\HealthProfessional\StoreCompanyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\HealthProfessional\StoreCompanyRequest;
use App\Models\HealthProfessional;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CompanyResource extends Controller
{
    public function index(HealthProfessional $doctor, Request $request, GetCompanyAction $getCompany): JsonResponse
    {
        return response()->json($getCompany->all($request->user(), $doctor));
    }

    public function store(StoreCompanyRequest $request, StoreCompanyAction $storeCompany, HealthProfessional $doctor): JsonResponse
    {
        return response()->json(
            $storeCompany->invoke($request->castedCollect('companies'), $doctor)
        );
    }
}
