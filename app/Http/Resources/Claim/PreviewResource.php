<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\FieldInformationProfessional;
use App\Models\Claim;
use App\Models\ClaimFormPService;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\InsuranceCompany;
use App\Models\InsurancePolicy;
use App\Models\Modifier;
use App\Models\Patient;
use App\Models\PlaceOfService;
use App\Models\Procedure;
use App\Models\TypeCatalog;
use App\Models\TypeForm;
use Carbon\Carbon;
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
        $typeFormat = $this->resource?->claimFormattable?->typeForm?->form ?? TypeForm::find($request->format ?? null)?->form ?? '';

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
            : auth()->user()?->billingCompanies->first()?->id;

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

        if (isset($request->insurance_policies)) {
            $higherOrderPolicy = InsurancePolicy::find($request->insurance_policies[0]['insurance_policy_id'] ?? null);
            $lowerOrderPolicy = InsurancePolicy::find($request->insurance_policies[1]['insurance_policy_id'] ?? null);

            if ($higherOrderPolicy) {
                $insuranceCompany = $higherOrderPolicy->insurancePlan->insuranceCompany;
            }
        } elseif (isset($this->resource)) {
            $higherOrderPolicy = $this->resource->insurancePolicies()
                ->wherePivot('order', 1)->first();
            $lowerOrderPolicy = $this->resource->insurancePolicies()
                ->wherePivot('order', 2)->first();

            if ($higherOrderPolicy) {
                $insuranceCompany = $higherOrderPolicy->insurancePlan->insuranceCompany;
            }
        }

        $subscriber = $higherOrderPolicy->own ?? true
            ? $patient?->user ?? null
            : $higherOrderPolicy?->subscribers->first();

        $subscriberOther = $lowerOrderPolicy->own ?? true
            ? $patient?->user ?? null
            : $lowerOrderPolicy?->subscribers->first();

        $patientOrInsuredInfo = $this->resource->claimFormattable?->patientOrInsuredInformation ?? $request->patient_or_insured_information ?? null;
        $physicianOrSupplierInfo = $this->resource->claimFormattable?->physicianOrSupplierInformation ?? $request->physician_or_supplier_information ?? null;

        if (isset($physicianOrSupplierInfo->claimDateInformations) || isset($physicianOrSupplierInfo['claim_date_informations'])) {
            $enums = collect(FieldInformationProfessional::cases());
            $otherField = null;
            $currentField = null;
            $currentOccupationField = null;
            $hospitalizationField = null;
            $additionalField = null;

            foreach ($physicianOrSupplierInfo->claimDateInformations ?? $physicianOrSupplierInfo['claim_date_informations'] ?? [] as $service) {
                $item = $enums->first(fn ($item) => $item->value === (int) $service['field_id']);
                $field = is_null($item) ? TypeCatalog::find($service['field_id']) : null;
                $description = $item?->getName() ?? $field['description'] ?? '';

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
                    $from_date = !empty($service['from_date_or_current'])
                        ? Carbon::createFromFormat('Y-m-d', $service['from_date_or_current'])->format('m/d/Y')
                        : '';
                    $to_date = !empty($service['to_date'])
                        ? Carbon::createFromFormat('Y-m-d', $service['to_date'])->format('m/d/Y')
                        : '';
                    $additionalField .= ((empty($additionalField)
                        ? ''
                        : ((isset($service['qualifier']) || !empty($service['qualifier_id']))
                            ? '   '
                            : ''))
                        .((isset($service->qualifier) ? $service->qualifier?->code : TypeCatalog::find($service['qualifier_id'] ?? null)?->code).(empty($service['description']) ? '' : ' '.$service['description'])
                        .((!empty($service['from_date_or_current']) || !empty($service['to_date'])) ? ' ' : '')
                        .$from_date
                        .((!empty($service['from_date_or_current']) && !empty($service['to_date'])) ? ' - ' : '')
                        .$to_date));
                }
            }

            $currentDate = explode('-', $currentField['from_date_or_current'] ?? '');
            $otherDate = explode('-', $otherField['from_date_or_current'] ?? '');
            $currentOccupationFrom = explode('-', $currentOccupationField['from_date_or_current'] ?? '');
            $currentOccupationTo = explode('-', $currentOccupationField['to_date'] ?? '');

            $hospitalizationFrom = explode('-', $hospitalizationField['from_date_or_current'] ?? '');
            $hospitalizationTo = explode('-', $hospitalizationField['to_date'] ?? '');
        }

        $provider = ($request->referred_id)
            ? HealthProfessional::find($request->referred_id)
            : $this->resource?->referred;
        $providerProfile = $provider?->user?->profile;
        $providerCode = ($request->referred_provider_role_id)
            ? TypeCatalog::find($request->referred_provider_role_id)?->code
            : $this->resource?->referredProviderRole?->code;

        $billingProvider = ($request->billing_provider_id)
            ? HealthProfessional::find($request->billing_provider_id)
            : $this->resource->billingProvider;
        $billingProviderProfile = $billingProvider?->user?->profile;

        $claimServices = $request->claim_services ?? $this->resource->claimFormattable->claimFormServices ?? [];

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
        $patientBirthdate = explode('-', $patient?->user->profile->date_of_birth ?? '');
        $patientAddress = $patient?->user?->addresses()?->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;
        $patientContact = $patient?->user->contacts()->select(
            'phone'
        )->first() ?? null;
        $subscriberBirthdate = explode('-', $subscriber?->date_of_birth ?? $subscriber?->profile?->date_of_birth ?? '');
        $subscriberAddress = $subscriber?->addresses()->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;
        $subscriberContact = $subscriber?->contacts()->select(
            'phone'
        )->first() ?? null;

        $resultServices = [];
        $totalCharge = 0;
        $totalCopay = 0;

        foreach ($claimServices ?? [] as $index => $item) {
            $arrayPrice = explode('.', (string) ($item['price'] ?? ''));
            $totalCharge += $item['price'] ?? 0;
            $totalCopay += $item['copay'] ?? 0;
            $fromService = explode('-', $item['from_service'] ?? '');
            $toService = explode('-', $item['to_service'] ?? '');
            /* 24A */
            $resultServices['from_year_A'.($index + 1)] = substr($fromService[0] ?? '', 2, 2);
            $resultServices['from_month_A'.($index + 1)] = $fromService[1] ?? '';
            $resultServices['from_day_A'.($index + 1)] = $fromService[2] ?? '';
            $resultServices['to_year_A'.($index + 1)] = substr($toService[0] ?? '', 2, 2);
            $resultServices['to_month_A'.($index + 1)] = $toService[1] ?? '';
            $resultServices['to_day_A'.($index + 1)] = $toService[2] ?? '';
            /* 24B */
            $resultServices['pos_B'.($index + 1)] = isset($item->placeOfService) ? $item->placeOfService?->code : PlaceOfService::find($item['place_of_service_id'] ?? null)?->code ?? '';
            /* 24C */
            $resultServices['emg_C'.($index + 1)] = ($item['emg']) ? 'Y' : '';
            /* 24D */
            $resultServices['procedure_D'.($index + 1)] = isset($item['procedure']) ? $item['procedure']?->code : Procedure::find($item['procedure_id'] ?? null)?->code ?? '';
            $resultServices['modifier1_D'.($index + 1)] = isset($item['modifiers'][0]) ? $item['modifiers'][0]['name'] : Modifier::find($item['modifier_ids'][0] ?? null)?->modifier ?? '';
            $resultServices['modifier2_D'.($index + 1)] = isset($item['modifiers'][1]) ? $item['modifiers'][1]['name'] : Modifier::find($item['modifier_ids'][1] ?? null)?->modifier ?? '';
            $resultServices['modifier3_D'.($index + 1)] = isset($item['modifiers'][2]) ? $item['modifiers'][2]['name'] : Modifier::find($item['modifier_ids'][2] ?? null)?->modifier ?? '';
            $resultServices['modifier4_D'.($index + 1)] = isset($item['modifiers'][3]) ? $item['modifiers'][3]['name'] : Modifier::find($item['modifier_ids'][3] ?? null)?->modifier ?? '';
            /* 24E */
            $resultServices['pointer_E'.($index + 1)] = ($item['diagnostic_pointers'][0] ?? '')
            .($item['diagnostic_pointers'][1] ?? '').($item['diagnostic_pointers'][2] ?? '').($item['diagnostic_pointers'][3] ?? '');
            /* 24F */
            $resultServices['charges_F'.($index + 1)] = str_replace(',', '', $arrayPrice[0] ?? '');
            $resultServices['charges_decimal_F'.($index + 1)] = $arrayPrice[1] ?? '';
            /* 24G */
            $resultServices['days_G'.($index + 1)] = $item['days_or_units'] ?? '';
            /* 24H */
            $resultServices['epsdt_H'.($index + 1)] = isset($item->epsdt) ? $item->epsdt?->code : TypeCatalog::find($item['epsdt_id'] ?? null)?->code ?? '';
            $resultServices['family_planing_H'.($index + 1)] = isset($item->familyPlanning) ? $item->familyPlanning?->code : TypeCatalog::find($item['family_planning_id'] ?? null)?->code ?? '';
            /** 24I */
            $tax_id = $provider?->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $tax_id_BP = $billingProvider?->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $resultServices['qualifier_I'.($index + 1)] = !empty($tax_id_BP) ? 'ZZ' : '';
            /* 24J */
            $resultServices['npi_J'.($index + 1)] = str_replace('-', '', $billingProvider->npi ?? '');
            $resultServices['tax_J'.($index + 1)] = str_replace('-', '', $tax_id_BP);
        }
        $arrayCharge = explode('.', (string) $totalCharge ?? '');
        $arrayCopay = explode('.', (string) $totalCopay ?? '');
        $dateOfFirstService = !empty($claimServices[0]['from_service'] ?? '')
            ? Carbon::createFromFormat('Y-m-d', $claimServices[0]['from_service'] ?? '')->format('m/d/Y')
            : '';
        $options = ['Medicare', 'Medicaid', 'Tricare', 'Champva', 'Group', 'Feca'];
        $searchString = $higherOrderPolicy?->insurancePlan?->insType?->code ?? '';
        $key = array_search(strtolower($searchString), array_map('strtolower', $options));

        return [
            'insurance_company' => [
                'name' => $insuranceCompany->name ?? '',
                'address1' => $insuranceCompanyAddress->address ?? '',
                'address2' => '',
                'address3' => substr($insuranceCompanyAddress->city ?? '', 0, 24).', '.substr($insuranceCompanyAddress->state ?? '', 0, 3).substr(str_replace('-', '', $insuranceCompanyAddress->zip ?? ''), 0, 12) ?? '',
            ],
            '1' => (false !== $key) ? $options[$key] : 'Other',
            '1a' => $higherOrderPolicy->policy_number ?? '',
            '2' => $patient
                ? ($patient?->user->profile->last_name
                .($patient?->user?->profile?->nameSuffix?->description ? ' '
                .$patient?->user->profile->nameSuffix->description : '').', '
                .$patient?->user->profile->first_name
                .($patient?->user->profile->middle_name
                    ? ', '.substr($patient?->user->profile->middle_name, 0, 1)
                    : ''))
                : '',
            '3' => [
                'year' => substr($patientBirthdate[0] ?? '', 2, 2),
                'month' => $patientBirthdate[1] ?? '',
                'day' => $patientBirthdate[2] ?? '',
                'sex' => strtoupper($patient?->user->profile->sex ?? ''),
            ],
            '4' => isset($subscriber)
                ? (($subscriber->last_name ?? $subscriber->profile->last_name)
                .', '.($subscriber->first_name ?? $subscriber->profile->first_name)
                .($subscriber->middle_name ?? $subscriber->profile->middle_name ?? null
                    ? ', '.substr($subscriber->middle_name ?? ($subscriber->profile->middle_name ?? ''), 0, 1)
                    : ''))
                : '',
            '5' => [
                'address' => substr($patientAddress->address ?? '', 0, 28),
                'city' => substr($patientAddress->city ?? '', 0, 24),
                'state' => substr($patientAddress->state ?? '', 0, 3),
                'zip' => str_replace('-', '', substr($patientAddress->zip ?? '', 0, 12)),
                'code_area' => str_replace('-', '', substr($patientContact->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($patientContact->phone ?? '', 3, 10)),
            ],
            '6' => ($higherOrderPolicy->own ?? false)
                ? 'self'
                : (str_contains(strtolower($subscriber?->relationship?->description ?? ''), 'spouse')
                    ? 'spouse'
                    : (str_contains(strtolower($subscriber?->relationship?->description ?? ''), 'child')
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
            '9' => isset($subscriberOther)
                ? (($subscriberOther->last_name ?? $subscriberOther->profile->last_name)
                .', '.($subscriberOther->first_name ?? $subscriberOther->profile->first_name)
                .($subscriberOther->middle_name ?? $subscriberOther->profile->middle_name ?? null
                    ? ', '.substr($subscriberOther->middle_name ?? ($subscriberOther->profile->middle_name ?? ''), 0, 1)
                    : ''))
                : '',
            '9a' => $lowerOrderPolicy->policy_number ?? '',
            '9b' => '',
            '9c' => '',
            '9d' => isset($lowerOrderPolicy->insurancePlan)
                ? ((empty($lowerOrderPolicy->insurancePlan->payer_id ?? '')
                    ? ''
                    : ''/**$lowerOrderPolicy->insurancePlan->payer_id.' - '*/)
                    .($lowerOrderPolicy->insurancePlan->name ?? ''))
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
                'year' => substr($subscriberBirthdate[0] ?? '', 2, 2),
                'month' => $subscriberBirthdate[1] ?? '',
                'day' => $subscriberBirthdate[2] ?? '',
                'sex' => strtoupper($subscriber?->sex ?? $subscriber?->profile?->sex ?? ''),
            ],
            '11b' => '',
            '11c' => isset($higherOrderPolicy->insurancePlan)
                ? ((empty($higherOrderPolicy->insurancePlan->payer_id ?? '')
                    ? ''
                    : ''/**$higherOrderPolicy->insurancePlan->payer_id.' - '*/)
                    .($higherOrderPolicy->insurancePlan->name ?? ''))
                : '',
            '11d' => isset($lowerOrderPolicy) ? true : false,
            '12' => [
                'signed' => ($patientOrInsuredInfo['patient_signature'] ?? false) ? 'Signature on File' : '',
                'date' => ($patientOrInsuredInfo['patient_signature'] ?? false) ? $dateOfFirstService : '',
            ],
            '13' => ($patientOrInsuredInfo['insured_signature'] ?? false) ? 'Signature on File' : '',
            '14' => [
                'year' => substr($currentDate[0] ?? '', 2, 2),
                'month' => $currentDate[1] ?? '',
                'day' => $currentDate[2] ?? '',
                'qualifier' => $currentField?->qualifier?->code ?? TypeCatalog::find($currentField['qualifier_id'] ?? null)?->code ?? '',
            ],
            '15' => [
                'year' => substr($otherDate[0] ?? '', 2, 2),
                'month' => $otherDate[1] ?? '',
                'day' => $otherDate[2] ?? '',
                'qualifier' => $otherField?->qualifier?->code ?? TypeCatalog::find($otherField['qualifier_id'] ?? null)?->code ?? '',
            ],
            '16' => [
                'from_year' => substr($currentOccupationFrom[0] ?? '', 2, 2),
                'from_month' => $currentOccupationFrom[1] ?? '',
                'from_day' => $currentOccupationFrom[2] ?? '',
                'to_year' => substr($currentOccupationTo[0] ?? '', 2, 2),
                'to_month' => $currentOccupationTo[1] ?? '',
                'to_day' => $currentOccupationTo[2] ?? '',
            ],
            '17' => [
                'code' => $providerCode ?? '',
                'name' => isset($providerProfile)
                ? ($providerProfile->first_name
                .(!empty($providerProfile->middle_name)
                    ? ' '.substr($providerProfile->middle_name, 0, 1)
                    : '')
                .' '.$providerProfile->last_name
                .(isset($providerProfile->nameSuffix)
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
                'from_year' => substr($hospitalizationFrom[0] ?? '', 2, 2),
                'from_month' => $hospitalizationFrom[1] ?? '',
                'from_day' => $hospitalizationFrom[2] ?? '',
                'to_year' => substr($hospitalizationTo[0] ?? '', 2, 2),
                'to_month' => $hospitalizationTo[1] ?? '',
                'to_day' => $hospitalizationTo[2] ?? '',
            ],
            '19' => $additionalField ?? '',
            '20' => [
                'value' => $request->physician_or_supplier_information['outside_lab'] ?? $physicianOrSupplierInfo->outside_lab ?? false,
                'charges' => ($request->physician_or_supplier_information['outside_lab'] ?? false)
                    ? str_replace([',', '.'], '', (string) ($request->physician_or_supplier_information['charges'] ?? ''))
                    : (($physicianOrSupplierInfo->outside_lab ?? false)
                        ? str_replace([',', '.'], '', (string) ($physicianOrSupplierInfo->charges ?? ''))
                        : ''),
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
            '23' => $request->physician_or_supplier_information['prior_authorization_number'] ?? $physicianOrSupplierInfo->prior_authorization_number ?? '',
            '24' => $resultServices,
            '25' => [
                'num' => str_replace('-', '', $company->ein ?? $company->ssn ?? ''),
                'value' => !empty($company->ein)
                    ? 'EIN'
                    : (!empty($company->ssn)
                        ? 'SSN'
                        : ''),
            ],
            '26' => $patient?->companies()
                ?->wherePivot('billing_company_id', $bC)->first()
                ?->pivot?->med_num ?? $patient?->code,
            '27' => $request->physician_or_supplier_information['accept_assignment'] ?? $physicianOrSupplierInfo->accept_assignment ?? false,
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
                'name' => isset($billingProviderProfile)
                    ? ($billingProviderProfile->first_name
                    .(!empty($billingProviderProfile->middle_name)
                        ? ' '.substr($billingProviderProfile->middle_name, 0, 1)
                        : '')
                    .' '.$billingProviderProfile->last_name
                    .(isset($billingProviderProfile->nameSuffix)
                        ? ' '.$billingProviderProfile->nameSuffix->description
                        : ''))
                    : '',
                'signed' => 'Signature on File',
                'date' => $dateOfFirstService ?? '',
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
            : auth()->user()?->billingCompanies->first()?->id;

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

        $patientBirthdate = explode('-', $patient?->user->profile->date_of_birth ?? '');
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
        $patientAddress = $patient?->user?->addresses()?->select(
            'country',
            'address',
            'city',
            'state',
            'zip',
        )->first() ?? null;

        $claimCreateDate = explode('-', (string) $this->resource?->created_at?->format('Y-m-d') ?? '');

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

        $patientContact = $patient?->user->contacts()->select(
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

        $claimServices = collect($this->resource->claimFormattable->claimFormServices ?? []);

        return [
            '1' => [
                'name' => substr($company->name ?? '', 0, 30),
                'address1' => substr($companyAddress->address ?? '', 0, 30),
                'address2' => substr($companyAddress->city ?? '', 0, 24),
                'state' => substr($companyAddress->state ?? '', 0, 3),
                'zip' => substr($companyAddress->zip ?? '', 0, 5),
            ],
            '2' => [
                'name' => substr($company->name ?? '', 0, 30),
                'address1' => substr($companyAddress->address ?? '', 0, 30),
                'address2' => substr($companyAddress->city ?? '', 0, 24),
                'state' => substr($companyAddress->state ?? '', 0, 3),
                'zip' => substr($companyAddress->zip ?? '', 0, 5),
            ],
            '3a' => $this->resource->control_number ?? '',
            '3b' => $patient?->companies?->find($company->id ?? null)?->pivot?->med_num ?? '',
            '4' => '0'
                .substr((string) $facility->facilityType->type ?? '', 0, 1)
                .('inpatient' == $this->resource->claimFormattable->type_of_medical_assistance
                    ? '1'
                    : '3'
                )
                .($this->resource->claimFormattable?->physicianOrSupplierInformation?->billClassification?->code ?? ''),
            '5' => $company->npi,
            '6' => [
                'from' => (($patientDate[1] ?? '').' '.($patientDate[2] ?? '').' '.substr($patientDate[0] ?? '', 0, 2)),
                'through' => (($patientDischarge[1] ?? '').' '.($patientDischarge[2] ?? '').' '.substr($patientDischarge[0] ?? '', 0, 2)),
            ],
            '7' => '',
            '8a' => $patient?->code ?? '',
            '8b' => $patient
                ? ($patient?->user->profile->last_name.', '
                .$patient?->user->profile->first_name
                .($patient?->user->profile->middle_name
                    ? ', '.substr($patient?->user->profile->middle_name, 0, 1)
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
            '11' => strtoupper($patient?->user->profile->sex ?? ''),
            '12' => (($patientDate[1] ?? '').' '.($patientDate[2] ?? '').' '.substr($patientDate[0] ?? '', 0, 2)),
            '13' => $patientHour[0] ?? '',
            '14' => $patienAdmissionType,
            '15' => $patienAdmissionSource,
            '16' => 'inpatient' == $this->resource->claimFormattable->type_of_medical_assistance
                ? $patientDischargeHour[0] ?? ''
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
            '42' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return $claimFormService->revenueCode->code ?? '';
                })
                ->toArray() ?? '',
            '43' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return $claimFormService->procedure->description ?? '';
                })
                ->toArray() ?? '',
            '44' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return $claimFormService->price ?? '';
                })
                ->toArray() ?? '',
            '45' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    $date = explode('-', $claimFormService->procedure->start_date ?? '');

                    return ($date[1] ?? '').' '.($date[2] ?? '').' '.($date[0] ?? '');
                })
                ->toArray(),
            '46' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return 1;
                })
                ->toArray()[0] ?? '',
            '47' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return $claimFormService->price ?? '';
                })
                ->toArray() ?? '',
            '48' => '',
            '49' => '',
            'ta' => '001',
            'tb' => [
                'page' => '1',
                'total' => '1',
            ],
            'tc' => (($claimCreateDate[1] ?? '').' '.($claimCreateDate[2] ?? '').' '.substr($claimCreateDate[0] ?? '', 0, 2)),
            'td' => $claimServices
                ->map(function (ClaimFormPService $claimFormService) {
                    return (int) $claimFormService->price ?? '';
                })
                ->sum(),
            'te' => '',
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
