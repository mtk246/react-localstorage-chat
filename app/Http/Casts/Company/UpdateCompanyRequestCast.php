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
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getNpi(): ?int
    {
        return $this->getInt('npi');
    }

    public function getEin(): ?string
    {
        return $this->get('ein');
    }

    public function getOtherName(): ?string
    {
        return $this->get('other_name');
    }

    public function getClia(): ?string
    {
        return $this->get('clia');
    }

    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getSplitCompanyClaim(): ?bool
    {
        return $this->get('split_company_claim');
    }

    public function getNickname(): ?string
    {
        return $this->get('nickname');
    }

    public function getAbbreviation(): ?string
    {
        return $this->get('abbreviation');
    }

    public function getMiscellaneous(): ?string
    {
        return $this->get('miscellaneous');
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
            + ($this->getOtherName() ? ['other_name' => $this->getOtherName()] : [])
            + ($this->getClia() ? ['clia' => $this->getClia()] : []);
    }
}
