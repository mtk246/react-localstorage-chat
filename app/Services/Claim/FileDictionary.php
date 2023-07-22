<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\FormatType;

final class FileDictionary extends Dictionary
{
    protected string $format = FormatType::FILE->value;

    protected function getCompanyAttribute(string $key): string
    {
        return (string) $this->company->getAttribute($key);
    }

    protected function getPatientCompanyAttribute(string $key): string
    {
        return (string) $this->claim
            ->demographicInformation
            ->patient
            ?->companies
            ?->find($this->company->id ?? null)
            ?->pivot
            ?->med_num ?? '';
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
        return $this->claim->higherInsurancePlan()?->insuranceCompany?->{$key} ?? '';
    }

    protected function getHigherInsurancePlanAttribute(string $key): string
    {
        return $this->claim->higherInsurancePlan()?->{$key} ?? '';
    }

    protected function getExistHigherInsurancePlanAttribute(): string|bool
    {
        return !empty($this->claim->higherInsurancePlan());
    }

    protected function getClaimDemographicInformationAttribute(string $key): string
    {
        return $this->claim->demographicInformation?->{$key} ?? '';
    }

    protected function getPatientSignatureAttribute(string $key): string
    {
        return $this->claim->demographicInformation?->{$key}
            ? 'Signature on File'
            : '';
    }

    protected function getFirstClaimServiceAttribute(string $key): string
    {
        return $this->claim
            ->claimService
            ?->services()
            ?->first()
            ?->{$key}
            ?->format('m/d/Y') ?? '';
    }

    protected function getReferredProviderRole(string $key): string
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
            'first_name' => ', '.$this->claim->provider()?->user?->profile?->{$key} ?? '',
            'name_suffix' => !empty($this->claim->provider()?->user?->profile?->{$key}?->code)
                ? ' '.$this->claim->provider()?->user?->profile?->{$key}?->code
                : '',
            'middle_name' => !empty($this->claim->provider()?->user?->profile?->{$key})
                ? ', '.substr($this->claim->provider()?->user?->profile?->{$key}, 0, 1)
                : '',
            default => $this->claim->patientProfile()?->{$key} ?? '',
        };
    }
}
