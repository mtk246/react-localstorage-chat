<?php

declare(strict_types=1);

namespace App\Http\Casts\Presets;

use App\Enums\Presets\VersionPresets;
use App\Http\Casts\CastsRequest;

final class StoreRequestCast extends CastsRequest
{
    public function getData($basePresetId = null): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'is_private' => $this->getIsPrivate(),
            'filter' => $this->getFilter(),
            'version' => $this->getVersion($basePresetId),
            'user_id' => $this->getUserId(),
            'report_id' => $this->getReporId(),
            'billing_company_id' => $this->getBillingCompanyId(),
        ];
    }

    public function getVersion($basePreset): string
    {
        if (!$basePreset) {
            return VersionPresets::getValue('V1');
        }

        return match ($basePreset) {
            VersionPresets::V1 => 'v1.1',
            VersionPresets::V1_1 => 'v1.2',
            VersionPresets::V1_2 => 'v1.3',
            VersionPresets::V1_3 => 'v1.4',
            VersionPresets::V1_4 => 'v1.5',
            VersionPresets::V1_5 => 'v1.6',
            VersionPresets::V1_6 => 'v1.7',
            VersionPresets::V1_7 => 'v1.8',
            VersionPresets::V1_8 => 'v1.9',
            VersionPresets::V1_9 => 'v1.10',
            VersionPresets::V1_10 => 'v2',
            VersionPresets::V2 => 'v2.1',
            VersionPresets::V2_1 => 'v2.2',
            VersionPresets::V2_2 => 'v2.3',
            VersionPresets::V2_3 => 'v2.4',
            VersionPresets::V2_4 => 'v2.5',
            VersionPresets::V2_5 => 'v2.6',
            VersionPresets::V2_6 => 'v2.7',
            VersionPresets::V2_7 => 'v2.8',
            VersionPresets::V2_8 => 'v2.9',
            VersionPresets::V2_9 => 'v2.10',
        };
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
