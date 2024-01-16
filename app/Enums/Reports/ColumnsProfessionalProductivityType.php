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

enum ColumnsProfessionalProductivityType: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case COMPANIES = 'companies';

    #[TypeAttribute('string')]
    #[TextAttribute('Healthcare Professional')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case HEALTHCARE_PROFESSIONAL = 'healthcare_professional';

    #[TypeAttribute('string')]
    #[TextAttribute('NPI')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case NPI = 'npi';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Facility')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case FACILITY = 'facility';

    #[TypeAttribute('string')]
    #[TextAttribute('Patient Count')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PATIENT_COUNT = 'patient_count';

    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';

    #[TypeAttribute('string')]
    #[TextAttribute('Charges amount')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case CHARGE_AMOUNT = 'charges_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Charge count')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case CHARGE_COUNT = 'charge_count';

    #[TypeAttribute('string')]
    #[TextAttribute('Distinct Charge count')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case DISTINCT_CHARGE_COUNT = 'distinct_charge_count';

    #[TypeAttribute('string')]
    #[TextAttribute('Total payments')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case TOTAL_PAYMENTS = 'total_payments';

    #[TypeAttribute('string')]
    #[TextAttribute('Payments amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PAYMENTS_AMOUNT = 'payments_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Total write offs')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TOTAL_WRITE_OFFS = 'total_write_offs';

    #[TypeAttribute('string')]
    #[TextAttribute('Write offs amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case WRITEOFFS_AMOUNT = 'writeoffs_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Total denied')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TOTAL_DENIED = 'total_denied';

    #[TypeAttribute('string')]
    #[TextAttribute('Plan')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case PLAN = 'plan';
}
