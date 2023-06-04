<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\FieldInformationProfessional;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\Patient;
use App\Models\TypeCatalog;
use Carbon\Carbon;
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
            $enums = collect(FieldInformationProfessional::cases());
            $otherField = null;
            $currentField = null;
            $currentOccupationField = null;
            $hospitalizationField = null;
            $additionalField = null;

            foreach ($physicianOrSupplierInfo->claimDateInformations ?? [] as $service) {
                $item = $enums->first(fn ($item) => $item->value === (int) $service->field_id);
                $field = is_null($item) ? TypeCatalog::find($service->field_id) : null;
                $description = $item?->getName() ?? $field?->description ?? '';

                if (str_contains($description, '14.')) {
                    if (!isset($currentField)) {
                        $currentField = $service;
                    }
                } elseif (str_contains($description, '15.')) {
                    if (!isset($otherField)) {
                        $otherField = $service;
                    }
                } elseif (str_contains($description, '16.')) {
                    if (!isset($currentOccupationField)) {
                        $currentOccupationField = $service;
                    }
                } elseif (str_contains($description, '18.')) {
                    if (!isset($hospitalizationField)) {
                        $hospitalizationField = $service;
                    }
                } elseif (str_contains($description, '19.')) {
                    /*
                     * @todo Formato Correcto "QualifierIdentificators Descripcion   Qualifier.." MAX:71caracteres
                     * Preguntar por los ientificadores!!
                     * */
                    $from_date = !empty($service->from_date_or_current)
                        ? Carbon::createFromFormat('Y-m-d', $service->from_date_or_current)->format('m/d/Y')
                        : '';
                    $to_date = !empty($service->to_date)
                        ? Carbon::createFromFormat('Y-m-d', $service->to_date)->format('m/d/Y')
                        : '';
                    $additionalField .= ((empty($additionalField)
                        ? ''
                        : (isset($service->qualifier)
                            ? '   '
                            : '')).
                        ($service->qualifier?->code.(empty($service->description) ? '' : ' '.$service->description).
                        ((!empty($service->from_date_or_current) || !empty($service->to_date)) ? ' ' : '').
                        $from_date.
                        ((!empty($service->from_date_or_current) && !empty($service->to_date)) ? ' - ' : '').
                        $to_date));
                }
            }

            $currentDate = explode('-', $currentField->from_date_or_current ?? '');
            $otherDate = explode('-', $otherField->from_date_or_current ?? '');
            $currentOccupationFrom = explode('-', $currentOccupationField->from_date_or_current ?? '');
            $currentOccupationTo = explode('-', $currentOccupationField->to_date ?? '');

            $hospitalizationFrom = explode('-', $hospitalizationField->from_date_or_current ?? '');
            $hospitalizationTo = explode('-', $hospitalizationField->to_date ?? '');
        }

        $provider = ($request->referred_id)
            ? HealthProfessional::find($request->referred_id)
            : $this->resource->referred;
        $providerProfile = $provider?->user?->profile;
        $providerCode = ($request->referred_provider_role_id)
            ? TypeCatalog::find($request->referred_provider_role_id)?->code
            : $this->resource->referredProviderRole?->code;

        $claimServices = $request->claim_form_services ?? $this->resource->claimFormattable->claimFormServices ?? [];

        foreach ($request->diagnoses ?? $this->resource->diagnoses ?? [] as $diagnosis) {
            $diag = Diagnosis::find($diagnosis->pivot->diagnosis_id ?? $diagnosis['diagnosis_id']);
            $diagnoses[$diagnosis->pivot->item ?? $diagnosis['item']] = $diag->code;
        }

        $company = Company::find($request->company_id ?? $this->resource->company_id ?? null);
        $companyAddress = isset($company)
            ? $company?->addresses()->select(
                'country',
                'address',
                'city',
                'state',
                'zip',
            )->first()
            : null;
        $companyContact = $company->contacts()->select(
            'phone'
        )->first() ?? null;

        $facility = Facility::find($request->facility_id ?? $this->resource->facility_id ?? null);
        $facilityAddress = isset($facility)
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
        $subscriberBirthdate = explode('-', $subscriber?->date_of_birth ?? '');
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

        foreach ($claimServices ?? [] as $index => $item) {
            $arrayPrice = explode('.', $item['price'] ?? '');
            $totalCharge += $item['price'] ?? 0;
            $totalCopay += $item['copay'] ?? 0;
            $fromService = explode('-', $item['from_service'] ?? '');
            $toService = explode('-', $item['to_service'] ?? '');
            /* 24A */
            $resultServices['from_year_A'.($index + 1)] = $fromService[0] ?? '';
            $resultServices['from_month_A'.($index + 1)] = $fromService[1] ?? '';
            $resultServices['from_day_A'.($index + 1)] = $fromService[2] ?? '';
            $resultServices['to_year_A'.($index + 1)] = $toService[0] ?? '';
            $resultServices['to_month_A'.($index + 1)] = $toService[1] ?? '';
            $resultServices['to_day_A'.($index + 1)] = $toService[2] ?? '';
            /* 24B */
            $resultServices['pos_B'.($index + 1)] = $item->placeOfService?->code ?? '';
            /* 24C */
            $resultServices['emg_C'.($index + 1)] = ($item['emg']) ? 'Y' : '';
            /* 24D */
            $resultServices['procedure_D'.($index + 1)] = $item->procedure?->code;
            $resultServices['modifier1_D'.($index + 1)] = $item['modifiers'][0]['name'] ?? '';
            $resultServices['modifier2_D'.($index + 1)] = $item['modifiers'][1]['name'] ?? '';
            $resultServices['modifier3_D'.($index + 1)] = $item['modifiers'][2]['name'] ?? '';
            $resultServices['modifier4_D'.($index + 1)] = $item['modifiers'][3]['name'] ?? '';
            /* 24E */
            $resultServices['pointer_E'.($index + 1)] = ($item['diagnostic_pointers'][0] ?? '').
            ($item['diagnostic_pointers'][1] ?? '').($item['diagnostic_pointers'][2] ?? '').($item['diagnostic_pointers'][3] ?? '');
            /* 24F */
            $resultServices['charges_F'.($index + 1)] = str_replace(',', '', $arrayPrice[0] ?? '');
            $resultServices['charges_decimal_F'.($index + 1)] = $arrayPrice[1] ?? '';
            /* 24G */
            $resultServices['days_G'.($index + 1)] = $item->days_or_units ?? '';
            /* 24H */
            $resultServices['epsdt_H'.($index + 1)] = $item->epsdt?->code ?? '';
            $resultServices['family_planing_H'.($index + 1)] = $item->familyPlanning?->code ?? '';
            /** 24I */
            $tax_id = $provider->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $resultServices['qualifier_I'.($index + 1)] = !empty($tax_id) ? 'ZZ' : '';
            /* 24J */
            $resultServices['npi_J'.($index + 1)] = str_replace('-', '', $provider->npi ?? '');
            $resultServices['tax_J'.($index + 1)] = str_replace('-', '', $tax_id);
        }
        $arrayCharge = explode('.', (string) $totalCharge ?? '');
        $arrayCopay = explode('.', (string) $totalCopay ?? '');

        return [
            'insurance_company' => [
                'name' => $insuranceCompany->name ?? '',
                'address1' => $insuranceCompanyAddress->address ?? '',
                'address2' => '',
                'address3' => substr($insuranceCompanyAddress->city ?? '', 0, 24).', '.substr($insuranceCompanyAddress->state ?? '', 0, 3).substr(str_replace('-', '', $insuranceCompanyAddress->zip ?? ''), 0, 12) ?? '',
            ],
            '1' => 'Medicare',
            '1a' => $higherOrderPolicy->policy_number ?? '',
            '2' => $patient
                ? ($patient->user->profile->last_name.
                ($patient->user?->profile?->nameSuffix?->description ? ' '.
                $patient->user->profile->nameSuffix->description : '').', '.
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
                'zip' => str_replace('-', '', substr($patientAddress->zip ?? '', 0, 12)),
                'code_area' => str_replace('-', '', substr($patientContact->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($patientContact->phone ?? '', 3, 10)),
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
                'zip' => str_replace('-', '', substr($subscriberAddress->zip ?? '', 0, 12)),
                'code_area' => str_replace('-', '', substr($subscriberContact->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($subscriberContact->phone ?? '', 3, 10)),
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
            '9d' => isset($lowerOrderPolicy->insurancePlan)
                ? ((empty($lowerOrderPolicy->insurancePlan->payer_id ?? '')
                    ? ''
                    : ''/**$lowerOrderPolicy->insurancePlan->payer_id.' - '*/).
                    ($lowerOrderPolicy->insurancePlan->name ?? ''))
                : '',
            '10' => '',
            '10a' => $patientOrInsuredInfo['employment_related_condition'] ?? false,
            '10b' => [
                'value' => $patientOrInsuredInfo['auto_accident_related_condition'] ?? false,
                'place_state' => substr($patientOrInsuredInfo['auto_accident_place_state'] ?? '', 0, 2),
            ],
            '10c' => $patientOrInsuredInfo['other_accident_related_condition'] ?? false,
            '10d' => '',
            '11' => $higherOrderPolicy->group_number ?? '',
            '11a' => [
                'year' => $subscriberBirthdate[0] ?? '',
                'month' => $subscriberBirthdate[1] ?? '',
                'day' => $subscriberBirthdate[2] ?? '',
                'sex' => strtoupper($subscriber->sex ?? ''),
            ],
            '11b' => '',
            '11c' => isset($higherOrderPolicy->insurancePlan)
                ? ((empty($higherOrderPolicy->insurancePlan->payer_id ?? '')
                    ? ''
                    : ''/**$higherOrderPolicy->insurancePlan->payer_id.' - '*/).
                    ($higherOrderPolicy->insurancePlan->name ?? ''))
                : '',
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
                'qualifier' => $currentField?->qualifier?->code ?? '',
            ],
            '15' => [
                'year' => $otherDate[0] ?? '',
                'month' => $otherDate[1] ?? '',
                'day' => $otherDate[2] ?? '',
                'qualifier' => $otherField?->qualifier?->code ?? '',
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
                'name' => isset($providerProfile)
                ? ($providerProfile->first_name.
                (!empty($providerProfile->middle_name)
                    ? ' '.substr($providerProfile->middle_name, 0, 1)
                    : '').
                ' '.$providerProfile->first_name.
                (isset($providerProfile->nameSuffix)
                    ? ' '.$providerProfile->nameSuffix->description
                    : ''))
                : '',
            ],
            '17a' => [
                'code' => (!isset($provider->npi) && isset($provider->upin)) ? 'G2' : '',
                'value' => (!isset($provider->npi) && isset($provider->upin)) ? str_replace('-', '', $provider->upin ?? '') : '',
            ],
            '17b' => str_replace('-', '', $provider->npi ?? ''),
            '18' => [
                'from_year' => $hospitalizationFrom[0] ?? '',
                'from_month' => $hospitalizationFrom[1] ?? '',
                'from_day' => $hospitalizationFrom[2] ?? '',
                'to_year' => $hospitalizationTo[0] ?? '',
                'to_month' => $hospitalizationTo[1] ?? '',
                'to_day' => $hospitalizationTo[2] ?? '',
            ],
            '19' => $additionalField ?? '',
            '20' => [
                'value' => $physicianOrSupplierInfo->outside_lab ?? false,
                'charges' => ($physicianOrSupplierInfo->outside_lab ?? false)
                    ? str_replace([',', '.'], '', $physicianOrSupplierInfo->charges ?? '')
                    : '',
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
            '25' => [
                'num' => str_replace('-', '', $company->ein ?? $company->ssn ?? ''),
                'value' => !empty($company->ein)
                    ? 'EIN'
                    : (!empty($company->ssn)
                        ? 'SSN'
                        : ''),
            ],
            '26' => $physicianOrSupplierInfo->patient_account_num ?? '',
            '27' => $physicianOrSupplierInfo->accept_assignment ?? false,
            '28' => [
                'total_charge' => $arrayCharge[0] ?? '',
                'total_charge_decimal' => (('' != $arrayCharge[0])
                    ? (str_pad($arrayCharge[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00')
                    : ''),
            ],
            '29' => [
                'total_copay' => $arrayCopay[0] ?? '',
                'total_copay_decimal' => (('' != $arrayCopay[0])
                    ? (str_pad($arrayCopay[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00')
                    : ''),
            ],
            '30' => '',
            '31' => [
                'signed' => 'Signature on File',
                'date' => now()->format('m/d/Y'),
            ],
            '32' => [
                'name' => $facility->name ?? '',
                'address1' => $facilityAddress->address ?? '',
                'address2' => substr($facilityAddress->city ?? '', 0, 24).', '.substr($facilityAddress->state ?? '', 0, 3).substr(str_replace('-', '', $facilityAddress->zip ?? ''), 0, 12) ?? '',
            ],
            '32a' => str_replace('-', '', $facility->npi ?? ''),
            '32b' => '',
            '33' => [
                'name' => $company->name ?? '',
                'address1' => $companyAddress->address ?? '',
                'address2' => substr($companyAddress->city ?? '', 0, 24).', '.substr($companyAddress->state ?? '', 0, 3).substr(str_replace('-', '', $companyAddress->zip ?? ''), 0, 12) ?? '',
                'code_area' => str_replace('-', '', substr($companyContact->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($companyContact->phone ?? '', 3, 10)),
            ],
            '33a' => str_replace('-', '', $company->npi ?? ''),
            '33b' => empty($company->npi) ? ((!empty($tax_id) ? 'ZZ' : '').str_replace('-', '', $tax_id)) : '',
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
        $patientDate = explode('-', $this->resource->claimFormattable?->physicianOrSupplierInformation?->admission_date ?? '');
        $patientHour = explode(':', $this->resource->claimFormattable?->physicianOrSupplierInformation?->admission_time ?? '');
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

        $company = Company::find($request->company_id ?? $this->resource->company_id ?? null);
        $companyTax = $company->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
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
            '3a' => '',
            '3b' => $patient?->companies?->find($company->id ?? null)?->pivot?->med_num ?? '',
            '4' => '',
            '5' => '',
            '6' => [
                'from' => '',
                'through' => '',
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
            '14' => '',
            '15' => '',
            '16' => '',
            '17' => '',
            '18' => '',
            '19' => '',
            '20' => '',
            '21' => '',
            '22' => '',
            '23' => '',
            '24' => '',
            '25' => '',
            '26' => '',
            '27' => '',
            '28' => '',
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
                'name' => '',
                'address1' => '',
                'address2' => '',
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
