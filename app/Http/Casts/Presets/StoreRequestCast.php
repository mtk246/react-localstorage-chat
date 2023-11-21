<?php

declare(strict_types=1);

namespace App\Http\Casts\Presets;

use App\Http\Casts\CastsRequest;
use App\Models\Reports\Report;

final class StoreRequestCast extends CastsRequest
{
    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function getFilter(): array
    {
        return $this->getArray('filter');
    }

    public function getBaseReport(): ?Report
    {
        return $this->get('base_report_id')
            ? Report::findOrFail($this->get('base_report_id'))
            : null;
    }
}
