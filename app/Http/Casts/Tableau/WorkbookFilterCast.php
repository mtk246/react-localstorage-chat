<?php

declare(strict_types=1);

namespace App\Http\Casts\Tableau;

use App\Enums\Tableau\WorkbookGroupType;
use App\Enums\Tableau\WorkbookType;
use App\Http\Casts\CastsRequest;

final class WorkbookFilterCast extends CastsRequest
{
    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getType(): ?WorkbookType
    {
        return $this->get('type')
            ? WorkbookType::tryFrom($this->get('type'))
            : null;
    }

    public function getGroup(): ?WorkbookGroupType
    {
        return $this->get('group')
            ? WorkbookGroupType::tryFrom($this->get('group'))
            : null;
    }
}
