<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class UpdateCompanyRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->inputs)
            ? (int) $this->inputs['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getNpi(): ?int
    {
        return array_key_exists('npi', $this->inputs)
            ? (int) $this->inputs['npi']
            : null;
    }

    public function getEin(): ?string
    {
        return array_key_exists('ein', $this->inputs)
            ? $this->inputs['ein']
            : null;
    }

    public function getOtherName(): ?string
    {
        return array_key_exists('other_name', $this->inputs)
            ? $this->inputs['other_name']
            : null;
    }

    public function getClia(): ?string
    {
        return array_key_exists('clia', $this->inputs)
            ? $this->inputs['clia']
            : null;
    }

    public function getName(): ?string
    {
        return array_key_exists('name', $this->inputs)
            ? $this->inputs['name']
            : null;
    }

    public function getSplitCompanyClaim(): ?bool
    {
        return array_key_exists('split_company_claim', $this->inputs)
            ? $this->inputs['split_company_claim']
            : false;
    }

    public function getNickname(): ?string
    {
        return array_key_exists('nickname', $this->inputs)
            ? $this->inputs['nickname']
            : null;
    }

    public function getAbbreviation(): ?string
    {
        return array_key_exists('abbreviation', $this->inputs)
            ? $this->inputs['abbreviation']
            : null;
    }

    public function getMiscellaneous(): ?string
    {
        return array_key_exists('miscellaneous', $this->inputs)
            ? $this->inputs['miscellaneous']
            : null;
    }

    public function getClaimFormats(): array
    {
        return $this->getArray('claim_format_ids');
    }

    public function getTaxonomies(): Collection
    {
        return collect($this->getArray('taxonomies'));
    }

    public function getCompanyValues(): array
    {
        return ($this->getEin() ? ['ein' => $this->getEin()] : [])
            + ($this->getSplitCompanyClaim() ? ['split_company_claim' => $this->getSplitCompanyClaim()] : [])
            + ($this->getOtherName() ? ['other_name' => $this->getOtherName()] : [])
            + ($this->getClia() ? ['clia' => $this->getClia()] : []);
    }
}
