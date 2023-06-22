<?php

declare(strict_types=1);

namespace App\Enums\Claim;

enum ClaimType: string
{
    case INSTITUTIONAL = 'institutional';
    case PROFESSIONAL = 'professional';
}
