<?php

declare(strict_types=1);

namespace App\Http\Casts\Reports;

use App\Http\Casts\CastsRequest;

final class ConfigurationCast extends CastsRequest
{
    public function getColums(): array
    {
        return $this->getArray('colums');
    }

    public function toArray(): array
    {
        return [
            'colums' => $this->getColums(),
        ];
    }
}
