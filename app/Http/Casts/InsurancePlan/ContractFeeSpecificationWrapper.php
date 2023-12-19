<?php

declare(strict_types=1);

namespace App\Http\Casts\InsurancePlan;

use App\Http\Casts\CastsRequest;
use App\Models\Company;
use App\Models\HealthProfessional;

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

    public function getHealthProfessionalId(): ?string
    {
        return $this->get('health_professional_id');
    }

    public function getHealthProfessionalTaxId(): ?string
    {
        return $this->get('health_professional_tax_id');
    }

    public function getHealthProfessionalTaxonomyId(): ?int
    {
        return $this->get('health_professional_taxonomy_id');
    }

    public function wrapperContractFeesSpecificationBody(): array
    {
        $billingProvider = explode(':', $this->getBillingProviderId());
        $healthProfessional = explode(':', $this->getHealthProfessionalId());

        return [
            'billing_provider_type' => ('healthProfessional' === $billingProvider[0]) ? HealthProfessional::class : Company::class,
            'billing_provider_id' => $billingProvider[1],
            'billing_provider_tax_id' => $this->getBillingProviderTaxId(),
            'billing_provider_taxonomy_id' => $this->getBillingProviderTaxonomyId(),
            'health_professional_id' => $healthProfessional[1] ?? null,
            'health_professional_tax_id' => $this->getHealthProfessionalTaxId(),
            'health_professional_taxonomy_id' => $this->getHealthProfessionalTaxonomyId(),
        ];
    }
}
