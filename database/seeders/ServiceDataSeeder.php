<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceApplicableTo;
use App\Models\ServiceGroup;
use App\Models\ServiceType;
use App\Models\ServiceTypeOfService;
use App\Models\ServiceRevCenter;
use App\Models\ServiceStmtDescription;
use App\Models\ServiceSpecialInstruction;

class ServiceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceApplicableTo = [
            ['applicable_to' => 'Male'],
            ['applicable_to' => 'Female'],
            ['applicable_to' => 'Both']
        ];

        foreach ($serviceApplicableTo as $applicableTo) {

            ServiceApplicableTo::updateOrCreate($applicableTo, $applicableTo);
        }

        $serviceGroups = [
            ['group' => 'EM - Evaluation & Management'],
            ['group' => 'LB - LAB'],
            ['group' => 'MI - Miscellaneous'],
            ['group' => 'PR - Procedures'],
            ['group' => 'SU - Surgery'],
            ['group' => 'XR - X Ray / Radiology']
        ];

        foreach ($serviceGroups as $group) {

            ServiceGroup::updateOrCreate($group, $group);
        }

        $serviceTypes = [
            ['type' => 'C - CPT'],
            ['type' => 'O - Office'],
            ['type' => 'V - Vode Codes'],
            ['type' => 'R - Revenue Codes'],
            ['type' => 'I - Inventory Virtual'],
            ['type' => 'D - DRG'],
            ['type' => 'E - Expl']
        ];

        foreach ($serviceTypes as $type) {

            ServiceType::updateOrCreate($type, $type);
        }

        $serviceTypeOfServices = [
            ['type_of_service' => '01 - Medical Care'],
            ['type_of_service' => '02 - Surgery'],
            ['type_of_service' => '03 - Consultation'],
            ['type_of_service' => '04 - Diagnostic X-Ray'],
            ['type_of_service' => '05 - Diagnostic Lab'],
            ['type_of_service' => '06 - Radiation Therapy'],
            ['type_of_service' => '07 - Anesthesia'],
            ['type_of_service' => '08 - Surgical Assistance'],
            ['type_of_service' => '09 - Other Medical'],
            ['type_of_service' => '10 - Blood Charges'],
            ['type_of_service' => '11 - Used DME'],
            ['type_of_service' => '12 - DME Purchase'],
            ['type_of_service' => '13 - ASC Facility'],
            ['type_of_service' => '14 - Renal Supplies In the Home'],
            ['type_of_service' => '15 - Alternate Method Dialysis Payment'],
            ['type_of_service' => '16 - CRD Equipment'],
            ['type_of_service' => '17 - Pre-Admission Testing'],
            ['type_of_service' => '18 - DME Renal'],
            ['type_of_service' => '19 - Pneumonia Vaccine'],
            ['type_of_service' => '20 - Second Surgical Opinion'],
            ['type_of_service' => '21 - Third Surgical Opinion'],
            ['type_of_service' => '22 - Third Surgical Opinion'],
            ['type_of_service' => '99 - Other Used For prescription drugsMedical Care'],
            ['type_of_service' => 'MA - Mammography']

        ];

        foreach ($serviceTypeOfServices as $typeOfService) {

            ServiceTypeOfService::updateOrCreate($typeOfService, $typeOfService);
        }

        $serviceRevCenters = [
            ['rev_center' => 'AD - Administrative Charge'],
            ['rev_center' => 'CO - Consultations'],
            ['rev_center' => 'DM - DME Charge'],
            ['rev_center' => 'EP - Established Patient Visit'],
            ['rev_center' => 'HV - Hospital Visits'],
            ['rev_center' => 'IN - Injections'],
            ['rev_center' => 'LB - Lab'],
            ['rev_center' => 'ME - Medications'],
            ['rev_center' => 'MI - Miscellaneous'],
            ['rev_center' => 'NP - New Patient Visit'],
            ['rev_center' => 'PR - Procedures'],
            ['rev_center' => 'RA - Radiology'],
            ['rev_center' => 'SP - Supplies'],
            ['rev_center' => 'SU - Surgery']
        ];

        foreach ($serviceRevCenters as $revCenter) {

            ServiceRevCenter::updateOrCreate($revCenter, $revCenter);
        }

        $serviceStmtDescriptions = [
            ['stmt_description' => 'HV - Hospital Visit'],
            ['stmt_description' => 'IN - Injection'],
            ['stmt_description' => 'LB - Lab Test'],
            ['stmt_description' => 'ME - Medication'],
            ['stmt_description' => 'OV - Office Visit'],
            ['stmt_description' => 'PR - Procedure'],
            ['stmt_description' => 'SP - Supplies'],
            ['stmt_description' => 'SU - Surgery'],
            ['stmt_description' => 'XR - X Ray / Radiology'],
            ['stmt_description' => 'XX - Do not Show On Patient Statement']
        ];

        foreach ($serviceStmtDescriptions as $stmtDescription) {

            ServiceStmtDescription::updateOrCreate($stmtDescription, $stmtDescription);
        }

        $serviceSpecialInstructions = [
            ['special_instruction' => 'BR - Op Report Required'],
            ['special_instruction' => 'PO - Paper Only']
        ];

        foreach ($serviceSpecialInstructions as $specialInstruction) {

            ServiceSpecialInstruction::updateOrCreate($specialInstruction, $specialInstruction);
        }
    }
}
