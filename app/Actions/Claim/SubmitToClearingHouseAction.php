<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\ClaimBatchStatus;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimTransmissionStatus;
use App\Models\ClaimTransmissionResponse;
use App\Models\Patient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class SubmitToClearingHouseAction
{
    public function invoke(string $token, ClaimBatch $batch)
    {
        return DB::transaction(function () use (&$batch, $token) {
            $claimBatchStatus = ClaimBatchStatus::whereStatus('Submitted')->first();
            $batch->update([
                'claim_batch_status_id' => $claimBatchStatus->id,
                'shipping_date' => now(),
            ]);
            $batch->claims
                ->map(fn (Claim $claim) => $this->claimSubmit($token, $claim->id, $batch->id));
        });
    }

    public function claimSubmit($token, $claimId, $batchId): Collection
    {
        return DB::transaction(function () use ($token, $claimId, $batchId) {
            $pointers = [
                'A' => 1,
                'B' => 2,
                'C' => 3,
                'D' => 4,
                'E' => 5,
                'F' => 6,
                'G' => 7,
                'H' => 8,
                'I' => 9,
                'J' => 10,
                'K' => 11,
                'L' => 12,
            ];
            $qualifierFields = [
                '431' => 'symptomDate',
                '304' => 'lastSeenDate',
                '444' => 'firstContactDate',
                '453' => 'acuteManifestationDate',
                '439' => 'accidentDate',
                '455' => 'lastXRayDate',
                '090' => 'assumedAndRelinquishedCareBeginDate',
                '091' => 'assumedAndRelinquishedCareEndDate',
                '454' => 'initialTreatmentDate',
                '471' => 'hearingAndVisionPrescriptionDate',
            ];
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/submission',
                    'body' => [
                        'controlNumber' => '000000001',
                        'tradingPartnerServiceId' => '9496',
                        'submitter' => [
                            'organizationName' => 'REGIONAL PPO NETWORK',
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '123456789',
                            ],
                        ],
                        'receiver' => [
                            'organizationName' => 'EXTRA HEALTHY INSURANCE',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000001',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'johnone',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00001',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],
                        'dependent' => [
                            'memberId' => '0000000002',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'janeone',
                            'lastName' => 'doeOne',
                            'gender' => 'F',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00002',
                            'relationshipToSubscriberCode' => '01',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],

                        'providers' => [
                            [
                                'providerType' => 'BillingProvider',
                                'npi' => '1760854442',
                                'employerId' => '123456789',
                                'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                                'contactInformation' => [
                                    'name' => 'janetwo doetwo',
                                    'phoneNumber' => '0000000001',
                                ],
                            ],
                            [
                                'providerType' => 'ReferringProvider',
                                'npi' => '1942788757',
                                'firstName' => 'johntwo',
                                'lastName' => 'doetwo',
                                'employerId' => '123456',
                            ],
                            [
                                'providerType' => 'RenderingProvider',
                                'npi' => '1942788757',
                                'firstName' => 'janetwo',
                                'lastName' => 'doetwo',
                                'middleName' => 'middletwo',
                                'ssn' => '000000000',
                            ],
                        ],
                        'claimInformation' => [
                            'claimFilingCode' => 'CI',
                            'patientControlNumber' => '12345',
                            'claimChargeAmount' => '28.75',
                            'placeOfServiceCode' => '11',
                            'claimFrequencyCode' => '1',
                            'signatureIndicator' => 'Y',
                            'planParticipationCode' => 'A',
                            'benefitsAssignmentCertificationIndicator' => 'Y',
                            'releaseInformationCode' => 'Y',
                            'claimSupplementalInformation' => [
                                'repricedClaimNumber' => '00001',
                                'claimNumber' => '12345',
                            ],
                            'healthCareCodeInformation' => [
                                [
                                    'diagnosisTypeCode' => 'BK',
                                    'diagnosisCode' => '496',
                                ],
                                [
                                    'diagnosisTypeCode' => 'BF',
                                    'diagnosisCode' => '25000',
                                ],
                            ],
                            'serviceFacilityLocation' => [
                                'organizationName' => 'HAPPY DOCTORS GROUP',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                            ],
                            'serviceLines' => [
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '25',
                                        'procedureCode' => 'E0570',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1', '2'],
                                        ],
                                    ],
                                ],
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '3.75',
                                        'procedureCode' => 'A7003',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/submission',
                    'body' => null,
                ],
            ];

            $claim = Claim::with([
                'company',
                'diagnoses',
                // "insuranceCompany",
                'insurancePolicies',
                'claimFormattable' => function ($query) {
                    $query->with([
                        'billingCompany' => function ($q) {
                            $q->with('contacts', 'addresses');
                        },
                        'claimFormServices' => function ($q) {
                            $q->with('typeOfService');
                        },
                    ]);
                },
            ])->find($claimId);

            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->find($claim->patient_id);
            $insurancePolicies = [];
            $claimInsurancePolicies = [];

            foreach ($claim->insurancePolicies ?? [] as $insurancePolicy) {
                array_push($claimInsurancePolicies, $insurancePolicy->id);
            }

            foreach ($patient->insurancePolicies()->whereIn('insurance_policies.id', $claimInsurancePolicies)->get() ?? [] as $insurancePolicy) {
                $subscriber =
                    (($insurancePolicy->own ?? false) == true)
                        ? $patient->user
                        : $insurancePolicy?->subscriber;
                $addressSubscriber = $subscriber->addresses->first();
                $addressPatient = $patient->user->addresses->first();
                $addressCompany = $claim->company->addresses->first();
                $contactCompany = $claim->company->contacts->first();

                $dependent = (($insurancePolicy->own ?? false) == true)
                    ? null
                    : [
                        'memberId' => $patient->code ?? null,
                        'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                        'firstName' => $patient->user->profile->first_name ?? null,
                        'lastName' => $patient->user->profile->last_name ?? null,
                        'gender' => strtoupper($patient->user->profile->sex ?? 'M'),
                        'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                        'policyNumber' => $insurancePolicy->policy_number ?? null,
                        'relationshipToSubscriberCode' => $subscriber->relationship->code ?? '21', /* Si no existe, descococido */
                        'address' => [
                            'address1' => $addressPatient->address ?? null,
                            'city' => $addressPatient->city ?? null,
                            'state' => substr($addressPatient->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressPatient->zip),
                        ],
                    ];
                $claimServiceLinePrincipal = $claim->claimFormattable->claimFormServices->first();
                $claimDiagnoses = [];

                foreach ($claim->diagnoses ?? [] as $diagnosis) {
                    if (0 == count($claimDiagnoses)) {
                        array_push($claimDiagnoses, [
                            'diagnosisTypeCode' => 'ABK',
                            'diagnosisCode' => $diagnosis->code,
                        ]);
                    } else {
                        array_push($claimDiagnoses, [
                            'diagnosisTypeCode' => 'ABF',
                            'diagnosisCode' => $diagnosis->code,
                        ]);
                    }
                }

                $facility = $claim->facility;
                $addressFacility = $claim->facility?->addresses->first();

                if (isset($facility) && isset($addressFacility)) {
                    $serviceFacilityLocation = [
                        'organizationName' => $facility->name,
                        'address' => [
                            'address1' => $addressFacility->address ?? null,
                            'city' => $addressFacility->city ?? null,
                            'state' => substr($addressFacility->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressFacility->zip),
                        ],
                    ];
                }

                $serviceLines = [];

                foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                    $valuesPoint = [];
                    foreach ($service->diagnostic_pointers as $point) {
                        array_push($valuesPoint, $pointers[$point]);
                    }
                    array_push($serviceLines, [
                        'serviceDate' => str_replace('-', '', $service->from_service),
                        'serviceDateEnd' => !empty($service->to_service)
                            ? str_replace('-', '', $service->to_service)
                            : null,
                        'professionalService' => [
                            'procedureIdentifier' => 'HC' /* No esta, Loop2400 SV101-01 * */,
                            'lineItemChargeAmount' => str_replace(',', '', $service->price),
                            'procedureCode' => $service->procedure->code,
                            'measurementUnit' => 'UN', /**Si es el mismo dias se expresa en min 'MJ' */
                            'serviceUnitCount' => $service->days_or_units ?? '1',
                            'compositeDiagnosisCodePointers' => [
                                'diagnosisCodePointers' => $valuesPoint ?? [],
                            ],
                        ],
                    ]);
                }
                $provider = $claim->referred;
                $providerProfile = $provider?->user?->profile;
                if ($providerProfile) {
                    $referred = [
                        'providerType' => 'ReferringProvider',
                        'npi' => str_replace('-', '', $provider->npi ?? ''),
                        'firstName' => $providerProfile->first_name,
                        'lastName' => $providerProfile->last_name,
                        'employerId' => str_replace('-', '', $provider->ein ?? $provider->npi),
                    ];
                }

                $claimDateInfo = [];
                foreach ($claim->claimFormattable?->physicianOrSupplierInformation?->claimDateInformations ?? [] as $dateInfo) {
                    $qualifier = $dateInfo?->qualifier?->code ?? '';
                    if (isset($qualifierFields[$qualifier])) {
                        if (1 == $dateInfo->field_id) {
                            $claimDateInfo[$qualifierFields[$qualifier]] = $dateInfo->from_date_or_current;
                        } else if (2 == $dateInfo->field_id) {
                            $claimDateInfo[$qualifierFields[$qualifier]] = $dateInfo->from_date_or_current;
                        } else if (3 == $dateInfo->field_id) {
                            $claimDateInfo['lastWorkedDate'] = $dateInfo->from_date_or_current;
                            $claimDateInfo['authorizedReturnToWorkDate'] = $dateInfo->to_date;
                        } else if (4 == $dateInfo->field_id) {
                            $claimDateInfo['admissionDate'] = $dateInfo->from_date_or_current;
                            $claimDateInfo['dischargeDate'] = $dateInfo->to_date;
                        }
                    }

                }

                $dataReal = [
                    'controlNumber' => $claim->control_number,
                    'tradingPartnerServiceId' => '9496', /* Caso de prueba */
                    'usageIndicator' => 'T',  /* Caso de prueba */
                    'tradingPartnerName' => 'Begento Technologies LLC',
                    'submitter' => [/* Billing Company */
                        'organizationName' => $claim->claimFormattable->billingCompany->name ?? null,
                        'contactInformation' => [
                            'name' => $claim->claimFormattable->billingCompany->contact->contact_name ?? $claim->claimFormattable->billingCompany->name ?? 'Contact Billing',
                            'phoneNumber' => str_replace('-', '', $claim->claimFormattable->billingCompany->contact->phone ?? ''),
                        ],
                    ],
                    'receiver' => [/**Insurance Company */
                        'organizationName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                    ],
                    'subscriber' => [
                        'memberId' => $subscriber->member_id ?? $subscriber->id ?? null,
                        'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                        'firstName' => $subscriber->first_name ?? $subscriber->profile->first_name,
                        'lastName' => $subscriber->last_name ?? $subscriber->profile->last_name,
                        'gender' => strtoupper($subscriber?->sex ?? $subscriber?->profile?->sex ?? 'M'),
                        'dateOfBirth' => str_replace('-', '', $subscriber->profile?->date_of_birth ?? $subscriber->date_of_birth),
                        'policyNumber' => $insurancePolicy->policy_number ?? null,
                        'address' => [
                            'address1' => $addressSubscriber->address ?? null,
                            'city' => $addressSubscriber->city ?? null,
                            'state' => substr($addressSubscriber->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressSubscriber->zip),
                        ],
                    ],
                    'dependent' => $dependent ?? null,
                    'providers' => [/* Company */
                        [
                            'providerType' => 'BillingProvider',
                            'npi' => str_replace('-', '', $claim->company->npi ?? ''),
                            'employerId' => str_replace('-', '', $claim->company->ein ?? $claim->company->npi),
                            'organizationName' => $claim->company->name ?? null,
                            'address' => [
                                'address1' => $addressCompany->address ?? null,
                                'city' => $addressCompany->city ?? null,
                                'state' => substr($addressCompany->state ?? '', 0, 2),
                                'postalCode' => str_replace('-', '', $addressCompany->zip),
                            ],
                            'contactInformation' => [
                                'name' => $contactCompany->contact_name ?? $claim->company->name ?? 'Contact company',
                                'phoneNumber' => str_replace('-', '', $contactCompany->phone ?? ''),
                            ],
                        ],
                    ],
                    'claimInformation' => [
                        'claimFilingCode' => 'CI',
                        'patientControlNumber' => $claim->control_number, /**Preguntar xq no el el codePAtient Loop2300*/
                        'claimChargeAmount' => str_replace(',', '', $claim->billed_amount ?? '0.00'),
                        'placeOfServiceCode' => $claimServiceLinePrincipal->placeOfService->code ?? '11',
                        'claimFrequencyCode' => '1', /* Porque siempre 1 ?? */
                        'signatureIndicator' => isset($claim->claimFormattable->patientOrInsuredInformation)
                            ? ((true == $claim->claimFormattable->patientOrInsuredInformation->insured_signature)
                                ? 'Y'
                                : 'N')
                            : 'N',
                        'planParticipationCode' => 'A',
                        'benefitsAssignmentCertificationIndicator' => 'Y',
                        'releaseInformationCode' => 'Y',
                        'claimSupplementalInformation' => [
                            'repricedClaimNumber' => '00001', /* Type 45 Donde lo guardo?. Los códigos del catálogo son diferentes */
                            'claimNumber' => '12345', /* ?? */
                        ],
                        'healthCareCodeInformation' => $claimDiagnoses ?? null,
                        'serviceFacilityLocation' => $serviceFacilityLocation ?? null,
                        'serviceLines' => $serviceLines,
                    ],
                ];
                if (isset($referred)) {
                    array_push($dataReal['providers'], $referred);
                }
                $dataReal['claimInformation']['claimDateInformation'] = !empty($claimDateInfo)
                    ? $claimDateInfo
                    : null;

                $response = Http::withToken($token)->acceptJson()->post(
                    $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                    $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                );
                $responseData['response'] = json_decode($response->body());
                $responseData['request'] = $dataReal;

                if ($response->successful()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Success')->first();
                    $statusSubmitted = ClaimStatus::whereStatus('Submitted')->first();

                    $this->changeStatus([
                        'status_id' => $statusSubmitted->id,
                        'private_note' => 'Submitted to ClearingHouse',
                    ], $claim->id);
                } elseif ($response->serverError()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();

                    $this->AddNoteCurrentStatus([
                        'private_note' => 'Error in transmission',
                    ], $claim->id);
                } elseif ($response->failed()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();
                    $statusDenied = ClaimStatus::whereStatus('Rejected')->first();

                    $this->changeStatus([
                        'status_id' => $statusDenied->id,
                        'private_note' => 'Submitted to ClearingHouse',
                    ], $claim->id);
                }

                $claimTransmissionResponse = ClaimTransmissionResponse::updateOrCreate([
                    'claim_id' => $claim->id,
                    'claim_batch_id' => $batchId,
                    'claim_transmission_status_id' => $claimTransmissionStatus->id,
                    'response_details' => isset($responseData) ? json_encode($responseData) : null,
                ]);
            }

            return $claim;
        });
    }
}
