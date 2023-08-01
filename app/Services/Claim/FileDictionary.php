<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\FormatType;
use App\Models\Claims\Services;
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

    public function getCompanyAddressAttribute(string $key, string $entry): string
    {
        $value = (string) $this->claim
            ->demographicInformation
            ->company
            ->addresses
            ->where('address_type_id', $this->claim
                ->demographicInformation
                ->company
                ->addresses
                ->where('address_type_id', (int) $entry)
                ->count() > 1
                    ? (int) $entry
                    : 1
            )
            ->first()
            ?->{$key};

        return match ($key) {
            'address' => substr($value ?? '', 0, 55),
            'city' => substr($value ?? '', 0, 30),
            'state' => substr($value ?? '', 0, 2),
            'zip' => str_replace('-', '', substr($value ?? '', 0, 12)),
            default => $value ?? '',
        };
    }

    public function getCompanyContactAttribute(string $key, string $entry): string
    {
        $value = $this->claim
            ->demographicInformation
            ->company
            ->contacts
            ->get((int) $entry);

        return match ($key) {
            'code_area' => str_replace('-', '', substr($value?->phone ?? '', 0, 3)),
            'phone' => str_replace('-', '', substr($value?->phone ?? '', 3, 10)),
            default => (string) $value?->{$key} ?? '',
        };
    }

    public function getMedicalAssistanceTypeAttribute(): string
    {
        $type = $this->claim
            ->demographicInformation
            ->type_of_medical_assistance;

        return 'inpatient' === $type
            ? '1'
            : '0';
    }

    public function getPatientConditionCodesAttribute(string $key): string
    {
        return collect($this->claim->patientInformation->condition_codes)
            ->map(fn ($code) => $code['code'])
            ->pad(11, '')
            ->get((int) $key);
    }

    protected function getInsTypeAttribute(string $key): string
    {
        $options = ['Medicare', 'Medicaid', 'Tricare', 'Champva', 'Group', 'Feca'];
        $search = $this->claim->insType()?->{$key} ?? '';
        $index = array_search(strtolower($search), array_map('strtolower', $options));

        return false !== $key
            ? $options[$index]
            : 'Other';
    }

    protected function getHigherOrderPolicyAttribute(string $key): string
    {
        return $this->claim->higherOrderPolicy()?->{$key} ?? '';
    }

    protected function getPatientProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => ', '.$this->claim->patientProfile()?->{$key} ?? '',
            'name_suffix' => !empty($this->claim->patientProfile()?->{$key}?->code)
                ? ' '.$this->claim->patientProfile()?->{$key}?->code
                : '',
            'middle_name' => !empty($this->claim->patientProfile()?->{$key})
                ? ', '.substr($this->claim->patientProfile()?->{$key}, 0, 1)
                : '',
            'year_of_birth' => substr(
                explode('-', $this->claim->patientProfile()?->date_of_birth ?? '')[0] ?? '',
                2,
                2,
            ),
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
            'year_of_birth' => substr(
                explode('-', $this->claim->subscriber()?->date_of_birth ?? '')[0] ?? '',
                2,
                2,
            ),
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

    protected function getHigherInsurancePlanAttribute(string $key): string
    {
        return $this->claim->higherInsurancePlan()?->{$key} ?? '';
    }

    protected function getExistHigherInsurancePlanAttribute(): string|bool
    {
        return !empty($this->claim->higherInsurancePlan());
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
                    'revenue_code' => $claimService->revenueCode->code,
                    'procedure_description' => $claimService->procedure->description,
                    'procedure_code' => $claimService->procedure->code,
                    'procedure_start_date' => $claimService->procedure->start_date,
                    'non_covered_charges' => $claimService->claimService->non_covered_charges ?? '',
                    'related_group' => $claimService->claimService->diagnosisRelatedGroup?->code ?? '',
                    'total_charge' => Money::parse($claimService->total_charge)->formatByDecimal(),
                    default => $claimService->{$key},
                };
            });
    }

    protected function getClaimServicesTotalAttribute(): string
    {
        return Money::parse($this->claim->service->services->sum('price'))->formatByDecimal();
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
        return Carbon::createFromFormat(
            'Y-m-d',
            $this->claim
                ->service
                ?->services()
                ?->first()
                ?->{$key} ?? ''
        )->format('m/d/Y');
    }

    protected function getClaimProfessionalServicesAttribute(string $key): Collection
    {
        $resultServices = [];
        $totalCharge = 0;
        $totalCopay = 0;

        foreach ($this->claim->service->services ?? [] as $index => $item) {
            $arrayPrice = explode('.', (string) ($item['price'] ?? ''));
            $totalCharge += $item['price'] ?? 0;
            $totalCopay += $item['copay'] ?? 0;
            $fromService = explode('-', $item['from_service'] ?? '');
            $toService = explode('-', $item['to_service'] ?? '');
            $billingProvider = $this->claim
                ?->demographicInformation
                ?->healthProfessionals()
                ?->wherePivot('field_id', 5)
                ?->first() ?? null;

            /* 24A */
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
            $resultServices['pointer_E'.($index + 1)] = ($item['diagnostic_pointers'][0] ?? '').
            ($item['diagnostic_pointers'][1] ?? '').($item['diagnostic_pointers'][2] ?? '').($item['diagnostic_pointers'][3] ?? '');
            /* 24F */
            $resultServices['charges_F'.($index + 1)] = str_replace(',', '', $arrayPrice[0] ?? '');
            $resultServices['charges_decimal_F'.($index + 1)] = $arrayPrice[1] ?? '';
            /* 24G */
            $resultServices['days_G'.($index + 1)] = $item['days_or_units'] ?? '';
            /* 24H */
            $resultServices['epsdt_H'.($index + 1)] = $item?->epsdt?->code ?? '';
            $resultServices['family_planing_H'.($index + 1)] = $item->familyPlanning?->code ?? '';
            /** 24I */
            // $tax_id = $this->claim?->provider?->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $tax_id_BP = $billingProvider?->taxonomies()->where('primary', true)->first()?->tax_id ?? '';
            $resultServices['qualifier_I'.($index + 1)] = !empty($tax_id_BP) ? 'ZZ' : '';
            /* 24J */
            $resultServices['npi_J'.($index + 1)] = str_replace('-', '', $billingProvider?->npi ?? '');
            $resultServices['tax_J'.($index + 1)] = str_replace('-', '', $tax_id_BP);
        }

        return Collect($resultServices);
    }

    protected function getReferredProviderRoleAttribute(string $key): string
    {
        return $this->claim
            ?->provider()
            ?->pivot
            ?->qualifier
            ?->{$key} ?? '';
    }

    protected function getProviderProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => $this->claim->provider()?->user?->profile?->{$key} ?? '',
            'last_name' => $this->claim->provider()?->user?->profile?->{$key} ?? '',
            'name_suffix' => $this->claim->provider()?->user?->profile?->{$key}?->code ?? '',
            'middle_name' => substr($this->claim->provider()?->user?->profile?->{$key} ?? '', 0, 1),
            'qualifier' => !empty($this->claim->provider()?->upin) ? 'G2' : '',
            'qualifierValue' => str_replace('-', '', $this->claim->provider()?->upin ?? ''),
            'npi' => str_replace('-', '', $this->claim->provider()?->npi ?? ''),
            default => $this->claim->provider()?->{$key} ?? '',
        };
    }

    protected function getBillingProviderProfileAttribute(string $key): string
    {
        return match ($key) {
            'first_name' => $this->claim->billingProvider()?->user?->profile?->{$key} ?? '',
            'last_name' => $this->claim->billingProvider()?->user?->profile?->{$key} ?? '',
            'name_suffix' => $this->claim->billingProvider()?->user?->profile?->{$key}?->code ?? '',
            'middle_name' => substr($this->claim->billingProvider()?->user?->profile?->{$key} ?? '', 0, 1),
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
            ?->first(fn ($dateInformation) => $dateInformation->field_id == $field);

        return match ($key) {
            'year_of_from_date' => substr(
                explode('-', $model?->from_date ?? '')[0] ?? '',
                2,
                2,
            ),
            'month_of_from_date' => explode('-', $model?->from_date ?? '')[1] ?? '',
            'day_of_from_date' => explode('-', $model?->from_date ?? '')[2] ?? '',
            'year_of_to_date' => substr(
                explode('-', $model?->to_date ?? '')[0] ?? '',
                2,
                2,
            ),
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

        public function getFacilityAddressAttribute(string $key, string $entry): string
        {
            $value = (string) $this->claim
                ->demographicInformation
                ->company
                ->addresses
                ->get((int) $entry)
                ?->{$key};

            return match ($key) {
                'address' => substr($value ?? '', 0, 55),
                'city' => substr($value ?? '', 0, 30),
                'state' => substr($value ?? '', 0, 2),
                'zip' => str_replace('-', '', substr($value ?? '', 0, 12)),
                default => $value ?? '',
            };
        }
}
