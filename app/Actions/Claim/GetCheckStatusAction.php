<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\Claim;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class GetCheckStatusAction
{
    public function invoke(string $token, Claim $claim): Claim
    {
        return DB::transaction(function () use ($token, $claim) {
            $claim = Claim::with(['patient', 'company', 'claimFormattable', 'claimFormattable.claimFormServices.typeOfService'])->find($id);
            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'profile',
            ])->find($claim->patient_id);

            $insurancePolicy = $claim->insurancePolicies->first();
            $encounter = [];
            $serviceCodes = [];

            foreach ($claim->service->services ?? [] as $service) {
                $encounter['beginningDateOfService'] = str_replace('-', '', $service->from_service);
                $encounter['endDateOfService'] = str_replace('-', '', $service->to_service);
                array_push($serviceCodes, $service->typeOfService->code);
            }
            $encounter['serviceTypeCodes'] = $serviceCodes;

            $dataReal = [
                'controlNumber' => $claim->control_number ?? '',
                'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                'provider' => [
                    'organizationName' => $claim->company->name ?? null,
                    'npi' => $claim->company->npi ?? null,
                    'serviceProviderNumber' => $claim->company->sevices_number ?? null,
                    'providerCode' => 'AD', // $claim->company->code ?? null,
                    'referenceIdentification' => $claim->company->reference_identification ?? null,
                ],
                'subscriber' => [
                    'memberId' => $insurancePolicy->subscriber->member_id ?? null,
                    'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                    'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                    'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                    'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->user->profile->date_of_birth),
                    'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                    'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                ],
                'dependents' => [
                    [
                        'firstName' => $patient->user->profile->first_name,
                        'lastName' => $patient->user->profile->last_name,
                        'gender' => strtoupper($patient->user->profile->sex),
                        'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                        'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                    ],
                ],
                'encounter' => $encounter,
            ];

            $response = Http::withToken($token)->acceptJson()->post(
                $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
            );
            $responseData = json_decode($response->body());

            return [
                'claim_id' => $claim->id,
                'response' => $responseData,
            ];
        });
    }
}
$response = Http::acceptJson()
    ->post(
        config('claim.connections.url_token'),
        [
            'client_id' => config('claim.connections.client_id'),
            'client_secret' => config('claim.connections.client_secret'),
            'grant_type' => 'client_credentials',
        ]
    );
$responseData = json_decode($response->body(), true);
