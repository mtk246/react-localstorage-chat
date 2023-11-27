<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class StatementCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->has('id', $this->inputs)
            ? $this->getInt('id')
            : 0;
    }

    public function getBillingCompanyId(): ?int
    {
        return $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : null;
    }

    public function getRuleId(): ?int
    {
        return $this->get('rule_id')
            ? (int) $this->get('rule_id')
            : null;
    }

    public function getWhenId(): ?int
    {
        return $this->get('when_id')
            ? (int) $this->get('when_id')
            : null;
    }

    public function getApplyToIds(): array
    {
        return $this->getArray('apply_to_ids');
    }

    public function getStartDate(): ?string
    {
        return $this->get('start_date');
    }

    public function getEndDate(): ?string
    {
        return $this->get('end_date');
    }
}
