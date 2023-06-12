<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class DemographicInformationWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [];
    }
}
