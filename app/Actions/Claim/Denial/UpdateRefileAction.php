<?php

declare(strict_types=1);

namespace App\Actions\Claim\Denial;

use App\Http\Casts\Claims\DenialRefileWrapper;
use App\Models\Claims\DenialRefile;

final class UpdateRefileAction
{
    public function invoke(DenialRefileWrapper $data): DenialRefile
    {
        $refile = $data->getRefile();
        $refile?->update($data->getData());

        return $refile?->refresh();
    }
}
