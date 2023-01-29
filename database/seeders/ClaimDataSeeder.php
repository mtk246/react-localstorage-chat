<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeForm;
use App\Models\TypeDiag;
use App\Models\ClaimStatus;
use App\Models\ClaimTransmissionStatus;
use App\Models\TypeOfService;
use App\Models\PlaceOfService;
use App\Models\PayerResponsibility;
use App\Models\ClaimEligibilityStatus;

class ClaimDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeForms = [
            ['form' => 'CMS-1500 / 837P'],
            ['form' => 'UB-04 / 837I'],
        ];

        foreach ($typeForms as $form) {
            TypeForm::updateOrCreate($form, $form);
        }

        $claimStatus = [
            ['status' => 'Draft',                    'background_color' => '#F2F2F2', 'font_color' => '#707070'],
            ['status' => 'Verified - Not submitted', 'background_color' => '#FBECDD', 'font_color' => '#B04D12'],
            ['status' => 'Submitted',                'background_color' => '#FFFAEC', 'font_color' => '#B04D12'],
            ['status' => 'Approved',                 'background_color' => '#E9FDF2', 'font_color' => '#1B6D49'],
            ['status' => 'Rejected',                 'background_color' => '#FFF1F1', 'font_color' => '#A72821'],
            ['status' => 'Denied',                   'background_color' => '#FFDEDC', 'font_color' => '#A72821'],
            ['status' => 'Complete',                 'background_color' => '#D1FFE5', 'font_color' => '#1B6D49']
            //['status' => 'Appel',                    'background_color' => '#E3F8FF', 'font_color' => '#018ECC']
        ];

        foreach ($claimStatus as $status) {
            ClaimStatus::updateOrCreate([
                'status' => $status['status']
            ], $status);
        }

        $serviceTypeOfServices = [
            ['code' => '0', 'name' => 'Whole Blood'],
            ['code' => '1', 'name' => 'Medical Care'],
            ['code' => '2', 'name' => 'Surgery'],
            ['code' => '3', 'name' => 'Consultation'],
            ['code' => '4', 'name' => 'Diagnostic Radiology'],
            ['code' => '5', 'name' => 'Diagnostic Laboratory'],
            ['code' => '6', 'name' => 'Therapeutic Radiology'],
            ['code' => '7', 'name' => 'Anesthesia'],
            ['code' => '8', 'name' => 'Assistant at Surgery'],
            ['code' => '9', 'name' => 'Other Medical Items or Services'],
            ['code' => 'A', 'name' => 'Used DME'],
            ['code' => 'B', 'name' => 'High Risk Screening Mammography'],
            ['code' => 'C', 'name' => 'Low Risk Screening Mammography'],
            ['code' => 'D', 'name' => 'Ambulance'],
            ['code' => 'E', 'name' => 'Enteral/Parenteral Nutrients/Supplies'],
            ['code' => 'F', 'name' => 'Ambulatory Surgical Center (Facility Usage for Surgical Services)'],
            ['code' => 'G', 'name' => 'Immunosuppressive Drugs'],
            ['code' => 'H', 'name' => 'Hospice'],
            ['code' => 'J', 'name' => 'Diabetic Shoes'],
            ['code' => 'K', 'name' => 'Hearing Items and Services'],
            ['code' => 'L', 'name' => 'ESRD Supplies'],
            ['code' => 'M', 'name' => 'Monthly Capitation Payment for Dialysis'],
            ['code' => 'N', 'name' => 'Kidney Donor'],
            ['code' => 'P', 'name' => 'Lump Sum Purchase of DME, Prosthetics, Orthotics'],
            ['code' => 'Q', 'name' => 'Vision Items or Services'],
            ['code' => 'R', 'name' => 'Rental of DME'],
            ['code' => 'S', 'name' => 'Surgical Dressings or Other Medical Supplies'],
            ['code' => 'T', 'name' => 'Outpatient Mental Health Treatment Limitation'],
            ['code' => 'U', 'name' => 'Occupational Therapy'],
            ['code' => 'V', 'name' => 'Pneumococcal/Flu Vaccine'],
            ['code' => 'W', 'name' => 'Physical Therapy']
        ];

        foreach ($serviceTypeOfServices as $typeOfService) {
            TypeOfService::updateOrCreate($typeOfService, $typeOfService);
        }

        $servicePlaceOfServices = [
            ['code' => '03', 'name' => 'School'],
            ['code' => '04', 'name' => 'Homeless Shelter'],
            ['code' => '05', 'name' => 'Indian Health Service Free-Standing Facility'],
            ['code' => '06', 'name' => 'Indian Health Service Provider-Based Facility'],
            ['code' => '07', 'name' => 'Tribal 638 Free-Standing Facility'],
            ['code' => '08', 'name' => 'Tribal 638 Provider Based-Facility'],
            ['code' => '11', 'name' => 'Office Visit'],
            ['code' => '12', 'name' => 'Home'],
            ['code' => '13', 'name' => 'Assisted Living'],
            ['code' => '14', 'name' => 'Group Home'],
            ['code' => '15', 'name' => 'Mobile Unit'],
            ['code' => '20', 'name' => 'Urgent Care Facility'],
            ['code' => '21', 'name' => 'Inpatient Hospital'],
            ['code' => '22', 'name' => 'Outpatient Hospital'],
            ['code' => '23', 'name' => 'Emergency Room'],
            ['code' => '24', 'name' => 'Ambulatory Surgical Center'],
            ['code' => '25', 'name' => 'Birthing Center'],
            ['code' => '26', 'name' => 'Military Treatment Facility'],
            ['code' => '31', 'name' => 'Skilled Nursing Facility'],
            ['code' => '32', 'name' => 'Nursing Facility'],
            ['code' => '33', 'name' => 'Custodial Care Facility'],
            ['code' => '34', 'name' => 'Hospice'],
            ['code' => '41', 'name' => 'Ambulance - Land'],
            ['code' => '42', 'name' => 'Ambulance - Air or Water'],
            ['code' => '50', 'name' => 'Federally Qualified Health Center'],
            ['code' => '51', 'name' => 'Inpatient Psychiatric Facility'],
            ['code' => '52', 'name' => 'Psychiatric Facility Partial Hospitalization'],
            ['code' => '53', 'name' => 'Community Mental Health Center'],
            ['code' => '54', 'name' => 'Intermediate Care Facility'],
            ['code' => '55', 'name' => 'Residential Substance Abuse Treatment Facility'],
            ['code' => '56', 'name' => 'Psychiatric Residential Treatment Center'],
            ['code' => '60', 'name' => 'Mass Immunization Center'],
            ['code' => '61', 'name' => 'Comprehensive Inpatient Rehab Facility'],
            ['code' => '62', 'name' => 'Comprehensive Outpatient Rehab Facility'],
            ['code' => '65', 'name' => 'End Stage Renal Disease Treatment Facility'],
            ['code' => '71', 'name' => 'State or Local Public Health Clinic'],
            ['code' => '2 ', 'name' => 'Rural Health Clinic'],
            ['code' => '81', 'name' => 'Independent Laboratory'],
            ['code' => '99', 'name' => 'Other Unlisted Facility'],
        ];

        foreach ($servicePlaceOfServices as $placeOfService) {
            PlaceOfService::updateOrCreate($placeOfService, $placeOfService);
        }

        $payerResponsibilities = [
            ['code' => 'A', 'description' => 'Payer Responsibility Four'],
            ['code' => 'B', 'description' => 'Payer Responsibility Five'],
            ['code' => 'C', 'description' => 'Payer Responsibility Six'],
            ['code' => 'D', 'description' => 'Payer Responsibility Seven'],
            ['code' => 'E', 'description' => 'Payer Responsibility Eight'],
            ['code' => 'F', 'description' => 'Payer Responsibility Nine'],
            ['code' => 'G', 'description' => 'Payer Responsibility Ten'],
            ['code' => 'H', 'description' => 'Payer Responsibility Eleven'],
            ['code' => 'P', 'description' => 'Primary'],
            ['code' => 'S', 'description' => 'Secondary'],
            ['code' => 'T', 'description' => 'Tertiary'],
            ['code' => 'U', 'description' => 'Unknow'],
        ];

        foreach ($payerResponsibilities as $payerResponsibility) {
            PayerResponsibility::updateOrCreate($payerResponsibility, $payerResponsibility);
        }

        $eligibilityStatuses = [
            ['status' => 'Eligible policy',   'background_color' => '#E9FDF2', 'font_color' => '#1B6D49'],
            ['status' => 'Ineligible policy', 'background_color' => '#FBECDD', 'font_color' => '#B04D12'],
            ['status' => 'Unknow',            'background_color' => '#FFF1F1', 'font_color' => '#A72821']
        ];

        foreach ($eligibilityStatuses as $eligibilityStatus) {
            ClaimEligibilityStatus::updateOrCreate([
                'status' => $eligibilityStatus
            ], $eligibilityStatus);
        }

        $typeDiags = [
            ['code' => 'A', 'description' => 'Allergy'],
            ['code' => 'C', 'description' => 'Chronic'],
            ['code' => 'D', 'description' => 'Problem List'],
            ['code' => 'O', 'description' => 'Other'],
            ['code' => 'P', 'description' => 'Pre Existing Condition'],
            ['code' => 'S', 'description' => 'Self Limiting'],
            ['code' => 'U', 'description' => 'Acute']
        ];

        foreach ($typeDiags as $type) {
            TypeDiag::updateOrCreate($type, $type);
        }


        $claimTransmissionStatus = [
            ['status' => 'Success',    'background_color' => '#E9FDF2', 'font_color' => '#1B6D49'],
            ['status' => 'In process', 'background_color' => '#FBECDD', 'font_color' => '#B04D12'],
            ['status' => 'Error',      'background_color' => '#FFF1F1', 'font_color' => '#A72821'],
        ];

        foreach ($claimTransmissionStatus as $transmissionStatus) {
            ClaimTransmissionStatus::updateOrCreate([
                'status' => $status['status']
            ], $transmissionStatus);
        }
    }
}
