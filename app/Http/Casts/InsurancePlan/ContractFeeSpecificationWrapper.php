<?php

declare(strict_types=1);

namespace App\Http\Casts\InsurancePlan;

use App\Http\Casts\CastsRequest;

final class ContractFeeSpecificationWrapper extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id');
    }

    public function getBillingProviderId(): int
    {
        return (int) $this->inputs['billing_provider_id'];
    }

    public function getBillingProviderTaxonomyId(): int
    {
        return (int) $this->inputs['billing_provider_taxonomy_id'];
    }

    public function getHealthProfessionalId(): int
    {
        return (int) $this->inputs['health_professional_id'];
    }

    public function getHealthProfessionalTaxonomyId(): int
    {
        return (int) $this->inputs['health_professional_taxonomy_id'];
    }
}
