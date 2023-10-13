<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasCodeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CodeValueFields: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasTypeAttributes;
    use HasCodeAttribute;

    #[CodeAttribute('01')]
    #[NameAttribute('Most common Semi-Private Rate')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_01 = 1;

    #[CodeAttribute('02')]
    #[NameAttribute('Hospital has no semi-private rooms')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_02 = 2;

    #[CodeAttribute('04')]
    #[NameAttribute('Professional component charges, combined billed')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_04 = 3;

    #[CodeAttribute('05')]
    #[NameAttribute('Professional component included, billed to carrier')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_05 = 4;

    #[CodeAttribute('06')]
    #[NameAttribute('Blood deductible')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_06 = 5;

    #[CodeAttribute('08')]
    #[NameAttribute('LTR amount, 1st calendar year')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_08 = 6;

    #[CodeAttribute('09')]
    #[NameAttribute('Co-ins amount, 1st calendar year')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_09 = 7;

    #[CodeAttribute('10')]
    #[NameAttribute('LTR amount, 2nd calendar year')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_10 = 8;

    #[CodeAttribute('11')]
    #[NameAttribute('Co-ins amount, 2nd calendar year')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_11 = 9;

    #[CodeAttribute('12')]
    #[NameAttribute('Working aged bene/spouse with EGHP')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_12 = 10;

    #[CodeAttribute('13')]
    #[NameAttribute('ESRD bene in Medicare coord period with EGHP')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_13 = 11;

    #[CodeAttribute('14')]
    #[NameAttribute('No-fault, including auto/other ins')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_14 = 12;

    #[CodeAttribute('15')]
    #[NameAttribute("Worker's compensation")]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_15 = 13;

    #[CodeAttribute('16')]
    #[NameAttribute('PHS or other federal agency')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_16 = 14;

    #[CodeAttribute('17')]
    #[NameAttribute('Operating Outlier Amount (Not reported by providers)')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_17 = 15;

    #[CodeAttribute('18')]
    #[NameAttribute('Operating Disproportionate Share Amount (Not reported by providers)')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_18 = 16;

    #[CodeAttribute('19')]
    #[NameAttribute('Operating Indirect medical education on Unibill (IME) (Not reported by providers)')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_19 = 17;

    #[CodeAttribute('20')]
    #[NameAttribute('Payer Code (For internal use by third party payers only)')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_20 = 18;

    #[CodeAttribute('21')]
    #[NameAttribute('Catastrophic')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_21 = 19;

    #[CodeAttribute('22')]
    #[NameAttribute('Surplus')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_22 = 20;

    #[CodeAttribute('23')]
    #[NameAttribute('Recurring monthly income')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_23 = 21;

    #[CodeAttribute('24')]
    #[NameAttribute('Medicaid rate code')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_24 = 22;

    #[CodeAttribute('25')]
    #[NameAttribute('Offset to pt-pymnt amnt - RX drugs')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_25 = 23;

    #[CodeAttribute('26')]
    #[NameAttribute('Offset to pt-pymnt amnt - hearing & ear')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_26 = 24;

    #[CodeAttribute('27')]
    #[NameAttribute('Offset to pt-pymnt amnt - vision & eye')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_27 = 25;

    #[CodeAttribute('28')]
    #[NameAttribute('Offset to pt-pymnt amnt - dental services')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_28 = 26;

    #[CodeAttribute('29')]
    #[NameAttribute('Offset to pt-pymnt amnt - chiropractic')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_29 = 27;

    #[CodeAttribute('30')]
    #[NameAttribute('Pre-admission testing')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_30 = 28;

    #[CodeAttribute('31')]
    #[NameAttribute('Patient liability amount')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_31 = 29;

    #[CodeAttribute('32')]
    #[NameAttribute('Multiple patient ambulance transport')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_32 = 30;

    #[CodeAttribute('33')]
    #[NameAttribute('Offset to pt-pymnt amnt - podiatric')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_33 = 31;

    #[CodeAttribute('34')]
    #[NameAttribute('Offset to pt-pymnt amnt - other medical')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_34 = 32;

    #[CodeAttribute('35')]
    #[NameAttribute('Offset to pt-pymnt amnt - health ins. Prem')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_35 = 33;

    #[CodeAttribute('37')]
    #[NameAttribute('Units of blood furnished')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_37 = 34;

    #[CodeAttribute('38')]
    #[NameAttribute('Blood deductible units')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_38 = 35;

    #[CodeAttribute('39')]
    #[NameAttribute('Units of blood replaced')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_39 = 36;

    #[CodeAttribute('40')]
    #[NameAttribute('New coverage not implemented by HMO')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_40 = 37;

    #[CodeAttribute('41')]
    #[NameAttribute('Black lung')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_41 = 38;

    #[CodeAttribute('42')]
    #[NameAttribute('Veterans Affairs')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_42 = 39;

    #[CodeAttribute('43')]
    #[NameAttribute('Disabled bene under 65 with LGHP')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_43 = 40;

    #[CodeAttribute('44')]
    #[NameAttribute('Amount provider agreed to accept from primary payer')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_44 = 41;

    #[CodeAttribute('45')]
    #[NameAttribute('Accident hour')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_45 = 42;

    #[CodeAttribute('46')]
    #[NameAttribute('Number of grace days')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_46 = 43;

    #[CodeAttribute('47')]
    #[NameAttribute('Any liability insurance')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_47 = 44;

    #[CodeAttribute('48')]
    #[NameAttribute('Hemoglobin reading')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_48 = 45;

    #[CodeAttribute('49')]
    #[NameAttribute('Hematocrit reading')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_49 = 46;

    #[CodeAttribute('50')]
    #[NameAttribute('Physical therapy visits')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_50 = 47;

    #[CodeAttribute('51')]
    #[NameAttribute('Occupational therapy visits')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_51 = 48;

    #[CodeAttribute('52')]
    #[NameAttribute('Speech therapy visits')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_52 = 49;

    #[CodeAttribute('53')]
    #[NameAttribute('Cardiac rehab visits')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_53 = 50;

    #[CodeAttribute('54')]
    #[NameAttribute('Newborn birth weight in grams')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_54 = 51;

    #[CodeAttribute('55')]
    #[NameAttribute('Eligibility threshold for charity care')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_55 = 52;

    #[CodeAttribute('56')]
    #[NameAttribute('Skilled nursing visits hours (HHA)')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_56 = 53;

    #[CodeAttribute('57')]
    #[NameAttribute('HH aide, home visit hours (HHA)')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_57 = 54;

    #[CodeAttribute('58')]
    #[NameAttribute('Arterial blood gas')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_58 = 55;

    #[CodeAttribute('59')]
    #[NameAttribute('Oxygen saturation')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_59 = 56;

    #[CodeAttribute('60')]
    #[NameAttribute('HHA branch MSA')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_60 = 57;

    #[CodeAttribute('61')]
    #[NameAttribute('Arterial blood gas')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_61 = 58;

    #[CodeAttribute('62')]
    #[NameAttribute('HH Visits - Part A (Internal Payer Use Only)')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_62 = 59;

    #[CodeAttribute('63')]
    #[NameAttribute('HH Visits - Part B (Internal Payer Use Only)')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_63 = 60;

    #[CodeAttribute('64')]
    #[NameAttribute('HH Reimbursement - Part A (Internal Payer Only)')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_64 = 61;

    #[CodeAttribute('65')]
    #[NameAttribute('HH Reimbursement - Part B (Internal Payer Only)')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_65 = 62;

    #[CodeAttribute('66')]
    #[NameAttribute('Medicaid spend down amount')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_66 = 63;

    #[CodeAttribute('67')]
    #[NameAttribute('Peritoneal dialysis (HHA)')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_67 = 64;

    #[CodeAttribute('68')]
    #[NameAttribute('EPO - drug')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_68 = 65;

    #[CodeAttribute('69')]
    #[NameAttribute('State charity care percent')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_69 = 66;

    #[CodeAttribute('70')]
    #[NameAttribute('Interest Amount')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_70 = 67;

    #[CodeAttribute('71')]
    #[NameAttribute('Funding of ESRD Networks')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_71 = 68;

    #[CodeAttribute('72')]
    #[NameAttribute('Flat Rate Surgery Charge')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_72 = 69;

    #[CodeAttribute('73')]
    #[NameAttribute('Payer Codes')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_73 = 70;

    #[CodeAttribute('74')]
    #[NameAttribute('Payer Codes')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_74 = 71;

    #[CodeAttribute('75')]
    #[NameAttribute('Payer Codes')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_75 = 72;

    #[CodeAttribute('76')]
    #[NameAttribute("Provider's interim rate (set internally)")]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_76 = 73;

    #[CodeAttribute('77')]
    #[NameAttribute('Medicare new technology add-on payment')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_77 = 74;

    #[CodeAttribute('78')]
    #[NameAttribute('Payer Codes')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_78 = 75;

    #[CodeAttribute('79')]
    #[NameAttribute('Payer Codes')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_79 = 76;

    #[CodeAttribute('80')]
    #[NameAttribute('Covered days')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_80 = 77;

    #[CodeAttribute('81')]
    #[NameAttribute('Non-covered days')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_81 = 78;

    #[CodeAttribute('82')]
    #[NameAttribute('Co-insurance days')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_82 = 79;

    #[CodeAttribute('83')]
    #[NameAttribute('Lifetime reserve days')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_83 = 80;

    #[CodeAttribute('84')]
    #[NameAttribute('Shorter duration, hemodialysis ')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_84 = 81;

    #[CodeAttribute('A0')]
    #[NameAttribute('Special ZIP code reporting')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A0 = 82;

    #[CodeAttribute('A1')]
    #[NameAttribute('Deductible, payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A1 = 83;

    #[CodeAttribute('A2')]
    #[NameAttribute('Co-insurance, payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A2 = 84;

    #[CodeAttribute('A3')]
    #[NameAttribute('Estimated responsibility, payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A3 = 85;

    #[CodeAttribute('A4')]
    #[NameAttribute('Cvrd self-administrable drugs/emergency')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A4 = 86;

    #[CodeAttribute('A5')]
    #[NameAttribute('A Cvrd self-administrable drugs - not self administrable form/situation')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A5 = 87;

    #[CodeAttribute('A6')]
    #[NameAttribute('Cvrd self-administrable drugs - study')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A6 = 88;

    #[CodeAttribute('A7')]
    #[NameAttribute('Co-payment payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A7 = 89;

    #[CodeAttribute('A8')]
    #[NameAttribute('Patient weight')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A8 = 90;

    #[CodeAttribute('A9')]
    #[NameAttribute('Patient height')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_A9 = 91;

    #[CodeAttribute('AA')]
    #[NameAttribute('Regulatory surcharges, assessments, allowances or health care related taxes payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_AA = 92;

    #[CodeAttribute('AB')]
    #[NameAttribute('Other assessments or allowances (e.g., medical education) payer A')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_AB = 93;

    #[CodeAttribute('B1')]
    #[NameAttribute('Deductible Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_B1 = 94;

    #[CodeAttribute('B2')]
    #[NameAttribute('Coinsurance Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_B2 = 95;

    #[CodeAttribute('B3')]
    #[NameAttribute('Estimated Responsibility Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_B3 = 96;

    #[CodeAttribute('B7')]
    #[NameAttribute('Co-payment Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_B7 = 97;

    #[CodeAttribute('BA')]
    #[NameAttribute('Regulatory Surcharges, Assessments, Allowances or Health Care Related Taxes Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_BA = 98;

    #[CodeAttribute('BB')]
    #[NameAttribute('Other Assessments or Allowances (e.g., Medical Education) Payer B')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_BB = 99;

    #[CodeAttribute('C1')]
    #[NameAttribute('Deductible Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_C1 = 100;

    #[CodeAttribute('C2')]
    #[NameAttribute('Coinsurance Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_C2 = 101;

    #[CodeAttribute('C3')]
    #[NameAttribute('Estimated Responsibility Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_C3 = 102;

    #[CodeAttribute('C7')]
    #[NameAttribute('Co-payment Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_C7 = 103;

    #[CodeAttribute('CA')]
    #[NameAttribute('Regulatory Surcharges, Assessments, Allowances or Health Care Related Taxes Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_CA = 104;

    #[CodeAttribute('CB')]
    #[NameAttribute('Other Assessments or Allowances (e.g., Medical Education Payer C')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_CB = 105;

    #[CodeAttribute('D3')]
    #[NameAttribute('Estimated Responsibility Patient')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_D3 = 106;

    #[CodeAttribute('D4')]
    #[NameAttribute('Clinical Trial Number')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_D4 = 107;

    #[CodeAttribute('D5')]
    #[NameAttribute('Result of last Kt/V')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_D5 = 108;

    #[CodeAttribute('D6')]
    #[NameAttribute('The total number of minutes of dialysis provided during the billing period')]
    #[TypeAttribute('Integer')]
    #[PublicAttribute(true)]
    case CODE_VALUE_D6 = 109;

    #[CodeAttribute('DR')]
    #[NameAttribute('Reserved by Disaster Related code')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_DR = 110;

    #[CodeAttribute('E1')]
    #[NameAttribute('Deductible Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_E1 = 111;

    #[CodeAttribute('E2')]
    #[NameAttribute('Coinsurance Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_E2 = 112;

    #[CodeAttribute('E3')]
    #[NameAttribute('Estimated Responsibility Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_E3 = 113;

    #[CodeAttribute('E7')]
    #[NameAttribute('Co-payment Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_E7 = 114;

    #[CodeAttribute('EA')]
    #[NameAttribute('Regulatory Surcharges, Assessments, Allowances or HealthCare Related Taxes Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_EA = 115;

    #[CodeAttribute('EB')]
    #[NameAttribute('Other Assessments or Allowances (e.g., Medical Education) Payer D')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_EB = 116;

    #[CodeAttribute('F1')]
    #[NameAttribute('Deductible Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_F1 = 117;

    #[CodeAttribute('F2')]
    #[NameAttribute('Coinsurance Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_F2 = 118;

    #[CodeAttribute('F3')]
    #[NameAttribute('Estimated Responsibility Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_F3 = 119;

    #[CodeAttribute('F7')]
    #[NameAttribute('Co-payment Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_F7 = 120;

    #[CodeAttribute('FA')]
    #[NameAttribute('Regulatory Surcharges, Assessments, Allowances or HealthCare Related Taxes Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_FA = 121;

    #[CodeAttribute('FB')]
    #[NameAttribute('Other Assessments or Allowances (e.g., Medical Education) Payer E')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_FB = 122;

    #[CodeAttribute('FC')]
    #[NameAttribute('Patient Prior Payments')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_FC = 123;

    #[CodeAttribute('G1')]
    #[NameAttribute('Deductible Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_G1 = 124;

    #[CodeAttribute('G2')]
    #[NameAttribute('Coinsurance Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_G2 = 125;

    #[CodeAttribute('G3')]
    #[NameAttribute('Estimated Responsibility Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_G3 = 126;

    #[CodeAttribute('G7')]
    #[NameAttribute('Co-payment Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_G7 = 127;

    #[CodeAttribute('G8')]
    #[NameAttribute('Facility where inpatient hospice service is delivered')]
    #[TypeAttribute('Unknown')]
    #[PublicAttribute(true)]
    case CODE_VALUE_G8 = 128;

    #[CodeAttribute('GA')]
    #[NameAttribute('Regulatory Surcharges, Assessments, Allowances or HealthCare Related Taxes Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_GA = 129;

    #[CodeAttribute('GB')]
    #[NameAttribute('Other Assessments or Allowances (e.g., Medical Education) Payer F')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_GB = 130;

    #[CodeAttribute('Y1')]
    #[NameAttribute('Part A Demonstration Payment')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_Y1 = 131;

    #[CodeAttribute('Y2')]
    #[NameAttribute('Part B Demonstration Payment')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_Y2 = 132;

    #[CodeAttribute('Y3')]
    #[NameAttribute('Part B Coinsurance (Demonstration Claims)')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_Y3 = 133;

    #[CodeAttribute('Y4')]
    #[NameAttribute('Conventional Provider Payment Amount for Non-Demonstration Claims')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_Y4 = 134;

    #[CodeAttribute('Y5')]
    #[NameAttribute('Part B deductible')]
    #[TypeAttribute('Float')]
    #[PublicAttribute(true)]
    case CODE_VALUE_Y5 = 135;

    public function getType(): string
    {
        return $this->getAttribute(TypeAttribute::class);
    }
}
