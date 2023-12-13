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
                        ?->insurancePlan
                        ?->insuranceCompany->name;
                })
                ->map(function ($claims, $insuranceCompany) {
                    return [
                        'insuranceCompany' => $insuranceCompany,
                        'claims' => $claims->map(function ($claim) {
                            $patientProfile = $claim->demographicInformation->patient->profile;
                            $healthcareProfile = match ($claim->type) {
                                ClaimType::INSTITUTIONAL => $claim->attending()?->profile,
                                ClaimType::PROFESSIONAL => $claim->billingProvider()?->profile,
                            };
                            $insurancePlan = $claim->insurancePolicies()
                                ->wherePivot('order', 1)
                                ->first()
                                ?->insurancePlan;
                            $abbreviationInsurance = $insurancePlan->abbreviations()
                                ->where('billing_company_id', $claim->billing_company_id)
                                ->first()
                                ?->abbreviation ?? '';
                            $abbreviationFacility = $claim->demographicInformation->facility->abbreviations()
                                ->where('billing_company_id', $claim->billing_company_id)
                                ->first()
                                ?->abbreviation ?? '';

                            return [
                                'code' => $claim->code,
                                'patientNumber' => $claim->demographicInformation->patient?->companies()
                                    ?->wherePivot('billing_company_id', $claim->billing_company_id)
                                    ?->wherePivot('company_id', $claim->demographicInformation->company_id)
                                    ->first()
                                    ?->pivot?->med_num ?? '',
                                'patientName' => $patientProfile->last_name
                                    .(!empty($patientProfile->nameSuffix?->code ?? '')
                                        ? (' '.$patientProfile->nameSuffix->code)
                                        : '')
                                    .(', '.$patientProfile->first_name.' '.$patientProfile->middle_name),
                                'healthProfessional' => $healthcareProfile->last_name
                                    .(!empty($healthcareProfile->nameSuffix?->code ?? '')
                                        ? (' '.$healthcareProfile->nameSuffix->code)
                                        : '')
                                    .(', '.$healthcareProfile->first_name.' '.$healthcareProfile->middle_name),
                                'insurancePlan' => !empty($abbreviationInsurance)
                                    ? $abbreviationInsurance.' - '.$insurancePlan->name
                                    : $insurancePlan->name,
                                'facility' => !empty($abbreviationFacility)
                                    ? $abbreviationFacility.' - '.$claim->demographicInformation->facility->name
                                    : $claim->demographicInformation->facility->name,
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
