<?php

declare(strict_types=1);

namespace App\Enums\Claim;

enum ClaimType: int
{
    case INSTITUTIONAL = 1;
    case PROFESSIONAL = 2;
}
