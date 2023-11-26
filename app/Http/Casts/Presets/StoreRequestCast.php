<?php

declare(strict_types=1);

namespace App\Http\Casts\Presets;

use App\Enums\Presets\VersionPresets;
use App\Http\Casts\CastsRequest;

final class StoreRequestCast extends CastsRequest
{
    public function getData(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'is_private' => $this->getIsPrivate(),
            'filter' => $this->getFilter(),
            'version' => VersionPresets::V1,
            'user_id' => $this->getUserId(),
            'report_id' => $this->getReporId(),
            'billing_company_id' => $this->getBillingCompanyId(),
        ];
    }

    public function getBillingCompanyId(): ?int
    {
        return \Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getName(): mixed
    {
        return $this->get('name');
    }

    public function getFilter(): mixed
    {
        return json_encode($this->get('filter'));
    }

    public function getDescription(): mixed
    {
        return $this->get('description');
    }

    public function getIsPrivate(): bool
    {
        return $this->getBool('is_private');
    }

    public function getUserId(): int
    {
        return \Auth::user()->id;
    }

    public function getReporId()
    {
        return $this->get('reportId');
    }
}
