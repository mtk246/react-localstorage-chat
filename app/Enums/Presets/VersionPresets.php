<?php

declare(strict_types=1);

namespace App\Enums\Presets;

use App\Enums\Interfaces\TypeInterface;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\NumberAttribute;
use App\Enums\Attributes\NextAttribute;
use App\Enums\Traits\HasVersionAttributes;

enum VersionPresets: string implements TypeInterface
{
    use HasVersionAttributes;

    #[NumberAttribute('v1')]
    #[NextAttribute('v1.1')]
    #[PublicAttribute(true)]
    case V1 = 'v1';
    
    #[NumberAttribute('v1.1')]
    #[NextAttribute('v1.2')]
    #[PublicAttribute(true)]
    case V1_1 = 'v1.1';
    
    #[NumberAttribute('v1.2')]
    #[NextAttribute('v1.3')]
    #[PublicAttribute(true)]
    case V1_2 = 'v1.2';
    
    #[NumberAttribute('v1.3')]
    #[NextAttribute('v1.4')]
    #[PublicAttribute(true)]
    case V1_3 = 'v1.3';
    
    #[NumberAttribute('v1.4')]
    #[NextAttribute('v1.5')]
    #[PublicAttribute(true)]
    case V1_4 = 'v1.4';
    
    #[NumberAttribute('v1.5')]
    #[NextAttribute('v1.6')]
    #[PublicAttribute(true)]
    case V1_5 = 'v1.5';
    
    #[NumberAttribute('v1.6')]
    #[NextAttribute('v1.7')]
    #[PublicAttribute(true)]
    case V1_6 = 'v1.6';
    
    #[NumberAttribute('v1.7')]
    #[NextAttribute('v1.8')]
    #[PublicAttribute(true)]
    case V1_7 = 'v1.7';
    
    #[NumberAttribute('v1.8')]
    #[NextAttribute('v1.9')]
    #[PublicAttribute(true)]
    case V1_8 = 'v1.8';
    
    #[NumberAttribute('v1.9')]
    #[NextAttribute('v1.10')]
    #[PublicAttribute(true)]
    case V1_9 = 'v1.9';
    
    #[NumberAttribute('v1.10')]
    #[NextAttribute('v2')]
    #[PublicAttribute(true)]
    case V1_10 = 'v1.10';
    
    #[NumberAttribute('v2')]
    #[NextAttribute('v2.1')]
    #[PublicAttribute(true)]
    case V2 = 'v2';
    
    #[NumberAttribute('v2.1')]
    #[NextAttribute('v2.2')]
    #[PublicAttribute(true)]
    case V2_1 = 'v2.1';
    
    #[NumberAttribute('v2.2')]
    #[NextAttribute('v2.3')]
    #[PublicAttribute(true)]
    case V2_2 = 'v2.2';
    #[NumberAttribute('v2.3')]
    #[NextAttribute('v2.4')]
    #[PublicAttribute(true)]
    case V2_3 = 'v2.3';
    
    #[NumberAttribute('v2.4')]
    #[NextAttribute('v2.5')]
    #[PublicAttribute(true)]
    case V2_4 = 'v2.4';
    
    #[NumberAttribute('v2.5')]
    #[NextAttribute('v2.6')]
    #[PublicAttribute(true)]
    case V2_5 = 'v2.5';
    
    #[NumberAttribute('v2.6')]
    #[NextAttribute('v2.7')]
    #[PublicAttribute(true)]
    case V2_6 = 'v2.6';
    
    #[NumberAttribute('v2.7')]
    #[NextAttribute('v2.8')]
    #[PublicAttribute(true)]
    case V2_7 = 'v2.7';
    
    #[NumberAttribute('v2.8')]
    #[NextAttribute('v2.9')]
    #[PublicAttribute(true)]
    case V2_8 = 'v2.8';
    
    #[NumberAttribute('v2.9')]
    #[NextAttribute('v2.10')]
    #[PublicAttribute(true)]
    case V2_9 = 'v2.9';
    
    #[NumberAttribute('v2.10')]
    #[NextAttribute('v2.10')]
    #[PublicAttribute(true)]
    case V2_10 = 'v2.10';
}

