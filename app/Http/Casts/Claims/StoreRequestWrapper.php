<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use App\Models\Claims\ClaimStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

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
            'code' => Str::ulid(),
            'type' => $this->get('type'),
            'submitter_name' => $this->get('submitter_name'),
            'submitter_contact' => $this->get('submitter_contact'),
            'submitter_phone' => $this->get('submitter_phone'),
            'billing_company_id' => $this->getBillingCompanyId(),
            'aditional_information' => $this->getAdditionalInformation()->getExtraInformation()->toJson(),
        ];
    }

    public function getDraft(): bool
    {
        return (bool) $this->get('draft');
    }

    public function getStatus(): int
    {
        return $this->getDraft()
            ? ClaimStatus::whereStatus('Draft')->first()?->id
            : $this->get('status') ?? 2;
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

    public function getPoliciesInsurances(): Collection
    {
        return $this->getCollect('policies_insurances')
            ->mapWithKeys(function (array $policy) {
                return [$policy['insurance_policy_id'] => ['order' => $policy['order']]];
            });
    }

    public function getAdditionalInformation(): AditionalInformationWrapper
    {
        return $this->cast('additional_information', AditionalInformationWrapper::class);
    }
}