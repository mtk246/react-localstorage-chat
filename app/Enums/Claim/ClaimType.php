<?php

declare(strict_types=1);

namespace App\Enums\Claim;

enum ClaimType: int
{
    case PROFESSIONAL = 1;
    case INSTITUTIONAL = 2;
}
