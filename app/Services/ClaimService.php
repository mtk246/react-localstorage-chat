<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Claim\FormatType;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Company;
use App\Models\InsurancePlan;
use App\Services\Claim\DictionaryInterface;
use App\Services\Claim\FileDictionary;
use App\Services\Claim\JSONDictionary;
use App\Services\Claim\X12Dictionary;

final class ClaimService
{
    public function create(FormatType $formatType, Claim $claim, ?Company $company, ?InsurancePlan $insurancePlan, ?ClaimBatch $batch = null): DictionaryInterface
    {
        return match ($formatType) {
            FormatType::FILE => new FileDictionary($claim, $company, $insurancePlan),
            FormatType::X12 => new X12Dictionary($claim, $company, $insurancePlan),
            FormatType::JSON => new JSONDictionary($claim, $company, $insurancePlan, $batch),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }
}
