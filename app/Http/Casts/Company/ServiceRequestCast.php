<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use App\Models\MacLocality;
use Illuminate\Database\Eloquent\Builder;

final class ServiceRequestCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function getBillingCompanyId(): ?int
    {
        return $this->getInt('billing_company_id');
    }

    public function getProcedureId(): ?int
    {
        return $this->get('procedure_id');
    }

    public function getModifierId(): ?int
    {
        return $this->get('modifier_id');
    }

    public function getRevenueCodeId(): ?int
    {
        return $this->get('revenue_code_id');
    }

    public function getPrice(): ?float
    {
        return $this->has('price')
            ? (float) $this->get('price')
            : null;
    }

    public function getMac(): ?string
    {
        return $this->has('state')
            ? $this->get('mac')
            : null;
    }

    public function getLocalityNumber(): ?string
    {
        return $this->has('fsa')
            ? $this->get('locality_number')
            : null;
    }

    public function getState(): ?string
    {
        return $this->get('state');
    }

    public function getFsa(): ?string
    {
        return $this->get('fsa');
    }

    public function getCounties(): ?string
    {
        return $this->get('counties');
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return $this->get('insurance_label_fee_id');
    }

    public function getPricePercentage(): ?int
    {
        return $this->get('price_percentage');
    }

    public function getClia(): ?string
    {
        return $this->get('clia');
    }

    public function getMedicationApplication(): bool
    {
        return $this->getBool('medication_application');
    }

    public function getMedication(): ?MedicationRequestCast
    {
        return $this->cast('medication', MedicationRequestCast::class);
    }

    public function getMacLocality(): ?MacLocality
    {
        $cond = 0;
        $query = MacLocality::query()
            ->when($this->getMac(), function (Builder $query) use (&$cond): void {
                ++$cond;
                $query->where('mac', $this->getMac());
            })
            ->when($this->getLocalityNumber(), function (Builder $query) use (&$cond): void {
                ++$cond;
                $query->where('locality_number', $this->getLocalityNumber());
            })
            ->when($this->getState(), function (Builder $query) use (&$cond): void {
                ++$cond;
                $query->where('state', $this->getState());
            })
            ->when($this->getFsa(), function (Builder $query) use (&$cond): void {
                ++$cond;
                $query->where('fsa', $this->getFsa());
            })
            ->when($this->getCounties(), function (Builder $query) use (&$cond): void {
                ++$cond;
                $query->where('counties', $this->getCounties());
            });

        return $cond > 0
            ? $query->first()
            : null;
    }
}
