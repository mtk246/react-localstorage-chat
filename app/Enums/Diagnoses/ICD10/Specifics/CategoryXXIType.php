<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryXXIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Pedestrian injured in transport accident')]
    #[RangeAttribute('V00-V09')]
    #[PublicAttribute(true)]
    case PEDESTRIAN_INJURED = 1;

    #[NameAttribute('Pedal cycle rider injured in transport accident')]
    #[RangeAttribute('V10-V19')]
    #[PublicAttribute(true)]
    case CYCLE_RIDER_INJURED = 2;

    #[NameAttribute('Motorcycle rider injured in transport accident')]
    #[RangeAttribute('V20-V29')]
    #[PublicAttribute(true)]
    case MOTORCYCLE_RIDER_INJURED = 3;

    #[NameAttribute('Occupant of three-wheeled motor vehicle injured in transport accident')]
    #[RangeAttribute('V30-V39')]
    #[PublicAttribute(true)]
    case THREE_WHEELED_VEHICLE_OCCUPANT_INJURED = 4;

    #[NameAttribute('Car occupant injured in transport accident')]
    #[RangeAttribute('V40-V49')]
    #[PublicAttribute(true)]
    case CAR_OCCUPANT_INJURED = 5;

    #[NameAttribute('Occupant of pick-up truck or van injured in transport accident')]
    #[RangeAttribute('V50-V59')]
    #[PublicAttribute(true)]
    case TRUCK_OR_VAN_OCCUPANT_INJURED = 6;

    #[NameAttribute('Occupant of heavy transport vehicle injured in transport accident')]
    #[RangeAttribute('V60-V69')]
    #[PublicAttribute(true)]
    case HEAVY_TRANSPORT_OCCUPANT_INJURED = 7;

    #[NameAttribute('Bus occupant injured in transport accident')]
    #[RangeAttribute('V70-V79')]
    #[PublicAttribute(true)]
    case BUS_OCCUPANT_INJURED = 8;

    #[NameAttribute('Other land transport accidents')]
    #[RangeAttribute('V80-V89')]
    #[PublicAttribute(true)]
    case OTHER_LAND_TRANSPORT_ACCIDENTS = 9;

    #[NameAttribute('Water transport accidents')]
    #[RangeAttribute('V90-V94')]
    #[PublicAttribute(true)]
    case WATER_TRANSPORT_ACCIDENTS = 10;

    #[NameAttribute('Air and space transport accidents')]
    #[RangeAttribute('V95-V97')]
    #[PublicAttribute(true)]
    case AIR_SPACE_TRANSPORT_ACCIDENTS = 11;

    #[NameAttribute('Other and unspecified transport accidents')]
    #[RangeAttribute('V98-V99')]
    #[PublicAttribute(true)]
    case OTHER_UNSPECIFIED_TRANSPORT_ACCIDENTS = 12;

    #[NameAttribute('Slipping, tripping, stumbling and falls')]
    #[RangeAttribute('W00-W19')]
    #[PublicAttribute(true)]
    case SLIPPING_TRIPPING_FALLS = 13;

    #[NameAttribute('Exposure to inanimate mechanical forces')]
    #[RangeAttribute('W20-W49')]
    #[PublicAttribute(true)]
    case EXPOSURE_TO_INANIMATE_MECHANICAL_FORCES = 14;

    #[NameAttribute('Exposure to animate mechanical forces')]
    #[RangeAttribute('W50-W64')]
    #[PublicAttribute(true)]
    case EXPOSURE_TO_ANIMATE_MECHANICAL_FORCES = 15;

    #[NameAttribute('Accidental non-transport drowning and submersion')]
    #[RangeAttribute('W65-W74')]
    #[PublicAttribute(true)]
    case ACCIDENTAL_NON_TRANSPORT_DROWNING = 16;

    #[NameAttribute('Exposure to electric current, radiation and extreme ambient air temperature and pressure')]
    #[RangeAttribute('W85-W99')]
    #[PublicAttribute(true)]
    case EXPOSURE_TO_ELECTRIC_CURRENT = 17;

    #[NameAttribute('Exposure to smoke, fire and flames')]
    #[RangeAttribute('X00-X08')]
    #[PublicAttribute(true)]
    case EXPOSURE_TO_SMOKE_FIRE_FLAMES = 18;

    #[NameAttribute('Contact with heat and hot substances')]
    #[RangeAttribute('X10-X19')]
    #[PublicAttribute(true)]
    case CONTACT_WITH_HEAT_HOT_SUBSTANCES = 19;

    #[NameAttribute('Exposure to forces of nature')]
    #[RangeAttribute('X30-X39')]
    #[PublicAttribute(true)]
    case EXPOSURE_TO_FORCES_OF_NATURE = 20;

    #[NameAttribute('Overexertion and strenuous or repetitive movements')]
    #[RangeAttribute('X50-X50')]
    #[PublicAttribute(true)]
    case OVEREXERTION_STRENUOUS_MOVEMENTS = 21;

    #[NameAttribute('Accidental exposure to other specified factors')]
    #[RangeAttribute('X52-X58')]
    #[PublicAttribute(true)]
    case ACCIDENTAL_EXPOSURE_OTHER_FACTORS = 22;

    #[NameAttribute('Intentional self-harm')]
    #[RangeAttribute('X71-X83')]
    #[PublicAttribute(true)]
    case INTENTIONAL_SELF_HARM = 23;

    #[NameAttribute('Assault')]
    #[RangeAttribute('X92-Y09')]
    #[PublicAttribute(true)]
    case ASSAULT = 24;

    #[NameAttribute('Event of undetermined intent')]
    #[RangeAttribute('Y21-Y33')]
    #[PublicAttribute(true)]
    case UNDETERMINED_INTENT = 25;

    #[NameAttribute('Legal intervention, operations of war, military operations, and terrorism')]
    #[RangeAttribute('Y35-Y38')]
    #[PublicAttribute(true)]
    case LEGAL_INTERVENTION_WAR_TERRORISM = 26;

    #[NameAttribute('Misadventures to patients during surgical and medical care')]
    #[RangeAttribute('Y62-Y69')]
    #[PublicAttribute(true)]
    case MISADVENTURES_PATIENTS = 27;

    #[NameAttribute('Medical devices associated with adverse incidents in diagnostic and therapeutic use')]
    #[RangeAttribute('Y70-Y82')]
    #[PublicAttribute(true)]
    case MEDICAL_DEVICES_ADVERSE_INCIDENTS = 28;

    #[NameAttribute('Surgical and other medical procedures as the cause of abnormal reaction of the patient, or of later complication, without mention of misadventure at the time of the procedure')]
    #[RangeAttribute('Y83-Y84')]
    #[PublicAttribute(true)]
    case SURGICAL_MEDICAL_PROCEDURES = 29;

    #[NameAttribute('Supplementary factors related to causes of morbidity classified elsewhere')]
    #[RangeAttribute('Y90-Y99')]
    #[PublicAttribute(true)]
    case SUPPLEMENTARY_FACTORS = 30;
}
