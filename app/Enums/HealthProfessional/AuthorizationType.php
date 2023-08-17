<?php

declare(strict_types=1);

namespace App\Enums\HealthProfessional;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasCatalogAttributes;

enum AuthorizationType: int
{
    use HasAttributes;
    // use HasCatalogAttributes;

    #[NameAttribute('Service provider')]
    #[PublicAttribute(true)]
    case SERVICE = 1;

    #[NameAttribute('Billing provider')]
    #[PublicAttribute(true)]
    case BILLING = 2;

    #[NameAttribute('Referred')]
    #[PublicAttribute(true)]
    case REFERRED = 3;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}
