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

enum ColumnsViewDailyInsuranceResponsibilityAging: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Billing companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case BILLING_COMPANIES = 'billing_companies';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Insurance')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case INSURANCE = 'insurance';

    #[TypeAttribute('string')]
    #[AlignAttribute('center')]
    #[TextAttribute('0_30')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FIRST_PERIOD = 'first_period';

    #[TypeAttribute('string')]
    #[TextAttribute('31_60')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SECOND_PERIOD = 'second_period';

    #[TypeAttribute('string')]
    #[TextAttribute('61_90')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case THIRD_PERIOD = 'third_period';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('91_120')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case FOURTH_PERIOD = 'fourth_period';

    #[TypeAttribute('string')]
    #[TextAttribute('121_150')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case FIFTH_PERIOD = 'fifth_period';

    #[TypeAttribute('string')]
    #[TextAttribute('151_180')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case SIXTH_PERIOD = 'sixth_period';

    #[TypeAttribute('string')]
    #[TextAttribute('181_210')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case SEVENTH_PERIOD = 'seventh_period';

    #[TypeAttribute('string')]
    #[TextAttribute('211_240')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case EIGHTH_PERIOD = 'eighth_period';

    #[TypeAttribute('string')]
    #[TextAttribute('241 +')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case NINTH_PERIOD = 'ninth_period';

    #[TypeAttribute('string')]
    #[TextAttribute('Total again')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case TOTAL_AGAIN = 'total_again';
}
