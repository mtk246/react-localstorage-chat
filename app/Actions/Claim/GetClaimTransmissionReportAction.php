<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimBatch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class GetClaimTransmissionReportAction
{
    public function invoke(ClaimBatch $batch)
    {
        return DB::transaction(function () use ($batch) {
            return $batch->claims
                ->groupBy(function ($claim) {
                    return $claim->insurancePolicies()
                        ->wherePivot('order', 1)
                        ->first()
                        ?->insurancePlan->name;
                })
                ->map(function ($claims, $insurancePlan) {
                    return [
                        'insurancePlan' => $insurancePlan,
                        'claims' => $claims->map(function ($claim) {
                            return [
                                'code' => $claim->code,
                                'patientNumber' => $claim->demographicInformation->patient?->companies()
                                    ?->wherePivot('billing_company_id', $claim->billing_company_id)
                                    ?->wherePivot('company_id', $claim->demographicInformation->company_id)
                                    ->first()
                                    ?->pivot?->med_num ?? '',
                                'patientName' => $claim->demographicInformation->patient->profile->fullName(),
                                'healthProfessional' => match ($claim->type) {
                                    ClaimType::INSTITUTIONAL => $claim->attending()?->profile?->fullName() ?? '',
                                    ClaimType::PROFESSIONAL => $claim->billingProvider()?->profile?->fullName() ?? '',
                                },
                                'facility' => $claim->demographicInformation->facility->name,
                                'date_of_service' => empty($claim->date_of_service)
                                    ? '-'
                                    : Carbon::createFromFormat('Y-m-d', $claim->date_of_service)->format('m/d/Y'),
                                'amount' => $claim->billed_amount,
                            ];
                        }),
                    ];
                });
        });
    }
}
