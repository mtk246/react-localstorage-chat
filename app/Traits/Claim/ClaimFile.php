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
            ?->user
            ?->profile ?? null;
    }

    public function subscriber(): Subscriber|Profile|null
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->user?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber ?? null;
    }

    public function patientAddress(): ?Address
    {
        return $this->demographicInformation
            ?->patient
            ?->user
            ?->addresses()
            ?->select('country', 'address', 'city', 'state', 'zip')
            ?->first() ?? null;
    }

    public function patientContact(): ?Contact
    {
        return $this->demographicInformation
            ?->patient
            ?->user
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
                ? $this->demographicInformation?->patient?->user?->profile ?? null
                : $higherOrderPolicy?->subscribers->first();

        return $subscriber?->relationship ?? null;
    }

    public function subscriberAddress(): ?Address
    {
        $higherOrderPolicy = $this->insurancePolicies()
            ->wherePivot('order', 1)->first();

        $subscriber =
            $higherOrderPolicy->own ?? true
                ? $this->demographicInformation?->patient?->user ?? null
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
                ? $this->demographicInformation?->patient?->user ?? null
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
                    ? $this->demographicInformation?->patient?->user?->profile ?? null
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
        return $this->claim
            ?->demographicInformation
            ?->healthProfessionals()
            ?->wherePivot('qualifier_id', 'DN')
            ?->first() ?? null;
    }
}
