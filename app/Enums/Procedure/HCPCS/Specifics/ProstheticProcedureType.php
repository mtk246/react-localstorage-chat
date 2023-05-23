<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ProstheticProcedureType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Partial Foot Prosthetics
    // Ankle Prosthetics
    // Below the Knee Prosthetics
    // Knee Disarticulation Prosthetics
    // Above the Knee Prosthetics
    // Hip Disarticulation Prosthetics
    // Endoskeletal Prosthetics, Lower Limbs
    // Prosthetic Fitting, Immediate Postsurgical or Early, Lower Limbs
    // Supply, Initial Prosthesis
    // Supply, Preparatory Prosthesis
    // Endoskeletal Prosthetic Additions, Lower Extremities
    // Test Socket Prosthetic Additions, Lower Extremities
    // Various Prosthetic Sockets
    // Socket Insert, Suspensions, and Other Prosthetic Additions
    // Replacement Sockets
    // Custom-shaped Protective Covers
    // Exoskeletal Knee-shin System Additions
    // Vacuum Pumps, Lower Limb Prosthetic Additions
    // Other Exoskeletal Additions
    // Endoskeletal Knee or Hip System Additions
    // Ankle and/or Foot Prosthetics and Additions
    // Partial Hand Prosthetics
    // Wrist Disarticulation, Hand Prosthetics
    // Below Elbow, Forearm and Hand Prosthetics
    // Elbow Disarticulation, Forearm and Hand Prosthetics
    // Above Elbow, Forearm and Hand Prosthetics
    // Shoulder Disarticulation, Arm and Hand Prosthetics
    // Interscapular Thoracic, Arm, and Hand Prosthetics
    // Prosthetic Fitting, Immediate Postsurgical or Early, Upper Limbs
    // Molded Socket Endoskeletal Prosthetic System, Upper Limbs
    // Preparatory Prosthetic, Upper Limbs
    // Upper Extremity Prosthetic Additions
    // Terminal Devices and Additions
    // Replacement Sockets, Upper Limbs
    // Hand Restoration Prosthetics and Additions
    // External Power Upper Limb Prosthetics
    // Electric Hand or Hook and Additions
    // Electronic Elbow and Additions
    // Batteries and Accessories
    // Additions for Upper Extremity Prosthetics
    // Upper Extremity Prosthetics, Not Otherwise Specified (NOS)
    // Prosthetic Repair
    // Prosthetic Donning Sleeve
    // Gasket or Seal with Prosthetic
    // Penile Prosthetics
    // Breast Prosthetics and Accessories
    // Facial and External Ear Prosthetics
    // Hernia Trusses
    // Prosthetic Sheaths, Socks, and Shrinkers
    // Unlisted Prosthetic Procedures
    // Voice Prosthetics and Accessories
    // Prosthetic Breast Implant
    // Bulking Agents
    // Implantable Eye and Ear Prosthetics and Accessories
    // Implantable Hand and Feet Prosthetics
    // Vascular Implants
    // Implantable Neurostimulators and Components
    // Miscellaneous Orthotic and Prosthetic Services and Supplies
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
