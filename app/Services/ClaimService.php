<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Claim\FormatType;
use App\Models\Claims\Claim;
use App\Models\Company;
use App\Models\InsuranceCompany;
use App\Services\Claim\DictionaryInterface;
use App\Services\Claim\FileDictionary;
use App\Services\Claim\JSONDictionary;
use App\Services\Claim\X12Dictionary;

final class ClaimService
{
    public function create(FormatType $formatType, Claim $claim, ?Company $company, ?InsuranceCompany $insuranceCompany): DictionaryInterface
    {
        return match ($formatType) {
            FormatType::FILE => new FileDictionary($claim, $company, $insuranceCompany),
            FormatType::X12 => new X12Dictionary($claim, $company, $insuranceCompany),
            FormatType::JSON => new JSONDictionary($claim, $company, $insuranceCompany),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }
}
