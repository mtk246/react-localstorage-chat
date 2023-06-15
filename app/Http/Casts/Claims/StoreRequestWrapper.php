<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use App\Models\Claims\ClaimStatus;
use Illuminate\Support\Facades\Gate;

final class StoreRequestWrapper extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->inputs)
            ? (int) $this->inputs['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getData(): array
    {
        return [
            'type' => $this->get('type'),
            'format' => $this->get('format'),
            'control_number' => $this->get('control_number'),
            'submitter_name' => $this->get('submitter_name'),
            'submitter_contact' => $this->get('submitter_contact'),
            'submitter_phone' => $this->get('submitter_phone'),
            'billing_company_id' => $this->getBillingCompanyId(),
            'aditional_information' => $this->getAditionalInformation()->getExtraData(),
        ];
    }

    public function getDraft(): bool
    {
        return (bool) $this->get('draft');
    }

    public function getStatus(): string
    {
        return $this->getDraft()
            ? ClaimStatus::whereStatus('Draft')->first()?->status
            : $this->get('status');
    }

    public function getSubStatus(): ?string
    {
        return !$this->getDraft()
            ? $this->get('sub_status')
            : null;
    }

    public function getDemographicInformation(): DemographicInformationWrapper
    {
        return $this->cast('demographic_information', DemographicInformationWrapper::class);
    }

    public function getClaimServices(): ClaimServicesWrapper
    {
        return $this->cast('claim_services', ClaimServicesWrapper::class);
    }

    public function getPoliciesInsurances(): PoliciesInsurancesWrapper
    {
        return $this->cast('policies_insurances', PoliciesInsurancesWrapper::class);
    }

    public function getAditionalInformation(): AditionalInformationWrapper
    {
        return $this->cast('aditional_information', AditionalInformationWrapper::class);
    }
}
