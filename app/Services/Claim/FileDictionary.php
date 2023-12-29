<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use App\Models\Claims\Services;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\HealthProfessional;
use App\Models\InsurancePolicy;
use App\Models\TypeCatalog;
use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Support\Collection;

final class FileDictionary extends Dictionary
{
    protected string $format = FormatType::FILE->value;

    protected function getCompanyAttribute(string $key): string
    {
        return match ($key) {
            'federal_tax' => str_replace('-', '', $this->company->getAttribute('ein') ?? $this->company->getAttribute('ssn') ?? ''),
            'federal_tax_value' => !empty($this->company->ein)
                ? 'EIN'
                : (!empty($this->company->ssn)
                    ? 'SSN'
                    : ''),
            'ein' => str_replace('-', '', $this->company->ein ?? ''),
            default => (string) $this->company->getAttribute($key),
        };
    }

    protected function getPatientCompanyAttribute(string $key): string
    {
        return (string) $this->claim
            ->demographicInformation
            ->patient
            ?->companies
            ?->find($this->company->id ?? null)
            ?->pivot
            ?->{$key} ?? '';
    }

    protected function getCompanyAddressAttribute(string $key, string $entry): string
    {
        $value = $this->claim
            ->demographicInformation
            ->company
            ->addresses
            ->where('billing_company_id', $this->claim->billing_company_id ?? null)
            ->where('address_type_id', $this->claim
                ->demographicInformation
                ->company
                ->addresses
                ->where('address_type_id', (int) $entry)
                ->count() >= 1
                    ? (int) $entry
                    : 1
            )
            ->first();

        return match ($key) {
            'address' => substr($value?->{$key} ?? '', 0, 55),
            'city' => substr($value?->{$key} ?? '', 0, 30),
            'state' => substr($value?->{$key} ?? '', 0, 2),
            'zip' => str_replace('-', '', substr($value?->{$key} ?? '', 0, 12)),
            'other_country' => $value?->country && 'US' != $value?->country
                ? $value?->country
                : '',
            default => $value?->{$key} ?? '',
        };
    }

    protected function getCompanyContactAttribute(string $key, string $entry): string
    {
        $value = $this->claim
            ->demographicInformation
            ->company
            ->contacts
            ->where('billing_company_id', $this->claim->billing_company_id ?? null)
            ->get((int) $entry);

        return match ($key) {
            'code_area' => str_replace('-', '', substr($value?->phone ?? '', 0, 3)),
            'phone' => str_replace('-', '', substr($value?->phone ?? '', 0, 10)),
            'phone_fax' => str_replace('-', '', substr($value?->phone ?? $value?->fax ?? '', 0, 10)),
            default => (string) $value?->{$key} ?? '',
        };
    }

    protected function getMedicalAssistanceTypeAttribute(): string
    {
        $type = $this->claim
            ->demographicInformation
            ->type_of_medical_assistance;

        return 'inpatient' === $type
            ? '1'
            : '0';
    }

    protected function getPatientConditionCodesAttribute(string $key): string
    {
        return collect($this->claim->patientInformation->condition_codes)
            ->map(fn ($code) => $code['code'])
            ->pad(11, '')
            ->get((int) $key);
    }

    protected function getInsTypeAttribute(string $key): string
    {
        $options = ['MED', 'MCE', 'TR', 'CH', 'GHP', 'FBL'];
        $search = $this->claim->insType()?->{$key} ?? '';
        $index = array_search(strtoupper($search), array_map('strtoupper', $options));

        return false != $index
            ? $options[$index]
            : 'OT';
    }

    protected function getHigherOrderPolicyAttribute(string $key): string
    {
        return $this->claim->higherOrderPolicy()?->{$key} ?? '';
    }

