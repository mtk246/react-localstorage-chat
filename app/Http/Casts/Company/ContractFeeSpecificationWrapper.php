<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ContractFeeSpecificationWrapper extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id');
    }

    public function getBillingProviderId(): ?string
    {
        return $this->get('billing_provider_id');
    }

    public function getBillingProviderTaxId(): ?string
    {
        return $this->get('billing_provider_tax_id');
    }

    public function getBillingProviderTaxonomyId(): ?int
    {
        return $this->get('billing_provider_taxonomy_id');
    }

    public function getHealthProfessionalId(): string
    {
        return $this->get('health_professional_id') ?? '';
    }

    public function getHealthProfessionalTaxId(): ?string
    {
        return $this->get('health_professional_tax_id');
    }

    public function getHealthProfessionalTaxonomyId(): ?int
    {
        return $this->get('health_professional_taxonomy_id');
    }
}
