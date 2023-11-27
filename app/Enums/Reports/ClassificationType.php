<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\BackgroundColorAttribute;
use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\IconAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextColorAttribute;
use App\Enums\Attributes\UrlAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColorsAttributes;
use App\Enums\Traits\HasIconAttributes;

enum ClassificationType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColorsAttributes;
    use HasIconAttributes;

    #[UrlAttribute('ClaimsReportsPDFGenerator/General2')]
    #[NameAttribute('Live insights')]
    #[DescriptionAttribute('Live insights')]
    #[BackgroundColorAttribute('#FFFAE6')]
    #[TextColorAttribute('#B04D12')]
    #[IconAttribute('ico-live-insights')]
    #[PublicAttribute(true)]
    case LIVE_INSIGHTS = 1;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Paymenttransactionaudit')]
    #[NameAttribute('Financial')]
    #[DescriptionAttribute('Financial')]
    #[BackgroundColorAttribute('#E9FDF2')]
    #[TextColorAttribute('#1B6D49')]
    #[IconAttribute('ico-financial')]
    #[PublicAttribute(true)]
    case FINANCIAL = 2;

    #[UrlAttribute('ReportsBeOS_16947907094600/Dashboard1')]
    #[NameAttribute('Productivity')]
    #[DescriptionAttribute('Productivity')]
    #[BackgroundColorAttribute('#E3F8FF')]
    #[TextColorAttribute('#018ECC')]
    #[IconAttribute('ico-productivity')]
    #[PublicAttribute(true)]
    case PRODUCTIVITY = 3;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Productivity')]
    #[NameAttribute('Audit')]
    #[DescriptionAttribute('Audit')]
    #[BackgroundColorAttribute('#FFF1F1')]
    #[TextColorAttribute('#A72821')]
    #[IconAttribute('ico-auditoring')]
    #[PublicAttribute(true)]
    case AUDITORING = 4;

    #[UrlAttribute('ClaimsReportsPDFGenerator/DailyInsuranceResponsibilityAging')]
    #[NameAttribute('Sheet reports')]
    #[DescriptionAttribute('Sheet reports')]
    #[BackgroundColorAttribute('#F2F2F2')]
    #[TextColorAttribute('#707070')]
    #[IconAttribute('ico-sheets-reports')]
    #[PublicAttribute(true)]
    case SHEET_REPORTS = 5;

    #[UrlAttribute('ClaimsReportsPDFGenerator/DailyInsuranceResponsibilityAging')]
    #[NameAttribute('Records')]
    #[DescriptionAttribute('All Records')]
    #[BackgroundColorAttribute('#E6E6E6')]
    #[TextColorAttribute('#808080')]
    #[IconAttribute('ico-records')]
    #[PublicAttribute(true)]
    case RECORDS_REPORTS = 6;

    public function getUrl(): string
    {
        return 'https://prod-useast-a.online.tableau.com/t/begento/views/'
            .$this->getAttribute(UrlAttribute::class);
    }
}
