<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\AlignAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Attributes\WidthAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColumnsAttributes;

enum ColumnsViewSobgDpr: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Provider')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case PROVIDER = 'provider';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Insurance')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case INSURANCE = 'insurance';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Account #')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case ACOUNT = 'account';

    #[TypeAttribute('string')]
    #[TextAttribute('Aging')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case AGING = 'aging';

    #[TypeAttribute('string')]
    #[TextAttribute('DOS')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case DOS = 'dos';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('ACTION TYPE')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case ACTION_TYPE = 'action_type';

    #[TypeAttribute('number')]
    #[AlignAttribute('center')]
    #[TextAttribute('Unpaid amount')]
    #[WidthAttribute('210px')]
    #[PublicAttribute(true)]
    case UNPAID_AMOUNT = 'unpaid_amount';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Status')]
    #[WidthAttribute('310px')]
    #[PublicAttribute(true)]
    case STATUS = 'status';
}