    protected function getPatientProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => ', '.$this->claim->patientProfile()?->first_name ?? '',
            'name_suffix' => !empty($this->claim->patientProfile()?->{$key}?->code)
                ? ' '.$this->claim->patientProfile()?->{$key}?->code
                : '',
            'middle_name' => !empty($this->claim->patientProfile()?->{$key})
                ? ', '.substr($this->claim->patientProfile()?->{$key}, 0, 1)
                : '',
            'year_of_birth' => explode('-', $this->claim->patientProfile()?->date_of_birth ?? '')[0] ?? '',
            'month_of_birth' => explode('-', $this->claim->patientProfile()?->date_of_birth ?? '')[1] ?? '',
            'day_of_birth' => explode('-', $this->claim->patientProfile()?->date_of_birth ?? '')[2] ?? '',
            default => $this->claim->patientProfile()?->{$key} ?? '',
        };
    }

    protected function getSubscriberAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => ', '.$this->claim->subscriber()?->{$key} ?? '',
            'name_suffix' => !empty($this->claim->subscriber()?->{$key}?->code)
                ? ' '.$this->claim->subscriber()?->{$key}?->code
                : '',
            'middle_name' => !empty($this->claim->subscriber()?->{$key})
                ? ', '.substr($this->claim->subscriber()?->{$key}, 0, 1)
                : '',
            'relationship' => $this->claim->subscriber()?->relationship->description ?? '',
            'year_of_birth' => explode('-', $this->claim->subscriber()?->date_of_birth ?? '')[0] ?? '',
            'month_of_birth' => explode('-', $this->claim->subscriber()?->date_of_birth ?? '')[1] ?? '',
            'day_of_birth' => explode('-', $this->claim->subscriber()?->date_of_birth ?? '')[2] ?? '',
            default => $this->claim->subscriber()?->{$key} ?? '',
        };
    }

    protected function getPatientAddressAttribute(string $key): string
    {
        return match ($key) {
            'address' => substr($this->claim->patientAddress()?->{$key} ?? '', 0, 55),
            'city' => substr($this->claim->patientAddress()?->{$key} ?? '', 0, 30),
            'state' => substr($this->claim->patientAddress()?->{$key} ?? '', 0, 2),
            'zip' => str_replace('-', '', substr($this->claim->patientAddress()?->{$key} ?? '', 0, 12)),
            default => $this->claim->patientAddress()?->{$key} ?? '',
        };
    }

    protected function getPatientContactAttribute(string $key): string
    {
        return match ($key) {
            'code' => str_replace('-', '', substr($this->claim->patientContact()?->phone ?? '', 0, 3)),
            'number' => str_replace('-', '', substr($this->claim->patientContact()?->phone ?? '', 3, 10)),
        };
    }

    protected function getSubscriberRelationshipAttribute(string $key): string
    {
        $relationship = $this->claim->subscriberRelationship()?->{$key} ?? '';

        return empty($relationship)
            ? 'self'
            : (str_contains(strtolower($relationship), 'spouse')
                ? 'spouse'
                : (str_contains(strtolower($relationship), 'child')
                    ? 'child'
                    : 'other'));
    }

    protected function getSubscriberAddressAttribute(string $key): string
    {
        return match ($key) {
            'state' => substr($this->claim->subscriberAddress()?->{$key} ?? '', 0, 2),
            'zip' => str_replace('-', '', substr($this->claim->subscriberAddress()?->{$key} ?? '', 0, 12)),
            default => $this->claim->subscriberAddress()?->{$key} ?? '',
        };
    }

    protected function getSubscriberContactAttribute(string $key): string
    {
        return match ($key) {
            'code' => str_replace('-', '', substr($this->claim->subscriberContact()?->phone ?? '', 0, 3)),
            'number' => str_replace('-', '', substr($this->claim->subscriberContact()?->phone ?? '', 3, 10)),
        };
    }

    protected function getLowerSubscriberAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => !empty($this->claim->lowerSubscriber()?->{$key})
                ? ', '.$this->claim->lowerSubscriber()?->{$key}
                : '',
            'name_suffix' => !empty($this->claim->lowerSubscriber()?->{$key}?->code)
                ? ' '.$this->claim->lowerSubscriber()?->{$key}?->code
                : '',
            'middle_name' => !empty($this->claim->lowerSubscriber()?->{$key})
                ? ', '.substr($this->claim->lowerSubscriber()?->{$key}, 0, 1)
                : '',
            default => $this->claim->lowerSubscriber()?->{$key} ?? '',
        };
    }

    protected function getLowerOrderPolicyAttribute(string $key): string
    {
        return $this->claim->lowerOrderPolicy()?->{$key} ?? '';
    }

    protected function getLowerInsurancePlanAttribute(string $key): string
    {
        return $this->claim->lowerInsurancePlan()?->{$key} ?? '';
    }

    protected function getHigherInsuranceCompanyAttribute(string $key): string
    {
        return match ($key) {
            'address' => $this->claim->higherInsurancePlan()?->insuranceCompany?->addresses?->first()->address ?? '',
            'city' => $this->claim->higherInsurancePlan()?->insuranceCompany?->addresses?->first()->city ?? '',
            'state' => substr($this->claim->higherInsurancePlan()?->insuranceCompany?->addresses?->first()->state ?? '', 0, 2),
            'zip' => $this->claim->higherInsurancePlan()?->insuranceCompany?->addresses?->first()->zip ?? '',
            default => $this->claim->higherInsurancePlan()?->insuranceCompany?->{$key} ?? '',
        };
    }

    protected function getInsurancePoliciesAttribute(string $key): Collection
    {
        return $this->claim->insurancePolicies->map(fn (InsurancePolicy $policy) => match ($key) {
            'release_info' => (bool) $policy->release_info ? 'Y' : 'N',
            'assign_benefits' => (bool) $this->claim->demographicInformation->accept_assignment ? 'Y' : 'N',
            'plan_name' => substr($policy->insurancePlan->name ?? '', 0, 21),
            default => $policy->{$key} ?? '',
        })
        ->pad(3, '');
    }

    protected function getInsurancePoliciesSubscriberAttribute(string $key): Collection
    {
        return $this->claim->insurancePolicies()->orderByPivot('order')->get()->map(fn (InsurancePolicy $policy) => match ($key) {
            'relationship_code' => $policy->subscribers->first()?->relationship->code ?? '18',
            default => $policy->subscribers->first()?->{$key} ?? null,
        } ?? str_replace(', ', '', $this->getPatientProfileAttribute($key)))
        ->pad(3, '');
    }

    protected function getInsuranceCompaniesAttribute(string $key): Collection
    {
        return $this->claim->insurancePolicies->map(fn (InsurancePolicy $policy) => match ($key) {
            'release_info' => (bool) $policy->release_info ? 'Y' : 'N',
            'payer_id' => $policy->payer_id ?? '',
            default => $policy->insurancePlan->insuranceCompany->{$key} ?? '',
        })
        ->pad(3, '');
    }

    protected function getHigherInsurancePlanAttribute(string $key): string
    {
        return $this->claim->higherInsurancePlan()?->{$key} ?? '';
    }

    protected function getExistLowerInsurancePlanAttribute(): string|bool
    {
        return !empty($this->claim->lowerInsurancePlan());
    }

    protected function getClaimDemographicInformationAttribute(string $key): string|bool
    {
        return match ($key) {
            'charges' => ($this->claim->demographicInformation?->outside_lab ?? false)
                ? str_replace([',', '.'], '', (string) ($this->claim->demographicInformation?->{$key} ?? ''))
                : '',
            default => $this->claim->demographicInformation?->{$key} ?? '',
        };
    }

    protected function getPatientSignatureAttribute(string $key): string
    {
        return $this->claim->demographicInformation?->{$key}
            ? 'Signature on File'
            : '';
    }

    protected function getClaimServicesAttribute(string $key): Collection
    {
        return $this->claim->service->services
            ->map(function (Services $claimService) use ($key) {
                return match ($key) {
                    'revenue_code' => $claimService->revenueCode?->code ?? '',
                    'revenue_code_description' => substr($claimService->revenueCode?->description ?? '', 0, 30),
                    'revenue_code_short_description' => $claimService->revenueCode?->short_description ?? '',
                    'procedure_code' => $claimService->procedure?->code ?? '',
                    'procedure_description' => substr($claimService->procedure?->description ?? '', 0, 30),
                    'procedure_short_description' => $claimService->procedure?->short_description ?? '',
                    'start_date' => Carbon::createFromFormat('Y-m-d', $claimService->from_service)
                        ->format('mdY'),
                    'non_covered_charges' => 0 != (int) $claimService->claimService->non_covered_charges
                        ? Money::parse($claimService->claimService->non_covered_charges, null, true)->formatByDecimal()
                        : '',
                    'related_group' => $claimService->claimService->diagnosisRelatedGroup?->code ?? '',
                    'total_charge' => Money::parse($claimService->total_charge, null, true)->formatByDecimal(),
                    default => $claimService->{$key},
                };
            });
    }

    protected function getClaimDiagnosisDxAttribute(string $key): string
    {
        /** @var \App\Models\Diagnosis|null */
        $diagnosisDx = $this->claim->service->diagnoses()->wherePivot('item', 'A')->first();

        return match ($key) {
            'type' => $diagnosisDx?->type?->getCode() ?? '',
            'code_poa' => $diagnosisDx?->code
                .('inpatient' == $this->claim->demographicInformation->type_of_medical_assistance
                    ? ' '.($diagnosisDx->pivot->poa)
                    : ''),
            'cond_code' => 'inpatient' == $this->claim->demographicInformation->type_of_medical_assistance
                    ? $diagnosisDx?->code
                    : '',
            default => $diagnosisDx?->{$key} ?? '',
        };
    }

    protected function getClaimDiagnosisAttribute(string $key): Collection
    {
        return $this->claim->service->diagnoses()->wherePivot('item', '!=', 'A')->get()
            ->map(fn (Diagnosis $diagnosis) => match ($key) {
                'code_poa' => $diagnosis?->code
                    .('inpatient' == $this->claim->demographicInformation->type_of_medical_assistance
                        ? ' '.($diagnosis->pivot->poa)
                        : ''),
                default => $diagnosis?->{$key} ?? '',
            })
            ->pad(17, '');
    }

    protected function getHealthProfessionalAttribute(string $key, string $fielId): string
    {
        $healthProfessional = $this->claim->demographicInformation->healthProfessionals()->wherePivot('field_id', $fielId)->first();

        return match ($key) {
            'first_name' => $healthProfessional?->profile->first_name ?? '',
            'last_name' => $healthProfessional?->profile->last_name ?? '',
            'qualifier' => TypeCatalog::find($healthProfessional->pivot->qualifier_id ?? 0)?->code ?? '',
            default => $healthProfessional?->{$key} ?? '',
        };
    }

    protected function getClaimServicesTotalAttribute(): string
    {
        return $this->claim->service->services->reduce(function (Money $carry, Services $ammount) {
            return $carry->add(Money::parse($ammount->total_charge, null, true));
        }, Money::parse('0', null, true))->formatByDecimal();
    }

    protected function getClaimServicesTotalKeyAttribute(string $key): Collection
    {
        $total = explode('.', (string) $this->claim->service->services->sum($key));
        $total[1] = (('' != $total[0])
                    ? (str_pad($total[1] ?? '', 2, '0', STR_PAD_RIGHT) ?? '00')
                    : '');

        return Collect($total);
    }

    protected function getFirstClaimServiceAttribute(string $key): string
    {
        $key = $this->claim
            ->service
            ?->services()
            ?->first()
            ?->{$key} ?? '';

        return !empty($key)
            ? Carbon::createFromFormat('Y-m-d', $key)->format('m/d/Y')
            : '';
    }

    protected function getClaimProfessionalServicesAttribute(string $key): Collection
    {
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

        $resultServices = [];
        $totalCharge = 0;
        $totalCopay = 0;
        $healthProfessional_BP = $this->claim
            ?->demographicInformation
            ?->healthProfessionals()
            ?->wherePivot('field_id', 5)
            ?->first() ?? null;

        $taxonomyHealthP = ($contractFeeSpecification?->healthProfessionalTaxonomy)
            ? ($contractFeeSpecification->healthProfessionalTaxonomy?->tax_id ?? '')
            : ($healthProfessional_BP?->taxonomies()?->where('taxonomies.primary', true)?->first()?->tax_id ?? '');

        foreach ($this->claim->service->services ?? [] as $index => $item) {
            $arrayPrice = explode('.', (string) ($item['price'] ?? ''));
            $totalCharge += $item['price'] ?? 0;
            $totalCopay += $item['copay'] ?? 0;
            $fromService = explode('-', $item['from_service'] ?? '');
            $toService = explode('-', $item['to_service'] ?? '');

            /* 24A */
            $medication = $item->procedure?->companyServices
                ->firstWhere('company_id', $this->claim
                    ?->demographicInformation
                    ?->company_id)?->medication;

            $resultServices['medication_A'.($index + 1)] = isset($medication)
                ? ('N4'.$medication->drug_code.' '.$medication->measurement_unit_id->getCode().(string) $medication->units).((true === $medication->repackaged_NDC ?? false) ? (' ORIGN4'.$medication->code_NDC) : '')
                : '';
            $resultServices['from_year_A'.($index + 1)] = substr($fromService[0] ?? '', 2, 2);
            $resultServices['from_month_A'.($index + 1)] = $fromService[1] ?? '';
            $resultServices['from_day_A'.($index + 1)] = $fromService[2] ?? '';
            $resultServices['to_year_A'.($index + 1)] = substr($toService[0] ?? '', 2, 2);
            $resultServices['to_month_A'.($index + 1)] = $toService[1] ?? '';
            $resultServices['to_day_A'.($index + 1)] = $toService[2] ?? '';
            /* 24B */
            $resultServices['pos_B'.($index + 1)] = $item?->placeOfService?->code ?? '';
            /* 24C */
            $resultServices['emg_C'.($index + 1)] = ($item['emg']) ? 'Y' : '';
            /* 24D */
            $resultServices['procedure_D'.($index + 1)] = $item?->procedure?->code ?? '';
            $resultServices['modifier1_D'.($index + 1)] = $item['modifiers'][0]['name'] ?? '';
            $resultServices['modifier2_D'.($index + 1)] = $item['modifiers'][1]['name'] ?? '';
            $resultServices['modifier3_D'.($index + 1)] = $item['modifiers'][2]['name'] ?? '';
            $resultServices['modifier4_D'.($index + 1)] = $item['modifiers'][3]['name'] ?? '';
            /* 24E */
            $resultServices['pointer_E'.($index + 1)] = ($item['diagnostic_pointers'][0] ?? '')
            .($item['diagnostic_pointers'][1] ?? '').($item['diagnostic_pointers'][2] ?? '').($item['diagnostic_pointers'][3] ?? '');
            /* 24F */
            $resultServices['charges_F'.($index + 1)] = str_replace(',', '', $arrayPrice[0] ?? '');
            $resultServices['charges_decimal_F'.($index + 1)] = $arrayPrice[1] ?? '00';
            /* 24G */
            $resultServices['days_G'.($index + 1)] = $item['days_or_units'] ?? '';
            /* 24H */
            $resultServices['epsdt_H'.($index + 1)] = $item?->epsdt?->code ?? '';
            $resultServices['family_planing_H'.($index + 1)] = $item->familyPlanning?->code ?? '';
            /* 24I */
            // $tax_id = $this->claim?->provider?->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $resultServices['qualifier_I'.($index + 1)] = !empty($taxonomyHealthP) ? 'ZZ' : '';
            /* 24J */
            $resultServices['npi_J'.($index + 1)] = str_replace('-', '', $healthProfessional_BP?->npi ?? '');
            $resultServices['tax_J'.($index + 1)] = str_replace('-', '', $taxonomyHealthP ?? '');
        }

        return Collect($resultServices);
    }

    protected function getReferredProviderRoleAttribute(string $key): string
    {
        return TypeCatalog::find($this->claim
            ?->provider()
            ?->pivot
            ?->qualifier_id)
            ?->{$key} ?? '';
    }

    protected function getProviderProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => $this->claim->provider()?->profile?->{$key} ?? '',
            'last_name' => $this->claim->provider()?->profile?->{$key} ?? '',
            'name_suffix' => $this->claim->provider()?->profile?->{$key}?->code ?? '',
            'middle_name' => substr($this->claim->provider()?->profile?->{$key} ?? '', 0, 1),
            'qualifier' => !empty($this->claim->provider()?->upin) ? 'G2' : '',
            'qualifierValue' => str_replace('-', '', $this->claim->provider()?->upin ?? ''),
            'npi' => str_replace('-', '', $this->claim->provider()?->npi ?? ''),
            default => $this->claim->provider()?->{$key} ?? '',
        };
    }

    protected function getBillingProviderProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => $this->claim->billingProvider()?->profile?->{$key} ?? '',
            'last_name' => $this->claim->billingProvider()?->profile?->{$key} ?? '',
            'name_suffix' => $this->claim->billingProvider()?->profile?->{$key}?->code ?? '',
            'middle_name' => substr($this->claim->billingProvider()?->profile?->{$key} ?? '', 0, 1),
            default => $this->claim->billingProvider()?->{$key} ?? '',
        };
    }

    protected function getClaimDateCurrentInformationAttribute(string $key): string
    {
        return $this->getClaimDateInformationAttribute($key, 1);
    }

    protected function getClaimDateOtherInformationAttribute(string $key): string
    {
        return $this->getClaimDateInformationAttribute($key, 2);
    }

    protected function getClaimDateWorkInformationAttribute(string $key): string
    {
        return $this->getClaimDateInformationAttribute($key, 3);
    }

    protected function getClaimDateHospitalInformationAttribute(string $key): string
    {
        return $this->getClaimDateInformationAttribute($key, 4);
    }

    protected function getClaimDateAdditionalInformationAttribute(string $key): string
    {
        return $this->getClaimDateInformationAttribute($key, 2);
    }

    protected function getClaimDiagnosesCodeAttribute(string $key): string
    {
        return $this->claim?->service?->diagnoses()?->wherePivot('item', $key)->first()?->code ?? '';
    }

    protected function getClaimDateInformationAttribute(string $key, int $field): string
    {
        $model = $this->claim
            ?->dateInformations
            ?->first(fn ($dateInformation) => $dateInformation->field_id?->value == $field);

        return match ($key) {
            'year_of_from_date' => explode('-', $model?->from_date ?? '')[0] ?? '',
            'month_of_from_date' => explode('-', $model?->from_date ?? '')[1] ?? '',
            'day_of_from_date' => explode('-', $model?->from_date ?? '')[2] ?? '',
            'year_of_to_date' => explode('-', $model?->to_date ?? '')[0] ?? '',
            'month_of_to_date' => explode('-', $model?->to_date ?? '')[1] ?? '',
            'day_of_to_date' => explode('-', $model?->to_date ?? '')[2] ?? '',
            'from_date' => !empty($model?->from_date)
                ? Carbon::createFromFormat(
                    'Y-m-d',
                    $model->from_date
                )->format('m/d/Y')
                : '',
            'to_date' => !empty($model?->to_date)
                ? Carbon::createFromFormat(
                    'Y-m-d',
                    $model->to_date
                )->format('m/d/Y')
                : '',
            'qualifier' => $model?->qualifier?->code ?? '',
            'description' => $model?->description ?? '',
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

    protected function getFacilityAddressAttribute(string $key, string $entry): string
    {
        $value = (string) $this->claim
            ->demographicInformation
            ->facility
            ?->addresses
            ?->get((int) $entry)
            ?->{$key};

        return match ($key) {
            'address' => substr($value ?? '', 0, 55),
            'city' => substr($value ?? '', 0, 30),
            'state' => substr($value ?? '', 0, 2),
            'zip' => str_replace('-', '', substr($value ?? '', 0, 12)),
            default => $value ?? '',
        };
    }

    protected function getBillingProviderAttribute(string $key): string
    {
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

        if (is_null($contractFeeSpecification)) {
            $companyAddress = $this->claim
                ->demographicInformation
                ->company
                ->addresses
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->where('address_type_id', 1)
                ->first();
            $companyContact = $this->claim
                ->demographicInformation
                ->company
                ->contacts
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->first();

            return match ($key) {
                'federal_tax' => str_replace('-', '', $this->company->getAttribute('ein') ?? ''),
                'federal_tax_value' => !empty($this->company->ein)
                    ? 'EIN'
                    : '',
                'ein' => str_replace('-', '', $this->company->ein ?? ''),
                'address' => substr($companyAddress?->{$key} ?? '', 0, 55),
                'city' => substr($companyAddress?->{$key} ?? '', 0, 30),
                'state' => substr($companyAddress?->{$key} ?? '', 0, 2),
                'zip' => str_replace('-', '', substr($companyAddress?->{$key} ?? '', 0, 12)),
                'other_country' => $companyAddress?->country && 'US' != $companyAddress?->country
                    ? $companyAddress?->country
                    : '',
                'code_area' => str_replace('-', '', substr($companyContact?->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($companyContact?->phone ?? '', 0, 10)),
                'phone_fax' => str_replace('-', '', substr($companyContact?->phone ?? $companyContact?->fax ?? '', 0, 10)),
                default => (string) $this->company->getAttribute($key),
            };
        }

        $billingProvider = $contractFeeSpecification?->billingProvider ?? $this->claim->demographicInformation->company;
        if (Company::class === $contractFeeSpecification->billing_provider_type) {
            $billingProviderAddress = $billingProvider->addresses
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->where('address_type_id', 1)
                ->first();
            $billingProviderContact = $billingProvider->contacts
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->first();
            $healthP = $contractFeeSpecification->healthProfessional;
            $federalTax = $contractFeeSpecification?->health_professional_tax_id
                ?? $billingProvider->getAttribute('ein')
                ?? '';

            $response = match ($key) {
                'federal_tax' => str_replace('-', '', $federalTax),
                'federal_tax_value' => (!empty($federalTax) && ($federalTax == $billingProvider->ein) || ($federalTax == $healthP?->ein))
                    ? 'EIN'
                    : ((!empty($federalTax) && ($federalTax == $healthP?->profile?->ssn))
                        ? 'SSN'
                        : ''),
                'ein' => str_replace('-', '', $billingProvider->ein ?? ''),
                'address' => substr($billingProviderAddress?->{$key} ?? '', 0, 55),
                'city' => substr($billingProviderAddress?->{$key} ?? '', 0, 30),
                'state' => substr($billingProviderAddress?->{$key} ?? '', 0, 2),
                'zip' => str_replace('-', '', substr($billingProviderAddress?->{$key} ?? '', 0, 12)),
                'other_country' => $billingProviderAddress?->country && 'US' != $billingProviderAddress?->country
                    ? $billingProviderAddress?->country
                    : '',
                'code_area' => str_replace('-', '', substr($billingProviderContact?->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($billingProviderContact?->phone ?? '', 0, 10)),
                'phone_fax' => str_replace('-', '', substr($billingProviderContact?->phone ?? $billingProviderContact?->fax ?? '', 0, 10)),
                default => (string) $billingProvider->getAttribute($key),
            };
        } elseif (HealthProfessional::class === $contractFeeSpecification->billing_provider_type) {
            $billingProviderAddress = $billingProvider->profile->addresses
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->first();
            $billingProviderContact = $billingProvider->profile->contacts
                ->where('billing_company_id', $this->claim->billing_company_id ?? null)
                ->first();
            $federalTax = $contractFeeSpecification?->health_professional_tax_id
                ?? $this->claim->demographicInformation->company->getAttribute('ein')
                ?? '';

            $response = match ($key) {
                'federal_tax' => str_replace('-', '', $federalTax),
                'federal_tax_value' => (!empty($federalTax) && ($federalTax == $billingProvider->ein) || ($federalTax == $this->claim->demographicInformation->company->getAttribute('ein')))
                    ? 'EIN'
                    : ((!empty($federalTax) && ($federalTax == $billingProvider?->profile?->ssn))
                        ? 'SSN'
                        : ''),
                'name' => $billingProvider->profile?->last_name.', '.$billingProvider->profile?->first_name
                    .(!empty($billingProvider->profile?->nameSuffix?->code)
                        ? ' '.$billingProvider->profile?->nameSuffix?->code
                        : '')
                    .(!empty($billingProvider->profile?->middle_name)
                        ? ', '.substr($billingProvider->profile?->middle_name, 0, 1)
                        : ''),
                'address' => substr($billingProviderAddress?->{$key} ?? '', 0, 55),
                'city' => substr($billingProviderAddress?->{$key} ?? '', 0, 30),
                'state' => substr($billingProviderAddress?->{$key} ?? '', 0, 2),
                'zip' => str_replace('-', '', substr($billingProviderAddress?->{$key} ?? '', 0, 12)),
                'other_country' => $billingProviderAddress?->country && 'US' != $billingProviderAddress?->country
                    ? $billingProviderAddress?->country
                    : '',
                'code_area' => str_replace('-', '', substr($billingProviderContact?->phone ?? '', 0, 3)),
                'phone' => str_replace('-', '', substr($billingProviderContact?->phone ?? '', 0, 10)),
                'phone_fax' => str_replace('-', '', substr($billingProviderContact?->phone ?? $billingProviderContact?->fax ?? '', 0, 10)),
                default => $billingProvider->{$key} ?? '',
            };
        }

        return $response ?? '';
    }
}
