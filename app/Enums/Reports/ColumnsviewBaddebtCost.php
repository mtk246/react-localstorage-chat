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

enum ColumnsviewBaddebtCost: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Patient Account')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case SYSTEM_CODE = 'system_code';

    #[TypeAttribute('string')]
    #[TextAttribute('Patient Name')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case PATIENT_NAME = 'patient_name';

    #[TypeAttribute('string')]
    #[TextAttribute('Inpatient/Outpatient')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case INPATIENT_OUTPATIENTE = 'inpatient_outpatient';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Primery Insurance')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case PRIMARY_INSURANCE = 'primery_insurance';

    #[TypeAttribute('string')]
    #[TextAttribute('Secondary Insurance')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case SECONDARY_INSURANCE = 'secondary_insurance';

    #[TypeAttribute('string')]
    #[TextAttribute('Admission Date')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case ADMISISON_DATE = 'admission_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Discharge Date')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case DISCHARGE_DATE = 'discharge_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Write off Date')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case WRITE_OFF_DATE = 'write_off_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Amount')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case AMOUNT = 'amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Primary Pd Date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PRIMARY_PD_DATE = 'primary_pd_date';

    #[TypeAttribute('string')]
    #[TextAttribute('2nd Pd DatE')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case SECOND_PD_DATE = 'second_pd_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Patient 1st Bill Date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case FIRST_BIL_DATE = 'first_bil_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Write offs amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case WRITEOFFS_AMOUNT = 'writeoffs_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Patient 2nd Bill Date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SECOND_BIL_DATE = 'second_bil_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Patient 3rd Bill Date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case THIRD_BIL_DATE = 'third_bil_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Pt Phone Call Date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case PHONE_CALL_DATE = 'phone_call_date';
}
