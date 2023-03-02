<?php

declare(strict_types=1);

namespace App\Http\Requests\Casts;

use App\Models\MacLocality;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class ContractFeesRequestCast
{
    /** @param array<key, string|int|null> $items*/
    public function __construct(private array $items, private User $user)
    {
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && array_key_exists('billing_company_id', $this->items)
            ? (int) $this->items['billing_company_id']
            : $this->user->billingCompanies->first()?->id;
    }

    public function getInsurancePlanId(): ?int
    {
        return array_key_exists('insurance_plan_id', $this->items)
            ? (int) $this->items['insurance_plan_id']
            : null;
    }

    public function getInsuranceCompanyId(): ?int
    {
        return array_key_exists('insurance_company_id', $this->items)
            ? (int) $this->items['insurance_company_id']
            : null;
    }

    public function getTypeId(): ?int
    {
        return array_key_exists('type_id', $this->items)
            ? (int) $this->items['type_id']
            : null;
    }

    public function getStartDate(): ?string
    {
        return array_key_exists('start_date', $this->items)
            ? $this->items['start_date']
            : null;
    }

    public function getEndDate(): ?string
    {
        return array_key_exists('end_date', $this->items)
            ? $this->items['end_date']
            : null;
    }

    public function getProceduresIds(): Collection
    {
        return collect($this->items['procedure_id'] ?? []);
    }

    public function getModifierId(): ?int
    {
        return array_key_exists('modifier_id', $this->items)
            ? (int) $this->items['modifier_id']
            : null;
    }

    public function getPrice(): ?int
    {
        return array_key_exists('price', $this->items)
            ? (int) $this->items['price']
            : null;
    }

    public function getMac(): ?string
    {
        return array_key_exists('state', $this->items)
            ? $this->items['mac']
            : null;
    }

    public function getLocalityNumber(): ?string
    {
        return array_key_exists('fsa', $this->items)
            ? $this->items['locality_number']
            : null;
    }

    public function getState(): ?string
    {
        return array_key_exists('state', $this->items)
            ? $this->items['state']
            : null;
    }

    public function getFsa(): ?string
    {
        return array_key_exists('fsa', $this->items)
            ? $this->items['fsa']
            : null;
    }

    public function getCounties(): ?string
    {
        return array_key_exists('counties', $this->items)
            ? $this->items['counties']
            : null;
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return array_key_exists('insurance_label_fee_id', $this->items)
            ? (int) $this->items['insurance_label_fee_id']
            : null;
    }

    public function getPricePercentage(): ?int
    {
        return array_key_exists('price_percentage', $this->items)
            ? (int) $this->items['price_percentage']
            : null;
    }

    public function getPrivateNote(): ?string
    {
        return array_key_exists('private_note', $this->items)
            ? $this->items['private_note']
            : null;
    }

    public function getMacLocality(): ?MacLocality
    {
        $query = MacLocality::query();

        if ($this->getMac()) {
            $query = $query->where('mac', $this->getMac());
        }

        if ($this->getLocalityNumber()) {
            $query = $query->where('locality_number', $this->getLocalityNumber());
        }

        if ($this->getState()) {
            $query = $query->where('state', $this->getState());
        }

        if ($this->getFsa()) {
            $query = $query->where('fsa', $this->getFsa());
        }

        if ($this->getCounties()) {
            $query = $query->where('counties', $this->getCounties());
        }

        return $query->first() ?? null;
    }
}
