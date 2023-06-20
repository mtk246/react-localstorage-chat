<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;

final class AditionalInformationWrapper extends CastsRequest
{
    public function getExtraData(): array
    {
        return [];
    }

    public function getDateInformation(): array
    {
        return [];
    }

    public function getPatientInformation(): array
    {
        return [];
    }
}
