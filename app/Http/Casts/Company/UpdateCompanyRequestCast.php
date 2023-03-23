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

    public function getUpin(): ?string
    {
        return array_key_exists('upin', $this->inputs)
            ? $this->inputs['upin']
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

    public function getTaxonomies(): Collection
    {
        return collect($this->getArray('taxonomies'));
    }

    public function getCompanyValues(): array
    {
        return ($this->getEin() ? ['ein' => $this->getEin()] : [])
            + ($this->getUpin() ? ['upin' => $this->getUpin()] : [])
            + ($this->getClia() ? ['clia' => $this->getClia()] : []);
    }
}
