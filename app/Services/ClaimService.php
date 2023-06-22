<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Claim\FormatType;
use App\Models\Claims\Claim;
use App\Services\Claim\DictionaryInterface;
use App\Services\Claim\FileDictionary;
use App\Services\Claim\X12Dictionary;

final class ClaimService
{
    public function create(FormatType $formatType, Claim $claim): DictionaryInterface
    {
        return match ($formatType) {
            FormatType::FILE => new FileDictionary($claim),
            FormatType::X12 => new X12Dictionary($claim),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }
}
