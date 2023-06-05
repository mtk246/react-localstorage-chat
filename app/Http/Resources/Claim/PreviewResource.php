<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Claim;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\InsuranceCompany;
use App\Models\Patient;
use App\Models\PlaceOfService;
use App\Models\Procedure;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

/** @property Claim $resource */
final class PreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $typeFormat = $this->resource->claimFormattable?->typeForm?->form;

        return ('UB-04 / 837I' == $typeFormat)
            ? $this->getUB04PreviewResource($request)
            : (('CMS-1500 / 837P' == $typeFormat)
                ? $this->getCMS1500PreviewResource($request)
                : []);
    }

    protected function getCMS1500PreviewResource($request)
    {
        $bC = (Gate::allows('is-admin'))
            ? ($request->billing_company_id ?? $this->resource->claimFormattable?->billing_company_id)
            : $this->user->billingCompanies->first()?->id;

        $patient = Patient::with([
            'user' => function ($query) use ($bC): void {
                $query->with([
                    'profile',
                    'addresses' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'contacts' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                ]);
            },
        ])->find($request->patient_id ?? $this->resource->patient_id ?? null);

        if (isset($this->resource)) {
            $higherOrderPolicy = $this->resource->insurancePolicies()
                ->wherePivot('order', 1)->first();
            $lowerOrderPolicy = $this->resource->insurancePolicies()
                ->wherePivot('order', 2)->first();

            if ($higherOrderPolicy) {
                $insuranceCompany = $higherOrderPolicy->insurancePlan->insuranceCompany;
            }
        }

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $patient->user ?? null
                : $higherOrderPolicy->subscribers->first();

        $subscriberOther =
            $lowerOrderPolicy->own ?? true
                ? $patient->user ?? null
                : $lowerOrderPolicy->subscribers->first();

        $patientOrInsuredInfo = $this->resource->claimFormattable?->patientOrInsuredInformation ?? $request->patient_or_insured_information ?? null;
        $physicianOrSupplierInfo = $this->resource->claimFormattable?->physicianOrSupplierInformation ?? $request->physician_or_supplier_information ?? null;

        if (isset($physicianOrSupplierInfo->claimDateInformations)) {
            $otherField = null;
            $currentField = null;
            $currentOccupationField = null;
            $hospitalizationField = null;
            $additionalField = null;

            foreach ($physicianOrSupplierInfo->claimDateInformations ?? [] as $service) {
                if (str_contains($service->field->description ?? '', '14.')) {
                    if (!isset($currentField)) {
                        $currentField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '15.')) {
                    if (!isset($otherField)) {
                        $otherField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '16.')) {
                    if (!isset($currentOccupationField)) {
                        $currentOccupationField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '18.')) {
                    if (!isset($hospitalizationField)) {
                        $hospitalizationField = $service;
                    }
                } elseif (str_contains($service->field->description ?? '', '19.')) {
                    if (!isset($additionalField)) {
                        $additionalField = $service;
                    }
                }
            }
            $currentDate = explode('-', $currentField->from_date_or_current ?? '');
            $otherDate = explode('-', $otherField->from_date_or_current ?? '');
            $currentOccupationFrom = explode('-', $currentOccupationField->from_date_or_current ?? '');
            $currentOccupationTo = explode('-', $currentOccupationField->to_date ?? '');

            $hospitalizationFrom = explode('-', $hospitalizationField->from_date_or_current ?? '');
            $hospitalizationTo = explode('-', $hospitalizationField->to_date ?? '');
        }

        if (isset($request->service_provider_id)) {
            $provider = HealthProfessional::find($request->service_provider_id);
            $providerCode = 'DN';
        } elseif (isset($request->referred_id)) {
            $provider = HealthProfessional::find($request->referred_id);
            $providerCode = 'DK';
        }

        $billingProvider = HealthProfessional::find($request->billing_provider_id ?? $this->resource->billing_provider_id ?? null);
        $billingProviderAddress = isset($insuranceCompany)
            ? $billingProvider?->user->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;
        $claimServices = $request->claim_form_services ?? $this->resource->claimFormattable->claimFormServices ?? [];

        foreach ($request->diagnoses ?? $this->resource->diagnoses ?? [] as $diagnosis) {
            $diag = Diagnosis::find($diagnosis->pivot->diagnosis_id ?? $diagnosis['diagnosis_id']);
            $diagnoses[$diagnosis->pivot->item ?? $diagnosis['item']] = $diag->code;
        }

        $company = Company::find($request->company_id ?? $this->resource->company_id ?? null);
        $facility = Facility::find($request->facility_id ?? $this->resource->facility_id ?? null);
        $facilityAddress = isset($insuranceCompany)
            ? $facility->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;
        $insuranceCompanyAddress = isset($insuranceCompany)
            ? $insuranceCompany->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;
        $patientBirthdate = explode('-', $patient->user->profile->date_of_birth ?? '');
        $patientAddress = $patient->user?->addresses()?->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;
        $patientContact = $patient->user->contacts()->select(
            'phone'
        )->first() ?? null;
        $subscriberBirthdate = explode('-', $this->subscriber?->date_of_birth ?? '');
        $subscriberAddress = $subscriber?->addresses()->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;
        $subscriberContact = $subscriber->contacts()->select(
            'phone'
        )->first() ?? null;

        $resultServices = [];
        $totalCharge = 0;
        $totalCopay = 0;

        foreach ($claimServices->toArray() ?? [] as $index => $item) {
            $arrayPrice = explode('.', $item['price'] ?? '');
            $totalCharge += $item['price'] ?? 0;
            $totalCopay += $item['copay'] ?? 0;
            $resultServices['from_service'.($index + 1)] = $item['from_service'];
            $resultServices['to_service'.($index + 1)] = $item['to_service'];
            $resultServices['price'.($index + 1)] = $item['price'];
            $resultServices['pointer1'.($index + 1)] = $item['diagnostic_pointers'][0] ?? '';
            $resultServices['pointer2'.($index + 1)] = $item['diagnostic_pointers'][1] ?? '';
            $resultServices['pointer3'.($index + 1)] = $item['diagnostic_pointers'][2] ?? '';
            $resultServices['pointer4'.($index + 1)] = $item['diagnostic_pointers'][3] ?? '';
            $resultServices['procedure'.($index + 1)] = Procedure::find($item['procedure_id'] ?? null)?->code;
            $resultServices['pos'.($index + 1)] = PlaceOfService::find($item['place_of_service_id'] ?? null)?->code;
            $resultServices['modifier1'.($index + 1)] = $item['modifiers'][0]['name'] ?? '';
            $resultServices['modifier2'.($index + 1)] = $item['modifiers'][1]['name'] ?? '';
            $resultServices['modifier3'.($index + 1)] = $item['modifiers'][2]['name'] ?? '';
            $resultServices['modifier4'.($index + 1)] = $item['modifiers'][3]['name'] ?? '';
            $resultServices['emg'.($index + 1)] = ($item['emg']) ? 'Y' : '';
        }

        return [
            'insurance_company' => [
                'name' => $insuranceCompany->name ?? '',
                'address1' => $insuranceCompanyAddress->address ?? '',
                'address2' => '',
                'address3' => substr($insuranceCompanyAddress->city ?? '', 0, 24).' '.substr($insuranceCompanyAddress->state ?? '', 0, 3).substr($insuranceCompanyAddress->zip ?? '', 0, 12) ?? '',
            ],
            '1' => 'Medicare',
            '1a' => $higherOrderPolicy->policy_number ?? '',
            '2' => $patient
                ? ($patient->user->profile->last_name.', '.
                $patient->user->profile->first_name.
                ($patient->user->profile->middle_name
                    ? ', '.substr($patient->user->profile->middle_name, 0, 1)
                    : ''))
                : '',
            '3' => [
                'year' => $patientBirthdate[0] ?? '',
                'month' => $patientBirthdate[1] ?? '',
                'day' => $patientBirthdate[2] ?? '',
                'sex' => strtoupper($patient->user->profile->sex ?? ''),
            ],
            '4' => ($subscriber->last_name ?? $subscriber->profile->last_name).
                ', '.($subscriber->first_name ?? $subscriber->profile->first_name).
                ($subscriber->middle_name ?? $subscriber->profile->middle_name ?? null
                    ? ', '.substr($subscriber->middle_name ?? ($subscriber->profile->middle_name ?? ''), 0, 1)
                    : ''),
            '5' => [
                'address' => substr($patientAddress->address ?? '', 0, 28),
                'city' => substr($patientAddress->city ?? '', 0, 24),
                'state' => substr($patientAddress->state ?? '', 0, 3),
                'zip' => substr($patientAddress->zip ?? '', 0, 12),
                'code_area' => substr($patientContact->phone ?? '', 0, 3),
                'phone' => substr($patientContact->phone ?? '', 3, 10),
            ],
            '6' => ($higherOrderPolicy->own ?? true)
                ? 'self'
                : (str_contains(strtolower($subscriber->relationship?->description), 'spouse')
                    ? 'spouse'
                    : (str_contains(strtolower($subscriber->relationship?->description), 'child')
                        ? 'child'
                        : 'other')),
            '7' => [
                'address' => substr($subscriberAddress->address ?? '', 0, 28),
                'city' => substr($subscriberAddress->city ?? '', 0, 24),
                'state' => substr($subscriberAddress->state ?? '', 0, 3),
                'zip' => substr($subscriberAddress->zip ?? '', 0, 12),
                'code_area' => substr($subscriberContact->phone ?? '', 0, 3),
                'phone' => substr($subscriberContact->phone ?? '', 3, 10),
            ],
            '8' => '',
            '9' => ($subscriberOther->last_name ?? $subscriberOther->profile->last_name).
            ', '.($subscriberOther->first_name ?? $subscriberOther->profile->first_name).
            ($subscriberOther->middle_name ?? $subscriberOther->profile->middle_name ?? null
                ? ', '.substr($subscriberOther->middle_name ?? ($subscriberOther->profile->middle_name ?? ''), 0, 1)
                : ''),
            '9a' => $lowerOrderPolicy->policy_number ?? '',
            '9b' => '',
            '9c' => '',
            '9d' => $lowerOrderPolicy->insurancePlan->name ?? '',
            '10' => '',
            '10a' => $patientOrInsuredInfo['employment_related_condition'] ?? false,
            '10b' => [
                'value' => $patientOrInsuredInfo['auto_accident_related_condition'] ?? false,
                'place_state' => substr($patientOrInsuredInfo['auto_accident_place_state'] ?? '', 0, 2),
            ],
            '10c' => $patientOrInsuredInfo['other_accident_related_condition'] ?? false,
            '10d' => '',
            '11' => ('P' == $higherOrderPolicy?->typeResponsibility->code)
                ? 'NONE'
                : $higherOrderPolicy->group_number ?? '',
            '11a' => [
                'year' => $subscriberBirthdate[0] ?? '',
                'month' => $subscriberBirthdate[1] ?? '',
                'day' => $subscriberBirthdate[2] ?? '',
                'sex' => strtoupper($subscriber->sex ?? ''),
            ],
            '11b' => '',
            '11c' => $higherOrderPolicy->insurancePlan->name ?? '',
            '11d' => ($lowerOrderPolicy) ? true : false,
            '12' => [
                'signed' => ($patientOrInsuredInfo['patient_signature'] ?? false) ? 'Signature on File' : '',
                'date' => ($patientOrInsuredInfo['patient_signature'] ?? false) ? now()->format('m/d/Y') : '',
            ],
            '13' => ($patientOrInsuredInfo['insured_signature'] ?? false) ? 'Signature on File' : '',
            '14' => [
                'year' => $currentDate[0] ?? '',
                'month' => $currentDate[1] ?? '',
                'day' => $currentDate[2] ?? '',
                'qualifier' => $currentField->qualifier?->code ?? '',
            ],
            '15' => [
                'year' => $otherDate[0] ?? '',
                'month' => $otherDate[1] ?? '',
                'day' => $otherDate[2] ?? '',
                'qualifier' => $otherField->qualifier?->code ?? '',
            ],
            '16' => [
                'from_year' => $currentOccupationFrom[0] ?? '',
                'from_month' => $currentOccupationFrom[1] ?? '',
                'from_day' => $currentOccupationFrom[2] ?? '',
                'to_year' => $currentOccupationTo[0] ?? '',
                'to_month' => $currentOccupationTo[1] ?? '',
                'to_day' => $currentOccupationTo[2] ?? '',
            ],
            '17' => [
                'code' => $providerCode ?? '',
                'name' => $provider->user->profile->first_name ?? ''.
                    (isset($provider->user->profile->middle_name)
                        ? ' '.substr($provider->user->profile->middle_name, 0, 1).' '
                        : ' ')
                    .($provider->user->profile->last_name ?? '').
                    ' '.($provider->user->profile->suffix_name ?? ''),
            ],
            '17a' => [
                'code' => 'G2',
                'value' => 'Por asignar',
            ],
            '17b' => [
                'code' => 'NPI',
                'value' => $provider->npi ?? '',
            ],
            '18' => [
                'from_year' => $hospitalizationFrom[0] ?? '',
                'from_month' => $hospitalizationFrom[1] ?? '',
                'from_day' => $hospitalizationFrom[2] ?? '',
                'to_year' => $hospitalizationTo[0] ?? '',
                'to_month' => $hospitalizationTo[1] ?? '',
                'to_day' => $hospitalizationTo[2] ?? '',
            ],
            '19' => 'Por asignar',
            '20' => [
                'outside_lab' => $physicianOrSupplierInfo->outside_lab ?? false,
                'charges' => $physicianOrSupplierInfo->charges ?? '',
            ],
            '21' => [
                'indicator' => '0', // '9',
                'A' => $diagnoses['A'] ?? '',
                'B' => $diagnoses['B'] ?? '',
                'C' => $diagnoses['C'] ?? '',
                'D' => $diagnoses['D'] ?? '',
                'E' => $diagnoses['E'] ?? '',
                'F' => $diagnoses['F'] ?? '',
                'G' => $diagnoses['G'] ?? '',
                'H' => $diagnoses['H'] ?? '',
                'I' => $diagnoses['I'] ?? '',
                'J' => $diagnoses['J'] ?? '',
                'K' => $diagnoses['K'] ?? '',
                'L' => $diagnoses['L'] ?? '',
            ],
            '22' => [
                'resubmision_code' => '',
                'original_code' => '',
            ],
            '23' => $physicianOrSupplierInfo->prior_authorization_number ?? '',
            '24' => $resultServices,
            '24a' => '',
            '24b' => '',
            '24c' => '',
            '24d' => '',
            '24e' => '',
            '24f' => '',
            '24g' => '',
            '24h' => '',
            '24i' => '',
            '24j' => $provider->npi ?? '',
            '25' => [
                'code' => 'EIN',
                'value' => $company->ein ?? '',
            ],
            '26' => $physicianOrSupplierInfo->patient_account_num ?? '',
            '27' => $physicianOrSupplierInfo->accept_assignment ?? false,
            '28' => $totalCharge ?? '',
            '29' => $totalCopay ?? '',
            '30' => '',
            '31' => [
                'signed' => 'Signature on File',
                'date' => now()->format('m/d/Y'),
            ],
            '32' => [
                'name' => $facility->name ?? '',
                'address1' => $facilityAddress->address ?? '',
                'address2' => '',
                'address3' => substr($facilityAddress->city ?? '', 0, 24).' '.substr($facilityAddress->state ?? '', 0, 3).substr($facilityAddress->zip ?? '', 0, 12) ?? '',
            ],
            '32a' => $facility->npi ?? '',
            '32b' => '',
            '33' => [
                'name' => isset($billingProvider)
                    ? ($billingProvider->user->profile->last_name.', '.
                        $billingProvider->user->profile->first_name.', '.
                        substr($billingProvider->user->profile->middle_name, 0, 1))
                    : '',
                    'address1' => $billingProviderAddress->address ?? '',
                    'address2' => '',
                    'address3' => substr($billingProviderAddress->city ?? '', 0, 24).' '.substr($billingProviderAddress->state ?? '', 0, 3).substr($billingProviderAddress->zip ?? '', 0, 12) ?? '',
            ],
            '33a' => $billingProvider->npi ?? '',
            '33b' => '',
        ];
    }

    protected function getUB04PreviewResource($request)
    {
        $bC = (Gate::allows('is-admin'))
            ? ($request->billing_company_id ?? $this->resource->claimFormattable?->billing_company_id)
            : $this->user->billingCompanies->first()?->id;

        $patient = Patient::with([
            'user' => function ($query) use ($bC): void {
                $query->with([
                    'profile',
                    'addresses' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'contacts' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                ]);
            },
        ])->find($request->patient_id ?? $this->resource->patient_id ?? null);

        $patientBirthdate = explode('-', $patient->user->profile->date_of_birth ?? '');
        $patienAditionalInformation = $this->resource->claimFormattable?->physicianOrSupplierInformation;
        $patientDate = explode('-', $patienAditionalInformation?->admission_date ?? '');
        $patientHour = explode(':', $patienAditionalInformation?->admission_time ?? '');
        $patientDischarge = explode('-', $patienAditionalInformation?->discharge_date ?? '');
        $patientDischargeHour = explode(':', $patienAditionalInformation?->discharge_time ?? '');
        $patienAdmissionType = $patienAditionalInformation?->admissionType?->code ?? '';
        $patienAdmissionSource = $patienAditionalInformation?->admissionSource?->code ?? '';
        $patienStatus = $patienAditionalInformation?->patientStatus?->code ?? '';
        $patienConditionCodes = collect($patienAditionalInformation?->conditionCodes ?? [])
            ->map(function ($item) {
                return $item['code'];
            })
            ->pad(11, '');
        $patientAddress = $patient->user?->addresses()?->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;

        $higherOrderPolicy = $this->resource->insurancePolicies()
            ->wherePivot('order', 1)->first();

        /** @var InsuranceCompany|null */
        $insuranceCompany = $higherOrderPolicy?->insurancePlan?->insuranceCompany;

        $facility = Facility::query()->find($request->facility_id ?? $this->resource->facility_id ?? null);

        $insuranceCompanyAddress = isset($insuranceCompany)
            ? $insuranceCompany->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;

        $patientContact = $patient->user->contacts()->select(
            'phone'
        )->first() ?? null;

        $company = Company::find($request->company_id ?? $this->resource->company_id ?? null);
        $companyAddress = isset($company)
            ? $company->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;

        return [
            '1' => [
                'name' => $company->name ?? '',
                'address1' => $companyAddress->address ?? '',
                'address2' => substr($companyAddress->city ?? '', 0, 24),
                'state' => substr($companyAddress->state ?? '', 0, 3),
                'zip' => substr($companyAddress->zip ?? '', 0, 5),
            ],
            '2' => [
                'name' => $company->name ?? '',
                'address1' => $companyAddress->address ?? '',
                'address2' => substr($companyAddress->city ?? '', 0, 24),
                'state' => substr($companyAddress->state ?? '', 0, 3),
                'zip' => substr($companyAddress->zip ?? '', 0, 5),
            ],
            '3a' => $this->resource->control_number ?? '',
            '3b' => $patient?->companies?->find($company->id ?? null)?->pivot?->med_num ?? '',
            '4' => '0'
                .(string) $facility->facility_type_id
                .('inpatient' == $this->resource->claimFormattable->type_of_medical_assistance
                    ? '1'
                    : '3'
                )
                .$this->resource->claimFormattable?->physicianOrSupplierInformation?->bill_classification_id,
            '5' => $company->npi,
            '6' => [
                'from' => $patientDate,
                'through' => $patientDischarge,
            ],
            '7' => '',
            '8a' => $patient->code ?? '',
            '8b' => $patient
                ? ($patient->user->profile->last_name.', '.
                $patient->user->profile->first_name.
                ($patient->user->profile->middle_name
                    ? ', '.substr($patient->user->profile->middle_name, 0, 1)
                    : ''))
                : '',
            '9' => [
                'A' => substr($patientAddress->address ?? '', 0, 28),
                'B' => substr($patientAddress->city ?? '', 0, 24),
                'C' => substr($patientAddress->state ?? '', 0, 3),
                'D' => substr($patientAddress->zip ?? '', 0, 12),
                'E' => '',
            ],
            '10' => (($patientBirthdate[1] ?? '').' '.($patientBirthdate[2] ?? '').' '.($patientBirthdate[0] ?? '')),
            '11' => strtoupper($patient->user->profile->sex ?? ''),
            '12' => (($patientDate[1] ?? '').' '.($patientDate[2] ?? '').' '.substr($patientDate[0] ?? '', 0, 2)),
            '13' => $patientHour[0] ?? '',
            '14' => $patienAdmissionType,
            '15' => $patienAdmissionSource,
            '16' => 'inpatient' == $this->resource->claimFormattable->type_of_medical_assistance
                ? $patientDischargeHour
                : '',
            '17' => $patienStatus,
            '18' => $patienConditionCodes->get(0),
            '19' => $patienConditionCodes->get(1),
            '20' => $patienConditionCodes->get(2),
            '21' => $patienConditionCodes->get(3),
            '22' => $patienConditionCodes->get(4),
            '23' => $patienConditionCodes->get(5),
            '24' => $patienConditionCodes->get(6),
            '25' => $patienConditionCodes->get(7),
            '26' => $patienConditionCodes->get(8),
            '27' => $patienConditionCodes->get(9),
            '28' => $patienConditionCodes->get(10),
            '29' => '',
            '30' => '',
            '31' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'DATE_A' => '',
                'DATE_B' => '',
            ],
            '32' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'DATE_A' => '',
                'DATE_B' => '',
            ],
            '33' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'DATE_A' => '',
                'DATE_B' => '',
            ],
            '34' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'DATE_A' => '',
                'DATE_B' => '',
            ],
            '35' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'FROM_A' => '',
                'FROM_B' => '',
                'THROUGH_A' => '',
                'THROUGH_B' => '',
            ],
            '36' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'FROM_A' => '',
                'FROM_B' => '',
                'THROUGH_A' => '',
                'THROUGH_B' => '',
            ],
            '37' => '',
            '38' => [
                'name' => $insuranceCompany?->name ?? '',
                'address1' => $insuranceCompanyAddress->address ?? '',
                'address3' => substr($insuranceCompanyAddress->city ?? '', 0, 24).' '.substr($insuranceCompanyAddress->state ?? '', 0, 3).substr($insuranceCompanyAddress->zip ?? '', 0, 12) ?? '',
            ],
            '39' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'CODE_C' => '',
                'CODE_D' => '',
                'AMOUNT_A' => '',
                'AMOUNT_B' => '',
                'AMOUNT_C' => '',
                'AMOUNT_D' => '',
            ],
            '40' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'CODE_C' => '',
                'CODE_D' => '',
                'AMOUNT_A' => '',
                'AMOUNT_B' => '',
                'AMOUNT_C' => '',
                'AMOUNT_D' => '',
            ],
            '41' => [
                'CODE_A' => '',
                'CODE_B' => '',
                'CODE_C' => '',
                'CODE_D' => '',
                'AMOUNT_A' => '',
                'AMOUNT_B' => '',
                'AMOUNT_C' => '',
                'AMOUNT_D' => '',
            ],
            '42' => [
                0 => '',
                1 => '',
                2 => '',
            ],
            '43' => [
                0 => '',
                1 => '',
                2 => '',
            ],
            '44' => '',
            '45' => '',
            '46' => '',
            '47' => '',
            '48' => '',
            '49' => '',
            '50' => '',
            '51' => '',
            '52' => '',
            '53' => '',
            '54' => '',
            '55' => '',
            '56' => '',
            '57' => '',
            '58' => '',
            '59' => '',
            '60' => '',
            '61' => '',
            '62' => '',
            '63' => '',
            '64' => '',
            '65' => '',
            '66' => '',
            '67' => '',
            '68' => '',
            '69' => '',
            '70' => '',
            '71' => '',
            '72' => '',
            '73' => '',
            '74' => '',
            '75' => '',
            '76' => '',
            '77' => '',
            '78' => '',
            '79' => '',
            '80' => '',
            '81' => '',
        ];
    }
}
