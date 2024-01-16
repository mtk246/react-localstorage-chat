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

enum ColumnsViewChangeModule: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('User name')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case USER_NAME = 'user_name';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Module')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case MODULE = 'module';

    #[TypeAttribute('string')]
    #[TextAttribute('Event')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case EVENT = 'event';

    #[TypeAttribute('string')]
    #[TextAttribute('12-14Hrs')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FIRST_HRS = 'firsthrs';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('14-16Hrs')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case SECOND_HRS = 'secondhrs';

    #[TypeAttribute('string')]
    #[TextAttribute('16-18hrs')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case THIRD_HRS = 'thirdhrs';

    #[TypeAttribute('string')]
    #[TextAttribute('18-20hrs')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case ADMISISON_DATE = 'quarterhrs';

    #[TypeAttribute('string')]
    #[TextAttribute('20-22hrs')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FIFTH_HRS = 'fifthhrs';

    #[TypeAttribute('string')]
    #[TextAttribute('22-24hrs')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case SIXT_HRS = 'sixthrs';
}
