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

enum CategoryXIIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Infectious arthropathies')]
    #[RangeAttribute('M00', 'M02')]
    #[PublicAttribute(true)]
    case INFECTIOUS_ARTHROPATHIES = 1;

    #[NameAttribute('Autoinflammatory syndromes')]
    #[RangeAttribute('M04', 'M04')]
    #[PublicAttribute(true)]
    case AUTOINFLAMMATORY_SYNDROMES = 2;

    #[NameAttribute('Inflammatory polyarthropathies')]
    #[RangeAttribute('M05', 'M14')]
    #[PublicAttribute(true)]
    case INFLAMMATORY_POLYARTHROPATHIES = 3;

    #[NameAttribute('Osteoarthritis')]
    #[RangeAttribute('M15', 'M19')]
    #[PublicAttribute(true)]
    case OSTEOARTHRITIS = 4;

    #[NameAttribute('Other joint disorders')]
    #[RangeAttribute('M20', 'M25')]
    #[PublicAttribute(true)]
    case OTHER_JOINT_DISORDERS = 5;

    #[NameAttribute('Dentofacial anomalies [including malocclusion] and other disorders of jaw')]
    #[RangeAttribute('M26', 'M27')]
    #[PublicAttribute(true)]
    case DENTOFACIAL_ANOMALIES = 6;

    #[NameAttribute('Systemic connective tissue disorders')]
    #[RangeAttribute('M30', 'M36')]
    #[PublicAttribute(true)]
    case SYSTEMIC_CONNECTIVE_TISSUE_DISORDERS = 7;

    #[NameAttribute('Deforming dorsopathies')]
    #[RangeAttribute('M40', 'M43')]
    #[PublicAttribute(true)]
    case DEFORMING_DORSOPATHIES = 8;

    #[NameAttribute('Spondylopathies')]
    #[RangeAttribute('M45', 'M49')]
    #[PublicAttribute(true)]
    case SPONDYLOPATHIES = 9;

    #[NameAttribute('Other dorsopathies')]
    #[RangeAttribute('M50', 'M54')]
    #[PublicAttribute(true)]
    case OTHER_DORSOPATHIES = 10;

    #[NameAttribute('Disorders of muscles')]
    #[RangeAttribute('M60', 'M63')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_MUSCLES = 11;

    #[NameAttribute('Disorders of synovium and tendon')]
    #[RangeAttribute('M65', 'M67')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_SYNOVIUM_AND_TENDON = 12;

    #[NameAttribute('Other soft tissue disorders')]
    #[RangeAttribute('M70', 'M79')]
    #[PublicAttribute(true)]
    case OTHER_SOFT_TISSUE_DISORDERS = 13;

    #[NameAttribute('Disorders of bone density and structure')]
    #[RangeAttribute('M80', 'M85')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_BONE_DENSITY_AND_STRUCTURE = 14;

    #[NameAttribute('Other osteopathies')]
    #[RangeAttribute('M86', 'M90')]
    #[PublicAttribute(true)]
    case OTHER_OSTEOPATHIES = 15;

    #[NameAttribute('Chondropathies')]
    #[RangeAttribute('M91', 'M94')]
    #[PublicAttribute(true)]
    case CHONDROPATHIES = 16;

    #[NameAttribute('Other disorders of the musculoskeletal system and connective tissue')]
    #[RangeAttribute('M95', 'M95')]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS_OF_MUSCULOSKELETAL_SYSTEM = 17;

    #[NameAttribute('Intraoperative and postprocedural complications and disorders of musculoskeletal system, not elsewhere classified')]
    #[RangeAttribute('M96', 'M96')]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_COMPLICATIONS = 18;

    #[NameAttribute('Periprosthetic fracture around internal prosthetic joint')]
    #[RangeAttribute('M97', 'M97')]
    #[PublicAttribute(true)]
    case PERIPROSTHETIC_FRACTURE = 19;

    #[NameAttribute('Biomechanical lesions, not elsewhere classified')]
    #[RangeAttribute('M99', 'M99')]
    #[PublicAttribute(true)]
    case BIOMECHANICAL_LESIONS = 20;
}
