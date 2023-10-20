<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Enums\Company\MeasurementUnit;
use Illuminate\Support\Collection;

final class GetMeasurementUnitAction
{
    public function all(): Collection
    {
        return collect(MeasurementUnit::cases())
            ->filter(function ($item) {
                return $item->getPublic();
            })
            ->map(function ($item) {
                return [
                    'id' => $item->value,
                    'name' => $item->getCode() . ' - ' . $item->getDescription(),
                ];
            });
    }
}
