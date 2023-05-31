<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\Patient;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

final class PreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
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
        }

        if (isset($request->service_provider_id)) {
            $provider = HealthProfessional::find($request->service_provider_id);
            $providerCode = 'DN';
        } elseif (isset($request->referred_id)) {
            $provider = HealthProfessional::find($request->referred_id);
            $providerCode = 'DK';
        }

        $billingProvider = HealthProfessional::find($request->billing_provider_id ?? $this->resource->billing_provider_id ?? null);
        $claimServices = $request->claim_form_services ?? $this->resource->claimFormattable->claimFormServices ?? [];

        foreach ($request->diagnoses ?? [] as $diagnosis) {
            $diag = Diagnosis::find($diagnosis->pivot->diagnosis_id ?? $diagnosis['diagnosis_id']);
            $diagnoses[$diagnosis->pivot->item ?? $diagnosis['item']] = $diag->code;
        }

        $company = Company::find($request->company_id ?? $this->resource->company_id ?? null);
        $facility = Facility::find($request->facility_id ?? $this->resource->facility_id ?? null);
        $insuranceCompanyAddress = isset($insuranceCompany)
            ? $insuranceCompany->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()?->toArray()
            : null;
        $patientBirthdate = explode('-', $patient->user->profile->date_of_birth ?? '');

        return [
            'insurance_company' => [
                'name' => $insuranceCompany->name ?? '',
                'address1' => $insuranceCompanyAddress->address ?? '',
                'address2' => $insuranceCompanyAddress->address ?? '',
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
                'sex' => $patient->user->profile->sex ?? '',
            ],
            '4' => ($subscriber->last_name ?? $subscriber->profile->last_name).
                ', '.($subscriber->first_name ?? $subscriber->profile->first_name).
                ($subscriber->middle_name ?? $subscriber->profile->middle_name ?? null
                    ? ', '.substr($subscriber->middle_name ?? ($subscriber->profile->middle_name ?? ''), 0, 1)
                    : ''),
            '5' => [
                'address' => $patient->user->addresses()->select(
                    'country',
                    'address',
                    'city',
                    'state',
                    'zip',
                )->first()?->toArray() ?? null,
                'contact' => $patient->user->contacts()->select(
                    'phone'
                )->first()?->toArray() ?? null,
            ],
            '6' => ($higherOrderPolicy->own ?? true)
                ? 'self'
                : (str_contains(strtolower($subscriber->relationship?->description), 'spouse')
                    ? 'spouse'
                    : (str_contains(strtolower($subscriber->relationship?->description), 'child')
                        ? 'child'
                        : 'other')),
            '7' => [
                'address' => $subscriber->addresses()->select(
                    'country',
                    'address',
                    'city',
                    'state',
                    'zip',
                )->first()?->toArray() ?? null,
                'contact' => $subscriber->contacts()->select(
                    'phone'
                )->first()?->toArray() ?? null,
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
                'state' => substr($patientOrInsuredInfo['auto_accident_place_state'] ?? '', 0, 2),
            ],
            '10c' => $patientOrInsuredInfo['other_accident_related_condition'] ?? false,
            '10d' => '',
            '11' => ('P' == $higherOrderPolicy?->typeResponsibility->code)
                ? 'NONE'
                : $higherOrderPolicy->group_number ?? '',
            '11a' => [
                'date' => $subscriber->date_of_birth ?? '',
                'sex' => $subscriber->sex ?? '',
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
                'date' => $currentField->from_date_or_current ?? '',
                'qualifier' => $currentField->qualifier?->code ?? '',
            ],
            '15' => [
                'date' => $otherField->from_date_or_current ?? '',
                'qualifier' => $otherField->qualifier?->code ?? '',
            ],
            '16' => [
                'from' => $currentOccupationField->from_date_or_current ?? '',
                'to' => $currentOccupationField->to_date ?? '',
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
                'from' => $hospitalizationField->from_date_or_current ?? '',
                'to' => $hospitalizationField->to_date ?? '',
            ],
            '19' => 'Por asignar',
            '20' => [
                'outside_lab' => $physicianOrSupplierInfo->outside_lab ?? false,
                'charges' => $physicianOrSupplierInfo->charges ?? '',
            ],
            '21' => [
                'indicator' => '0', // '9',
                'diagnoses' => $diagnoses,
            ],
            '22' => [
                'resubmision_code' => '',
                'original_code' => '',
            ],
            '23' => $physicianOrSupplierInfo->prior_authorization_number ?? '',
            '24' => $claimServices ?? [],
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
                'address' => isset($facility)
                    ? $facility->addresses()->select(
                        'country',
                        'address',
                        'city',
                        'state',
                        'zip',
                    )->first()?->toArray()
                    : null,
            ],
            '32a' => $facility->npi ?? '',
            '32b' => '',
            '33' => [
                'name' => isset($billingProvider)
                    ? ($billingProvider->user->profile->last_name.', '.
                        $billingProvider->user->profile->first_name.', '.
                        substr($billingProvider->user->profile->middle_name, 0, 1))
                    : '',
                'address' => $billingProvider->user->addresses()->select(
                    'country',
                    'address',
                    'city',
                    'state',
                    'zip',
                )->first()?->toArray() ?? null,
            ],
            '33a' => $billingProvider->npi ?? '',
            '33b' => '',
        ];
    }
}
