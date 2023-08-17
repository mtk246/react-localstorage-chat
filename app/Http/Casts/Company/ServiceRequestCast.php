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
        return array_key_exists('id', $this->inputs)
            ? (int) $this->inputs['id']
            : null;
    }

    public function getBillingCompanyId(): ?int
    {
        return array_key_exists('billing_company_id', $this->inputs)
            ? $this->inputs['billing_company_id']
            : null;
    }

    public function getProcedureIds(): ?array
    {
        return $this->get('procedure_ids');
    }

    public function getModifierIds(): ?array
    {
        return $this->get('modifier_ids');
    }

    public function getPrice(): ?float
    {
        return array_key_exists('price', $this->inputs)
            ? (float) $this->inputs['price']
            : null;
    }

    public function getMac(): ?string
    {
        return array_key_exists('state', $this->inputs)
            ? $this->inputs['mac']
            : null;
    }

    public function getLocalityNumber(): ?string
    {
        return array_key_exists('fsa', $this->inputs)
            ? $this->inputs['locality_number']
            : null;
    }

    public function getState(): ?string
    {
        return array_key_exists('state', $this->inputs)
            ? $this->inputs['state']
            : null;
    }

    public function getFsa(): ?string
    {
        return array_key_exists('fsa', $this->inputs)
            ? $this->inputs['fsa']
            : null;
    }

    public function getCounties(): ?string
    {
        return array_key_exists('counties', $this->inputs)
            ? $this->inputs['counties']
            : null;
    }

    public function getInsuranceLabelFeeId(): ?int
    {
        return $this->get('insurance_label_fee_id');
    }

    public function getPricePercentage(): ?int
    {
        return array_key_exists('price_percentage', $this->inputs)
            ? (int) $this->inputs['price_percentage']
            : null;
    }

    public function getClia(): ?string
    {
        return array_key_exists('clia', $this->inputs)
            ? $this->inputs['clia']
            : null;
    }

    public function getMedicationApplication(): bool
    {
        return array_key_exists('medication_application', $this->inputs)
            ? (bool) $this->inputs['medication_application']
            : false;
    }

    public function getMedication(): MedicationRequestCast
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
