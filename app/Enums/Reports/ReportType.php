<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\UrlAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum ReportType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;

    public const TABLEAU_URL = 'https://prod-useast-a.online.tableau.com/t/begento/views/';

    #[UrlAttribute('ClaimsReportsPDFGenerator/General2', self::TABLEAU_URL)]
    #[DescriptionAttribute('General Report')]
    #[PublicAttribute(true)]
    case GENERAL_REPORT = 1;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Paymenttransactionaudit', self::TABLEAU_URL)]
    #[DescriptionAttribute('Posted Payment Transaction Audit Report')]
    #[PublicAttribute(true)]
    case POSTED_PAYMENT_TRANSACTION_AUDIT_REPORT = 2;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Payments2', self::TABLEAU_URL)]
    #[DescriptionAttribute('Payments')]
    #[PublicAttribute(true)]
    case PAYMENTS = 3;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Productivity', self::TABLEAU_URL)]
    #[DescriptionAttribute('Productivity')]
    #[PublicAttribute(true)]
    case PRODUCTIVITY = 4;

    #[UrlAttribute('ClaimsReportsPDFGenerator/DailyInsuranceResponsibilityAging', self::TABLEAU_URL)]
    #[DescriptionAttribute('Daily Insurance Responsibility Aging')]
    #[PublicAttribute(true)]
    case DAILY_INSURANCE_RESPONSIBILITY_AGING = 5;

    #[UrlAttribute('ClaimsReportsPDFGenerator/BadDebt', self::TABLEAU_URL)]
    #[DescriptionAttribute('Bad Debt Amount General Report')]
    #[PublicAttribute(true)]
    case BAD_DEBT_AMOUNT_GENERAL_REPORT = 6;

    #[UrlAttribute('ClaimsReportsPDFGenerator/Charges/7620d2a6-b5e6-4bf5-96ff-fe5da3e4fa76/e8ee638c-fb84-4628-8000-f1f803ce426b', self::TABLEAU_URL)]
    #[DescriptionAttribute('Charges Report')]
    #[PublicAttribute(true)]
    case CHARGES_REPORT = 7;

    public function getUrl(): string
    {
        return $this->getAttribute(UrlAttribute::class);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(DescriptionAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}
