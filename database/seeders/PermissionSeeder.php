<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Roles\Models\Permission;
use App\Roles\Models\Role;
use App\Models\User;

use DB;

class  PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUserRole = Role::where('slug', 'superuser')->first();
        $billingManagerRole = Role::where('slug', 'billingmanager')->first();
        $billerRole = Role::where('slug', 'biller')->first();
        $paymentProcessorRole = Role::where('slug', 'paymentprocessor')->first();
        $collectorRole = Role::where('slug', 'collector')->first();
        $accountManagerRole = Role::where('slug', 'accountmanager')->first();
        $auditorRole = Role::where('slug', 'auditor')->first();
        $healthProfessionalRole = Role::where('slug', 'healthprofessional')->first();
        $patientRole = Role::where('slug', 'patient')->first();
        $clientRole = Role::where('slug', 'client')->first();
        $developmentSupportRole = Role::where('slug', 'developmentsupport')->first();

        $permissions = [
            [
                'name' => 'Manage permissions for each role',
                'slug' => 'rolePermission.manage',
                'description' => 'Manage permissions for each role'
            ],
            [
                'name' => 'Create Billing Company',
                'slug' => 'billingCompany.create',
                'description' => 'Create Billing Company'
            ],
            [
                'name' => 'View Billing Companies',
                'slug' => 'billingCompany.show',
                'description' => 'View Billing Companies'
            ],
            [
                'name' => 'View Billing Company',
                'slug' => 'billingCompany.showme',
                'description' => 'View Billing Company'
            ],
            [
                'name' => 'Create User',
                'slug' => 'user.create',
                'description' => 'Create User'
            ],
            [
                'name' => 'View Users',
                'slug' => 'user.show',
                'description' => 'View Users'
            ],
            [
                'name' => 'Create Company',
                'slug' => 'company.create',
                'description' => 'Create Company'
            ],
            [
                'name' => 'View Companies',
                'slug' => 'company.show',
                'description' => 'View Companies'
            ],
            [
                'name' => 'Create Facility',
                'slug' => 'facility.create',
                'description' => 'Create Facility'
            ],
            [
                'name' => 'View Facilities',
                'slug' => 'facility.show',
                'description' => 'View Facilities'
            ],
            [
                'name' => 'Create Clearing House',
                'slug' => 'clearingHouse.create',
                'description' => 'Create Clearing House'
            ],
            [
                'name' => 'View Clearing Houses',
                'slug' => 'clearingHouse.show',
                'description' => 'View Clearing Houses'
            ],
            [
                'name' => 'Create Insurance Company',
                'slug' => 'insuranceCompany.create',
                'description' => 'Create Insurance Company'
            ],
            [
                'name' => 'View Insurance Company',
                'slug' => 'insuranceCompany.show',
                'description' => 'View Insurance Company'
            ],
            [
                'name' => 'Create Insurance',
                'slug' => 'insurance.create',
                'description' => 'Create Insurance'
            ],
            [
                'name' => 'View Insurance',
                'slug' => 'insurance.show',
                'description' => 'View Insurance'
            ],
            [
                'name' => 'Create Heatlh Professional',
                'slug' => 'heatlhProfessional.create',
                'description' => 'Create Heatlh Professional'
            ],
            [
                'name' => 'View Heatlh Professional',
                'slug' => 'heatlhProfessional.show',
                'description' => 'View Heatlh Professional'
            ],
            [
                'name' => 'Register a Patient',
                'slug' => 'patient.create',
                'description' => 'Register a Patient'
            ],
            [
                'name' => 'Update or verify personal information',
                'slug' => 'patient.updateverify.personalinfo',
                'description' => 'Update or verify personal information'
            ],
            [
                'name' => 'Update or verify insurance policy information',
                'slug' => 'patient.updateverify.insurancePolicyinfo',
                'description' => 'Update or verify insurance policy information'
            ],
            [
                'name' => 'Create Claim',
                'slug' => 'claim.create',
                'description' => 'Create Claim'
            ],
            [
                'name' => 'Verification and debuggin claim / Send claim',
                'slug' => 'claim.verifydebug',
                'description' => 'Verification and debuggin claim / Send claim'
            ],
            [
                'name' => 'Correct and re-submit claim',
                'slug' => 'claim.correctsubmit',
                'description' => 'Correct and re-submit claim'
            ],
            [
                'name' => 'Generate Appeal',
                'slug' => 'claim.generateappeal',
                'description' => 'Generate Appeal'
            ],
            [
                'name' => 'View Claims',
                'slug' => 'claim.show',
                'description' => 'View Claims'
            ],
            [
                'name' => 'Manage users responsible for a claims',
                'slug' => 'claim.manageusers',
                'description' => 'Manage users responsible for a claims'
            ],

            [
                'name' => 'Register Payment',
                'slug' => 'payment.create',
                'description' => 'Register Payment'
            ],
            [
                'name' => 'Generate patient accounts statements',
                'slug' => 'payment.generatepatientaccount',
                'description' => 'Generate patient accounts statements'
            ],
            [
                'name' => 'Send co-pays and co-insurance',
                'slug' => 'payment.sendcopayscoinsurance',
                'description' => 'Send co-pays and co-insurance'
            ],
            [
                'name' => 'Generate Reports',
                'slug' => 'report.create',
                'description' => 'Generate Reports'
            ],
            [
                'name' => 'View Reports',
                'slug' => 'report.show',
                'description' => 'View Reports'
            ],
            [
                'name' => 'Generate error report',
                'slug' => 'setting.errorreport.create',
                'description' => 'Generate error report'
            ],
            [
                'name' => 'Manage responses in the FAQ forum',
                'slug' => 'setting.responses.manage',
                'description' => 'Manage responses in the FAQ forum'
            ],
            [
                'name' => 'View Profile',
                'slug' => 'setting.profile.show',
                'description' => 'View Profile'
            ],
            [
                'name' => 'View Audit',
                'slug' => 'audit.show',
                'description' => 'View Audit'
            ]
        ];

        $defaultPermissions = [
            'superuser' => [
                'rolePermission.manage',
                'billingCompany.create',
                'billingCompany.show',
                'billingCompany.showme',
                'user.create',
                'user.show',
                'company.create',
                'company.show',
                'facility.create',
                'facility.show',
                'clearingHouse.create',
                'clearingHouse.show',
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insurance.create',
                'insurance.show',
                'heatlhProfessional.create',
                'heatlhProfessional.show',
                'patient.create',
                'patient.updateverify.personalinfo',
                'patient.updateverify.insurancePolicyinfo',
                'claim.create',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'claim.show',
                'claim.manageusers',
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'report.create',
                'report.show',
                'setting.errorreport.create',
                'setting.responses.manage',
                'setting.profile.show',
                'audit.show'
            ],
            'billingmanager' => [
                'billingCompany.showme',
                'user.create',
                'user.show',
                'company.create',
                'company.show',
                'facility.create',
                'facility.show',
                'clearingHouse.create',
                'clearingHouse.show',
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insurance.create',
                'insurance.show',
                'heatlhProfessional.create',
                'heatlhProfessional.show',
                'patient.create',
                'patient.updateverify.personalinfo',
                'patient.updateverify.insurancePolicyinfo',
                'claim.create',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'claim.show',
                'claim.manageusers',
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'report.create',
                'report.show',
                'setting.errorreport.create',
                'setting.responses.manage',
                'setting.profile.show',
                'audit.show'
            ],
            'biller' => [
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insurance.create',
                'insurance.show',
                'patient.create',
                'patient.updateverify.personalinfo',
                'patient.updateverify.insurancePolicyinfo',
                'claim.create',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'claim.show',
                'setting.profile.show'
            ],
            'paymentprocessor' => [
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'setting.profile.show'
            ],
            'collector' => [
                'payment.generatepatientaccount',
                'setting.profile.show'
            ],
            'accountmanager' => [
                'report.create',
                'report.show',
                'setting.profile.show'
            ],
            'auditor' => [
                'audit.show',
                'setting.profile.show'
            ],
            'healthprofessional' => [],
            'patient' => [],
            'client' => [],
            'developmentsupport' => [
                'setting.errorreport.create',
                'setting.responses.manage'
            ],
        ];

        $oldPermissions = Permission::all();

        DB::transaction(function () use ($permissions, $defaultPermissions, $oldPermissions, $superUserRole,
                                         $billingManagerRole, $billerRole, $paymentProcessorRole, $collectorRole,
                                         $accountManagerRole, $auditorRole, $healthProfessionalRole, $patientRole,
                                         $clientRole, $developmentSupportRole) {

            $superUserRole->detachAllPermissions();
            $billingManagerRole->detachAllPermissions();
            $billerRole->detachAllPermissions();
            $paymentProcessorRole->detachAllPermissions();
            $collectorRole->detachAllPermissions();
            $accountManagerRole->detachAllPermissions();
            $auditorRole->detachAllPermissions();
            $healthProfessionalRole->detachAllPermissions();
            $patientRole->detachAllPermissions();
            $clientRole->detachAllPermissions();
            $developmentSupportRole->detachAllPermissions();
            
            foreach ($oldPermissions as $perm) {
                $perm->delete();
            }

            /** Assing permissions to role */

            foreach ($permissions as $permission) {

                $per = Permission::updateOrCreate([
                    'slug' => $permission['slug']
                    ],
                    [
                        'name' => $permission['name'], 'description' => $permission['description']
                    ]
                );
                if ($superUserRole) {
                    $superUserRole->attachPermission($per);
                }
                if ($billingManagerRole && in_array($permission['slug'], $defaultPermissions['billingmanager'])) {
                    $billingManagerRole->attachPermission($per);
                }
                if ($billerRole && in_array($permission['slug'], $defaultPermissions['biller'])) {
                    $billerRole->attachPermission($per);
                }
                if ($paymentProcessorRole && in_array($permission['slug'], $defaultPermissions['paymentprocessor'])) {
                    $paymentProcessorRole->attachPermission($per);
                }
                if ($collectorRole && in_array($permission['slug'], $defaultPermissions['collector'])) {
                    $collectorRole->attachPermission($per);
                }
                if ($accountManagerRole && in_array($permission['slug'], $defaultPermissions['accountmanager'])) {
                    $accountManagerRole->attachPermission($per);
                }
                if ($auditorRole && in_array($permission['slug'], $defaultPermissions['auditor'])) {
                    $auditorRole->attachPermission($per);
                }
                if ($healthProfessionalRole && in_array($permission['slug'], $defaultPermissions['healthprofessional'])) {
                    $healthProfessionalRole->attachPermission($per);
                }
                if ($patientRole && in_array($permission['slug'], $defaultPermissions['patient'])) {
                    $patientRole->attachPermission($per);
                }
                if ($clientRole && in_array($permission['slug'], $defaultPermissions['client'])) {
                    $clientRole->attachPermission($per);
                }
                if ($developmentSupportRole && in_array($permission['slug'], $defaultPermissions['developmentsupport'])) {
                    $developmentSupportRole->attachPermission($per);
                }
            }
            /** Assing permissions to users */
            foreach (User::all() as $usr) {
                $usr->detachAllPermissions();
                if ($usr->hasRole('superuser')) {
                    $perms = Permission::whereHas('roles', function ($query) use ($superUserRole) {
                        $query->where('role_id', $superUserRole->id);
                    })->get();
                    foreach ($perms as $perm) {
                        $usr->attachPermission($perm);
                    }
                }
                if ($usr->hasRole('billingmanager')) {
                    $perms = Permission::whereHas('roles', function ($query) use ($billingManagerRole) {
                        $query->where('role_id', $billingManagerRole->id);
                    })->get();
                    foreach ($perms as $perm) {
                        $usr->attachPermission($perm);
                    }
                }
            }
        });
    }
}
