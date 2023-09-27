<?php

declare(strict_types=1);

namespace App\Traits\Claim;

use App\Models\Address;
use App\Models\Claims\ClaimDemographicInformation;
use App\Models\Contact;
use App\Models\HealthProfessional;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use App\Models\Profile;
use App\Models\Subscriber;
use App\Models\TypeCatalog;

/** @property ClaimDemographicInformation $demographicInformation */
trait ClaimFile
{
    public function insType(): ?TypeCatalog
    {
        return $this->insurancePolicies()
            ->wherePivot('order', 1)
            ->first()
            ?->insurancePlan
            ?->insType ?? null;
    }

    public function higherOrderPolicy(): ?InsurancePolicy
    {
        return $this->insurancePolicies()
            ->wherePivot('order', 1)
            ->first() ?? null;
    }

    public function patientProfile(): ?Profile
    {
        return $this->demographicInformation
            ?->patient
            ?->profile ?? null;
    }

    public function subscriber(): Subscriber|Profile|null
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber ?? null;
    }

    public function patientAddress(): ?Address
    {
        return $this->demographicInformation
                ?->patient
                ?->mainAddress
            ?? $this->demographicInformation
                ?->patient
                ?->profile
                ?->addresses
                ?->first()
            ?? null;
    }

    public function patientContact(): ?Contact
    {
        return $this->demographicInformation
            ?->patient
            ?->profile
            ?->contacts()
            ?->select('phone')
            ?->first() ?? null;
    }

    public function subscriberRelationship(): ?TypeCatalog
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)
            ->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber?->relationship ?? null;
    }

    public function subscriberAddress(): ?Address
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber
            ?->addresses()
            ?->select('country', 'address', 'city', 'state', 'zip')
            ->first() ?? null;
    }

    public function subscriberContact(): ?Contact
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber
            ?->contacts()
            ->select('phone')
            ->first() ?? null;
    }

    public function lowerSubscriber(): Subscriber|Profile|null
    {
        $lowerOrderPolicy = $this->insurancePolicies()
                ->wherePivot('order', 2)->first();

        if ($lowerOrderPolicy) {
            $subscriber =
                $lowerOrderPolicy->own ?? true
                    ? $this->demographicInformation?->patient?->profile ?? null
                    : $lowerOrderPolicy?->subscribers->first();
        }

        return $subscriber ?? null;
    }

    public function lowerOrderPolicy(): ?InsurancePolicy
    {
        return $this->insurancePolicies()
            ->wherePivot('order', 2)
            ->first() ?? null;
    }

    public function lowerInsurancePlan(): ?InsurancePlan
    {
        return $this->insurancePolicies()
            ->wherePivot('order', 2)
            ->first()
            ?->insurancePlan ?? null;
    }

    public function higherInsurancePlan(): ?InsurancePlan
    {
        return $this->insurancePolicies()
            ->wherePivot('order', 1)
            ->first()
            ?->insurancePlan ?? null;
    }

    public function claimDemographicInformation(): ?ClaimDemographicInformation
    {
        return $this->demographicInformation ?? null;
    }

    public function provider(): ?HealthProfessional
    {
        return $this->demographicInformation
            ?->healthProfessionals()
            ?->wherePivot('field_id', 6)
            ?->first() ?? null;
    }

    public function billingProvider(): ?HealthProfessional
    {
        return $this->demographicInformation
            ?->healthProfessionals()
            ?->wherePivot('field_id', 5)
            ?->first() ?? null;
    }

    public function attending(): ?HealthProfessional
    {
        return $this->demographicInformation
            ?->healthProfessionals()
            ?->wherePivot('field_id', 76)
            ?->first() ?? null;
    }
}
