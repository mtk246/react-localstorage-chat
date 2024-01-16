<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use App\Models\BillingCompany;
use App\Models\Claims\ClaimStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

final class StoreRequestWrapper extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getData(): array
    {
        $submitter = BillingCompany::query()->find($this->getBillingCompanyId());

        return [
            'code' => Str::ulid(),
            'type' => $this->get('type'),
            'submitter_name' => $this->get('submitter_name') ?? $submitter?->name ?? '',
            'submitter_contact' => $this->get('submitter_contact') ?? str_replace('-', '', $submitter?->contact?->contact_name ?? $submitter?->name ?? ''),
            'submitter_phone' => $this->get('submitter_phone') ?? str_replace('-', '', $submitter?->contact?->phone ?? ''),
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
            : ClaimStatus::whereStatus('Not submitted')->first()?->id;
    }

    public function getSubStatus(): ?int
    {
        return $this->getDraft()
            ? $this->get('sub_status_id')
            : null;
    }

    public function getDemographicInformation(): DemographicInformationWrapper
    {
        return $this->cast('demographic_information', DemographicInformationWrapper::class);
    }

    public function getPrivateNote(string $preNote = 'Claim created successfully'): ?string
    {
        return $this->getDraft()
            ? $this->get('private_note')
            : ((false === ($this->get('demographic_information')['validate'] ?? false))
                ? ($preNote.', system verification')
                : ($preNote.', automated verification'));
    }

    public function getClaimServices(): ClaimServicesWrapper
    {
        return $this->cast('claim_services', ClaimServicesWrapper::class);
    }

    public function getPoliciesInsurances(): Collection
    {
        return $this->getCollect('insurance_policies')
            ->mapWithKeys(function (array $policy) {
                return [$policy['insurance_policy_id'] => ['order' => $policy['order']]];
            })
            ->filter(function ($policy, $index) {
                return $index > 0;
            });
    }

    public function getAdditionalInformation(): AditionalInformationWrapper
    {
        return $this->cast('additional_information', AditionalInformationWrapper::class);
    }
}
