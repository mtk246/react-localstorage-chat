<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Resources\Claim\DenialBodyResource;
use App\Models\Claims\Claim;

final class GetDenialAction
{
    public function single(Claim $claim): DenialBodyResource
    {
        return DenialBodyResource::make($claim);
    }
}
