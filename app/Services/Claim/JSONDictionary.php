<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use App\Models\HealthProfessional;
use App\Services\ClearingHouse\ClearingHouseAPI;
use Carbon\Carbon;
use Illuminate\Support\Str;

final class JSONDictionary extends Dictionary
{
    protected string $format = FormatType::JSON->value;

    protected function getByApi(string $key): string
    {
        $api = new ClearingHouseAPI();

        return $api->getDataByPayerID(
            $this->claim->higherInsurancePlan()?->payer_id,
            $this->claim->higherInsurancePlan()?->name,
            $this->claim->type->value,
            $this->batch?->fake_transmission ?? false,
            $key
        );
    }

    protected function getSingleArrayFormat(object $value): array
    {
        return array_filter_recursive($this->getSingleFormat($value->id)->toArray());
    }

    protected function getMultipleFormat(array $values, string $glue, string $key): array
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return $this->{'get'.Str::ucfirst(Str::camel($accesorKey))}($property);
    }

    protected function getClaimAttribute(string $key): bool|string|array|null
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'controlNumber' => str_pad((string) $this->claim->id, 9, '0', STR_PAD_LEFT),
            'tradingPartnerServiceId' => $this->getByApi('cpid'),
            'tradingPartnerName' => $this->getByApi('name'),
            'usageIndicator' => ('production' == config('app.env')) ? '' : 'T',
            'submitter' => $this->getSubmitter($property),
            'receiver' => $this->getReceiver($property),
            'subscriber' => $this->getSubscriber($property),
            'dependent' => $this->getDependent($property),
            'payToAddress' => $this->getPayToAddress($property),
            'payToPlan' => $this->getPayToPlan($property),
            'payerAddress' => $this->getPayerAddress($property),
            'billing' => $this->getBilling($property),
            'referring' => $this->getReferring($property),
            'rendering' => $this->getRendering($property),
            'ordering' => $this->getOrdering($property),
            'supervising' => $this->getSupervising($property),
            'attending' => $this->getAttending($property),
            'claimInformation' => $this->getClaimInformation($property),
            default => $this->{'get'.Str::ucfirst(Str::camel($key))}($property),
        };
    }

    protected function getSubmitter($key): string|bool
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'organizationName' => $this->claim->billingCompany->name,
            'taxId' => $this->claim->billingCompany?->tax_id ?? '',
            'lastName' => '',
            'firstName' => '',
            'middleName' => '',
            'contactInformation' => $this->getSubmitterContactInformation($property),
        };
    }

    protected function getSubmitterContactInformation($key): string|bool
    {
        return match ($key) {
            'name' => $this->claim->billingCompany->contact?->contact_name ?? $this->claim->billingCompany->name ?? 'Contact Billing',
            'phoneNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->phone ?? ''),
            'faxNumber' => str_replace('-', '', $this->claim->billingCompany->contact?->fax ?? ''),
            'email' => $this->claim->billingCompany->contact?->email ?? '',
            'validContact' => true,
            default => '',
        };
    }

    protected function getReceiver($key): string
    {
        return match ($key) {
            'organizationName' => $this->claim->higherInsurancePlan()?->insuranceCompany?->name ?? null,
            default => '',
        };
    }

    protected function getSubscriber($key): string
    {
        $subscriber = $this->claim->subscriber();

        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'memberId' => $this->claim->higherOrderPolicy()?->policy_number,
            'standardHealthId' => '', /* Identificador sanitario, se envia si no se envia el memberId */
            'ssn' => str_replace('-', '', $subscriber->ssn ?? ''),
            'paymentResponsibilityLevelCode' => $this->claim->higherOrderPolicy()?->typeResponsibility?->code ?? 'U',
            'organizationName' => '',
            'insuranceTypeCode' => '',
            'subscriberGroupName' => '',
            'firstName' => $subscriber->first_name,
            'lastName' => $subscriber->last_name,
            'middleName' => $subscriber->middle_name ?? '',
            'suffix' => $subscriber->nameSuffix?->code ?? '',
            'gender' => strtoupper($subscriber->sex ?? 'U'),
            'dateOfBirth' => str_replace('-', '', $subscriber->date_of_birth),
            'policyNumber' => $this->claim->higherOrderPolicy()->policy_number ?? '',
            'groupNumber' => '',
            'contactInformation' => $this->getSubscriberContactInformation($property),
            'address' => $this->getSubscriberAddress($property),
            default => '',
        };
    }

    protected function getSubscriberContactInformation($key): string
    {
        $subscriber = $this->claim->subscriber();
        $subscriberContact = $subscriber?->contacts()->first() ?? null;

        return match ($key) {
            'name' => $subscriberContact->contact_name ?? $subscriber->first_name,
            'phoneNumber' => str_replace('-', '', $subscriberContact?->phone ?? '') ?? '',
            'faxNumber' => str_replace('-', '', $subscriberContact?->fax ?? '') ?? '',
            'email' => $subscriberContact?->email ?? '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getSubscriberAddress($key): string
    {
        $subscriber = $this->claim->subscriber();
        $subscriberAddress = $subscriber?->addresses()?->first() ?? null;

        return match ($key) {
            'address1' => $subscriberAddress?->address ?? '',
            'address2' => '',
            'city' => $subscriberAddress?->city ?? '',
            'state' => substr($subscriberAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $subscriberAddress?->zip ?? '') ?? '',
            'countryCode' => ('US' !== $subscriberAddress?->country) ? $subscriberAddress?->country : '',
            'countrySubDivisionCode' => ('US' !== $subscriberAddress?->country) ? $subscriberAddress?->country_subdivision_code : '',
            default => '',
        };
    }

    protected function getDependent($key): string
    {
        $patient = $this->claim
            ?->demographicInformation
            ?->patient;

        if (true == ($this->claim->higherOrderPolicy()?->own ?? false)) {
            return '';
        }

        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'firstName' => $patient->profile->first_name,
            'lastName' => $patient->profile->last_name,
            'middleName' => $patient->profile->middle_name ?? '',
            'suffix' => $patient->profile?->nameSuffix?->code ?? '',
            'gender' => strtoupper($patient->profile?->sex ?? 'U'),
            'dateOfBirth' => str_replace('-', '', $patient->profile?->date_of_birth ?? ''),
            'ssn' => str_replace('-', '', $patient->profile?->ssn ?? ''),
            'memberId' => $patient->code,
            'relationshipToSubscriberCode' => $this->claim->subscriber()->relationship->code ?? '21',
            'contactInformation' => $this->getDependentContactInformation($property),
            'address' => $this->getDependentAddress($property),
            default => '',
        };
    }

    protected function getDependentContactInformation($key): string
    {
        $patient = $this->claim
            ?->demographicInformation
            ?->patient;
        $patientContact = $patient?->profile->contacts()
            ->first() ?? null;

        if (true == ($this->claim->higherOrderPolicy()?->own ?? false)) {
            return '';
        }

        return match ($key) {
            'name' => $patientContact?->contact_name ?? $patient->profile->first_name,
            'phoneNumber' => str_replace('-', '', $patientContact?->phone ?? '') ?? '',
            'faxNumber' => str_replace('-', '', $patientContact?->fax ?? '') ?? '',
            'email' => $patientContact?->email ?? '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getDependentAddress($key): string
    {
        $patient = $this->claim
            ?->demographicInformation
            ?->patient;
        $patientAddress = $patient?->profile?->addresses()
            ?->first() ?? null;

        if (true == ($this->claim->higherOrderPolicy()?->own ?? false)) {
            return '';
        }

        return match ($key) {
            'address1' => $patientAddress?->address ?? '',
            'address2' => '',
            'city' => $patientAddress?->city ?? '',
            'state' => substr($patientAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $patientAddress?->zip ?? '') ?? '',
            'countryCode' => $patientAddress?->country ?? '',
            'countrySubDivisionCode' => $patientAddress?->country_subdivision_code ?? '',
            default => '',
        };
    }

    protected function getClaimDateInformation($key): string
    {
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
        $claimDateInfo = [];
        foreach ($this->claim->dateInformations ?? [] as $dateInfo) {
            $qualifier = $dateInfo?->qualifier?->code ?? '';
            if (isset($qualifierFields[$qualifier])) {
                if ((1 == $dateInfo->field_id->value) || (2 == $dateInfo->field_id->value)) {
                    $claimDateInfo[$qualifierFields[$qualifier]] = str_replace('-', '', $dateInfo?->from_date ?? '');
                } elseif (3 == $dateInfo->field_id->value) {
                    $claimDateInfo['lastWorkedDate'] = str_replace('-', '', $dateInfo?->from_date ?? '');
                    $claimDateInfo['authorizedReturnToWorkDate'] = str_replace('-', '', $dateInfo->to_date ?? '');
                }
            }
            if (4 == $dateInfo->field_id->value) {
                $claimDateInfo['admissionDate'] = str_replace('-', '', $dateInfo?->from_date ?? '');
                $claimDateInfo['dischargeDate'] = str_replace('-', '', $dateInfo->to_date ?? '');
            }
        }

        return $claimDateInfo[$key] ?? '';
    }

    protected function getClaimDateInstitutionalInformation($key): string
    {
        return match ($key) {
            'admissionDateAndHour' => str_replace('-', '', $this->claim->patientInformation->admission_date ?? '')
                .substr(str_replace(
                    ':',
                    '',
                    ('' != ($this->claim->patientInformation->admission_date ?? ''))
                        ? ($this->claim->patientInformation->admission_time ?? '0000')
                        : ''),
                    0,
                    4
                ),
            'statementBeginDate' => str_replace('-', '', $this->claim->service?->from ?? ''),
            'statementEndDate' => str_replace('-', '', $this->claim->service?->to ?? ''),
            'dischargeHour' => substr(str_replace(':', '', $this->claim->patientInformation->discharge_time ?? ''), 0, 4),
            'repricerReceivedDate' => Carbon::now()->format('Ymd'),
            default => '',
        };
    }

    protected function getClaimEpsdtReferral($key): string|array
    {
        $claimServiceLinePrincipal = $this->claim->service->services->first();

        return match ($key) {
            'certificationConditionCodeAppliesIndicator' => isset($claimServiceLinePrincipal?->epsdt?->code) ? 'Y' : 'N',
            'conditionCodes' => [
                $claimServiceLinePrincipal?->epsdt?->code ?? 'NU',
            ],
            default => '',
        };
    }

    protected function getclaimHealthCareCodeInformation(): array
    {
        return $this->claim->service->diagnoses
            ->map(fn ($diagnosis, $index) => [
                    'diagnosisTypeCode' => (0 == $index) ? 'ABK' : 'ABF',
                    'diagnosisCode' => $diagnosis->code,
            ]
            )->toArray();
    }

    protected function getClaimSupplementalInformation($key): string|bool
    {
        return match ($key) {
            'priorAuthorizationNumber' => $this->claim->demographicInformation?->prior_authorization_number ?? '',
            'referralNumber' => '',
            'claimControlNumber' => '',
            'repricedClaimNumber' => '',
            'investigationalDeviceExemptionNumber' => '',
            'claimNumber' => '',
            'medicalRecordNumber' => '',
            'demoProjectIdentifier' => '',
            'serviceAuthorizationExceptionCode' => '',
            'autoAccidentState' => $this->claim->demographicInformation?->auto_accident_place_state ?? '',
            'peerReviewAuthorizationNumber' => '',
            'adjustedRepricedClaimRefNumber' => '',
            default => '',
        };
    }

    protected function getClaimPrincipalDiagnosis($key): string
    {
        $diagnosisPrincipal = $this->claim->service->diagnoses->first();

        return match ($key) {
            'qualifierCode' => 'ABK',
            'principalDiagnosisCode' => $diagnosisPrincipal?->code ?? '',
            'presentOnAdmissionIndicator' => (true === $diagnosisPrincipal?->pivot?->admission ?? false) ? 'Y' : 'N',
            default => '',
        };
    }

    protected function getClaimAdmittingDiagnosis($key): string
    {
        $admittingDiagnosis = $this->claim->service->diagnoses->first(function ($diagnosis) {
            return $diagnosis->pivot->admission ?? false;
        });

        if (is_null($admittingDiagnosis)) {
            return '';
        }

        return match ($key) {
            'qualifierCode' => 'ABJ',
            'admittingDiagnosisCode' => $admittingDiagnosis->code,
            default => '',
        };
    }

    protected function getClaimDiagnosisRelatedGroupInformation($key): string
    {
        return match ($key) {
            'drugRelatedGroupCode' => $this->claim->service?->diagnosisRelatedGroup?->code ?? '',
            default => '',
        };
    }

    protected function getClaimOtherDiagnosisInformationList(): array
    {
        return [
            $this->claim->service->diagnoses
                ->skip(1)
                ->map(fn ($diagnosis, $index) => [
                    'qualifierCode' => 'ABF',
                    'otherDiagnosisCode' => $diagnosis->code,
                    'presentOnAdmissionIndicator' => (true === $diagnosis->pivot?->admission ?? false) ? 'Y' : 'N',
                ])->values()->toArray(),
        ];
    }

    protected function getClaimValueInformationList(): array
    {
        return [
            [
                [
                    'valueCode' => '80',
                    'valueCodeAmount' => (string) $this->claim->service?->services?->reduce(function ($carry, $service) {
                        return $carry + $service['days_or_units'] ?? 1;
                    }, 0),
                ],
            ],
        ];
    }

    protected function getClaimCodeInformation($key): string
    {
        return match ($key) {
            'admissionTypeCode' => $this->claim->patientInformation?->admissionType?->code ?? '',
            'admissionSourceCode' => $this->claim->patientInformation?->admissionSource?->code ?? '',
            'patientStatusCode' => !is_null($this->claim?->patientInformation?->patientStatus?->code)
                ? str_pad((string) $this->claim->patientInformation->patientStatus->code, 2, '0', STR_PAD_LEFT)
                : '',
            default => '',
        };
    }

    protected function getClaimInformation($key): array|string|bool
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        $claimServiceLinePrincipal = $this->claim->service->services->first();
        $relatedCausesCode = array_filter([
            (true === $this->claim->demographicInformation?->auto_accident_related_condition) ? 'AA' : null,
            (true === $this->claim->demographicInformation?->employment_related_condition) ? 'EM' : null,
            (true === $this->claim->demographicInformation?->other_accident_related_condition) ? 'OA' : null,
        ]);
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
        $serviceLines = [];
        foreach ($this->claim->service->services ?? [] as $service) {
            $valuesPoint = [];
            foreach ($service->diagnostic_pointers as $point) {
                array_push($valuesPoint, $pointers[$point]);
            }
            $procedureIdentifier = match ($service->procedure?->type?->getName()) {
                'HCPCS' => 'HC',
                'HIPPS' => 'HP',
                'HIEC' => 'IV',
                'ABC' => 'WK',
                '' => 'ER',
                default => ''
            };
            $procedureDescription = match ($service->procedure?->type?->getName()) {
                'HCPCS' => '',
                'HIPPS' => '',
                default => $service->procedure?->description,
            };
            $serviceLine = match ($this->claim->type) {
                ClaimType::PROFESSIONAL => [
                    'serviceDate' => str_replace('-', '', $service->from_service),
                    'serviceDateEnd' => !empty($service->to_service)
                        ? str_replace('-', '', $service->to_service)
                        : null,
                    'professionalService' => [
                        'procedureIdentifier' => 'HC' /* No esta, Loop2400 SV101-01 * */,
                        'lineItemChargeAmount' => str_replace(',', '', number_format((float) $service->price * (int) ($service->days_or_units ?? 1), 2)),
                        'procedureCode' => $service->procedure?->code,
                        'measurementUnit' => 'UN', /**Si es el mismo dias se expresa en min 'MJ' */
                        'serviceUnitCount' => $service->days_or_units ?? '1',
                        'compositeDiagnosisCodePointers' => [
                            'diagnosisCodePointers' => $valuesPoint ?? [],
                        ],
                    ],
                ],
                ClaimType::INSTITUTIONAL => [
                    'lineSupplementInformation' => [
                        'priorAuthorizationNumber' => '',
                        'referralNumber' => '',
                        'claimControlNumber' => '',
                        'repricedClaimNumber' => '',
                        'investigationalDeviceExemptionNumber' => '',
                        'claimNumber' => '',
                        'medicalRecordNumber' => '',
                        'demoProjectIdentifier' => '',
                        'serviceAuthorizationExceptionCode' => '1',
                        'autoAccidentState' => '',
                        'peerReviewAuthorizationNumber' => '',
                        'adjustedRepricedClaimRefNumber' => '',
                    ],
                    'institutionalService' => [
                        'procedureModifiers' => (!empty($service->procedure?->code) && !empty($procedureIdentifier))
                            ? array_map(fn ($mod) => $mod->modifier, $service->modifiers ?? [])
                            : [],
                        'measurementUnit' => match (isset($service->procedure?->companyServices
                        ->firstWhere('company_id', $this->claim
                            ?->demographicInformation
                            ?->company_id)?->medication)) {
                            false => 'DA',  /* DA = Days */
                            true => 'UN',   /* UN = Unit */
                            default => 'UN',
                        },
                        'serviceLineRevenueCode' => $service->revenueCode?->code,
                        'procedureIdentifier' => (!empty($service->procedure?->code)) ? $procedureIdentifier : '',
                        'procedureCode' => (!empty($procedureIdentifier)) ? $service->procedure?->code : '',
                        'description' => (!empty($service->procedure?->code) && !empty($procedureIdentifier)) ? $procedureDescription : '',
                        'lineItemChargeAmount' => str_replace(',', '', number_format((float) $service->price * (int) ($service->days_or_units ?? 1), 2)),
                        'serviceUnitCount' => $service->days_or_units ?? '1',
                        'nonCoveredChargeAmount' => '',
                    ],
                    'assignedNumber' => $service->id,
                    'serviceDate' => '',
                    'serviceDateEnd' => '',
                    'serviceTaxAmount' => '',
                    'facilityTaxAmount' => '',
                    'lineItemControlNumber' => '',
                    'repricedLineItemReferenceNumber' => '',
                    'description' => '',
                    'adjustedRepricedLineItemReferenceNumber' => '',
                    'lineNoteText' => '',
                ]
            };
            array_push($serviceLines, $serviceLine);
        }
        if (ClaimType::PROFESSIONAL === $this->claim->type) {
            return match ($accesorKey) {
                'claimFilingCode' => 'CI',
                'propertyCasualtyClaimNumber' => '',
                'deathDate' => '',
                'patientWeight' => '',
                'pregnancyIndicator' => '',
                'patientControlNumber' => $this->claim->demographicInformation?->patient?->code ?? '',
                'claimChargeAmount' => str_replace(',', '', $this->claim->billed_amount ?? '0.00'),
                'placeOfServiceCode' => $claimServiceLinePrincipal?->placeOfService?->code ?? '11',
                'claimFrequencyCode' => '1',
                'signatureIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->insured_signature)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'planParticipationCode' => 'A', /* Código que indica si el proveedor aceptó la asignación.
                * A = Asignado
                * B = Asignación aceptada sólo en servicios de laboratorio clínico
                * C = No asignado */
                'benefitsAssignmentCertificationIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->accept_assignment)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'releaseInformationCode' => 'Y', /* Código que indica si el proveedor tiene archivada una declaración firmada por el paciente autorizando la divulgación de datos médicos a otras organizaciones.
                * Informado = I, Sí = Y */
                'patientSignatureSourceCode' => '',
                'relatedCausesCode' => $relatedCausesCode,
                'autoAccidentStateCode' => in_array('AA', $relatedCausesCode) ? 'AA' : '',
                'autoAccidentCountryCode' => $this->claim->demographicInformation?->auto_accident_place_state ?? '',
                'specialProgramCode' => '', /* 02 .. Servicios especiales solo para medicaid */
                'delayReasonCode' => '', /* 1 .. Código de retraso */
                'patientAmountPaid' => '', /* Monto pagado por el paciente AMT02 */
                'fileInformation' => '', /* El segmento K3 sólo se utiliza para cumplir un requisito de datos inesperado de una autoridad legislativa. */
                'fileInformationList' => [],

                'claimDateInformation' => $this->getClaimDateInformation($property),
                'claimSupplementalInformation' => [
                    'priorAuthorizationNumber' => $this->claim->demographicInformation?->prior_authorization_number ?? '',
                    'referralNumber' => '',
                    'claimControlNumber' => '',
                    'cliaNumber' => '',
                    'repricedClaimNumber' => '',
                    'adjustedRepricedClaimNumber' => '',
                    'investigationalDeviceExemptionNumber' => '',
                    'claimNumber' => '',
                    'mammographyCertificationNumber' => '',
                    'medicalRecordNumber' => '',
                    'demoProjectIdentifier' => '',
                    'carePlanOversightNumber' => '',
                    'medicareCrossoverReferenceId' => '',
                    'serviceAuthorizationExceptionCode' => '',
                ],
                'homeboundIndicator' => true,
                'epsdtReferral' => $this->getClaimEpsdtReferral($property),
                'healthCareCodeInformation' => $this->getclaimHealthCareCodeInformation(),
                'serviceFacilityLocation' => $this->getFacility($property),
                'serviceLines' => $serviceLines,
                default => '',
            };
        }
        if (ClaimType::INSTITUTIONAL === $this->claim->type) {
            return match ($accesorKey) {
                'claimFilingCode' => 'CI',
                'patientControlNumber' => $this->claim->demographicInformation?->patient?->code,
                'planParticipationCode' => 'A', /* Código que indica si el proveedor aceptó la asignación.
                    * A = Asignado
                    * B = Asignación aceptada sólo en servicios de laboratorio clínico
                    * C = No asignado */
                'benefitsAssignmentCertificationIndicator' => isset($this->claim->demographicInformation)
                    ? ((true === $this->claim->demographicInformation->accept_assignment)
                        ? 'Y'
                        : 'N')
                    : 'N',
                'releaseInformationCode' => 'Y', /* Código que indica si el proveedor tiene archivada una declaración firmada por el paciente autorizando la divulgación de datos médicos a otras organizaciones.
                * Informado = I, Sí = Y */
                'claimDateInformation' => $this->getClaimDateInstitutionalInformation($property),
                'claimSupplementalInformation' => $this->getClaimSupplementalInformation($property),
                'principalDiagnosis' => $this->getClaimPrincipalDiagnosis($property),
                'admittingDiagnosis' => $this->getClaimAdmittingDiagnosis($property),
                'diagnosisRelatedGroupInformation' => $this->getClaimDiagnosisRelatedGroupInformation($property),
                'otherDiagnosisInformationList' => $this->getClaimOtherDiagnosisInformationList(),
                'occurrenceSpanInformations' => [
                    [
                        [
                            'occurrenceSpanCode' => '',
                            'occurrenceSpanCodeStartDate' => '',
                            'occurrenceSpanCodeEndDate' => '',
                        ],
                    ],
                ],
                'valueInformationList' => ('inpatient' == $this->claim->demographicInformation?->type_of_medical_assistance)
                    ? $this->getClaimValueInformationList()
                    : '',
                'occurrenceInformationList' => [
                    [
                        [
                            'occurrenceSpanCode' => '',
                            'occurrenceSpanCodeDate' => '',
                        ],
                    ],
                ],
                'treatmentCodeInformationList' => [
                    [
                        '',
                    ],
                ],
                'conditionCodesList' => [
                    [
                        [
                            'conditionCode' => '',
                        ],
                    ],
                ],
                'serviceFacilityLocation' => $this->getFacility($property),
                'serviceLines' => $serviceLines,
                'claimCodeInformation' => $this->getClaimCodeInformation($property),
                'epsdtReferral' => $this->getClaimEpsdtReferral($property),
                'propertyCasualtyClaimNumber' => '',
                'claimChargeAmount' => str_replace(',', '', $this->claim->billed_amount ?? '0.00'),
                'placeOfServiceCode' => $this->claim->demographicInformation?->bill_classification,
                'claimFrequencyCode' => '1',
                'delayReasonCode' => '',
                'patientEstimatedAmountDue' => '',
                'billingNote' => '',
                default => '',
            };
        }

        return '';
    }

    protected function getPayToAddress($key): string
    {
        $billingProviderPaymentAddress = $this->claim
            ?->demographicInformation
            ?->company
            ->addresses()
            ->where('billing_company_id', $this->claim->billing_company_id)
            ->where('address_type_id', '3')
            ?->first() ?? null;

        if (!isset($billingProviderPaymentAddress)) {
            return '';
        }

        return match ($key) {
            'address1' => $billingProviderPaymentAddress?->address ?? '',
            'address2' => '',
            'city' => $billingProviderPaymentAddress?->city ?? '',
            'state' => substr($billingProviderPaymentAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $billingProviderPaymentAddress?->zip) ?? '',
            'countryCode' => ('US' !== $billingProviderPaymentAddress?->country) ? $billingProviderPaymentAddress?->country : '',
            'countrySubDivisionCode' => ('US' !== $billingProviderPaymentAddress?->country) ? $billingProviderPaymentAddress?->country_subdivision_code : '',
            default => '',
        };
    }

    protected function getPayToPlan($key): string
    {
        /* @todo Se emplea cuando el pago se hace a otra compañia de seguro
         * Esta es la data del insurance al que hay que hacerle el pago
         * Actualmente no esta considerado en el sistema
         */
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'organizationName' => '',
            'primaryIdentifierTypeCode' => '',
            'primaryIdentifier' => '',
            'address' => $this->getPayToPlanAddress($property),
            'secondaryIdentifierTypeCode' => '',
            'secondaryIdentifier' => '',
            'taxIdentificationNumber' => '',
            default => '',
        };
    }

    protected function getPayToPlanAddress($key): string
    {
        return match ($key) {
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'postalCode' => '',
            'countryCode' => '',
            'countrySubDivisionCode' => '',
            default => '',
        };
    }

    protected function getPayerAddress($key): string
    {
        /* @todo Se emplea cuando el pago se hace a otra compañia de seguro
         * Esta es la data del insurance al que hay que hacerle el pago
         * Actualmente no esta considerado en el sistema
         */
        return match ($key) {
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'postalCode' => '',
            'countryCode' => '',
            'countrySubDivisionCode' => '',
            default => '',
        };
    }

    protected function getBilling($key): string
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        $healthProfessional = match ($this->claim->type) {
            ClaimType::PROFESSIONAL => $this->claim->demographicInformation
                ?->healthProfessionals()
                ?->wherePivot('field_id', 5)
                ?->first(),
            ClaimType::INSTITUTIONAL => $this->claim->demographicInformation
                ?->healthProfessionals()
                ?->wherePivot('field_id', 1)
                ?->orWherePivot('field_id', 76)
                ?->first(),
        };

        $contractFeeSpecification = $this->claim?->demographicInformation->company->contractFees()
            ->whereHas('insurancePlans', function ($query) {
                $query->where('insurance_plans.id', $this->claim?->higherInsurancePlan()?->id);
            })
            ?->first()
            ?->contractFeeSpecifications()
            ?->where(function ($query) use ($healthProfessional) {
                $query->whereNull('health_professional_id')
                    ?->orWhere('health_professional_id', $healthProfessional?->id);
            })->first();

        if (HealthProfessional::class === $contractFeeSpecification?->billing_provider_type) {
            return $this->getBillingByHeatlhProfessional($key);
        }

        $billingProvider = $this->claim
            ?->demographicInformation
            ?->company;

        return match ($accesorKey) {
            'providerType' => 'BillingProvider',
            'npi' => str_replace('-', '', $billingProvider?->npi ?? '') ?? null,
            'ssn' => str_replace('-', '', $billingProvider?->ssn ?? ''),
            'employerId' => str_replace('-', '', $billingProvider->ein ?? $billingProvider->npi),
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
            'firstName' => '',
            'lastName' => '',
            'middleName' => '',
            'suffix' => '',
            'organizationName' => $billingProvider?->name,
            'contactInformation' => $this->getBillingContactInformation($property),
            'address' => $this->getBillingAddress($property),
            default => '',
        };
    }

    protected function getBillingContactInformation($key): string
    {
        $billingProvider = $this->claim
            ?->demographicInformation
            ?->company;
        $billingProviderContact = $billingProvider
            ->contacts()
            ->where('billing_company_id', $this->claim->billing_company_id ?? null)
            ?->first() ?? null;

        return match ($key) {
            'name' => ('' === $billingProviderContact->phone ?? '')
                ? $this->claim->billingCompany->contact?->contact_name ?? $this->claim->billingCompany->name
                : $billingProviderContact->contact_name ?? $billingProvider->name,
            'phoneNumber' => str_replace(
                '-',
                '',
                $billingProviderContact->phone ?? $this->claim->billingCompany->contact?->phone ?? ''
            ) ?? null,
            'faxNumber' => '',
            'email' => '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getBillingAddress($key): string
    {
        $billingProvider = $this->claim
            ?->demographicInformation
            ?->company;
        $billingProviderAddress = $billingProvider
            ->addresses()
            ->where('billing_company_id', $this->claim->billing_company_id ?? null)
            ->where('address_type_id', 1)
            ?->first() ?? null;

        return match ($key) {
            'address1' => $billingProviderAddress?->address ?? '',
            'address2' => '',
            'city' => $billingProviderAddress?->city ?? '',
            'state' => substr($billingProviderAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $billingProviderAddress?->zip) ?? '',
            'countryCode' => ('US' !== $billingProviderAddress?->country)
                ? $billingProviderAddress?->country
                : '',
            'countrySubDivisionCode' => ('US' !== $billingProviderAddress?->country)
                ? $billingProviderAddress?->country_subdivision_code
                : '',
            default => '',
        };
    }

    protected function getBillingByHeatlhProfessional($key): string
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        $healthProfessional = match ($this->claim->type) {
            ClaimType::PROFESSIONAL => $this->claim->demographicInformation
                ?->healthProfessionals()
                ?->wherePivot('field_id', 5)
                ?->first(),
            ClaimType::INSTITUTIONAL => $this->claim->demographicInformation
                ?->healthProfessionals()
                ?->wherePivot('field_id', 1)
                ?->orWherePivot('field_id', 76)
                ?->first(),
        };

        $contractFeeSpecification = $this->claim?->demographicInformation->company->contractFees()
            ->whereHas('insurancePlans', function ($query) {
                $query->where('insurance_plans.id', $this->claim?->higherInsurancePlan()?->id);
            })
            ?->first()
            ?->contractFeeSpecifications()
            ?->where(function ($query) use ($healthProfessional) {
                $query->whereNull('health_professional_id')
                    ?->orWhere('health_professional_id', $healthProfessional?->id);
            })->first();

        $billingProvider = $contractFeeSpecification->billingProvider;
        $federalTax = $contractFeeSpecification->billing_provider_tax_id ?? '';

        return match ($accesorKey) {
            'providerType' => 'BillingProvider',
            'npi' => str_replace('-', '', $billingProvider?->npi ?? '') ?? '',
            'ssn' => (!empty($federalTax) && ($federalTax == $billingProvider?->profile?->ssn))
                ? str_replace('-', '', $billingProvider?->profile?->ssn ?? '')
                : '',
            'employerId' => (!empty($federalTax) && ($federalTax == $billingProvider->ein))
                ? str_replace('-', '', $billingProvider->ein ?? $billingProvider->npi ?? '')
                : '',
            'firstName' => $billingProvider?->profile?->first_name ?? '',
            'lastName' => $billingProvider?->profile?->last_name ?? '',
            'middleName' => $billingProvider?->profile?->middle_name ?? '',
            'suffix' => $billingProvider?->profile?->nameSuffix?->code ?? '',
            'contactInformation' => $this->getBillingContactInformation($property),
            'address' => $this->getBillingAddress($property),
            default => '',
        };
    }

    protected function getReferring($key): string
    {
        $referringProvider = $this->claim->provider();
        if (!isset($referringProvider)) {
            return '';
        }

        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'providerType' => 'ReferringProvider',
            'npi' => str_replace('-', '', $referringProvider->npi ?? ''),
            'ssn' => str_replace('-', '', $referringProvider->ssn ?? ''),
            'employerId' => str_replace('-', '', $referringProvider->ein ?? $referringProvider->npi ?? ''),
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => str_replace('-', '', $referringProvider->upin ?? ''),
            'taxonomyCode' => '',
            'firstName' => $referringProvider?->profile?->first_name ?? '',
            'lastName' => $referringProvider?->profile?->last_name ?? '',
            'middleName' => $referringProvider?->profile?->middle_name ?? '',
            'suffix' => $referringProvider?->profile?->nameSuffix?->code ?? '',
            'organizationName' => '',
            'contactInformation' => $this->getReferringContactInformation($property),
            'address' => $this->getReferringAddress($property),
            default => '',
        };
    }

    protected function getReferringContactInformation($key): string
    {
        $referringProvider = $this->claim->provider();
        $referringProviderContact = $referringProvider?->profile?->contacts()?->first();

        return match ($key) {
            'name' => $referringProviderContact->contact_name ?? $referringProvider?->profile?->first_name ?? '',
            'phoneNumber' => str_replace('-', '', $referringProviderContact?->phone ?? '') ?? '',
            'faxNumber' => str_replace('-', '', $referringProviderContact?->fax ?? '') ?? '',
            'email' => $referringProviderContact?->email ?? '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getReferringAddress($key): string
    {
        $referringProvider = $this->claim->provider();
        $referringProviderAddress = $referringProvider?->profile?->addresses()?->first();

        return match ($key) {
            'address1' => $referringProviderAddress?->address ?? '',
            'address2' => '',
            'city' => $referringProviderAddress?->city ?? '',
            'state' => substr($referringProviderAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $referringProviderAddress?->zip ?? '') ?? '',
            'countryCode' => $referringProviderAddress?->country ?? '',
            'countrySubDivisionCode' => $referringProviderAddress?->country_subdivision_code ?? '',
            default => '',
        };
    }

    protected function getRendering($key): string
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'providerType' => 'BillingProvider',
            'npi' => '',
            'ssn' => '',
            'employerId' => '',
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
            'firstName' => '',
            'lastName' => '',
            'middleName' => '',
            'suffix' => '',
            'organizationName' => '',
            'contactInformation' => $this->getRenderingContactInformation($property),
            'address' => $this->getRenderingAddress($property),
            default => '',
        };
    }

    protected function getRenderingContactInformation($key): string
    {
        return match ($key) {
            'name' => '',
            'phoneNumber' => '',
            'faxNumber' => '',
            'email' => '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getRenderingAddress($key): string
    {
        return match ($key) {
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'postalCode' => '',
            'countryCode' => '',
            'countrySubDivisionCode' => '',
            default => '',
        };
    }

    protected function getOrdering($key): string
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'providerType' => 'BillingProvider',
            'npi' => '',
            'ssn' => '',
            'employerId' => '',
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
            'firstName' => '',
            'lastName' => '',
            'middleName' => '',
            'suffix' => '',
            'organizationName' => '',
            'contactInformation' => $this->getOrderingContactInformation($property),
            'address' => $this->getOrderingAddress($property),
            default => '',
        };
    }

    protected function getOrderingContactInformation($key): string
    {
        return match ($key) {
            'name' => '',
            'phoneNumber' => '',
            'faxNumber' => '',
            'email' => '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getOrderingAddress($key): string
    {
        return match ($key) {
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'postalCode' => '',
            'countryCode' => '',
            'countrySubDivisionCode' => '',
            default => '',
        };
    }

    protected function getSupervising($key): string
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'providerType' => 'BillingProvider',
            'npi' => '',
            'ssn' => '',
            'employerId' => '',
            'commercialNumber' => '',
            'locationNumber' => '',
            'payerIdentificationNumber' => '',
            'employerIdentificationNumber' => '',
            'claimOfficeNumber' => '',
            'naic' => '',
            'stateLicenseNumber' => '',
            'providerUpinNumber' => '',
            'taxonomyCode' => '',
            'firstName' => '',
            'lastName' => '',
            'middleName' => '',
            'suffix' => '',
            'organizationName' => '',
            'contactInformation' => $this->getSupervisingContactInformation($property),
            'address' => $this->getSupervisingAddress($property),
            default => '',
        };
    }

    protected function getSupervisingContactInformation($key): string
    {
        return match ($key) {
            'name' => '',
            'phoneNumber' => '',
            'faxNumber' => '',
            'email' => '',
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getSupervisingAddress($key): string
    {
        return match ($key) {
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'postalCode' => '',
            'countryCode' => '',
            'countrySubDivisionCode' => '',
            default => '',
        };
    }

    protected function getAttending($key): string
    {
        $attending = $this->claim->attending();

        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'providerType' => 'AttendingProvider',
            'npi' => str_replace('-', '', $attending->npi ?? '') ?? '',
            'secondaryIdentificationQualifierCode' => '',
            'secondaryIdentifier' => '',
            'employerId' => str_replace('-', '', $attending->ein ?? '') ?? '',
            'taxonomyCode' => '',
            'firstName' => $attending->profile->first_name,
            'lastName' => $attending->profile->last_name,
            'middleName' => $attending->profile->middle_name,
            'suffix' => $attending->profile?->nameSuffix?->code ?? '',
            'organizationName' => '',
            'contactInformation' => $this->getAttendingContactInformation($property),
            'address' => $this->getAttendingAddress($property),
            default => '',
        };
    }

    protected function getAttendingContactInformation($key): string
    {
        $attending = $this->claim->attending();
        $attendingContact = $attending?->profile->contacts()
            ?->first() ?? null;
        if (
            empty($attendingContact?->phone)
            || empty($attendingContact?->email)
            || empty($attendingContact?->fax)
        ) {
            return '';
        }

        return match ($key) {
            'name' => $attendingContact?->contact_name ?? $attending->profile->first_name,
            'phoneNumber' => str_replace('-', '', $attendingContact?->phone ?? '') ?? '',
            'faxNumber' => str_replace('-', '', $attendingContact?->fax ?? '') ?? '',
            'email' => $attendingContact?->email ?? '',
            'validContact' => true,
            default => '',
        };
    }

    protected function getAttendingAddress($key): string
    {
        $attending = $this->claim->attending();
        $attendingAddress = $attending?->profile?->addresses()
            ?->first() ?? null;

        return match ($key) {
            'address1' => $attendingAddress?->address ?? '',
            'address2' => '',
            'city' => $attendingAddress?->city ?? '',
            'state' => substr($attendingAddress?->state ?? '', 0, 2) ?? '',
            'postalCode' => str_replace('-', '', $attendingAddress?->zip ?? '') ?? '',
            'countryCode' => ('US' !== $attendingAddress?->country) ? $attendingAddress?->country : '',
            'countrySubDivisionCode' => ('US' !== $attendingAddress?->country) ? $attendingAddress?->country_subdivision_code : '',
            default => '',
        };
    }

    protected function getFacility(string $key): string|array
    {
        $segments = explode('.', $key);
        $accesorKey = $segments[0] ?? null;
        $property = isset($segments[1]) ? implode('.', array_slice($segments, 1)) : null;

        return match ($accesorKey) {
            'organizationName' => $this->getFacilityAttribute('name'),
            'address' => $this->getFacilityAddress($property),
            'npi' => $this->getFacilityAttribute('npi'),
            'phoneName' => $this->getFacilityContactAttribute('contact_name', '1'),
            'phoneNumber' => $this->getFacilityContactAttribute('phone', '1'),
            'phoneExtension' => '',
            default => '',
        };
    }

    protected function getFacilityAddress(string $key): string
    {
        return match ($key) {
            'address1' => $this->getFacilityAddressAttribute('address', '1'),
            'address2' => '',
            'city' => $this->getFacilityAddressAttribute('city', '1'),
            'state' => $this->getFacilityAddressAttribute('state', '1'),
            'postalCode' => $this->getFacilityAddressAttribute('zip', '1'),
            'countryCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                ? $this->getFacilityAddressAttribute('country', '1')
                : '',
            'countrySubDivisionCode' => ('US' !== $this->getFacilityAddressAttribute('country', '1'))
                ? $this->getFacilityAddressAttribute('country_subdivision_code', '1')
                : '',
            default => '',
        };
    }

    protected function getFacilityAttribute(string $key): string
    {
        return (string) $this->claim
        ->demographicInformation
        ->facility
        ?->{$key} ?? '';
    }

    public function getFacilityAddressAttribute(string $key, string $entry): string
    {
        $value = (string) $this->claim
            ->demographicInformation
            ->facility
            ->addresses
            ->first()
            ?->{$key};

        return match ($key) {
            'address' => substr($value ?? '', 0, 55),
            'city' => substr($value ?? '', 0, 30),
            'state' => substr($value ?? '', 0, 2),
            'zip' => substr(str_replace('-', '', $value ?? ''), 0, 12),
            default => !empty($value) ? $value : '',
        };
    }

    public function getFacilityContactAttribute(string $key, string $entry): string
    {
        $value = $this->claim
            ->demographicInformation
            ->facility
            ->contacts
            ->get((int) $entry);

        return match ($key) {
            'phone' => str_replace('-', '', $value?->phone ?? '') ?? '',
            default => (string) $value?->{$key} ?? '',
        };
    }

    public function toArray(): array
    {
        $keys = array_keys(
            array_filter($this->config, function ($value) {
                return $value['default'] ?? false;
            })
        );

        return array_combine(
            $keys,
            array_map(function ($key) {
                return $this->translate((string) $key);
            }, $keys)
        );
    }
}
