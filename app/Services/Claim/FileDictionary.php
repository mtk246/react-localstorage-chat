<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\FormatType;

final class FileDictionary extends Dictionary
{
    protected string $format = FormatType::FILE;

    protected function getCompanyAttribute(string $key): string
    {
        return (string) $this->company->getAttribute($key);
    }

    protected function getPatientCompanyAttribute(string $key): string
    {
        return (string) $this->claim
            ->demographicInformation
            ->patient
            ?->companies
            ?->find($this->company->id ?? null)
            ?->pivot
            ?->med_num ?? '';
    }
}
